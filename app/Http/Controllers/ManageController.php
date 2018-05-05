<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_user_index', array('user' => $user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_user_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_user_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_user_create_process(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'image' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        if($validator->fails())
        {

            $messages = $validator->messages();
            
            return Redirect::to('manage_user_create')
            -> withErrors($validator)
            ->withInput (Input::except('password','c_password'))
            ->withInput (Input::except('image','confirm'));
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

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $image_filename = $image->getClientOriginalName();
                $image_extension = $image->getClientOriginalExtension();
                //$destinationPath = public_path(). '/user_image/';
                //$image->move($destinationPath, $image_filename);
                $save_image_name = $add->id.'.'.$image_extension;
                $destinationPath = public_path().'/user_image/';
                $image->move($destinationPath, $save_image_name);
                $path = "user_image/".$save_image_name;                
                Storage::disk('s3')->put($path, file_get_contents($image));

                //$add->image = $save_image_name;
                users::where('id', $add->id)->update(['image' => $save_image_name]);
            }

            Session::flash('message','Successfully created user!');
            return Redirect::to('manage_user_index');
        }
    }

    public function manage_user_show()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $show_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $show_selected_user[$i] = '';
            $show_selected_user[$i] = users::find($selected_user[$i]);
        }

        return View::make('manage_user_show', array('show_selected_user' => $show_selected_user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_user_edit()
    {
        $user = users::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_user = Input::get('selected_user');

        $edit_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $edit_selected_user[$i] = '';
            $edit_selected_user[$i] = users::find($selected_user[$i]);
        }

        
        return View::make('manage_user_edit')->with(array('edit_selected_user' => $edit_selected_user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
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
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_medicine_index', array('med' => $medicine, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_medicine_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_medicine_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
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
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_med = Input::get('selected_med');

        $show_selected_med = array();

        for ($i=0; $i < sizeof($selected_med); $i++)
        {
            $show_selected_med[$i] = '';
            $show_selected_med[$i] = medicine::find($selected_med[$i]);
        }

        return View::make('manage_medicine_show',array('show_selected_med' => $show_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_medicine_edit()
    {
        $medicine = medicine::all();
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_med = Input::get('selected_med');

        $edit_selected_med = array();

        for ($i=0; $i < sizeof($selected_med); $i++)
        {
            $edit_selected_med[$i] = '';
            $edit_selected_med[$i] = medicine::find($selected_med[$i]);
        }

        
        return View::make('manage_medicine_edit')->with(array('edit_selected_med' => $edit_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
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
        $user = users::all();

        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_report_index', array('rep' => $report, 'user' => $user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_report_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_report_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_report_create_process()
    {
        $rules = array(
            'rep_medicine' => 'required',
            'rep_location' => 'required',
            'user_name' => 'required',
            'rep_info' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        $get_user_name = Input::get('user_name');
        $get_user = users::where('name', $get_user_name)->first();

        if($validator->fails())
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_report_create')
            ->withErrors($validator)
            ->withInput();
        }
        else if (is_null($get_user)) 
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
            $add->user_id = $get_user->id;
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
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_rep = Input::get('selected_rep');

        $show_selected_rep = array();
        $get_selected_user = array();

        for ($i=0; $i < sizeof($selected_rep); $i++)
        {
            $show_selected_rep[$i] = '';
            $get_selected_user[$i] = '';
            $show_selected_rep[$i] = report::find($selected_rep[$i]);
            $get_selected_user[$i] = users::where('id', $show_selected_rep[$i]->user_id)->first();
        }

        return View::make('manage_report_show',array('show_selected_rep' => $show_selected_rep, 'get_selected_user' => $get_selected_user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_report_edit()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_rep = Input::get('selected_rep');

        $edit_selected_rep = array();
        $get_selected_user = array();

        for ($i=0; $i < sizeof($selected_rep); $i++)
        {
            $edit_selected_rep[$i] = '';
            $get_selected_user[$i] = '';
            $edit_selected_rep[$i] = report::find($selected_rep[$i]);
            $get_selected_user[$i] = users::where('id', $edit_selected_rep[$i]->user_id)->first();
        }
        
        return View::make('manage_report_edit')->with(array('edit_selected_rep' => $edit_selected_rep, 'get_selected_user' => $get_selected_user, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_report_edit_process()
    {
        $edit_selected_rep = Input::get('edit_selected_rep');
        $rep_medicine = Input::get('rep_medicine');
        $rep_location = Input::get('rep_location');
        $get_user_name = Input::get('user_name');
        $rep_info = Input::get('rep_info');

        $edit = array();
        $get_selected_user = array();

        for ($i=0; $i < sizeof($edit_selected_rep); $i++)
        {
            $edit[$i] = '';
            $get_selected_user[$i] = '';
            $edit[$i] = report::find($edit_selected_rep[$i]);
            $edit[$i]->rep_medicine = $rep_medicine[$i];
            $edit[$i]->rep_location = $rep_location[$i];
            $get_selected_user[$i] = users::where('name', $get_user_name[$i])->first();
            $edit[$i]->user_id = $get_selected_user[$i]->id;
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








    public function manage_appointment_index()
    {
        $appointment = appointment::all();
        $user = users::all();
        $medicine = medicine::all();

        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_appointment_index', array('app' => $appointment, 'user' => $user, 'med' => $medicine, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_appointment_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_appointment_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_appointment_create_process()
    {
        $rules = array(
            'user_name' => 'required',
            'med_name' => 'required',
            'app_date' => 'required',
            'app_time' => 'required',
            'app_location' => 'required',
            'app_method' => 'required',
            );

        $validator = Validator::make(Input::all(), $rules);

        $get_user_name = Input::get('user_name');
        $get_user = users::where('name', $get_user_name)->first();
        $get_med_name = Input::get('med_name');
        $get_med = medicine::where('med_name', $get_med_name)->where('med_authenticity', 'Legal')->first();

        if($validator->fails())
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_appointment_create')
            ->withErrors($validator)
            ->withInput();
        }
        else if (is_null($get_user)) 
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_appointment_create')
            ->withErrors($validator)
            ->withInput();
        }
        else if (is_null($get_med)) 
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_appointment_create')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
            $add = new appointment;
            $add->user_id = $get_user->id;
            $add->med_id = $get_med->id;
            $add->app_date = Input::get('app_date');
            $add->app_time = Input::get('app_time');
            $add->app_location = Input::get('app_location');
            $add->app_method = Input::get('app_method');

            $add->save();

            Session::flash('message','Successfully created appointment!');
            return Redirect::to('manage_appointment_index');
        }
    }

    public function manage_appointment_show()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_app = Input::get('selected_app');

        $show_selected_app = array();
        $get_selected_user = array();
        $get_selected_med = array();

        for ($i=0; $i < sizeof($selected_app); $i++)
        {
            $show_selected_app[$i] = '';
            $get_selected_user[$i] = '';
            $get_selected_med[$i] = '';
            $show_selected_app[$i] = appointment::find($selected_app[$i]);
            $get_selected_user[$i] = users::where('id', $show_selected_app[$i]->user_id)->first();
            $get_selected_med[$i] = medicine::where('id', $show_selected_app[$i]->med_id)->first();
        }

        return View::make('manage_appointment_show',array('show_selected_app' => $show_selected_app, 'get_selected_user' => $get_selected_user, 'get_selected_med' => $get_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_appointment_edit()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_app = Input::get('selected_app');

        $edit_selected_app = array();
        $get_selected_user = array();
        $get_selected_med = array();

        for ($i=0; $i < sizeof($selected_app); $i++)
        {
            $edit_selected_app[$i] = '';
            $get_selected_user[$i] = '';
            $get_selected_med[$i] = '';
            $edit_selected_app[$i] = appointment::find($selected_app[$i]);
            $get_selected_user[$i] = users::where('id', $edit_selected_app[$i]->user_id)->first();
            $get_selected_med[$i] = medicine::where('id', $edit_selected_app[$i]->med_id)->first();
        }
        
        return View::make('manage_appointment_edit')->with(array('edit_selected_app' => $edit_selected_app, 'get_selected_user' => $get_selected_user, 'get_selected_med' => $get_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_appointment_edit_process()
    {
        $edit_selected_app = Input::get('edit_selected_app');
        $get_user_name = Input::get('user_name');
        $get_med_name = Input::get('med_name');
        $app_date = Input::get('app_date');
        $app_time = Input::get('app_time');
        $app_location = Input::get('app_location');
        $app_method = Input::get('app_method');

        $edit = array();
        $get_selected_user = array();
        $get_selected_med = array();

        for ($i=0; $i < sizeof($edit_selected_app); $i++)
        {
            $edit[$i] = '';
            $get_selected_user[$i] = '';
            $get_selected_med[$i] = '';
            $edit[$i] = appointment::find($edit_selected_app[$i]);
            $get_selected_user[$i] = users::where('name', $get_user_name[$i])->first();
            $edit[$i]->user_id = $get_selected_user[$i]->id;
            $get_selected_med[$i] = medicine::where('med_name', $get_med_name[$i])->where('med_authenticity', 'Legal')->first();
            $edit[$i]->med_id = $get_selected_med[$i]->id;
            $edit[$i]->app_date = $app_date[$i];
            $edit[$i]->app_time = $app_time[$i];
            $edit[$i]->app_location = $app_location[$i];
            $edit[$i]->app_method = $app_method[$i];

            $edit[$i]->save();
        }

        Session::flash('message','Successfully updated appointment(s)!');
        return Redirect::to('manage_appointment_index');
    }

    public function manage_appointment_delete()
    {
        $selected_app = Input::get('selected_app');

        for ($i=0; $i < sizeof($selected_app); $i++)
        {
            $delete_selected_app[$i] = appointment::where('id',$selected_app[$i])->delete();
        }

        Session::flash('message','Successfully deleted appointment(s)!');
        return Redirect::to('manage_appointment_index');
    }









    public function manage_vas_index()
    {
        $vas = vas::all();
        $medicine = medicine::all();

        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_vas_index', array('vas' => $vas, 'med' => $medicine, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_vas_create()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        return View::make('manage_vas_create', array('lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_vas_create_process()
    {
        $rules = array(
            'med_name' => 'required',
            'vas_availability_batupahat' => 'required',
            'vas_availability_johorbahru' => 'required',
            'vas_availability_muar' => 'required',
            'vas_availability_segamat' => 'required',
            'vas_availability_kulaijaya' => 'required',
            );

        $validator = Validator::make(Input::all(),$rules);

        $get_med_name = Input::get('med_name');
        $get_med = medicine::where('med_name', $get_med_name)->where('med_authenticity', 'Legal')->first();

        if($validator->fails())
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_vas_create')
            ->withErrors($validator)
            ->withInput();
        }
        else if (is_null($get_med)) 
        {
            $messages = $validator->messages();
            
            return Redirect::to('manage_vas_create')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
            $add = new vas;
            $add->med_id = $get_med->id;
            $add->vas_availability_batupahat = Input::get('vas_availability_batupahat');
            $add->vas_availability_johorbahru = Input::get('vas_availability_johorbahru');
            $add->vas_availability_muar = Input::get('vas_availability_muar');
            $add->vas_availability_segamat = Input::get('vas_availability_segamat');
            $add->vas_availability_kulaijaya = Input::get('vas_availability_kulaijaya');

            $add->save();

            Session::flash('message','Successfully created VAS!');
            return Redirect::to('manage_vas_index');
        }
    }

    public function manage_vas_show()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_vas = Input::get('selected_vas');

        $show_selected_vas = array();
        $get_selected_med = array();

        for ($i=0; $i < sizeof($selected_vas); $i++)
        {
            $show_selected_vas[$i] = '';
            $get_selected_med[$i] = '';
            $show_selected_vas[$i] = vas::find($selected_vas[$i]);
            $get_selected_med[$i] = medicine::where('id', $show_selected_vas[$i]->med_id)->first();
        }

        return View::make('manage_vas_show',array('show_selected_vas' => $show_selected_vas, 'get_selected_med' => $get_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_vas_edit()
    {
        $lastest_user = users::orderBy('created_at', 'desc')->first();
        $lastest_med = medicine::orderBy('created_at', 'desc')->first();
        $lastest_rep = report::orderBy('created_at', 'desc')->first();
        $lastest_app = appointment::orderBy('created_at', 'desc')->first();

        $selected_vas = Input::get('selected_vas');

        $edit_selected_vas = array();
        $get_selected_med = array();

        for ($i=0; $i < sizeof($selected_vas); $i++)
        {
            $edit_selected_vas[$i] = '';
            $get_selected_med[$i] = '';
            $edit_selected_vas[$i] = vas::find($selected_vas[$i]);
            $get_selected_med[$i] = medicine::where('id', $edit_selected_vas[$i]->med_id)->first();
        }
        
        return View::make('manage_vas_edit')->with(array('edit_selected_vas' => $edit_selected_vas, 'get_selected_med' => $get_selected_med, 'lastest_user' => $lastest_user, 'lastest_med' => $lastest_med, 'lastest_rep' => $lastest_rep, 'lastest_app' => $lastest_app));
    }

    public function manage_vas_edit_process()
    {
        $edit_selected_vas = Input::get('edit_selected_vas');
        $get_med_name = Input::get('med_name');
        $vas_availability_batupahat = Input::get('vas_availability_batupahat');
        $vas_availability_johorbahru = Input::get('vas_availability_johorbahru');
        $vas_availability_muar = Input::get('vas_availability_muar');
        $vas_availability_segamat = Input::get('vas_availability_segamat');
        $vas_availability_kulaijaya = Input::get('vas_availability_kulaijaya');

        $edit = array();
        $get_selected_med = array();

        for ($i=0; $i < sizeof($edit_selected_vas); $i++)
        {
            $edit[$i] = '';
            $get_selected_med[$i] = '';
            $edit[$i] = vas::find($edit_selected_vas[$i]);
            $get_selected_med[$i] = medicine::where('med_name', $get_med_name[$i])->where('med_authenticity', 'Legal')->first();
            $edit[$i]->med_id = $get_selected_med[$i]->id;
            $edit[$i]->vas_availability_batupahat = $vas_availability_batupahat[$i];
            $edit[$i]->vas_availability_johorbahru = $vas_availability_johorbahru[$i];
            $edit[$i]->vas_availability_muar = $vas_availability_muar[$i];
            $edit[$i]->vas_availability_segamat = $vas_availability_segamat[$i];
            $edit[$i]->vas_availability_kulaijaya = $vas_availability_kulaijaya[$i];

            $edit[$i]->save();
        }

        Session::flash('message','Successfully updated VAS(s)!');
        return Redirect::to('manage_vas_index');
    }

    public function manage_vas_delete()
    {
        $selected_vas = Input::get('selected_vas');

        for ($i=0; $i < sizeof($selected_vas); $i++)
        {
            $delete_selected_vas[$i] = vas::where('id', $selected_vas[$i])->delete();
        }

        Session::flash('message','Successfully deleted VAS(s)!');
        return Redirect::to('manage_vas_index');
    }
}