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

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_user_index()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();

        return View::make('manage_user_index', array('user' => $user, 'lastest_user' => $lastest_user));
    }

    public function manage_user_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();

        return View::make('manage_user_create', array('lastest_user' => $lastest_user));
    }

    public function manage_user_create_process()
    {
         $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            );

        $validator = Validator::make(Input::all(),$rules);

        if($validator -> fails()){

            $messages = $validator->messages();
            
            return Redirect::to('manage_user_create')
            -> withErrors($validator)
            ->withInput (Input::except('password','c_password'));
        }
        else
        {
            $add = new users;
            $add->name = Input::get('name');
            $add->email = Input::get('email');
            $add->phone = Input::get('phone');
            $add->password = Hash::make(Input::get('password'));
            $add->type = Input::get('type');;

            $add->save();

            Session::flash('message','Successfully created user!');
            return Redirect::to('manage_user_index');
        }
    }

    public function manage_user_show()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $show_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $show_selected_user[$i] = '';
            $show_selected_user[$i] = users::find($selected_user[$i]);
        }

        return View::make('manage_user_show',array('show_selected_user' => $show_selected_user, 'lastest_user' => $lastest_user));
    }

    public function manage_user_edit()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $edit_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $edit_selected_user[$i] = '';
            $edit_selected_user[$i] = users::find($selected_user[$i]);
        }

        
        return View::make('manage_user_edit')->with(array('edit_selected_user' => $edit_selected_user, 'lastest_user' => $lastest_user));
    }

    public function manage_user_edit_process()
    {
        $user = users::all();
        $edit_selected_user = Input::get('edit_selected_user');
        $name = Input::get('name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $password = Input::get('password');
        $type = Input::get('type');
        $edit = array();

        for ($i=0; $i < sizeof($edit_selected_user); $i++)
        {
            $edit[$i] = '';
            $edit[$i] = users::find($edit_selected_user[$i]);
            $edit[$i]->name = $name[$i];
            $edit[$i]->email = $email[$i];
            $edit[$i]->phone = $phone[$i];
            $edit[$i]->password = Hash::make($password[$i]);
            $edit[$i]->type = $type[$i];

            $edit[$i]->save();
        }

        Session::flash('message','Successfully updated user(s)!');
        return Redirect::to('manage_user_index');
    }

    public function manage_user_delete()
    {
        $selected_user = Input::get('selected_user');

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $delete_selected_user[$i] = users::where('id',$selected_user[$i])->delete();
        }

        Session::flash('message','Successfully deleted user(s)!');
        return Redirect::to('manage_user_index');
    }








    public function manage_medicine_index()
    {
        $user = users::all();
        $medicine = medicine::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('med_id', 'desc')->first();

        return View::make('manage_medicine_index', array('med' => $medicine, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_medicine_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('med_id', 'desc')->first();

        return View::make('manage_medicine_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_medicine_create_process()
    {
         $rules = array(
            'med_name' => 'required',
            'med_number' => 'required|unique:medicine|max:255',
            'med_category' => 'required',
            'med_authenticity' => 'required',
            'med_ingredient' => 'required',
            'med_info' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        if($validator -> fails()){

            $messages = $validator->messages();
            
            return Redirect::to('manage_medicine_create')
            -> withErrors($validator);
        }
        else
        {
            $add = new medicine;
            $add->med_name = Input::get('med_name');
            $add->med_number = Input::get('med_number');
            $add->med_category = Input::get('med_category');
            $add->med_authenticity = Input::get('med_authenticity');
            $add->med_ingredient = Input::get('med_ingredient');
            $add->med_info = Input::get('med_info');

            $add->save();

            Session::flash('message','Successfully created medicine!');
            return Redirect::to('manage_medicine_index');
        }
    }

    public function manage_medicine_show()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $show_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $show_selected_user[$i] = '';
            $show_selected_user[$i] = users::find($selected_user[$i]);
        }

        return View::make('manage_medicine_show',array('show_selected_user' => $show_selected_user, 'lastest_user' => $lastest_user));
    }

    public function manage_medicine_edit()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $edit_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $edit_selected_user[$i] = '';
            $edit_selected_user[$i] = users::find($selected_user[$i]);
        }

        
        return View::make('manage_medicine_edit')->with(array('edit_selected_user' => $edit_selected_user, 'lastest_user' => $lastest_user));
    }

    public function manage_medicine_edit_process()
    {
        $user = users::all();
        $edit_selected_user = Input::get('edit_selected_user');
        $name = Input::get('name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $password = Input::get('password');
        $type = Input::get('type');
        $edit = array();

        for ($i=0; $i < sizeof($edit_selected_user); $i++)
        {
            $edit[$i] = '';
            $edit[$i] = users::find($edit_selected_user[$i]);
            $edit[$i]->name = $name[$i];
            $edit[$i]->email = $email[$i];
            $edit[$i]->phone = $phone[$i];
            $edit[$i]->password = Hash::make($password[$i]);
            $edit[$i]->type = $type[$i];

            $edit[$i]->save();
        }

        Session::flash('message','Successfully updated user(s)!');
        return Redirect::to('manage_medicine_index');
    }

    public function manage_medicine_delete()
    {
        $selected_user = Input::get('selected_user');

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $delete_selected_user[$i] = users::where('id',$selected_user[$i])->delete();
        }

        Session::flash('message','Successfully deleted user(s)!');
        return Redirect::to('manage_medicine_index');
    }

}

