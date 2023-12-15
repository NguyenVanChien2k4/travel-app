<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginControllers extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function register() {
        return view('login.register');
    }

    public function store(Request $request) {

        $userCheck = User::where('email', $request->post('email'))->count();
        $avatar = './storage/avatar_user.jpg';
        $status = 'Email đã được đăng ký cho tài khoản khác!';

        if($userCheck > 0) {
            return redirect('/register')->with('status', $status);
        } else {

            $user = User::create([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'role' => $request->post('role'),
                'password' => $request->post('password'),
                'address' => $request->post('province'),
                'phone' => $request->post('phone'),
                'birth' => $request->post('birth'),
                'gender' => $request->post('gender'),
                'point' => 10,
                'avatar' => $avatar
            ]);
            $user->save();
            return redirect('/');
        }

    }

    public function checkLogin(Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');

        $count = User::where(['email' => $email, 'password' => $password])->count();
        $user = User::where(['email' => $email, 'password' => $password])->first();

        if($count > 0) {
            $this->saveSession($email, $password);
            if($user->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/home');
            }
        } else {
            return redirect('/')->with('status', 'Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }
    public function saveSession( $email, $password ) {
        $user = User::where(['email' => $email])->first();
        Session::put('id', $user->id);
        Session::put('avatar', $user->avatar);
    }

}
