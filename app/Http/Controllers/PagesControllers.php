<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Tours;
use App\Models\Picks;
use App\Models\User;
use App\Models\Supports;
use App\Models\GroupTours;

class PagesControllers extends Controller
{
    
    public function home() {
        $addressType = 'Trong nước';

        $date = Carbon::now()->format('Y-m-d');

        Tours::where('start_day', '<', $date)
            ->update(['status' => 0]);

        $tours_near = DB::table('tours')
                        ->where('status', '>', 0)
                        ->where('start_day', '>', now())
                        ->where('start_day', '<=', Carbon::now()->addDays(10)->format('Y-m-d'))
                        ->get();
        $tours_in = DB::table('tours')
                        ->where('status', '>', 0)
                        ->where('addresstype', $addressType)
                        ->limit(5)
                        ->get();

        $picks = DB::table('picks')->orderByDesc('picks')->limit(4)->get();

        GroupTours::where('end_day', '<', $date)->delete();

        $groupTours = DB::table('group_tours')->orderByDesc('start_day')->limit(3)->get();

        $sales = DB::table('sales')->get();

        $this->loadPlaces();

        return view("pages.home", [
            'tours_near' => $tours_near,
            'tours_in' => $tours_in,
            'picks' => $picks,
            'groups' => $groupTours,
            'sales' => $sales
        ]);
    }

    public function tour(Request $request) {

        $this->loadPlaces();

        $id = $request->get('id');
        $tours = Tours::find($id);

        $toursPropose = DB::table('tours')
                        ->where('status', '>', 0)
                        ->where('id', '!=', $id)
                        ->limit(5)
                        ->get();

        $toursDetails = DB::table('detail_tours')
                            ->where('id_tour', $id)
                            ->get();

        $priceTypes = DB::table('price_types')->get();

        $picks = DB::table('picks')->where('name', $tours->desstination)->first();

        $missions = DB::table('missions')
                        ->where('id_tour', $id)
                        ->get();

        $guide_1 = null;
        $guide_2 = null;

        foreach($missions as $mission) {
            if($mission->role == 0) {
                $guide_1 = DB::table('tour_guides')
                    ->where('id', $mission->id_guide)
                    ->first();
            } else {
                $guide_2 = DB::table('tour_guides')
                    ->where('id', $mission->id_guide)
                    ->first();
            }
        }

        return view("pages.tour", [
            'tours' => $tours,
            'toursDetails' => $toursDetails,
            'priceTypes' => $priceTypes,
            'toursPropose' => $toursPropose,
            'guide_1' => $guide_1,
            'guide_2' => $guide_2,
            'desc' => $picks->desc,
        ]);
        
    }

    public function booking(Request $request) {

        $this->loadPlaces();

        $id = $request->get('id');
        $tour = DB::table('tours')
                    ->where('id', $id)
                    ->first();
        
        $typePrice = DB::table('price_types')->get();

        $id_user = Session::get('id');
        $user = User::find($id_user);

        $services = DB::table('services')
                    ->where('point_start', '<=', $user->point)
                    ->where('point_end', '>=', $user->point)
                    ->first();
        $precent = $services->sale;

        return view("pages.booking", [
            'tour' => $tour,
            'typePrices' => $typePrice,
            'user' => $user,
            'precent' => $precent,
        ]);
    }

    public function addBooking(Request $request) {

        $id_user = Session::get('id');
        $id_tour = $request->post('id_tour');

        $tourExists = Tours::where('id', $id_tour)->exists();

        if (!$tourExists) {
        }

        $id_tour = $request->post('id_tour');
        $name = $request->post('name');
        $phone = $request->post('phone');
        $address = $request->post('address');
        $email = $request->post('email');
        $adult = $request->post('type_1');
        $children = $request->post('type_2');
        $young = $request->post('type_3');
        $baby = $request->post('type_4');
        $note = $request->post('note');
        $pay = $request->post('pay');
        $price = $request->post('price');
        $sale = $request->post('price_sale');
        $total = $adult + $children + $young + $baby;
        $book = Booking::create([
            'user_id' => $id_user,
            'tour_id' => $id_tour,
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
            'adult' => $adult,
            'children' => $children,
            'young' => $young,
            'baby' => $baby,
            'note' => $note,
            'pay' => $pay,
            'price' => $price,
            'sale' => $sale
        ]);
        $book->save();

        $order = DB::table('picks')->where('id', $id_tour)->first();
        $totalOrder = $order->picks + $total;

        $tourOrder = DB::table('tours')->where('id', $id_tour)->first();

        Tours::where( 'id', $id_tour)
                ->update(['ordered' => $tourOrder->ordered + $total]);

        Picks::where( 'name', $tourOrder->desstination)
                ->update(['picks' => $totalOrder]);
        
        $point = DB::table('users')->where('id', $id_user)->first();
        $totalPoint = $point->point + $total * 10;

        User::where( 'id', $id_user)
                ->update(['point' => $totalPoint]);

        return redirect('/home');
    }

    public function contacts() {

        $this->loadPlaces();

        $id_user = Session::get('id');
        $user = User::find($id_user);

        return view("pages.contacts", [
            'user' => $user,
        ]);
    }

    public function saveContacts(Request $request) {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $support = Supports::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'content' => $request->input('content'),
            'date' => $date
        ]);

        $support->save();

        return redirect('/home');
    }
    
    public function account() {

        $this->loadPlaces();

        $id_user = Session::get('id');
        $user = User::find($id_user);

        $bookings = $user->bookings;

        $services = DB::table('services')->get();

        return view("pages.account", [
            'user' => $user,
            'bookings' => $bookings,
            'services' => $services,
        ]);
    }

    public function loadPlaces() {

        $places = DB::table('picks')->get();
        view()->share('places', $places);

    }

    public function deleteBooking($id) {

        $booking = DB::table('bookings')->where('id', $id)->first();

        $tour = DB::table('tours')->where('id', $booking->tour_id)->first();
        $quantity = $booking->adult + $booking->children + $booking->young + $booking->baby;
        $addressTour = $tour->desstination;

        $picks = Picks::where('name', $addressTour)->first();
        $picksQuantity = $picks->picks - $quantity;

        $pickUpdate = Picks::where('name', $addressTour)->update(['picks' => $picksQuantity]);

        $tourUpdate = Tours::where('id', $booking->tour_id)->update(['ordered' => $tour->ordered - $quantity]);

        $bookingDelete = Booking::where('id', $id)->delete();

        return redirect('/account');
    }

    public function showAccount() {

        $this->loadPlaces();

        $id_user = Session::get('id');
        $user = User::find($id_user);

        return view("form.index", [
            'user' => $user,
        ]);
    }

    public function editAccount(Request $request) {
        $this->loadPlaces();

        $id_user = Session::get('id');

        User::where('id', $id_user)->update([
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'address' => $request->input('province'),
            'phone' => $request->input('phone'),
            'birth' => $request->input('birth'),
            'gender' => $request->input('gender'),
        ]);

        return redirect('/account');

    }

    public function avatarUpdate(Request $request) {
        $id_user = Session::get('id');
        
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $request->file('avatar')->guessExtension();   
        
        $extension = $request->file('avatar')->getClientOriginalExtension();

        $generatedImageName = './storage/image' . time() . '-000'
                                . $id_user . '.' 
                                . $extension;
        
        $request->file('avatar')->move(public_path('storage'), $generatedImageName);

        User::where('id', $id_user)->update([
            'avatar' => $generatedImageName,
        ]);

        return redirect('/account');
    }

}
