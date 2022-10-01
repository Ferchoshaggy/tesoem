<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

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
  border: 1px solid white;
  border-radius: 15px;
  color: white;
  padding: 15px 25px;
  text-decoration: none;
        }
        .but2{
            color: white;
            text-decoration: none;
        }
        .let{
            color: white;
            text-align: center;
        }
        hr{
            background-color: white
        }
        .reg{

  border-radius: 15px;
  background: rgb(53, 184, 21);
  color: white;
  padding: 20px 46%;
  text-decoration: none;

        }
        .x{
    text-align: center;position: relative;
    top: 50%;
    transform: translateY(50%);
    -webkit-transform: translateY(50%);
    -ms-transform: translateY(50%);
        }

    </style>
</head>
<div id="particles-js"></div>
<body>

    <div class="container-fluid fixed-top p-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                    <!--  <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a> -->
                        @else
                        <a href="#" class="but2"> Centro de Ayuda</a>
                            <a href="{{ route('login') }}" class="ms-4 but">Iniciar sesion</a>

                            @if (Route::has('register'))
                <!-- <a href="{{ route('register') }}" class="ms-4 text-muted">Register</a> -->
                            @endif
                        @endif
                    </div>
                @endif
            </div>

            <div class="row">
            <div class="col-md-6 x">
            <div style="position: relative; float: left;">
                <img src="{{asset('img/LogoT.png')}}" alt="logo"  width="600">
            </div>
            <h1 class="let">Te damos la bienvenida</h1>
            <hr>
            <br>
            <div>
                <a href="{{ route('register') }}" class="reg">Register</a>
            </div>
        </div>
        </div>


        </div>
    </div>

</body>
</html>
<script src="js/particles.min.js"></script>
<script src="js/particulass.js"></script>
