<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use App\Model\users;
use App\Model\medicine;

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
        //$lastest_med = medicine::orderBy('id', 'desc')->first();

        $user_count = users::count();
        //$med_count = medicine::count();
        //, 'med_count' => $med_count
        return View::make('home',array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'user_count' => $user_count));
    }
}
