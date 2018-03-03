<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Farmavel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('admin/assets/img/favicon-16x16.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('admin/assets/img/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{URL::asset('admin/assets/img/favicon-96x96.png')}}">

        <link rel="stylesheet" href="{{URL::asset('admin/lib/ionicons.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/angular-toastr.css')}}">
        <link rel="stylesheet" href="{{URL::asset('admin/lib/animate.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/bootstrap.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/bootstrap-select.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/bootstrap-switch.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/bootstrap-tagsinput.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/font-awesome.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/fullcalendar.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/leaflet.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/angular-progress-button-styles.min.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/chartist.min.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/morris.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/ion.rangeSlider.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/ion.rangeSlider.skinFlat.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/textAngular.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/xeditable.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/style.css')}}" >
        <link rel="stylesheet" href="{{URL::asset('admin/lib/select.css')}}" >

        <link rel="stylesheet" href="{{URL::asset('admin/app/auth.css')}}">

        <!-- Styles -->
        <!-- <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style> -->
    </head>

    <body>
        <main class="auth-main">
            <div class="auth-block">
                <div class="title m-b-md">
                    Farmavel
                </div>

                <div class="links">
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Login</a>
                            <a href="{{ url('/register') }}">Register</a>
                        @endif
                    @endif
                </div>
            </div>
        </main>

    </body>
</html>
