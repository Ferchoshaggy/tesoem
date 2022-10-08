<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bienvenido</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'arial';
            background: #193333;
        }
        .but{
            padding: 15px 25px;
            border-radius: 15px; 
            font-size: 20px;
        }
        .but2{
            color: white;
            text-decoration: none;
        }
        .let{
            color: white;
            text-align: center;
            margin-top: 55px;
            font-size: 6vh;
            font-weight: bold;
        }
        li{
            background-color: white;
            height: 5px;
            list-style:none;
            margin-top: 55px;
        }
        .reg{
          border-radius: 15px;
          background: rgb(53, 184, 21);
          color: white;
          width: 100%;
          text-decoration: none;
          font-size: 45px;
          margin-top: 55px;
        }


   </style>

</head>
<div id="particles-js"  style="width: 100%; height: 100vh; position: fixed; z-index: -1;"></div>
<body style="padding-right: 20px; padding-left: 30px;">

<header>
    <div class="col-12">
        <div class="d-flex justify-content-end" style="margin-top:20px">
            @if (Route::has('login'))
                <div class="">
                    @auth
                <!--  <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a> -->
                    @else
                    <a href="#" class="but2"> Centro de Ayuda</a>
                        <a href="{{ route('login') }}" class="ms-4 btn btn-outline-light but">Iniciar Sesión</a>

                        @if (Route::has('register'))
            <!-- <a href="{{ route('register') }}" class="ms-4 text-muted">Register</a> -->
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</header>
<br>
<div class="row" style="padding-top: 5%;">
    <div class="col-md-6">
        <img src="{{asset('img/LogoT.png')}}" class="img-fluid" alt="logo">
        <h1 class="let">Te damos la bienvenida</h1>
        <li></li>
        <br>
        <a href="{{ route('register') }}" class="btn btn-success reg">Registrate</a>
    </div>

    <div class="col-md-6">
        <br>

    </div>

</div>



</body>
</html>
<script src="js/particles.min.js"></script>
<script src="js/particulass.js"></script>

