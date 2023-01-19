@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')

<style type="text/css">
    .secciones_body{
        background-color: #234747;
        border-radius: 10px; 
        margin-bottom: 35px; 
        color: #fff; 
        text-align: center; 
        font-size: 20px;
    }
    /*este es para el diseño del archivo */
    .archivo{
      display: none;
    }

    .boton_file{
      display: inline-block;
      cursor: pointer;
      width: 50%;
    }
    html{
        background-color: #193333;
    }
</style>

<div>
    <h3 style="color: white; margin-bottom: 45px;">Subir documentos</h3>
</div>

@if(Session::get('tipo')== "error")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
          <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/>
          <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/>
          <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

@if(Session::get('tipo')== "agregado")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold; margin-bottom: 45px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
          <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

@if(Session::get('tipo')== "pdf_null")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold; margin-bottom: 45px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
          <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

@if(Session::get('tipo')== "falta")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold; margin-bottom: 45px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
          <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

@if(Session::get('tipo')== "actualizar")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold; margin-bottom: 45px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-files" viewBox="0 0 16 16">
          <path d="M13 0H6a2 2 0 0 0-2 2 2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 13V4a2 2 0 0 0-2-2H5a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM3 4a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4z"/>
        </svg> &nbsp;&nbsp;&nbsp;
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
        {{ Session::get('message') }}
        
    </div>
@endif

<div class="card-body secciones_body">
    
    @if($h_academico != null && $dictamen != null && $comprobante != null && $certificado != null)
    Todos los documentos han sido subidos correctamente, espera la comprobacion de los mismos, se le notificara al correo personal que proporcionaste o en la campana de notificaciones para que continues con tu tramite.
    <br>
    <div class="col-md-12" style="text-align: right;">
        <img src="{{url('icons/paloma.png')}}" style="width: 9vh; height: auto; margin-right: -25px; margin-bottom: -35px;">
    </div>

    @else

    Sube en cada uno el documento que se te solicita, el documento debe ser prefectamente legible y en formato PDF

    @endif
    
</div>

<div class="card-body secciones_body">
    @if($h_academico != null && $dictamen != null && $comprobante != null && $certificado != null)

    <form method="POST" action="{{url('/update_documents')}}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Historial academico</label><br>
                <img id="img1" src="{{url('icons/D5.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo1" type="file" name="h_academico" class="archivo" onchange="document_up_edit(this)" accept=".pdf">
                <label id="archivo1_button" for="archivo1" class="boton_file btn btn-success">Editar</label>
            </div>
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Dictamen</label><br>
                <img id="img2" src="{{url('icons/D6.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo2" type="file" name="dictamen" class="archivo" onchange="document_up_edit(this)" accept=".pdf">
                <label id="archivo2_button" for="archivo2" class="boton_file btn btn-success">Editar</label>
            </div>
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Comprobante de pago</label><br>
                <img id="img3" src="{{url('icons/D8.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo3" type="file" name="c_pago" class="archivo" onchange="document_up_edit(this)" accept=".pdf">
                <label id="archivo3_button" for="archivo3" class="boton_file btn btn-success">Editar</label>
            </div>
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Certificado medico</label><br>
                <img id="img4" src="{{url('icons/D9.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo4" type="file" name="c_medico" class="archivo" onchange="document_up_edit(this)" accept=".pdf">
                <label id="archivo4_button" for="archivo4" class="boton_file btn btn-success">Editar</label>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-11" style="text-align: left; padding: 20px">
                Solo sera cambiado el archivo que edites.
            </div>
            <div class="col-md-1">
                <br><br>
                <button class="btn btn-success" id="button_envio" disabled title="Guardar"><img src="{{url('icons/4305589.png')}}" style="width: 45px; height:auto;"></button>
            </div>
            
        </div>

    </form>
    
    @else
    <!-- este es para cuendo apenas los subira-->
    <form method="POST" action="{{url('/save_documents')}}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Historial academico</label><br>
                <img id="img1" src="{{url('icons/D1.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo1" type="file" name="h_academico" class="archivo" onchange="document_up(this)" accept=".pdf">
                <label id="archivo1_button" for="archivo1" class="boton_file btn btn-success">Subir</label>
            </div>
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Dictamen</label><br>
                <img id="img2" src="{{url('icons/D2.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo2" type="file" name="dictamen" class="archivo" onchange="document_up(this)" accept=".pdf">
                <label id="archivo2_button" for="archivo2" class="boton_file btn btn-success">Subir</label>
            </div>
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Comprobante de pago</label><br>
                <img id="img3" src="{{url('icons/D3.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo3" type="file" name="c_pago" class="archivo" onchange="document_up(this)" accept=".pdf">
                <label id="archivo3_button" for="archivo3" class="boton_file btn btn-success">Subir</label>
            </div>
            <div class="col-md-3" style="margin-bottom: 25px;">
                <label>Certificado medico</label><br>
                <img id="img4" src="{{url('icons/D4.png')}}" style="width: 25%; height: auto;"><br><br>
                <input id="archivo4" type="file" name="c_medico" class="archivo" onchange="document_up(this)" accept=".pdf">
                <label id="archivo4_button" for="archivo4" class="boton_file btn btn-success">Subir</label>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-11" style="text-align: left; padding: 20px">
                Al subir los 4 archivos no olvides presionar el botón guardar para que se envie tu progreso
            </div>
            <div class="col-md-1">
                <br><br>
                <button class="btn btn-success" id="button_envio" disabled title="Guardar"><img src="{{url('icons/4305589.png')}}" style="width: 45px; height:auto;"></button>
            </div>
            
        </div>

    </form>
    @endif
</div>


<div id="div_notification" class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="display: none; position: fixed; padding: 20px; background-color: #3d9970; width: auto;  margin-right: 25px;">
    <button type="button" class="close" style="margin-right: -17px; margin-top: -20px; " onclick="cerrar_div_notifiaction();">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
            <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
    </button>
    <br>
    hola soy las notifiaciones!!
</div>


@stop

@section('css')

@stop

@section('js')



<script type="text/javascript">
    

    function document_up(file){
        if (file.id=="archivo1") {
            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img1").src="{{url('icons/D5.png')}}";
                    document.getElementById("archivo1_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img1").src="{{url('icons/D1.png')}}";
                    document.getElementById("archivo1_button").innerHTML="subir";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img1").src="{{url('icons/D1.png')}}";
                document.getElementById("archivo1_button").innerHTML="subir";
                file.value=null;
            }
            
        }else if(file.id=="archivo2"){
            if (file.files[0]!=null){

                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img2").src="{{url('icons/D6.png')}}";
                    document.getElementById("archivo2_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img2").src="{{url('icons/D2.png')}}";
                    document.getElementById("archivo2_button").innerHTML="subir";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img2").src="{{url('icons/D2.png')}}";
                document.getElementById("archivo2_button").innerHTML="subir";
                file.value=null;
            }
            
        }else if(file.id=="archivo3"){
            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img3").src="{{url('icons/D8.png')}}";
                    document.getElementById("archivo3_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img3").src="{{url('icons/D3.png')}}";
                    document.getElementById("archivo3_button").innerHTML="subir";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img3").src="{{url('icons/D3.png')}}";
                document.getElementById("archivo3_button").innerHTML="subir";
                file.value=null;
            }
            
        }else if(file.id=="archivo4"){
            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img4").src="{{url('icons/D9.png')}}";
                    document.getElementById("archivo4_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img4").src="{{url('icons/D4.png')}}";
                    document.getElementById("archivo4_button").innerHTML="subir";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img4").src="{{url('icons/D4.png')}}";
                document.getElementById("archivo4_button").innerHTML="subir";
                file.value=null;
            }
            
        }
        documenten_exit(file);
        
    }

    function document_up_edit(file){
        if (file.id=="archivo1") {
            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img1").src="{{url('icons/D5.png')}}";
                    document.getElementById("archivo1_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img1").src="{{url('icons/D5.png')}}";
                    document.getElementById("archivo1_button").innerHTML="Editar";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img1").src="{{url('icons/D5.png')}}";
                document.getElementById("archivo1_button").innerHTML="Editar";
                file.value=null;
            }
            
        }else if(file.id=="archivo2"){
            if (file.files[0]!=null){

                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img2").src="{{url('icons/D6.png')}}";
                    document.getElementById("archivo2_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img2").src="{{url('icons/D6.png')}}";
                    document.getElementById("archivo2_button").innerHTML="Editar";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img2").src="{{url('icons/D6.png')}}";
                document.getElementById("archivo2_button").innerHTML="Editar";
                file.value=null;
            }
            
        }else if(file.id=="archivo3"){
            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img3").src="{{url('icons/D8.png')}}";
                    document.getElementById("archivo3_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img3").src="{{url('icons/D8.png')}}";
                    document.getElementById("archivo3_button").innerHTML="Editar";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img3").src="{{url('icons/D8.png')}}";
                document.getElementById("archivo3_button").innerHTML="Editar";
                file.value=null;
            }
            
        }else if(file.id=="archivo4"){
            if (file.files[0]!=null){
                if(file.value.split('.').pop()=="pdf"){
                    document.getElementById("img4").src="{{url('icons/D9.png')}}";
                    document.getElementById("archivo4_button").innerHTML="Cambiar";
                }else{
                    document.getElementById("img4").src="{{url('icons/D9.png')}}";
                    document.getElementById("archivo4_button").innerHTML="Editar";
                    alert("EL ARCHIVO DEBE SER PDF");
                    file.value=null;
                }
            }else{
                document.getElementById("img4").src="{{url('icons/D9.png')}}";
                document.getElementById("archivo4_button").innerHTML="Editar";
                file.value=null;
            }
            
        }
        //alert($('#archivo1').get(0).files[0]);
        if ($('#archivo1').get(0).files[0]==null && $('#archivo2').get(0).files[0]==null && $('#archivo3').get(0).files[0]==null && $('#archivo4').get(0).files[0]==null){

            document.getElementById("button_envio").disabled=true;
        }else{
            document.getElementById("button_envio").disabled=false;
        }
        
        
    }

    function documenten_exit(file){
        if(document.getElementById("img4").src=="{{url('icons/D9.png')}}" && document.getElementById("img3").src=="{{url('icons/D8.png')}}" && document.getElementById("img2").src=="{{url('icons/D6.png')}}" && document.getElementById("img1").src=="{{url('icons/D5.png')}}"){
            document.getElementById("button_envio").disabled=false;
        }else{
            document.getElementById("button_envio").disabled=true;
        }
    }


    //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        console.log("estás usando un móvil");
    }else{
        console.log("No estás usando un móvil");
    }

    function img_pathUrl(input){
      $('#img_url1')[0].src = (window.URL ? URL : webkitURL).createObjectURL();
  }

    document.getElementById("not_li").innerHTML='<a href="#" class="nav-link" id="notification"><i class="fas fa-solid far fa-bell"></i><span style="position: absolute;top: 2px; font-weight: 0; text-decoration: none;" id="number_notification">1</span></a>';

    document.getElementById("notification").addEventListener("click",function () {

        //asi se optiene el valor del objeto clickeado
        let rect = this.getBoundingClientRect();
        //asi del mause
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        document.getElementById("div_notification").style.top=rect.y+60+"px";
        //document.getElementById("div_notification").style.left=rect.x-180+"px";
        //document.getElementById("div_notification").style.position="absolute";
        if (document.getElementById("div_notification").style.display=="none"){
            document.getElementById("div_notification").style.display="block";
        }else{
            document.getElementById("div_notification").style.display="none";
        }
    })

    document.getElementById("div_notification").addEventListener("mouseleave",function(){
        document.getElementById("div_notification").style.display="none";
    });

    function cerrar_div_notifiaction(){
        document.getElementById("div_notification").style.display="none";
    }
    
</script>

@stop