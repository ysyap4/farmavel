<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmavel | All-Time Charts</title>

    <link href="{{URL::asset('inspinia-master/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

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
                        <li class="active"><a href="{{URL::route('graph_alltime_index')}}">All-Time Charts</a></li>
                        <li><a href="{{URL::route('graph_periodic_index')}}">Periodic Charts</a></li>
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
                <h2>All-Time Charts</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ url('/home') }}">Home</a>
                    </li>
                    <li>
                        <a>Graphs</a>
                    </li>
                    <li class="active">
                        <strong>All-Time Charts</strong>
                    </li>
                    <li>
                        <a class="btn btn-sm btn-primary pull-right m-t-n-xs" href="{{URL::route('graph_alltime_index_pdf')}}" style="color:#fff;"><strong>Download PDF</strong> </a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pie Chart: Legal and Illegal Medicine</h5>

                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="doughnutChart" height="140"></canvas>
                            </div>
                            <h5><div class="color-box a3e1d4"></div> {{$pie_medicine_legal_count}} Legal </h5>
                            <h5><div class="color-box dedede"></div> {{$pie_medicine_illegal_count}} Illegal </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Polar Area: Medicine Categories</h5>

                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div class="text-center">
                                <canvas id="polarChart" height="140"></canvas>
                            </div>
                            <h5><div class="color-box a3e1d4"></div> {{$polar_medicine_traditional_count}} Traditional </h5>
                            <h5><div class="color-box dedede"></div> {{$polar_medicine_natural_count}} Natural ingredient </h5>
                            <h5><div class="color-box b5b8cf"></div> {{$polar_medicine_supplement_count}} Supplement </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Radar Chart: Number of Illegal Medicine Reports by Respective Locations </h5>
                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="radarChart"></canvas>
                            </div>
                            <table class="table-align-center">
                            <thead class="thead">
                                <tr>
                                    <th><h5>Area</h5></th>
                                    <th><h5><div class="color-box a3e1d4"></div>Number</h5></th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    <td><h5>Batu Pahat</h5></td>
                                    <td><h5>{{$radar_report_batupahat_count}}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Johor Bahru</h5></td>
                                    <td><h5>{{$radar_report_johorbahru_count}}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Muar</h5></td>
                                    <td><h5>{{$radar_report_muar_count}}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Segamat</h5></td>
                                    <td><h5>{{$radar_report_segamat_count}}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Kulaijaya</h5></td>
                                    <td><h5>{{$radar_report_kulaijaya_count}}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Skudai</h5></td>
                                    <td><h5>{{$radar_report_skudai_count}}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Pasir Gudang</h5></td>
                                    <td><h5>{{$radar_report_pasirgudang_count}}</h5></td>
                                </tr>
                            </tbody>
                            </table>
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


    <script type="text/javascript">
    $(function () {
    
        var polarData = [
            {
                value: {{$polar_medicine_traditional_count}},
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "Traditional"
            },
            {
                value: {{$polar_medicine_natural_count}},
                color: "#dedede",
                highlight: "#1ab394",
                label: "Natural ingredient"
            },
            {
                value: {{$polar_medicine_supplement_count}},
                color: "#b5b8cf",
                highlight: "#1ab394",
                label: "Supplement"
            }
        ];
    
        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: "rgba(255,255,255,0.75)",
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
    
        };
    
        var ctx = document.getElementById("polarChart").getContext("2d");
        var myNewChart = new Chart(ctx).PolarArea(polarData, polarOptions);
    
        var doughnutData = [
            {
                value: {{$pie_medicine_legal_count}},
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "Legal"
            },
            {
                value: {{$pie_medicine_illegal_count}},
                color: "#dedede",
                highlight: "#1ab394",
                label: "Illegal"
            },
        ];
    
        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
        };
    
    
        var ctx = document.getElementById("doughnutChart").getContext("2d");
        var myNewChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);
    
    
        var radarData = {
            labels: ["Batu Pahat", "Johor Bahru", "Muar", "Segamat", "Kulaijaya", "Skudai", "Pasir Gudang"],
            datasets: [
                {
                    label: "VnG400",
                    fillColor: "rgba(26,179,148,0.2)",
                    strokeColor: "rgba(26,179,148,1)",
                    pointColor: "rgba(26,179,148,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [{{$radar_report_batupahat_count}}, 
                            {{$radar_report_johorbahru_count}}, 
                            {{$radar_report_muar_count}}, 
                            {{$radar_report_segamat_count}}, 
                            {{$radar_report_kulaijaya_count}}, 
                            {{$radar_report_skudai_count}}, 
                            {{$radar_report_pasirgudang_count}}]
                }
            ]
        };
    
        var radarOptions = {
            scaleShowLine: true,
            angleShowLineOut: true,
            scaleShowLabels: false,
            scaleBeginAtZero: true,
            angleLineColor: "rgba(0,0,0,.1)",
            angleLineWidth: 1,
            pointLabelFontFamily: "'Arial'",
            pointLabelFontStyle: "normal",
            pointLabelFontSize: 10,
            pointLabelFontColor: "#666",
            pointDot: true,
            pointDotRadius: 3,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            responsive: true,
        }
    
        var ctx = document.getElementById("radarChart").getContext("2d");
        var myNewChart = new Chart(ctx).Radar(radarData, radarOptions);
    }); 
    </script>


</body>

</html>
