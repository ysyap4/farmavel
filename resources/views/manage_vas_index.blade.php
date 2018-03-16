<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmavel | Manage Value-Added Service</title>

    <link href="{{URL::asset('inspinia-master/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Data Tables -->
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/dataTables/dataTables.responsive.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/dataTables/dataTables.tableTools.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('inspinia-master/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('inspinia-master/assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('node_modules/sweetalert/dist/sweetalert.css')}}">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/profile_small.jpg')}}" />
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
                <li class="active">
                    <a href="{{ url('/home') }}"><i class="fa fa-table"></i> <span class="nav-label">Manage</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{URL::route('manage_user_index')}}">User</a></li>
                        <li><a href="{{URL::route('manage_medicine_index')}}">Medicine</a></li>
                        <li><a href="{{URL::route('manage_report_index')}}">Illegal Medicine Report</a></li>
                        <li><a href="{{URL::route('manage_appointment_index')}}">Appointment</a></li>
                        <li class="active"><a href="{{URL::route('manage_vas_index')}}">Value Added Service</a></li>
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
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{URL::asset('inspinia-master/assets/img/a7.jpg')}}">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">NEW user</small>
                                    <strong> {{$lastest_user->name}} </strong> is registered to <strong>Farmavel</strong>. <br>
                                    <small class="text-muted"> {{$lastest_user->created_at}} </small>
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
                                    <strong> {{$lastest_med->med_name}} </strong> is added as <strong>{{$lastest_med->med_number}}</strong>. <br>
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
                                <div class="media-body ">
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
                    <h2>Manage Value-Added Service</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        <li>
                            <a>Manage</a>
                        </li>
                        <li class="active">
                            <strong>Value-Added Service</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Value-Added Service Table</h5>
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
                        <a class="btn btn-primary" href="{{URL::route('manage_vas_create')}}">Add</a>
                        <a class="btn btn-primary" onClick="manage_vas_show()">Show</a>
                        <a class="btn btn-primary" onClick="manage_vas_edit()">Edit</a>
                        <button class="btn btn-primary" id="manage_vas_delete" onClick="manage_vas_delete()">Delete</button>
                    <form method="GET" name="get_checkbox">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="allBlogs">
                    <thead>
                    <tr>
                        <th style="text-align: center;">Select</th>
                        <th style="text-align: center;">Index</th>
                        <th>VAS Medicine Name</th>
                        <th>Batu Pahat</th>
                        <th>Johor Bahru</th>
                        <th>Muar</th>
                        <th>Segamat</th>
                        <th>Kulaijaya</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($vas as $value)
                    <tr>
                        <td style="text-align: center;"><div class="checkbox i-checks"> <input type="checkbox" name="selected_vas[]" value="{{ $value->id }}" id="selected_vas"> <i></i> </div></td>
                        <td style="text-align: center;"><?php echo $no ?></td>
                        @foreach($med as $value2)
                            @if($value->med_id === $value2->id)
                                <td> {{$value2->med_name}} </td>
                            @endif
                        @endforeach
                        <td>{{ $value->vas_availability_batupahat }}</td>
                        <td>{{ $value->vas_availability_johorbahru }}</td>
                        <td>{{ $value->vas_availability_muar }}</td>
                        <td>{{ $value->vas_availability_segamat }}</td>
                        <td>{{ $value->vas_availability_kulaijaya }}</td>
                    </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="text-align: center;">Select</th>
                        <th style="text-align: center;">Index</th>
                        <th>VAS Medicine Name</th>
                        <th>Batu Pahat</th>
                        <th>Johor Bahru</th>
                        <th>Muar</th>
                        <th>Segamat</th>
                        <th>Kulaijaya</th>
                    </tr>
                    </tfoot>
                    </table>
                    </form>

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
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/jeditable/jquery.jeditable.js')}}"></script>
    <script src="{{URL::asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>

    <!-- Data Tables -->
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/dataTables/dataTables.responsive.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/dataTables/dataTables.tableTools.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('inspinia-master/assets/js/inspinia.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/plugins/iCheck/icheck.min.js')}}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "{{URL::asset('inspinia-master/assets/js/plugins/pace/copy_csv_xls_pdf.swf')}}"
                }
            });

            /* Init DataTables */
            var oTable = $('#editable').dataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '{{URL::asset('node_modules/jquery-jeditable/save.blade.php')}}', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>

    <script type="text/javascript">
    function manage_vas_show()
    {
        var x =[];

        if (this.checked)
        {
          $('#selected_vas').removeAttr('disabled');
          $('#allBlogs :checked').each(function()
          {
            x.push($(this).val());
          });
        }

        x = document.getElementById("selected_vas").value;
        document.get_checkbox.action = "{{URL::route('manage_vas_show')}}";
        document.get_checkbox.submit();
    }
    </script>

    <script type="text/javascript">
    function manage_vas_edit()
    {
        var x =[];

        if (this.checked)
        {
          $('#selected_vas').removeAttr('disabled');
          $('#allBlogs :checked').each(function()
          {
            x.push($(this).val());
          });
        }

        x = document.getElementById("selected_vas").value;
        document.get_checkbox.action = "{{URL::route('manage_vas_edit')}}";
        document.get_checkbox.submit();
    }
    </script>

    <script type="text/javascript">
    function manage_vas_delete()
    {
        var x =[];

        $('button#manage_vas_delete').on('click',
            function(){
              swal({
               title: "Are you sure?",
               text: "You will not be able to recover this report!",
               type: "warning",
               html: true,
               showCancelButton: true,
               confirmButtonColor: '#3ebf8f',
               confirmButtonText: 'Yes,delete it!',
               closeOnConfirm: true,
               showLoaderOnConfirm: false
              },
              function(){
                $.ajax({
                     success: function (userRows) {
                         swal({
                               title: "Removed report(s)!",
                               type: "success",
                               html: true,
                               showCancelButton: false,
                               confirmButtonColor: '#3ebf8f',
                               confirmButtonText: 'OK',
                               closeOnConfirm: true
                               },
                               function(){
        
                                 if (this.checked)
                {
                  $('#selected_vas').removeAttr('disabled');
                  $('#allBlogs :checked').each(function()
                  {
                    x.push($(this).val());
                  });
                }
        
                x = document.getElementById("selected_vas").value;
                document.get_checkbox.action = "{{URL::route('manage_vas_delete')}}";
                document.get_checkbox.submit();
                         
           });
          }
        });
      });
    })
       
    }
    </script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

<style>
    body.DTTT_Print {
        background: #fff;

    }
    .DTTT_Print #page-wrapper {
        margin: 0;
        background:#fff;
    }

    button.DTTT_button, div.DTTT_button, a.DTTT_button {
        border: 1px solid #e7eaec;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }
    button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
        border: 1px solid #d2d2d2;
        background: #fff;
        color: #676a6c;
        box-shadow: none;
        padding: 6px 8px;
    }

    .dataTables_filter label {
        margin-right: 5px;

    }
</style>
</body>

</html>