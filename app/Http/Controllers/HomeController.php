<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return View::make('home',array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'user_count' => $user_count, 'med_count' => $med_count, 'rep_count' => $rep_count, 'app_count' => $app_count, 'user_sub_count' => $user_sub_count));
    }
}
