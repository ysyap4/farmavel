<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use App\Model\users;

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
        $user_count = users::count();

        return View::make('home',array('lastest_user' => $lastest_user, 'user_count' => $user_count));
    }
}
