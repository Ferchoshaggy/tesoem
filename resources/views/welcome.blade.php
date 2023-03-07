<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bienvenido</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
#not_li{
        background-color: #8340EC;
        border-radius: 8px;
        font-weight: bold;
        color: white;
        font-size: 20px;
        margin-right: 10px;
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
                    <a href="{{ url('/redirects') }}" class="ms-4 btn btn-outline-light but" style="margin-bottom: 25px;">Entrar</a>
                    @else
                    <button  id="not_li" class="ms-4 btn" data-bs-toggle="modal" data-bs-target="#ver_ayuda"  style="margin-bottom: 25px;">Video de ayuda</button>
                        <a href="{{ route('login') }}" class="ms-4 btn btn-outline-light but"  style="margin-bottom: 25px;">Iniciar Sesión</a>

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
<!-- ayuda -->
<div class="modal fade" id="ver_ayuda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Ayuda</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style=" background-color: transparent; border: 0px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333; text-align: center;">
            <iframe width="100%" height="340" src="https://www.youtube.com/embed/4QuXhINRIaM" frameborder="0" allowfullscreen=""></iframe>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

</body>
</html>
<script src="js/particles.min.js"></script>
<script src="js/particulass.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
