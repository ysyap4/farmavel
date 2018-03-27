<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Hash;
use Redirect;
use Auth;
use Session;
use App\Model\users;
use App\Model\medicine;
use App\Model\report;
use App\Model\appointment;
use App\Model\vas;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ApiController extends Controller
{
    public function login(Request $request) 
    {
        $user = users::where('email', $request->input('email'))->get()->first();
        
        if ($user) 
        {
            if (Hash::check($request->input('password'), $user->password)) 
            {
                $remember_token = bcrypt($user->id.time());
                $user->remember_token = $remember_token;
                $user->save();
                $data = [
                    'status' => 'success',
                    'data' => $user
                ];
            }
            else 
            {
                $data = [
                    'status' => 'fail',
                    'message' => 'Incorrect password.'
                ];
            }
        }
        else 
        {
            $data = [
                'status' => 'fail',
                'message' => 'User does not exist.'
            ];
        }

        return response()->json($data);
    }

    public function signup(Request $request) 
    {
        $add = new users;
        $add->name = $request->input('name');
        $add->email = $request->input('email');
        $add->phone = $request->input('phone');
        $add->password = bcrypt($request->input('password'));
        $add->type = 'Patient';

        $add->save();

        $registered_user = users::where('email', $request->input('email'))->get()->first();
        $remember_token = bcrypt($registered_user->id + time());
        $registered_user->remember_token = $remember_token;
        $registered_user->save();

        $data = [
            'status' => 'success',
            'data' => $registered_user
        ];

        return response()->json($data);
    }

    public function logout(Request $request) 
    {
        $user = users::where('remember_token', $request->input('token'))->get(['id'])->first();

        if($user) 
        {
            $user->remember_token = null;
            $user->save();
            $data = [
                'status' => 'success'
            ];
        }
        else 
        {
            $data = [
                'status' => 'invalid',
                'message' => 'Invalid session.'
            ];
        }

        return response()->json($data);
    }

    public function check_medicine_authenticity(Request $request) 
    {
        $user = users::where('remember_token', $request->input('remember_token'))->get(['id'])->first();

        if($user) {

        $searchTerm = $request->input('searchTerm');

        $get_medicine = medicine::where('med_name', $searchTerm)->get()->first();

        if($get_medicine) 
        {
            $data = [
                'status' => 'success',
                'data' => $get_medicine
            ];
        }
        else 
        {
            $data = [
                'status' => 'invalid',
                'message' => 'Invalid session.'
            ];
        }
    }

        return response()->json($data);
    }
}
