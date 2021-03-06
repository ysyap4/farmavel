<!DOCTYPE html>
<?php
    use Illuminate\Support\Facades\Input;
?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmavel | Edit Report</title>

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
                        <li><a href="{{URL::route('manage_medicine_index')}}">Medicine</a></li>
                        <li class="active"><a href="{{URL::route('manage_report_index')}}">Illegal Medicine Report</a></li>
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
                    <h2>Manage Report</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        <li>
                            <a>Manage</a>
                        </li>
                        <li>
                            <a>Report</a>
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
    <form method="POST" class="form-horizontal" name="manage_report_edit_process" id="manage_report_edit_process" action="{{ URL::route ('manage_report_edit_process')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @for ($i=0; $i < sizeof($edit_selected_rep); $i++)
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Report ID {{$edit_selected_rep[$i]->id}} </h5>
                            <input type="hidden" name="edit_selected_rep[]" value="{{ $edit_selected_rep[$i]->id }}">
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
                                <div class="form-group{{ $errors->has('rep_medicine') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Reported Medicine Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="rep_medicine[]" class="form-control" name="rep_medicine[]" placeholder="Reported Medicine Name" value="{{$edit_selected_rep[$i]->rep_medicine}}">
                                        @if ($errors->has('rep_medicine'))
                                            <p class="help-block">{{$errors ->first('rep_medicine')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('rep_location') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Report Location</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="rep_location[]" class="form-control" name="rep_location[]" placeholder="Report Location" value="{{$edit_selected_rep[$i]->rep_location}}">
                                        @if ($errors->has('rep_location'))
                                            <p class="help-block">{{$errors ->first('rep_location')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Reported by</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="user_name[]" class="form-control" name="user_name[]" placeholder="Reported by" value="{{$get_selected_user[$i]->name}}">
                                        @if ($errors->has('user_name'))
                                            <p class="help-block">{{$errors ->first('user_name')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('rep_info') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Report Info</label>

                                    <div class="col-sm-10">
                                        <input type="text" id="rep_info[]" class="form-control" name="rep_info[]" placeholder="Report Info" value="{{$edit_selected_rep[$i]->rep_info}}">
                                        @if ($errors->has('rep_info'))
                                            <p class="help-block">{{$errors ->first('rep_info')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Report Image</label>
                                    <div class="row col-sm-10">
                                        <div class="col-md-6">
                                            <div class="image-crop">
                                                @if (is_null($edit_selected_rep[$i]->rep_image))
                                                    <img src="{{URL::asset('report_image/no_image.jpg')}}" id="change_image{{$i}}" style="height:300px; width:300px;">
                                                @else
                                                    <img src="{{URL::asset(Storage::disk('s3')->url('report_image/' . $edit_selected_rep[$i]->rep_image))}}" id="change_image{{$i}}" style="height:300px; width:300px;">
                                                @endif
                                            </div>
                                            <br>
                                            <div class="btn-group">
                                                <label title="Upload image file" for="inputImage">
                                                    <input type="file" accept="image/*" name="rep_image[]" class="inputImage" set-to="change_image{{$i}}">
                                                    
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