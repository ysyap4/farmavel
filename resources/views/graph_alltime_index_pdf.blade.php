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
    
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pie Chart: Legal and Illegal Medicine</h5>

                            <div ibox-tools></div>
                        </div>
                        <div class="ibox-content">
                            <div style="width:800px; height:200;">
                                <canvas id="doughnutChart" height="140"></canvas>
                            </div>
                            <h5><div class="color-box blue"></div> {{$pie_medicine_legal_count}} Legal </h5>
                            <h5><div class="color-box grey"></div> {{$pie_medicine_illegal_count}} Illegal </h5>
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
                            <div class="text-center" style="width:800px; height:200;">
                                <canvas id="polarChart" height="140"></canvas>
                            </div>
                            <h5><div class="color-box blue"></div> {{$polar_medicine_traditional_count}} Traditional </h5>
                            <h5><div class="color-box grey"></div> {{$polar_medicine_natural_count}} Natural ingredient </h5>
                            <h5><div class="color-box purple"></div> {{$polar_medicine_supplement_count}} Supplement </h5>
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
                            <div style="width:800px; height:200;">
                                <canvas id="radarChart"></canvas>
                            </div>
                            <table class="table-align-center">
                            <thead class="thead">
                                <tr>
                                    <th><h5>Area</h5></th>
                                    <th><h5><div class="color-box blue"></div>Number</h5></th>
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
        
        .blue {
          background: #117A65;
        }
        
        .grey {
          background: #626567;
        }
        
        .purple {
          background: #633974;
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
                color: "#117A65",
                highlight: "#1ab394",
                label: "Traditional"
            },
            {
                value: {{$polar_medicine_natural_count}},
                color: "#626567",
                highlight: "#1ab394",
                label: "Natural ingredient"
            },
            {
                value: {{$polar_medicine_supplement_count}},
                color: "#633974",
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
                color: "#117A65",
                highlight: "#1ab394",
                label: "Legal"
            },
            {
                value: {{$pie_medicine_illegal_count}},
                color: "#626567",
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
