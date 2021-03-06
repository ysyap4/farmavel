<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Farmavel | Login</title>

  <link href="{{URL::asset('inspinia-master/assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('inspinia-master/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
  <link href="{{URL::asset('inspinia-master/assets/css/animate.css')}}" rel="stylesheet">
  <link href="{{URL::asset('inspinia-master/assets/css/style.css')}}" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>

<body class="blur-bg">

    <h1 class="logo-name"><a href="{{ url('/') }}">Farmavel</a></h1>
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        
        <div>
            <h3>Welcome to Farmavel Administration</h3>

            <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <!--<label for="email" class="col-sm-2 control-label">Email</label>-->
                    
                    
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                        
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <!--<label for="password" class="col-sm-2 control-label">Password</label>-->

                    
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="{{ route('password.request') }}" class="forgot-pass"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a href="{{ url('/register') }}" class="btn btn-sm btn-white btn-block">Create an account</a>
            </form>
            <p class="m-t"> <small>Farmavel &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{URL::asset('inspinia-master/assets/js/jquery-2.1.1.js')}}"></script>
    <script src="{{URL::asset('inspinia-master/assets/js/bootstrap.min.js')}}"></script>

</body>

</html>
