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
        $user = users::all();

        return View::make('home',array('user' => $user));
    }
}
