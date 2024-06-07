<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý phim</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/login.css')}}" rel="stylesheet">



</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div style="color: white;">
            <div >
                <h1 class="logo-name">App movie management</h1>
            </div>
            
            
         
            <div class="login">
                
                <form method="POST" role="form" action="{{route('auth.login')}}">
                   
                    <input type="text" name="TenDangNhap" placeholder="username" />
                    @if ($errors->has('TenDangNhap'))
                    <span class="error-message">*{{$errors->first('TenDangNhap')}}</span>

                    @endif
                    <input type="password" name="MatKhau" placeholder="Password"/>
                    @if ($errors->has('MatKhau'))
                    <span class="error-message">*{{$errors->first('MatKhau')}}</span>

                    @endif
                    <label>
                        <input style="width:max-content" type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block btn-large">Login</button>
                </form>
            </div>

    <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>

</html>