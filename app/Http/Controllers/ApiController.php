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
        
        if($user) 
        {
            if(Hash::check($request->input('password'), $user->password)) 
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
}
