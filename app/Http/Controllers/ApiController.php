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
        if ($request->has('name') && $request->has('email') && $request->has('phone') && $request->has('password'))
        {
            $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            );

            $validator = Validator::make($request->all(), $rules);
    
            if($validator->fails())
            {
                $data = [
                'status' => 'invalid',
                'message' => 'All correct information must be filled.'
            ];
            }
            else
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
            }
        }
        else
        {
            $data = [
                'status' => 'invalid',
                'message' => 'All valid information must be filled.'
            ];
        }

        return response()->json($data);
    }

    public function logout(Request $request) 
    {
        $user = users::where('remember_token', $request->input('token'))->get()->first();

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
        $user = users::where('remember_token', $request->input('token'))->get()->first();

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
        $user = users::where('remember_token', $request->input('token'))->get()->first();

        if ($user) 
        {
            $add = new report;
            $add->user_id = $user->id;
            $add->rep_medicine = $request->input('rep_medicine');
            $add->rep_location = $request->input('rep_location');
            $add->rep_info = $request->input('rep_info');

            $add->save();

            $get_report = report::where('user_id', $user->id)
                                ->where('rep_medicine', $request->input('rep_medicine'))
                                ->where('rep_location', $request->input('rep_location'))
                                ->where('rep_info', $request->input('rep_info'))
                                ->get()
                                ->first();
    
            if ($get_report) 
            {
                $data = [
                    'status' => 'success',
                    'data' => $get_report,
                    'message' => 'The report is submitted successfully.'
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

    public function get_user(Request $request) 
    {
        $get_user = users::where('remember_token', $request->input('token'))->get()->first();

        if ($get_user) 
        {
            $data = [
                'status' => 'success',
                'data' => $get_user
            ];
        }
        else 
        {
            $data = [
                'status' => 'invalid',
                'message' => 'The user data is not valid.'
            ];
        }

        return response()->json($data);
    }

    public function make_appointment(Request $request) 
    {
        $user = users::where('remember_token', $request->input('token'))->get()->first();

        if ($user)
        {
            $medicine = medicine::where('med_name', $request->input('app_medicine'))->get()->first();

            if ($medicine)
            {
                $vas = vas::where('med_id', $medicine->id)->get()->first();
    
                if ($vas)
                {
                    if ($request->input('app_location') == "Batu Pahat")
                    {
                        $vas_availability = $vas->vas_availability_batupahat;
                    }
                    else if ($request->input('app_location') == "Johor Bahru")
                    {
                        $vas_availability = $vas->vas_availability_johorbahru;
                    }
                    else if ($request->input('app_location') == "Muar")
                    {
                        $vas_availability = $vas->vas_availability_muar;
                    }
                    else if ($request->input('app_location') == "Segamat")
                    {
                        $vas_availability = $vas->vas_availability_segamat;
                    }
                    else if ($request->input('app_location') == "Kulaijaya")
                    {
                        $vas_availability = $vas->vas_availability_kulaijaya;
                    }
    
                    if ($vas_availability == "1")
                    {
                        $add = new appointment;
                        $add->user_id = $user->id;
                        $add->med_id = $medicine->id;
                        $add->app_date = $request->input('app_date');
                        $add->app_time = $request->input('app_time');
                        $add->app_location = $request->input('app_location');
                        $add->app_method = $request->input('app_method');
    
                        $add->save();
    
                        $get_appointment = appointment::where('user_id', $user->id)
                                            ->where('med_id', $medicine->id)
                                            ->where('app_date', $request->input('app_date'))
                                            ->where('app_time', $request->input('app_time'))
                                            ->where('app_location', $request->input('app_location'))
                                            ->where('app_method', $request->input('app_method'))
                                            ->get()
                                            ->first();
                
                        if ($get_appointment) 
                        {
                            $data = [
                                'status' => 'success',
                                'data' => $get_appointment,
                                'message' => 'The appointment is submitted successfully.'
                            ];
                        }
                        else 
                        {
                            $data = [
                                'status' => 'invalid',
                                'message' => 'The appointment is failed to submit.'
                            ];
                        }
                    }
                    else 
                    {
                        $data = [
                            'status' => 'invalid',
                            'message' => 'The medicine is not available temporarily.'
                        ];
                    }
                }
                else 
                {
                    $data = [
                        'status' => 'invalid',
                        'message' => 'The value added service is not available.'
                    ];
                }
            }
            else 
            {
                $data = [
                    'status' => 'invalid',
                    'message' => 'The medicine is not available.'
                ];
            }
        }
        else 
        {
            $data = [
                'status' => 'invalid',
                'message' => 'The user is not valid.'
            ];
        }

        return response()->json($data);
    }

    public function check_medicine_availability(Request $request) 
    {
        $user = users::where('remember_token', $request->input('token'))->get()->first();
        $location = $request->input('location');

        if ($user) 
        {
            $medicine = medicine::where('med_name', $request->input('medicine'))->get()->first();

            if ($medicine)
            {
                $vas = vas::where('med_id', $medicine->id)->get()->first();

                if ($vas)
                {
                    if ($location == "Batu Pahat")
                    {
                        $vas_availability = $vas->vas_availability_batupahat;
                    }
                    else if ($location == "Johor Bahru")
                    {
                        $vas_availability = $vas->vas_availability_johorbahru;
                    }
                    else if ($location == "Muar")
                    {
                        $vas_availability = $vas->vas_availability_muar;
                    }
                    else if ($location == "Segamat")
                    {
                        $vas_availability = $vas->vas_availability_segamat;
                    }
                    else if ($location == "Kulaijaya")
                    {
                        $vas_availability = $vas->vas_availability_kulaijaya;
                    }

                    $get_medicine = $medicine;
                    $get_vas = $vas_availability;

                    $data = [
                        'status' => 'success',
                        'medicine_data' => $get_medicine,
                        'vas_data' =>  $get_vas
                    ];
                }
                else
                {
                    $data = [
                        'status' => 'invalid',
                        'message' => 'The value added service is not available.'
                    ];
                }
            }
            else
            {
                $data = [
                    'status' => 'invalid',
                    'message' => 'The medicine is not available.'
                ];
            }
        }    
        else 
        {
            $data = [
                'status' => 'invalid',
                'message' => 'The user is not found.'
            ];
            
        }

        return response()->json($data);
    }
}
