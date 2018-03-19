<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use View;
use App\Model\users;
use App\Model\medicine;
use App\Model\report;
use App\Model\appointment;
use App\Model\vas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $user_count = users::count();
        $med_count = medicine::count();
        $rep_count = report::count();
        $app_count = appointment::count();

        $user_sub_count = users::select(DB::raw('count(*) as sub_count, type'))
                                        ->groupBy('type')
                                        ->orderBy('sub_count', 'desc')
                                        ->take(2)
                                        ->get();

        $med_sub_count = medicine::select(DB::raw('count(*) as sub_count, med_category'))
                                        ->groupBy('med_category')
                                        ->orderBy('sub_count', 'desc')
                                        ->take(2)
                                        ->get();

        $rep_sub_count = report::select(DB::raw('count(*) as sub_count, rep_location'))
                                        ->groupBy('rep_location')
                                        ->orderBy('sub_count', 'desc')
                                        ->take(2)
                                        ->get();

        $app_sub_count = appointment::select(DB::raw('count(*) as sub_count, app_method'))
                                        ->groupBy('app_method')
                                        ->orderBy('sub_count', 'desc')
                                        ->take(2)
                                        ->get();

        return View::make('home',array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'user_count' => $user_count, 'med_count' => $med_count, 'rep_count' => $rep_count, 'app_count' => $app_count, 'user_sub_count' => $user_sub_count, 'med_sub_count' => $med_sub_count, 'rep_sub_count' => $rep_sub_count, 'app_sub_count' => $app_sub_count));
    }
}
