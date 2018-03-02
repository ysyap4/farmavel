<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blur Admin</title>

  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>

  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/img/favicon-16x16.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/assets/img/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/favicon-96x96.png')}}">

  <!-- build:css({.tmp/serve,src}) styles/vendor.css -->
  <!-- bower:css -->
  <link rel="stylesheet" href="{{asset('admin/lib/ionicons.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/angular-toastr.css')}}">
  <link rel="stylesheet" href="{{asset('admin/lib/animate.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/bootstrap.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/bootstrap-select.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/bootstrap-switch.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/bootstrap-tagsinput.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/font-awesome.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/fullcalendar.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/leaflet.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/angular-progress-button-styles.min.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/chartist.min.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/morris.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/ion.rangeSlider.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/ion.rangeSlider.skinFlat.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/textAngular.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/xeditable.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/style.css')}}" >
  <link rel="stylesheet" href="{{asset('admin/lib/select.css')}}" >
  <!-- endbower -->
  <!-- endbuild -->

  <!-- build:css({.tmp/serve,src}) styles/auth.css -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin/app/auth.css')}}">
  <!-- endinject -->
  <!-- endbuild -->
</head>
<body>
<main class="auth-main">
  <div class="auth-block">
    <h1>Sign in to Blur Admin</h1>
    <a href="../../../../../../p2/blur-admin-1.3.1/dev-release/reg.html" class="auth-link">New to Blur Admin? Sign up!</a>

    <form class="form-horizontal">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default btn-auth">Sign in</button>
          <a href class="forgot-pass">Forgot password?</a>
        </div>
      </div>
    </form>

    <div class="auth-sep"><span><span>or Sign in with one click</span></span></div>

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