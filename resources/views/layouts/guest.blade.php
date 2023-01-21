<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: #193333;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style type="text/css">
            .btn-success:hover {
                color: #000000 !important;
            }
        </style>

        <!-- Scripts -->
        <!--
        <script src="{{ mix('js/app.js') }}" defer></script>
        -->
        <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
        
    </head>
    <div id="particles-js"  style="width: 100%; height: 100vh; position: fixed; z-index: -1;"></div>
    <body class="font-sans antialiased" style="background-color: rgba(0, 0, 0, 0);">
        {{ $slot }}
    </body>
    <script src="js/particles.min.js"></script>
    <script src="js/particulass.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
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