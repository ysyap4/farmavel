<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Farmavel</title>

  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>

  <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('admin/assets/img/favicon-16x16.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('admin/assets/img/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{URL::asset('admin/assets/img/favicon-96x96.png')}}">

  <!-- build:css({.tmp/serve,src}) styles/vendor.css -->
  <!-- bower:css -->
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
  <!-- endbower -->
  <!-- endbuild -->

  <!-- build:css({.tmp/serve,src}) styles/auth.css -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{URL::asset('admin/app/auth.css')}}">
  <!-- endinject -->
  <!-- endbuild -->
</head>

<body>
<main class="auth-main">
    <div class="auth-block">
        <h1>Sign up to Farmavel</h1>
        <a href="{{ url('/login') }}" class="auth-link">Sign in</a>

        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-sm-3 control-label">Name</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
            <label for="password-confirm" class="col-sm-3 control-label">Confirm-Password</label>

                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password-confirm" placeholder="Confirm Password" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                    <button type="submit" class="btn btn-default btn-auth col-sm-2">Sign up</button>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </form>

    <div class="auth-sep"><span><span>or Sign up with one click</span></span></div>

    <div class="al-share-auth">
      <ul class="al-share clearfix">
        <li><i class="socicon socicon-facebook" title="Share on Facebook"></i></li>
        <li><i class="socicon socicon-twitter" title="Share on Twitter"></i></li>
        <li><i class="socicon socicon-google" title="Share on Google Plus"></i></li>
      </ul>
    </div>
  </div>
</main>
</body>
</html>




