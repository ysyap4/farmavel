<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmavel | Periodic Charts</title>

    <link href="{{URL::asset('inspinia-master/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{URL::asset('inspinia-master/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/style.css')}}" rel="stylesheet">

    <link href="{{URL::asset('inspinia-master/assets/css/plugins/nouslider/nouislider.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/profile_small.jpg')}}"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Admin <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li class="divider"></li>
                            <li>
                              <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Manage</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{URL::route('manage_user_index')}}">User</a></li>
                        <li><a href="{{URL::route('manage_medicine_index')}}">Medicine</a></li>
                        <li><a href="{{URL::route('manage_report_index')}}">Illegal Medicine Report</a></li>
                        <li><a href="{{URL::route('manage_appointment_index')}}">Appointment</a></li>
                        <li><a href="{{URL::route('manage_vas_index')}}">Value Added Service</a></li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Graph</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{URL::route('graph_alltime_index')}}">All-Time Charts</a></li>
                        <li class="active"><a href="{{URL::route('graph_periodic_index')}}">Periodic Charts</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
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
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/a7.jpg')}}">
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
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/a4.jpg')}}">
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
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/profile.jpg')}}">
                                </a>
                                <div>
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

        </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Periodic Charts</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('/home') }}">Home</a>
                    </li>
                    <li>
                        <a>Graphs</a>
                    </li>
                    <li class="active">
                        <strong>Periodic Charts</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5> Periodic Charts </h5>
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
                        <div class="row">
                            <div class="col-sm-6 b-r"><h4 class="m-t-none m-b">Select information <small>to be displayed.</small> </h4>
                                <form role="form" method="GET" name="get_slider" id="get_slider" action="{{URL::route('graph_periodic_results')}}">
                                    <div class="form-group"><label>Information</label> 
                                        <div class="radio i-checks"><label> <input type="radio" value="Report" name="information" checked=""> <i></i> Report </label></div>
                                        <div class="radio i-checks"><label> <input type="radio" value="Appointment" name="information"> <i></i> Appointment </label></div>
                                    </div>
                            </div>
                            <div class="col-sm-6"><h4 class="m-t-none m-b">Select range <small>to be displayed.</small> </h4>
                                    <div class="form-group"><label>Range of months</label></div>
                                    <br><br>
                                    <div id="range_slider">
                                        <input type="hidden" id="get_slider_value1" value="1">
                                        <input type="hidden" id="get_slider_value2" value="">
                                    </div>
                                    <div class="form-group">
                                        <br><br>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" id="submit_periodic" type="submit"><strong>Submit</strong>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

    <!-- Flot -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('inspinia-master/assets/js/inspinia.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/pace/pace.min.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/chartJs/Chart.min.js')}}"></script>

    <script src="{{URL::asset('inspinia-master/assets/js/plugins/nouslider/wNumb.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/nouslider/nouislider.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <script type="text/javascript">

        var dragSlider = document.getElementById('range_slider');

        noUiSlider.create(dragSlider, {
            start: [ 1, 3 ],
            behaviour: 'drag',
            tooltips: true,
            connect: true,
            range: {
                'min':  1,
                'max':  12
            },
            format: wNumb({
                decimals: 0,
            })
        });

        document.getElementById('submit_periodic').addEventListener('click', function(){

            document.getElementById('get_slider_value1').value = dragSlider.noUiSlider.get()[0];
            document.get_slider.action = "{{URL::route('graph_periodic_results')}}";
            document.get_slider.submit();

        });
        
    </script>

    <style type="text/css">
        .color-box {
          float: left;
          width: 13px;
          height: 13px;
          margin-right: 5px;
          border: 1px solid rgba(0, 0, 0, .2);
        }
        
        .a3e1d4 {
          background: #a3e1d4;
        }
        
        .dedede {
          background: #dedede;
        }
        
        .b5b8cf {
          background: #b5b8cf;
        }

        .thead th, thead td {
            text-align: center;
            margin-right: 5px;
        }

        .tbody th, tbody td {
            text-align: center;
            margin-right: 5px;
        }
    </style>

</body>

</html>
