<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmavel | Dashboard</title>

    <link href="{{URL::asset('inspinia-master/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Morris -->
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">

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
                <li class="active">
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
                                    <small class="pull-right">NEW report</small>
                                    Report of<strong>{{$lastest_rep->rep_medicine}}</strong> at <strong>{{$lastest_rep->rep_location}}</strong> is submitted. <br>
                                    <small class="text-muted">{{$lastest_rep->created_at}}</small>
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
                                    <small class="pull-right">NEW appointment</small>
                                    New appointment at <strong>{{$lastest_app->app_location}}</strong> by <strong>{{$lastest_app->app_method}}</strong> is confirmed. <br>
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


        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Total</span>
                        <h5>Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$user_count}} </h1>
                        <small>Users in system</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$user_sub_count[0]->sub_count}} </h1>
                        <small>{{$user_sub_count[0]->type}}</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$user_sub_count[1]->sub_count}} </h1>
                        <small>{{$user_sub_count[1]->type}}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Total</span>
                        <h5>Medicine</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success">{{$med_count}}</h1>
                        <small>Medicine in system</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$med_sub_count[0]->sub_count}} </h1>
                        <small>{{$med_sub_count[0]->med_category}}</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$med_sub_count[1]->sub_count}} </h1>
                        <small>{{$med_sub_count[1]->med_category}}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Total</span>
                        <h5>Report</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success">{{$rep_count}}</h1>
                        <small>Report in system</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$rep_sub_count[0]->sub_count}} </h1>
                        <small>{{$rep_sub_count[0]->rep_location}}</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$rep_sub_count[1]->sub_count}} </h1>
                        <small>{{$rep_sub_count[1]->rep_location}}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Total</span>
                        <h5>Appointment</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success">{{$app_count}}</h1>
                        <small>Appointment in system</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$app_sub_count[0]->sub_count}} </h1>
                        <small>{{$app_sub_count[0]->app_method}}</small>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins font-bold text-success"> {{$app_sub_count[1]->sub_count}} </h1>
                        <small>{{$app_sub_count[1]->app_method}}</small>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Monthly income</h5>
                        <div class="ibox-tools">
                            <span class="label label-primary">Updated 12.2015</span>
                        </div>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="flot-chart m-t-lg" style="height: 55px;">
                            <div class="flot-chart-content" id="flot-chart1"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div>
                                        <span class="pull-right text-right">
                                        <small>Average value of sales in the past month in: <strong>United states</strong></small>
                                            <br/>
                                            All sales: 162,862
                                        </span>
                            <h3 class="font-bold no-margins">
                                Half-year revenue margin
                            </h3>
                            <small>Sales marketing.</small>
                        </div>

                        <div class="m-t-sm">

                            <div class="row">
                                <div class="col-md-8">
                                    <div>
                                        <canvas id="lineChart" height="114"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <ul class="stat-list m-t-lg">
                                        <li>
                                            <h2 class="no-margins">2,346</h2>
                                            <small>Total orders in period</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 48%;"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins ">4,422</h2>
                                            <small>Orders in last month</small>
                                            <div class="progress progress-mini">
                                                <div class="progress-bar" style="width: 60%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="m-t-md">
                            <small class="pull-right">
                                <i class="fa fa-clock-o"> </i>
                                Update on 16.07.2015
                            </small>
                            <small>
                                <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                            </small>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-warning pull-right">Data has changed</span>
                        <h5>User activity</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>236 321.80</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>46.11%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>432.021</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>643 321.10</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>92.43%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>564.554</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-4">
                                <small class="stats-label">Pages / Visit</small>
                                <h4>436 547.20</h4>
                            </div>

                            <div class="col-xs-4">
                                <small class="stats-label">% New Visits</small>
                                <h4>150.23%</h4>
                            </div>
                            <div class="col-xs-4">
                                <small class="stats-label">Last week</small>
                                <h4>124.990</h4>
                            </div>
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
    <script src="{{URL::asset('inspinia-master/assets/js/jquery-2.1.1.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/jquery.flot.symbol.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/flot/curvedLines.js')}}"></script>

    <!-- Peity -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('inspinia-master/assets/js/inspinia.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- Jvectormap -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{URL::asset('inspinia-master/assets/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/chartJs/Chart.min.js')}}"></script>

    <script>
        $(document).ready(function() {


            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false,
                }
            });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    },
                    {
                        label: "Example dataset",
                        fillColor: "rgba(26,179,148,0.5)",
                        strokeColor: "rgba(26,179,148,0.7)",
                        pointColor: "rgba(26,179,148,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

        });
    </script>
</body>
</html>
