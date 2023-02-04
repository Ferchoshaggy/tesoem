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
    <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
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

/* carusel*/

.container-slider{
 width: 90%;
 max-width: 900px;
 margin: auto;
 overflow: hidden;
 position: relative;
 border-radius: 10px;
}
.slider{
display: flex;
width: 600%; /*Modificar si quiero agregar mas imagenes 100% por imagen*/
height: 400px;
margin-left: -100%;
}
.slider__section{
width: 100%;
}
.slider__img{
display: block;
width: 100%;
height: 100%;
object-fit: cover;
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
                    <a href="{{ url('/dashboard') }}" class="ms-4 btn btn-outline-light but">Entrar</a>
                    @else
                    <a href="{{url('/ayuda')}}" class="but2"> Centro de Ayuda</a>
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
<div class="row" >
    <div class="col-md-6">

        <img src="{{asset('img/LogoT.png')}}" class="img-fluid" alt="logo">
        <h1 class="let">Te damos la bienvenida</h1>
        <li></li>
        <br>
        <a href="{{ route('register') }}" class="btn btn-success reg">Registrate</a>
    </div>


    <div class="col-md-6">
        <br>
<div class="container-slider" >
    <div class="slider" id="slider">
      <div class="slider__section">
        <img src="{{asset('img/C1.png')}}" alt="" class="slider__img">
    </div>
      <div class="slider__section">
        <img src="{{asset('img/C2.png')}}" alt="" class="slider__img">
    </div>
      <div class="slider__section">
        <img src="{{asset('img/C3.png')}}" alt="" class="slider__img">
    </div>
      <div class="slider__section">
        <img src="{{asset('img/C4.jpg')}}" alt="" class="slider__img">
    </div>
    <div class="slider__section">
        <img src="{{asset('img/C5.jpg')}}" alt="" class="slider__img">
    </div>
    <div class="slider__section">
        <img src="{{asset('img/C6.jpg')}}" alt="" class="slider__img">
    </div>
    </div>

</div>
    </div>

</div>



</body>
</html>
<script src="js/particles.min.js"></script>
<script src="js/particulass.js"></script>

<script>
const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider__section");
let sliderSectionLast = sliderSection[sliderSection.length -1];

const btnLeft = document.querySelector("#btn-left");
const btnRight = document.querySelector("#btn-right");

slider.insertAdjacentElement('afterbegin',sliderSectionLast);

function Next(){
    let sliderSectionFirst = document.querySelectorAll(".slider__section")[0];
    slider.style.marginLeft="-200%";
    slider.style.transition="all 0.5s";
    setTimeout(function(){
        slider.style.transition="none";
        slider.insertAdjacentElement('beforeend',sliderSectionFirst);
        slider.style.marginLeft="-100%";
    }, 500);
}

function Prev(){
    let sliderSection = document.querySelectorAll(".slider__section");
    let sliderSectionLast = sliderSection[sliderSection.length -1];
    slider.style.marginLeft="0";
    slider.style.transition="all 0.5s";
    setTimeout(function(){
        slider.style.transition="none";
        slider.insertAdjacentElement('afterbegin',sliderSectionLast);
        slider.style.marginLeft="-100%";
    }, 500);
}


setInterval(function(){
Next();
}, 3000);

</script>
