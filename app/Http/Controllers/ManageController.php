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

        return View::make('manage_user_index',array('user' => $user));
    }

    public function manage_user_create()
    {
        return View::make('manage_user_create');
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

            $add->save();

            Session::flash('message','Successfully created user!');
            return Redirect::to('manage_user_index');
        }
    }

    public function manage_user_edit(Request $request)
    {
        $user = users::all();

        $selected_user = Input::get('selected_user');

        $edit_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $edit_selected_user[$i] = '';
            $edit_selected_user[$i] = users::find($selected_user[$i]);
        }

        
        return View::make('manage_user_edit')->with(array('edit_selected_user'=>$edit_selected_user));
    }



     public function home()
    {
        // return view('home');

         $user = users::whereEmail(Auth::user()->email)->first();

                   if($user->type==1)
                    {
                        return Redirect::to('adminhomepage');
                    }
                    elseif($user->type==0)
                    {
                        return Redirect::to('users');
                    }

                    else
                    {
                        return Redirect::to('user_index');
                    }
                

    }
    public function adminhomepage()
    {

        return View::make('home');
    }


    public function user_create_process()
    {
         $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',///mksd dia email x kn sma dri table student
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',//dy akn sma dgn password ats
            );

        $validator = Validator::make(Input::all(),$rules);

        if($validator -> fails()){

            $messages = $validator->messages();
            
            return Redirect::to('user_create')///nama dlm roteu
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

            $add->save();

            Session::flash('message','Successfully created student!');
            return Redirect::to('user_create');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_show()
    {
        $user = users::all();

        $selected_user = Input::get('selected_user');

        $show_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $show_selected_user[$i] = '';
            $show_selected_user[$i] = users::find($selected_user[$i]);
        }

        return View::make('user_show',array('show_selected_user'=>$show_selected_user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_edit()
    {
        $user = users::all();

        $selected_user = Input::get('selected_user');

        $edit_selected_user = array();

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $edit_selected_user[$i] = '';
            $edit_selected_user[$i] = users::find($selected_user[$i]);
        }

        
        return View::make('user_edit')->with(array('edit_selected_user'=>$edit_selected_user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_edit_process()
    {
        $user = users::all();
        $edit_selected_user = Input::get('edit_selected_user');
        $name = Input::get('name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $password = Input::get('password');
        $edit = array();

        for ($i=0; $i < sizeof($edit_selected_user); $i++)
        {
            $edit[$i] = '';
            $edit[$i] = users::find($edit_selected_user[$i]);
            $edit[$i]->name = $name[$i];
            $edit[$i]->email = $email[$i];
            $edit[$i]->phone = $phone[$i];
            $edit[$i]->password = Hash::make($password[$i]);

            $edit[$i]->save();
        }

        Session::flash('message','Successfully Update User!');
        return Redirect::to('user_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function user_delete()
    {
        $selected_user = Input::get('selected_user');

        for ($i=0; $i < sizeof($selected_user); $i++)
        {
            $delete_selected_user[$i] = users::where('id',$selected_user[$i])->delete();
        }

        Session::flash('message','Successfully Delete user!');
        return Redirect::to('user_index');
    }

    public function cetak_ListOfUser()
    {
        $btn_pdf = Input::get('btnpdf');
        $btn_xls = Input::get('btnxls');

        $database = \Config::get('database.connections.generic');
        $jasper = new JasperPHP();
        $filename = "laporan2";
        $reportPath =  "/views/laporan";
        

        $resource_path = $reportPath . "/" . "$filename.jasper";
        $public_path = "laporan/$filename";
        $pdf = "laporan/$filename.pdf";
        $xls = "laporan/$filename.xls";


        if(isset($btn_pdf))
        {
            $flag = "pdf";
        }
        if(isset($btn_xls))
        {
            $flag = "xls";
        }

        \JasperPHP::process(
            resource_path(). $resource_path,
            public_path()."/". $public_path,
            array("pdf", "xls"),
            array(),
            $database
            )->execute();

        return \View::make('report_index',
            array('report_title'=> 'LAPORAN SENARAI EDIT','pdf' => $pdf , 'xls' => $xls, 'flag' => $flag));
    }

     public function profile()
    {

    $user = Auth::users();
    return view('profile')->with(['user' => $users]);
    }
}

