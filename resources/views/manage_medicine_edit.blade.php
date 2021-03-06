<!DOCTYPE html>
<?php
    use Illuminate\Support\Facades\Input;
?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmavel | Edit Medicine</title>

    <link href="{{URL::asset('inspinia-master/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            @if (is_null(Auth::user()->image))
                            <img alt="image" class="img-circle" style="height:48px; width:48px;" src="{{URL::asset('user_image/no_image.png')}}"/>
                            @else
                            <img alt="image" class="img-circle" style="height:48px; width:48px;" src="{{URL::asset(Storage::disk('s3')->url('user_image/' . Auth::user()->image))}}">
                            @endif
                            </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Admin <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li class="divider"></li>
                            <li>
                              <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        Farmavel
                    </div>
                </li>
                <li>
                    <a href="{{ url('/home') }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span> </a>
                </li>
                <li class="active">
                    <a href="{{ url('/home') }}"><i class="fa fa-table"></i> <span class="nav-label">Manage</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{URL::route('manage_user_index')}}">User</a></li>
                        <li class="active"><a href="{{URL::route('manage_medicine_index')}}">Medicine</a></li>
                        <li><a href="{{URL::route('manage_report_index')}}">Illegal Medicine Report</a></li>
                        <li><a href="{{URL::route('manage_appointment_index')}}">Appointment</a></li>
                        <li><a href="{{URL::route('manage_vas_index')}}">Value Added Service</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graph</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{URL::route('graph_alltime_index')}}">All-Time Charts</a></li>
                        <li><a href="{{URL::route('graph_periodic_index')}}">Periodic Charts</a></li>
                    </ul>
                </li>
                
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Farmavel Administration</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-warning">4</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/users.png')}}">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">NEW user</small>
                                    <strong>{{$lastest_user->name}}</strong> is registered to <strong>{{$lastest_user->type}}</strong>. <br>
                                    <small class="text-muted">{{$lastest_user->created_at}}</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/medicine.png')}}">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">NEW medicine</small>
                                    <strong>{{$lastest_med->med_name}}</strong> is added as <strong>{{$lastest_med->med_number}}</strong>. <br>
                                    <small class="text-muted">{{$lastest_med->created_at}}</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/report.png')}}">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">NEW report</small>
                                    <strong>{{$lastest_rep->rep_medicine}}</strong> at <strong>{{$lastest_rep->rep_location}}</strong> is reported. <br>
                                    <small class="text-muted">{{$lastest_rep->created_at}}</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/appointment.png')}}">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">NEW appointment</small>
                                    Appointment at <strong>{{$lastest_app->app_location}}</strong> by <strong>{{$lastest_app->app_method}}</strong> is confirmed. <br>
                                    <small class="text-muted">{{$lastest_rep->created_at}}</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Manage Medicine</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        <li>
                            <a>Manage</a>
                        </li>
                        <li>
                            <a>Medicine</a>
                        </li>
                        <li class="active">
                            <strong>Edit</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
    <form method="POST" class="form-horizontal" name="manage_medicine_edit_process" id="manage_medicine_edit_process" action="{{ URL::route ('manage_medicine_edit_process')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @for ($i=0; $i < sizeof($edit_selected_med); $i++)
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Medicine ID {{$edit_selected_med[$i]->id}} </h5>
                            <input type="hidden" name="edit_selected_med[]" value="{{ $edit_selected_med[$i]->id }}">
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                                <div class="form-group{{ $errors->has('med_number') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Medicine Number</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="med_number[]" class="form-control" name="med_number[]" placeholder="Medicine Number" value="{{$edit_selected_med[$i]->med_number}}">
                                        @if ($errors->has('med_number'))
                                            <p class="help-block">{{$errors ->first('med_number')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('med_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Medicine Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="med_name[]" class="form-control" name="med_name[]" placeholder="Medicine Name" value="{{$edit_selected_med[$i]->med_name}}">
                                        @if ($errors->has('med_name'))
                                            <p class="help-block">{{$errors ->first('med_name')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('med_category') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Category</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="med_category[]" class="form-control" name="med_category[]" placeholder="Category" value="{{$edit_selected_med[$i]->med_category}}">
                                        @if ($errors->has('med_category'))
                                            <p class="help-block">{{$errors ->first('med_category')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('med_authenticity') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Authenticity</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="med_authenticity[]" class="form-control" name="med_authenticity[]" placeholder="Authenticity" value="{{$edit_selected_med[$i]->med_authenticity}}">
                                        @if ($errors->has('med_authenticity'))
                                            <p class="help-block">{{$errors ->first('med_authenticity')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('med_ingredient') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Ingredient</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="med_ingredient[]" class="form-control" name="med_ingredient[]" placeholder="Ingredient" value="{{$edit_selected_med[$i]->med_ingredient}}">
                                        @if ($errors->has('med_ingredient'))
                                            <p class="help-block">{{$errors ->first('med_ingredient')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('med_info') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Medicine Info</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="med_info[]" class="form-control" name="med_info[]" placeholder="Medicine Info" value="{{$edit_selected_med[$i]->med_info}}">
                                        @if ($errors->has('med_info'))
                                            <p class="help-block">{{$errors ->first('med_info')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Medicine Image</label>
                                    <div class="row col-sm-10">
                                        <div class="col-md-6">
                                            <div class="image-crop">
                                                @if (is_null($edit_selected_med[$i]->med_image))
                                                    <img src="{{URL::asset('medicine_image/no_image.jpg')}}" id="change_image{{$i}}" style="height:300px; width:300px;">
                                                @else
                                                    <img src="{{URL::asset(Storage::disk('s3')->url('medicine_image/' . $edit_selected_med[$i]->med_image))}}" id="change_image{{$i}}" style="height:300px; width:300px;">
                                                @endif
                                            </div>
                                            <br>
                                            <div class="btn-group">
                                                <label title="Upload image file" for="inputImage">
                                                    <input type="file" accept="image/*" name="med_image[]" class="inputImage" set-to="change_image{{$i}}">
                                                    
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            @endfor
        <div class="form-group">
            <div class="col-sm-12 col-sm-offset-1">
                <a class="btn btn-white" href="{{ url()->previous() }}">Cancel</a>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>

            </div>
        </div>
        </form>


        <div class="footer">
            <div>
                <strong>Copyright</strong> Farmavel &copy; 2018
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="{{URL::asset('inspinia-master/assets/js/jquery-3.3.1.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('inspinia-master/assets/js/inspinia.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/pace/pace.min.js')}}"></script>

        <!-- iCheck -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                var imgId = $(input).attr('set-to');
                reader.onload = function (e) {
                    $('#'+imgId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".inputImage").change(function(){
            readURL(this);
        });
    </script>

</body>

</html>