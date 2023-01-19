@extends('adminlte::page')

@section('title', 'Configuración de Usuario')

@section('content_header')
<!--este es para el selected2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" >

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

@stop
@section('content')
<style type="text/css">
  input[type="file"]{
        background: white;
        outline: none;
    }
    ::-webkit-file-upload-button{
      margin-top: -20px;
      margin-left: -12px;
      background: #00A1D8;
      color: white;
      height: 35px;
      border: none;
      outline: none;
      font-weight: bolder;
      cursor: pointer;
      border-radius: 5px;
    }
    ::-webkit-file-upload-button:hover{
      background: #111111;

    }
    .redondeo_img{
      border-radius: 100px; 
      width: 200px; 
      height: 200px;
      box-shadow: 0 8px 12px rgba(0,0,0);
      transition: 1s;
    }

    .redondeo_img:hover{
      transition: 1s;
      border-radius: 10px;
      cursor: pointer;
    }
    .input_edit{
        font-size: 1.3rem;
        font-weight: bold;
    }
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
        font-weight: bold; 
        font-size: 1.3rem; 
        color: #8f9ca8; 
        cursor: pointer;
        padding-top: 3px;
    }
    html{
        background-color: #193333;
    }
</style>
<div>
    <h3 style="color: white; margin-bottom: 45px;">Configuración de usuario</h3>
</div>
@if(Session::has('message'))
<div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold; margin-bottom: 45px;">
  
  @if(Session::get('color')=="warning")
  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
  </svg>
  @endif

  @if(Session::get('color')=="danger")
  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bug-fill" viewBox="0 0 16 16">
  <path d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956z"/>
  <path d="M13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z"/>
</svg>
  @endif

   {{ Session::get('message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" >
          <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
      </svg>
  </button>
</div>
@endif



<div class="card-body secciones_body">
  <form method="POST" action="{{url('/Actualizar_user')}}" enctype="multipart/form-data">
    @csrf
    @foreach($datos_user as $dato)
    <div class="row">
      <div class="col-md-6" style="text-align: center; margin-bottom: 25px;">
        @if($dato->foto==null)
        <div style="background-image: url(./img/portada{{rand(1,12)}}.gif); background-size: cover; background-repeat:no-repeat; background-position: center center; border-radius: 10px; padding-top: 20px; padding-bottom: 20px;">
          <img class="redondeo_img" src="https://picsum.photos/300/300" id="foto" data-toggle="modal" data-toggle="modal" data-target="#ver_foto">
        </div>
        <br>
        <label>SIN FOTO, SE TE OTORGA UNA ALEATORIA</label><br>
        <label>PARA CAMBIARLA SOLO AGREGA UNA NUEVA  &nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
        </svg></label>
        <input type="file" name="foto" id="foto_archivo" class="form-control input_edit archivo" onchange="cambio_foto(this);">
        <label id="button_file" for="foto_archivo" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;Subir foto nueva</label>
        @else
        <div style="background-image: url(./img/portada{{rand(1,12)}}.gif); background-size: cover; background-repeat:no-repeat; background-position: center center; border-radius: 10px; padding-top: 20px; padding-bottom: 20px;">
          <img class="redondeo_img" src="fotos_users\{{$dato->foto}}" id="foto" data-toggle="modal" data-toggle="modal" data-target="#ver_foto">
        </div>
        <br>
        <label>FOTO ACTUAL, PUEDES CAMBIARLA</label><br>
        <label>PARA CAMBIARLA SOLO AGREGA UNA NUEVA  &nbsp;  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
        </svg></label>
        <input type="file" name="foto" id="foto_archivo" class="form-control input_edit archivo" onchange="cambio_foto(this);">
        <label id="button_file" for="foto_archivo" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;Subir foto nueva</label>
        @endif
      </div>

      <div class="col-md-6" style="margin-bottom: 25px;">
        <div class="row">
          
          <div class="col-md-4" style="margin-bottom: 25px;">
            
            <input type="text" name="nombre" class="form-control input_edit" placeholder="NOMBRE USUARIO" required value="{{$dato->name}}" onkeyup="this.value = this.value.toUpperCase();">
          </div>
          <div class="col-md-4" style="margin-bottom: 25px;">
            
            <input type="text" name="ape_pat" class="form-control input_edit" placeholder="APELLIDO PATERNO" required value="{{$dato->ape_pat}}" onkeyup="this.value = this.value.toUpperCase();">
          </div>
          <div class="col-md-4" style="margin-bottom: 25px;">
            
            <input type="text" name="ape_mat" class="form-control input_edit" placeholder="APELLIDO MATERNO" required value="{{$dato->ape_mat}}" onkeyup="this.value = this.value.toUpperCase();">
          </div>

        </div>

        <div class="row">
          
          <div class="col-md-4" style="margin-bottom: 25px;">
            
            <input type="number" name="edad" class="form-control input_edit" placeholder="Edad minima de 10" min="10" required value="{{$dato->edad}}">
          </div>
          <div class="col-md-8" style="margin-bottom: 25px;">
            
            <input type="text" name="direccion" class="form-control input_edit" placeholder="DIRECCIÓN SEA LO MAS SIMPLE POR FAVOR" required value="{{$dato->direccion}}">
          </div>
          

        </div>

        <div class="row">
          
          <div class="col-md-6" style="margin-bottom: 25px;">
            
            <input type="text" name="correo" class="form-control input_edit" placeholder="CORREO" required value="{{$dato->email}}">
          </div>
          <div class="col-md-6" style="margin-bottom: 25px;">
            
            <div class="input-group mb-3">
              <input type="password" name="contrasena" class="form-control input_edit" placeholder="Contraseña nueva" aria-label="AGREGA SI DESEAS CAMBIAR" aria-describedby="button-addon2" id="contra" minlength="8" value="">

              <button class="btn btn-light" type="button" id="button-addon2" onclick="ver_contrasena();">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                  <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                  <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                </svg>
              </button>

            </div>
          </div>

        </div>
        
        <div class="col-md-12" style="margin-bottom: 25px; text-align: center;">
          <button class="btn btn-success" style="font-weight: bold; font-size: 20px;">ACTUALIZAR</button>
        </div>
      </div>

    </div>
    @endforeach
    

  </form>
  
</div>


<!-- vsita imagen-->
<div class="modal fade" id="ver_foto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; background-color: #111111bd;">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
      <div class="modal-header" style="border-bottom: 1px solid #193333;">
        <h3 class="modal-title" id="exampleModalLabel">IMAGEN ACTUAL</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
            <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          </svg>
        </button>
      </div>
      <div class="modal-body" style="border-bottom: 1px solid #193333; text-align: center;">

        <div class="secciones_body" style="padding-top: 25px; padding-bottom: 25px; margin-bottom: 0px;">
          @if($dato->foto==null)
          <img src="https://picsum.photos/300/300"  id="foto_2" width="80%" height="auto"><br>
          @else
          <img  src="fotos_users\{{$dato->foto}}"  id="foto_2" width="80%" height="auto"><br>
          @endif
        </div>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #193333;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ACEPTAR</button>
      </div>
    </div>
  </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- este es para el selected2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.table').DataTable({
       "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       }
    });
  });

  function ver_contrasena(){

    if(document.getElementById("contra").type=="password"){

      document.getElementById("contra").type="text";

      document.getElementById("button-addon2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"> <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/> </svg>';

    }else{

      document.getElementById("contra").type="password";
      document.getElementById("button-addon2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"> <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/> <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/> </svg>';
    }
  }

  function cambio_foto(file){
    var url_img=null;
    if (file.files[0]!=null){
        if(file.value.split('.').pop()=="gif" || file.value.split('.').pop()=="png" || file.value.split('.').pop()=="jpg" || file.value.split('.').pop()=="ico"){

          document.getElementById("foto").src= (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
          document.getElementById("foto_2").src= (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
            
          document.getElementById("button_file").innerHTML=file.value;
        
        }else{
            
            document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;Subir foto nueva';
            alert("EL ARCHIVO NO ES DE TIPO IMAGEN");
            file.value=null;
            
            if("{{$dato->foto}}"!=""){

              url_img="{{url('fotos_users')}}/{{$dato->foto}}";
            }else{
              url_img="https://picsum.photos/300/300";
            }
            document.getElementById("foto").src=url_img;
            document.getElementById("foto_2").src=url_img;
        }
    }else{
        
        document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;Subir foto nueva';
        file.value=null;
        if("{{$dato->foto}}"!=""){

          url_img="{{url('fotos_users')}}/{{$dato->foto}}";
        }else{
          url_img="https://picsum.photos/300/300";
        }
        document.getElementById("foto").src=url_img;
        document.getElementById("foto_2").src=url_img;
    }


  }

</script>

@stop