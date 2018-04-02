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

    public function check_medicine_information(Request $request) 
    {
        $user = users::where('remember_token', $request->input('token'))->get(['id'])->first();

        if ($user) 
        {
            $medicine = $request->input('medicine');
    
            $get_medicine = medicine::where('med_name', $request->input('medicine'))->get()->first();
    
            if ($get_medicine) 
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
                    'message' => 'The medicine is not found.'
                ];
            }
        }

        return response()->json($data);
    }

    public function submit_report(Request $request) 
    {
        $user = users::where('remember_token', $request->input('token'))->get(['id'])->first();

        if ($user) 
        {
            $add = new report;
            $add->rep_medicine = $request->input('rep_medicine');
            $add->rep_location = $request->input('rep_location');
            $add->rep_info = $request->input('rep_info');

            $add->save();

            $get_report = medicine::where('rep_medicine', $add->rep_medicine)
                                    ->where('rep_location', $add->rep_location)
                                    ->where('rep_info', $add->rep_info)
                                    ->get()
                                    ->first();
    
            if ($get_report) 
            {
                $data = [
                    'status' => 'success',
                    'data' => $get_report
                ];
            }
            else 
            {
                $data = [
                    'status' => 'invalid',
                    'message' => 'The report is failed to submit.'
                ];
            }
        }

        return response()->json($data);
    }
}
