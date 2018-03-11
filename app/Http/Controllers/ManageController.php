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
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        return View::make('manage_user_index', array('user' => $user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_user_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        return View::make('manage_user_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
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

        if($validator->fails())
        {

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
            $add->type = Input::get('type');

            $add->save();

            Session::flash('message','Successfully created user!');
            return Redirect::to('manage_user_index');
        }
    }

    public function manage_user_show()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $show_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $show_selected_user[$i] = '';
            $show_selected_user[$i] = users::find($selected_user[$i]);
        }

        return View::make('manage_user_show',array('show_selected_user' => $show_selected_user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_user_edit()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $edit_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $edit_selected_user[$i] = '';
            $edit_selected_user[$i] = users::find($selected_user[$i]);
        }

        
        return View::make('manage_user_edit')->with(array('edit_selected_user' => $edit_selected_user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
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
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        return View::make('manage_medicine_index', array('med' => $medicine, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_medicine_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        return View::make('manage_medicine_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_medicine_create_process()
    {
        $rules = array(
            'med_number' => 'required',
            'med_name' => 'required',
            'med_category' => 'required',
            'med_authenticity' => 'required',
            'med_ingredient' => 'required',
            'med_info' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        if($validator->fails())
        {

            $messages = $validator->messages();
            
            return Redirect::to('manage_medicine_create')
            -> withErrors($validator)
            ->withInput (Input::except('med_number'));
        }
        else
        {
            $add = new medicine;
            $add->med_number = Input::get('med_number');
            $add->med_name = Input::get('med_name');
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
        $medicine = medicine::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        $selected_med = Input::get('selected_med');

        $show_selected_med = array();

        for ($i=0; $i < sizeof($selected_med); $i++)
        {
            $show_selected_med[$i] = '';
            $show_selected_med[$i] = medicine::find($selected_med[$i]);
        }

        return View::make('manage_medicine_show',array('show_selected_med' => $show_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_medicine_edit()
    {
        $medicine = medicine::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        $selected_med = Input::get('selected_med');

        $edit_selected_med = array();

        for ($i=0; $i < sizeof($selected_med); $i++)
        {
            $edit_selected_med[$i] = '';
            $edit_selected_med[$i] = medicine::find($selected_med[$i]);
        }

        
        return View::make('manage_medicine_edit')->with(array('edit_selected_med' => $edit_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_medicine_edit_process()
    {
        $medicine = medicine::all();
        $edit_selected_med = Input::get('edit_selected_med');
        $med_number = Input::get('med_number');
        $med_name = Input::get('med_name');
        $med_category = Input::get('med_category');
        $med_authenticity = Input::get('med_authenticity');
        $med_ingredient = Input::get('med_ingredient');
        $med_info = Input::get('med_info');
        $edit = array();

        for ($i=0; $i < sizeof($edit_selected_med); $i++)
        {
            $edit[$i] = '';
            $edit[$i] = medicine::find($edit_selected_med[$i]);
            $edit[$i]->med_number = $med_number[$i];
            $edit[$i]->med_name = $med_name[$i];
            $edit[$i]->med_category = $med_category[$i];
            $edit[$i]->med_authenticity = $med_authenticity[$i];
            $edit[$i]->med_ingredient = $med_ingredient[$i];
            $edit[$i]->med_info = $med_info[$i];

            $edit[$i]->save();
        }

        Session::flash('message','Successfully updated medicine(s)!');
        return Redirect::to('manage_medicine_index');
    }

    public function manage_medicine_delete()
    {
        $selected_med = Input::get('selected_med');

        for ($i=0; $i < sizeof($selected_med); $i++)
        {
            $delete_selected_med[$i] = medicine::where('id',$selected_med[$i])->delete();
        }

        Session::flash('message','Successfully deleted medicine(s)!');
        return Redirect::to('manage_medicine_index');
    }








    public function manage_report_index()
    {
        $report = report::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        return View::make('manage_report_index', array('rep' => $report, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_report_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        return View::make('manage_report_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_report_create_process()
    {
        $rules = array(
            'rep_medicine' => 'required',
            'rep_location' => 'required',
            'user_id' => 'required',
            'rep_info' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        $get_user_name = Input::get('user_id');
        $get_user_name = users::where('name', $get_user_name)->first();
        dd($get_user_name);

        if($validator->fails())
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_report_create')
            ->withErrors($validator)
            ->withInput();
        }
        else if (condition) 
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_report_create')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
            $add = new report;
            $add->rep_medicine = Input::get('rep_medicine');
            $add->rep_location = Input::get('rep_location');
            $add->user_id = $get_user_name->id;
            $add->rep_info = Input::get('rep_info');

            $add->save();

            Session::flash('message','Successfully created report!');
            return Redirect::to('manage_report_index');
        }
    }

    public function manage_report_show()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        $selected_rep = Input::get('selected_rep');

        $show_selected_rep = array();

        for ($i=0; $i < sizeof($selected_rep); $i++)
        {
            $show_selected_rep[$i] = '';
            $show_selected_rep[$i] = medicine::find($selected_rep[$i]);
        }

        return View::make('manage_report_show',array('show_selected_rep' => $show_selected_rep, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_report_edit()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();

        $selected_rep = Input::get('selected_rep');

        $edit_selected_rep = array();

        for ($i=0; $i < sizeof($selected_med); $i++)
        {
            $edit_selected_rep[$i] = '';
            $edit_selected_rep[$i] = report::find($selected_rep[$i]);
        }
        
        return View::make('manage_report_edit')->with(array('edit_selected_rep' => $edit_selected_rep, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med));
    }

    public function manage_report_edit_process()
    {
        $edit_selected_rep = Input::get('edit_selected_rep');
        $rep_medicine = Input::get('rep_medicine');
        $rep_location = Input::get('rep_location');
        $user_id = Input::get('user_id');
        $rep_info = Input::get('rep_info');
        $edit = array();

        for ($i=0; $i < sizeof($edit_selected_rep); $i++)
        {
            $edit[$i] = '';
            $edit[$i] = report::find($edit_selected_rep[$i]);
            $edit[$i]->rep_medicine = $rep_medicine[$i];
            $edit[$i]->rep_location = $rep_location[$i];
            $edit[$i]->user_id = $user_id[$i];
            $edit[$i]->rep_info = $rep_info[$i];

            $edit[$i]->save();
        }

        Session::flash('message','Successfully updated report(s)!');
        return Redirect::to('manage_report_index');
    }

    public function manage_report_delete()
    {
        $selected_rep = Input::get('selected_rep');

        for ($i=0; $i < sizeof($selected_rep); $i++)
        {
            $delete_selected_rep[$i] = report::where('id',$selected_rep[$i])->delete();
        }

        Session::flash('message','Successfully deleted report(s)!');
        return Redirect::to('manage_report_index');
    }
}

