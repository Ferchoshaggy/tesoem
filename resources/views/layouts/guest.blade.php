<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: #193333;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style type="text/css">
            .btn-success:hover {
                color: #000000 !important;
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
        
        #not_li{
            background-color: #8340EC;
            border-radius: 8px;
            font-weight: bold;
            color: white;
            font-size: 20px;
            margin-right: 10px;
        }
        </style>

        <!-- Scripts -->
        <!--
        <script src="{{ mix('js/app.js') }}" defer></script>
        -->
        <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>

        <div class="col-12">
            <div class="d-flex justify-content-end" style="margin-top:20px">
                @if (Route::has('login'))
                    <div class="" style="padding-right: 10px;">
                        <button  id="not_li" class=" ms-4 btn" data-bs-toggle="modal" data-bs-target="#ver_ayuda"  style="margin-bottom: 25px;">Video de ayuda</button>
                        <a href="{{url('/ayuda')}}" class="ms-4 btn btn-outline-light but"  style="margin-bottom: 25px;"> Centro de Ayuda</a>
                        @auth
                            <a href="{{ route('index_vista') }}" class="ms-4 btn btn-outline-light but" style="margin-bottom: 25px;">Entrar</a>
                        @else
                        @endif
                    </div>
                @endif
            </div>
        </div>
        
    </head>
    <div id="particles-js"  style="width: 100%; height: 100vh; position: fixed; z-index: -1;"></div>
    <body class="font-sans antialiased" style="background-color: rgba(0, 0, 0, 0);">
        {{ $slot }}

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
    <script src="js/particles.min.js"></script>
    <script src="js/particulass.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function document_up(file){

            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="png" || file.value.split('.').pop()=="jpg" || file.value.split('.').pop()=="ico" || file.value.split('.').pop()=="gif"){
                    document.getElementById("text_file").innerHTML=file.value;
                }else{
                    alert("USA FORMATOS COMO png,jpg y gif. \n RECUERDA QUE NO ES OBLIGATORIA");
                    file.value=null;
                    document.getElementById("text_file").innerHTML="Campo no Obligatorio";
                }
            }else{
                file.value=null;
                document.getElementById("text_file").innerHTML="Campo no Obligatorio";
            }
        }
        document.getElementById("nombre").addEventListener("keyup",function(){
        this.value = this.value.toUpperCase();
        });

        document.getElementById("nombre").addEventListener("change",function(){
            this.value = this.value.toUpperCase();
        });

        $(document).ready(function() {
            $.ajax({
              url: "{{url('/carreras_tesoem')}}",
              dataType: "json",
              timeout : 80000,
              //context: document.body
            }).done(function(carreras) {

              if(carreras==null){
                console.log("sin carreras, por favor de avisar del problema");
              }else{
                for (var i = 0; i <carreras.length; i++) {
                    $("#select_carrera").append('<option value="'+carreras[i].id+'">'+carreras[i].nombre+'</option>');
                }
              }
            });
        });
    </script>
</html>