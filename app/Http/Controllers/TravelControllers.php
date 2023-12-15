<?php

namespace App\Http\Controllers;

use App\Models\Picks;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Tours;
use App\Models\GroupTours;

class TravelControllers extends Controller
{
    public $totalPage;
    public function __construct() {
        $this->totalPage = 1;
    }

    public function index(Request $request) {

        $places = DB::table('picks')->get();
        view()->share('places', $places);

        $type = $request->get('type');
        $seach = $request->get('seach');
        $start = $request->get('start');
        $soNguoi = $request->get('SoNguoi');
        $soNgay = $request->get('SoNgay');
        $Dongtour = $request->get('Dongtour');
        $page = $request->get('page') ? $request->get('page') : 1;
        $limitPages = 9;

        if(!$Dongtour) {
            $Dongtour = 'null';
        }

        $day = $request->get('day');

        if(!$day) {
            $day = 'null';
        }

        $tours = null;
        $start_plase = null;
        $end_plase = null;
        $desc = null;
        $title = '';
        $desc_type = '';
        $desstination = '';

        $picks = DB::table('picks')->orderByDesc('picks')->limit(4)->get();
        
        $start_plase = Tours::select('departure')
                        ->groupBy('departure')
                        ->get();

        if($type) {
            
            $end_plase = Tours::select('desstination')
                        ->groupBy('desstination')
                        ->get();

            $groupTours = DB::table('group_tours')->where('id', $type)->first();

            $desc_type = $groupTours->desc;

            $title = $groupTours->name;
            $toursQuery = DB::table('tours')
                        ->where('status', '>', 0)
                        ->where('start_day', '>', $groupTours->start_day)
                        ->where('end_day', '<=', $groupTours->end_day);

            if($seach != 'null') {

                $desstination = $seach;
    
                if($start && $start != 'null') {
                    if($soNguoi) {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 0, 100);
                        }
                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 0, 100);
                        }
                    }
                } else {
                    if($soNguoi) {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 0, 100);
                        }
                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 0, 100 );
                        }
                    }
                }
                
            } else {
                if($start && $start != 'null') {
                    if($soNguoi) {

                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_start_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_start_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_start_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_start_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_start_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 0, 100);
                        }

                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_start_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_start_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_start_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_start_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_start_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, 0, 100);
                        }
                    }

                } else {
                    if($soNguoi) {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, 0, 100);
                        }
                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, 0, 100);
                        }
                    }
        
                }
                            
            }

        } else if($seach) {

            if($seach != 'null') {
                $title = $seach;

                $desstination = $title;
   
                $desc = DB::table('picks')
                    ->where('name', $seach)
                    ->first();

                $end_plase = Picks::select('name')
                    ->where('area', $desc->area)
                    ->get();
    
                if($start && $start != 'null') {
                    if($soNguoi) {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_start_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_start_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_start_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_start_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_start_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 0, 100);
                        }
                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_start_end_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_start_end_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_start_end_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_start_end_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_start_end_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 0, 100);
                        }
                    }
                } else {
                    if($soNguoi) {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 0, 100);
                        }
                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 0, 100);
                        }
                    }
                }
                
            } else {
                $title = "Trong nước";

                $end_plase = Tours::select('desstination')
                ->where('addresstype', $title)
                ->groupBy('desstination')
                ->get();
                
                if($start && $start != 'null') {
                    if($soNguoi) {

                        if($soNgay == '1-3') {
                            $tours = $this->tours_start_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_start_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_start_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_start_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_start_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, 0, 100);
                        }

                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_start_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_start_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_start_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_start_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_start_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, 0, 100);
                        }
                    }

                } else {
                    if($soNguoi) {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, 0, 100);
                        }
                    } else {
                        if($soNgay == '1-3') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 1, 3);
                        } else if ($soNgay == '4-7') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 4, 7);
                        } else if ($soNgay == '8-14') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 8, 14);
                        } else if ($soNgay == '15') {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 14, 100);
                        } else {
                            $tours = $this->tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, 0, 100);
                        }
                    }
        
                }
                            
            }

        }

        return view('pages.travel', [
            'tours' => $tours,
            'title' => $title,
            'start' => $start,
            'desstination' => $desstination,
            'start_place' => $start_plase,
            'end_place' => $end_plase,
            'desc' => $desc,
            'desc_type' => $desc_type,
            'SoNgay' => $soNgay,
            'SoNguoi' => $soNguoi,
            'Dongtour' => $Dongtour,
            'picks' => $picks,
            'day' => $day,
            'totalPage' => $this->totalPage,
            'page' => $page,
        ]);
    }

    public function tours_start_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, $x, $y ) {
        if($Dongtour != 'null') {
            $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('departure', $start)
                    ->where('desstination', $title)
                    ->where('type_tour', $Dongtour)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        } else {
            $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('departure', $start)
                    ->where('desstination', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        }
        return $tours;
    }

    public function tours_start_end_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, $x, $y ) {
        if($Dongtour != 'null') {
            $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('departure', $start)
                    ->where('desstination', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('type_tour', $Dongtour);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        } else {
            $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('desstination', $title);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        }
        return $tours;
    }

    public function tours_end_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $Dongtour, $day, $x, $y ) {
        if($Dongtour != 'null') {
            if($title == "Trong nước") {
                $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('addresstype', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('type_tour', $Dongtour)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                    });
                }
                $count = $toursQuery->count();

                $startPages = $this->handlePages( $count, $limitPages, $page);
                $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
            } else {
                $toursQuery = DB::table('tours')
                        ->where('status', '>', 0)
                        ->where('desstination', $title)
                        ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                        ->where('type_tour', $Dongtour)
                        ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
                if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                    });
                }
                $count = $toursQuery->count();

                $startPages = $this->handlePages( $count, $limitPages, $page);
                $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
            }
        } else {
            if($title == "Trong nước") {
                $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('addresstype', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
                if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                    });
                }
                $count = $toursQuery->count();

                $startPages = $this->handlePages( $count, $limitPages, $page);
                $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
            } else {
                $toursQuery = DB::table('tours')
                        ->where('status', '>', 0)
                        ->where('desstination', $title)
                        ->where('schedule', '>=', $x)
                        ->where('schedule', '<=', $y)
                        ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
                if($day != 'null') {
                    $toursQuery->where(function ($query) use ($x, $y, $day) {
                        $query->where('start_day', $day);
                    });
                }
                $count = $toursQuery->count();

                $startPages = $this->handlePages( $count, $limitPages, $page);
                $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
            }
        }
        return $tours;
    }

    public function tours_end_SoNgay( $title, $limitPages, $page, $Dongtour, $day, $x, $y ) {
        if($Dongtour != 'null') {
            if($title == "Trong nước") {
                $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('addresstype', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('type_tour', $Dongtour);
                if($day != 'null') {
                    $toursQuery->where(function ($query) use ($day) {
                        $query->where('start_day', $day);
                    });
                }
            } else {
                $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('desstination', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('type_tour', $Dongtour);
                if($day != 'null') {
                    $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();

            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                ->take($limitPages)
                ->get();
            }
        } else {
            if($title == "Trong nước") {
                $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('addresstype', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y);
                    if($day != 'null') {
                        $toursQuery->where(function ($query) use ($day) {
                            $query->where('start_day', $day);
                        });
                    }
            } else {
                $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('desstination', $title)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y);
                    if($day != 'null') {
                        $toursQuery->where(function ($query) use ($day) {
                            $query->where('start_day', $day);
                        });
                    }
            }
        }
        $count = $toursQuery->count();

        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
            ->take($limitPages)
            ->get();
        return $tours;
    }

    public function tours_start_SoNguoi_SoNgay( $title, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, $x, $y ) {
        if($Dongtour != 'null') {
            $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('addresstype', $title)
                    ->where('type_tour', $Dongtour)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        } else {
            $toursQuery = DB::table('tours')
                ->where('status', '>', 0)
                ->where('departure', $start)
                ->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->where('addresstype', $title)
                ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        }
        return $tours;
    }

    public function tours_start_SoNgay( $title, $limitPages, $page, $start, $Dongtour, $day, $x, $y ) {
        if($Dongtour != 'null') {
            $toursQuery = DB::table('tours')
                ->where('status', '>', 0)
                ->where('departure', $start)
                ->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->where('addresstype', $title)
                ->where('type_tour', $Dongtour);
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        } else {
            $toursQuery = DB::table('tours')
                    ->where('status', '>', 0)
                    ->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('addresstype', $title);
                if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
            $count = $toursQuery->count();
            $startPages = $this->handlePages( $count, $limitPages, $page);
            $tours = $toursQuery->skip($startPages)
                    ->take($limitPages)
                    ->get();
        }
        return $tours;
    }

    public function tours_type_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, $x, $y ) {
        
        if($Dongtour != 'null') {
            $toursQuery->where(function ($query) use ($soNguoi, $start, $Dongtour, $x, $y) {
                    $query->where('departure', $start)
                    ->where('type_tour', $Dongtour)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
            
        } else {
            $toursQuery->where(function ($query) use ($soNguoi, $start, $x, $y) {
                $query->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
        }

        if( $desstination != '') {
            $toursQuery->where(function ($query) use ($desstination) {
                $query->where('desstination', $desstination);
            });
        }
        $count = $toursQuery->count();
        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
                ->take($limitPages)
                ->get();
        return $tours;
    }

    public function tours_type_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, $x, $y ) {
        
        if($Dongtour != 'null') {
            $toursQuery->where(function ($query) use ($start, $Dongtour, $x, $y) {
                $query->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('type_tour', $Dongtour);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
        } else {
            $toursQuery->where(function ($query) use ($start, $x, $y) {
                $query->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
        }
        if( $desstination != '') {
            $toursQuery->where(function ($query) use ($desstination) {
                $query->where('desstination', $desstination);
            });
        }
        $count = $toursQuery->count();
        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
                ->take($limitPages)
                ->get();
        return $tours;
    }

    public function tours_type_end_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $Dongtour, $day, $x, $y ) {
        if($desstination != '') {

        } else {

        }
        if($Dongtour != 'null') {
            $toursQuery->where(function ($query) use ($Dongtour, $x, $y, $soNguoi) {
                $query->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->where('type_tour', $Dongtour)
                ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
        } else {
            $toursQuery->where(function ($query) use ($x, $y, $soNguoi) {
                $query->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            });
            if($day != 'null') {
            $toursQuery->where(function ($query) use ($day) {
                $query->where('start_day', $day);
                });
            }
        }
        if( $desstination != '') {
            $toursQuery->where(function ($query) use ($desstination) {
                $query->where('desstination', $desstination);
            });
        }
        $count = $toursQuery->count();

        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
            ->take($limitPages)
            ->get();
        return $tours;
    }

    public function tours_type_end_SoNgay( $toursQuery, $desstination, $limitPages, $page, $Dongtour, $day, $x, $y ) {
        
        if($Dongtour != 'null') {
            $toursQuery->where(function ($query) use ($Dongtour, $x, $y) {
                $query->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->where('type_tour', $Dongtour);
            });
        } else {
            $toursQuery->where(function ($query) use ($x, $y) {
                $query->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y);
            });
        }
        if( $desstination != '') {
            $toursQuery->where(function ($query) use ($desstination) {
                $query->where('desstination', $desstination);
            });
        }
        $count = $toursQuery->count();
    
        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
            ->take($limitPages)
            ->get();
        return $tours;
    }

    public function tours_type_start_SoNguoi_SoNgay( $toursQuery, $desstination, $limitPages, $page, $soNguoi, $start, $Dongtour, $day, $x, $y ) {
        
        if($Dongtour != 'null') {
            $toursQuery->where(function ($query) use ($Dongtour, $x, $y, $start, $soNguoi) {
                $query->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y)
                    ->where('type_tour', $Dongtour)
                    ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($day) {
                    $query->where('start_day', $day);
                });
            }
        } else {
            $toursQuery->where(function ($query) use ( $start, $soNguoi, $x, $y) {
                $query->where('departure', $start)
                ->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->whereRaw('(seat - ordered) >= ?', [(int)$soNguoi]);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
        }
        if( $desstination != '') {
            $toursQuery->where(function ($query) use ($desstination) {
                $query->where('desstination', $desstination);
            });
        }
        $count = $toursQuery->count();
        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
                ->take($limitPages)
                ->get();
        return $tours;
    }

    public function tours_type_start_SoNgay( $toursQuery, $desstination, $limitPages, $page, $start, $Dongtour, $day, $x, $y ) {
        
        if($Dongtour != 'null') {
            $toursQuery->where(function ($query) use ($Dongtour, $start, $x, $y) {
                $query->where('departure', $start)
                ->where('schedule', '>=', $x)
                ->where('schedule', '<=', $y)
                ->where('type_tour', $Dongtour);
            });
            if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
        } else {
            $toursQuery->where(function ($query) use ( $start, $x, $y) {
                $query->where('departure', $start)
                    ->where('schedule', '>=', $x)
                    ->where('schedule', '<=', $y);
            });
                if($day != 'null') {
                $toursQuery->where(function ($query) use ($x, $y, $day) {
                    $query->where('start_day', $day);
                });
            }
        }
        if( $desstination != '') {
            $toursQuery->where(function ($query) use ($desstination) {
                $query->where('desstination', $desstination);
            });
        }
        $count = $toursQuery->count();
        $startPages = $this->handlePages( $count, $limitPages, $page);
        $tours = $toursQuery->skip($startPages)
                ->take($limitPages)
                ->get();
        return $tours;
    }

    public function handlePages($count, $limitPages, $page) {

        $totalPages = ceil($count / $limitPages);
        $this->totalPage = $totalPages;

        if($page > $totalPages) {
            $page = $totalPages;
        } else if($page < 1) {
            $page = 1;
        }

        $startPages = ($page - 1) * $limitPages;
        return $startPages;
    }

}
