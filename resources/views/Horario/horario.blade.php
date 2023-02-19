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
    .edit_select{
        font-weight: bold;
        font-size: 1.3rem;
        padding-left: 10px;
        padding-top: 4px;
    }

    .input_edit {
        font-size: 1.3rem;
        font-weight: bold;
    }
    .form-control:disabled, .form-control[readonly] {
        background-color: #ababab !important;
    }
</style>

<div>
    <h3 style="color: white; margin-bottom: 45px;">Horario</h3>
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
    <div class="row">
        <div class="col-md-10" style="text-align: justify;">
            En este apartado crearas tu horario acorde con las materias que no pudiste convalidar y que te restan por cursar para tu plan de estudios, selecciona las materias con cautela tomando en cuenta tus horarios y las materias sin exceder el limite de creditos que puedes cursar por semestre.
        </div>
        <div class="col-md-2" style="text-align: center;">
            <img src="{{url('icons/horario.png')}}" style="width: 75%; height: auto;">
        </div>
    </div>
</div>
<form method="POST" action="" enctype="multipart/form-data" id="form_horario">
    @csrf
    <div class="card-body secciones_body">
        <div class="row">
            <div class="col-md-3" style="text-align: left; margin-bottom: 25px;">
                <button type="button" class="btn" style="background-color: #F076FF; color: #fff; font-size: 1.3rem; font-weight: bold;" disabled data-toggle="modal" data-target="#pdf_horario" id="generar_doc" onclick="envio_form_institucion();">GENERAR DOCUMENTO</button>
            </div>
            <div class="col-md-3" style="text-align: left; margin-bottom: 25px;">
                <button type="button" class="btn" style="background-color: #FF8F00; color: #fff; font-size: 1.3rem; font-weight: bold;" data-toggle="modal" data-target="#pdf_horario_carrera">VER HORARIOS</button>
            </div>
            <div class="col-md-6" style="text-align: right; margin-bottom: 25px;">
                <div class="row">
                    <div class="col-md-6" style="text-align: right;">
                        Total de Creditos:
                    </div>
                    <div class="col-md-6">
                        <input class="form-control input_edit" type="text" name="creditos_totales" id="creditos_totales" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div id="div_central" style="margin-top: 35px; max-height: 400px; overflow-y: auto; overflow-x: hidden;" class="multiple">
            <div class="row">
                <div class="col-md-5" style="margin-bottom: 25px; text-align: justify;">
                    <label>Materias</label>
                    <select class="form-control edit_select" id="materias[]" name="materias[]" data-fila="0" onchange="agregar_clave(this); verificar_empy(); diferentes(this);">
                        <option selected disabled value="">Materias</option>
                        @foreach($materias as $materia)
                        @if($materia->calificacion<=69)
                        <option value="{{$materia->id}}">{{$materia->nombre}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2" style="margin-bottom: 25px; text-align: justify;">
                    <label>Clave</label>
                    <input type="text" name="calve[]" id="clave[]" class="form-control input_edit" disabled data-fila="0" onchange="verificar_empy();" onkeyup="verificar_empy();">
                    <input type="hidden" name="creditos0" id="creditos0" data-fila="0">
                </div>
                <div class="col-md-2" style="margin-bottom: 25px; text-align: justify;">
                    <label>Grupo</label>
                    <input type="text" name="grupo[]" id="grupo[]" class="form-control input_edit" data-fila="0" onchange=" this.value = this.value.toUpperCase(); verificar_empy();" onkeyup="this.value = this.value.toUpperCase(); verificar_empy();">
                </div>
                <div class="col-md-2" style="margin-bottom: 25px; text-align: justify;">
                    <label>Temario</label><br>
                    <button type="button" class="btn btn-warning" style="width: 100%; font-size: 1.3rem; font-weight: bold; padding-top: 3px; padding-bottom: 3px;" data-fila="0" id="ver_temario0" disabled onclick="pasar_url_temario(0);" data-toggle="modal" data-target="#pdf_temario">ver</button>
                    <input type="hidden" name="temario0" id="temario0" data-fila="0">
                </div>
                <div class="col-md-1" style="margin-bottom: 25px; text-align: justify;">
                    <br>
                    <button type="button" class="btn btn-success" style="width: 100%; font-size: 1.3rem; font-weight: bold; margin-top: 8px; padding-top: 3px; padding-bottom: 3px;" data-fila="0" onclick="agregar_fila();">+</button>
                </div>
            </div>
        </div>
    </div>

</form>


<!-- modal de ver pdf-->
<div class="modal fade" id="pdf_horario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Horario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" margin-bottom: 0px;">
                <div class="col-md-12" id="carga_espera">
                    <img src="{{url('img/cargando_12.gif')}}" style="width: 100%; height: auto; border-radius: 10%; "><br>
                    Espere un momento...
                </div>
                <div id="contenido_pdf" style="display: none;">
                    <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira">
                        <p>UPss! &nbsp;&nbsp; !SI EL PDF NO SE VISUALIZA O DESCARGA, PRECIONA AQUI!</p>
                        <a class="btn btn-success" target="_blank" href="" id="ir_otro_lado">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
                    </div>
                    <embed type="application/pdf" src="" style="width:100%; height: 600px;" id="visor_pdf">
                </div>
                
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- modal de ver pdf-->
<div class="modal fade" id="pdf_horario_carrera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Horarios de la carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">
            @if($horarios_pdf!=null)
            <div class="card-body secciones_body" style=" margin-bottom: 0px;">
                <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira_3">
                    <p>UPss! &nbsp;&nbsp; !SI EL PDF NO SE VISUALIZA O DESCARGA, PRECIONA AQUI!</p>
                    <a class="btn btn-success" target="_blank" href="{{url('/horarios_c_docente')}}/{{$horarios_pdf->horario}}" id="ir_otro_lado_3">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
                </div>
                <embed type="application/pdf" src="{{url('/horarios_c_docente')}}/{{$horarios_pdf->horario}}" style="width:100%; height: 600px;" id="visor_pdf_3">
            </div>
            @else
            <div>El administrador no ha subido el horario, regresa cuando ya este cargado</div>
            @endif
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- modal de ver pdf-->
<div class="modal fade" id="pdf_temario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Temario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" margin-bottom: 0px;">
                <div class="col-md-12" style="text-align: center;display: none;" id="no_se_mira_2">
                    <p>UPss! &nbsp;&nbsp; !SI EL PDF NO SE VISUALIZA O DESCARGA, PRECIONA AQUI!</p>
                    <a class="btn btn-success" target="_blank" href="" id="ir_otro_lado_2">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
                </div>
                <embed type="application/pdf" src="" style="width:100%; height: 600px;" id="visor_pdf_2">
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>
@stop

@section('css')

@stop

@section('js')

<script type="text/javascript">

    var materias_alumno=null;

    $(document).ready(function() {
        $.ajax({
            url:"{{url('/materias_c_alumno')}}",
            type:'GET',
            dataType:'json',
            timeout : 80000,
        }).done(function(materias){

            if(materias!=null){
                materias_alumno=materias;
                //console.log(materias_admin_c);
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
        verificar_horario();
    });

    function verificar_horario(){
        $.ajax({
            url:"{{url('/materias_horario')}}",
            type:'GET',
            dataType:'json',
            timeout : 80000,
        }).done(function(materias_horario){

            if(materias_horario!=null){
                console.log(materias_horario);
                for (var i = 0; i < materias_horario.length; i++) {
                    if(i==0){
                        $("select[id='materias[]']")[0].value=materias_horario[i].id_materia_convalidacion;
                        $("input[id='clave[]']")[0].value=materias_horario[i].matricula;
                        document.getElementById("creditos0").value=materias_horario[i].creditos;
                        document.getElementById("ver_temario0").disabled=false;
                        document.getElementById("temario0").value=materias_horario[i].temario;
                        $("input[id='grupo[]']")[0].value=materias_horario[i].grupo;
                    }else{
                        agregar_fila();
                        $("select[id='materias[]']")[i].value=materias_horario[i].id_materia_convalidacion;
                        $("input[id='clave[]']")[i].value=materias_horario[i].matricula;
                        document.getElementById("creditos"+i).value=materias_horario[i].creditos;
                        document.getElementById("ver_temario"+i).disabled=false;
                        document.getElementById("temario"+i).value=materias_horario[i].temario;
                        $("input[id='grupo[]']")[i].value=materias_horario[i].grupo;
                    }
                }
                verificar_empy();
            }else{
                console.log("sin horario");
            }
        });
    }

    function pasar_url_temario(fila) {
        var url="{{url('/temarios')}}"+"/"+document.getElementById("temario"+fila).value;
        document.getElementById("visor_pdf_2").src=url;
        document.getElementById("ir_otro_lado_2").href=url;
    } 
    //aqui agrego la clave y el temario y creditos
    function agregar_clave(select) {
        var clave=null;
        var temario=null;
        var creditos=null;
        for (var i = 0; i < materias_alumno.length; i++) {
            if(select.value==materias_alumno[i].id){
                clave=materias_alumno[i].matricula;
                temario=materias_alumno[i].temario;
                creditos=materias_alumno[i].creditos;
                break;
            }
        }
        for (var i = 0; i < $("select[id='materias[]']").length; i++) {
            if(select.dataset.fila==$("input[id='clave[]']")[i].dataset.fila){
                $("input[id='clave[]']")[i].value=clave;
                document.getElementById("ver_temario"+select.dataset.fila).disabled=false;
                document.getElementById("temario"+select.dataset.fila).value=temario;
                document.getElementById("creditos"+select.dataset.fila).value=creditos;
                break;
            }
        }
    }
    var numero_fila=1;
    function agregar_fila(){
        $("#div_central").append(
            '<div class="row" id="fila_'+numero_fila+'">'+
                '<div class="col-md-5" style="margin-bottom: 25px; text-align: justify;">'+
                    '<label>Materias</label>'+
                    '<select class="form-control edit_select" id="materias[]" name="materias[]" data-fila="'+numero_fila+'" onchange="agregar_clave(this); verificar_empy(); diferentes(this);">'+
                        '<option selected disabled value="">Materias</option>'+
                        '@foreach($materias as $materia)'+
                        '@if($materia->calificacion<=69)'+
                        '<option value="{{$materia->id}}">{{$materia->nombre}}</option>'+
                        '@endif'+
                        '@endforeach'+
                    '</select>'+
                '</div>'+
                '<div class="col-md-2" style="margin-bottom: 25px; text-align: justify;">'+
                    '<label>Clave</label>'+
                    '<input type="text" name="calve[]" id="clave[]" class="form-control input_edit" disabled data-fila="'+numero_fila+'" onchange="verificar_empy();" onkeyup="verificar_empy()">'+
                    '<input type="hidden" name="creditos'+numero_fila+'" id="creditos'+numero_fila+'" data-fila="'+numero_fila+'">'+
                '</div>'+
                '<div class="col-md-2" style="margin-bottom: 25px; text-align: justify;">'+
                    '<label>Grupo</label>'+
                    '<input type="text" name="grupo[]" id="grupo[]" class="form-control input_edit" data-fila="'+numero_fila+'" onchange="this.value = this.value.toUpperCase(); verificar_empy();" onkeyup="this.value = this.value.toUpperCase(); verificar_empy();">'+
                '</div>'+
                '<div class="col-md-2" style="margin-bottom: 25px; text-align: justify;">'+
                    '<label>Temario</label><br>'+
                    '<button type="button" class="btn btn-warning" style="width: 100%; font-size: 1.3rem; font-weight: bold; padding-top: 3px; padding-bottom: 3px;" data-fila="'+numero_fila+'" id="ver_temario'+numero_fila+'" disabled onclick="pasar_url_temario('+numero_fila+');" data-toggle="modal" data-target="#pdf_temario">ver</button>'+
                    '<input type="hidden" name="temario'+numero_fila+'" id="temario'+numero_fila+'" data-fila="'+numero_fila+'">'+
                '</div>'+
                '<div class="col-md-1" style="margin-bottom: 25px; text-align: justify;">'+
                    '<br>'+
                    '<button type="button" class="btn btn-primary" style="width: 100%; font-size: 1.3rem; font-weight: bold; margin-top: 8px; padding-top: 3px; padding-bottom: 3px;" data-fila="'+numero_fila+'" onclick="eliminar_fila('+numero_fila+')">-</button>'+
                '</div>'+
            '</div>'
            );
        numero_fila++;
        verificar_empy();
    }

    function eliminar_fila(fila){
        $('#fila_'+fila).remove();
        verificar_empy();
    }
    function verificar_empy(){
        suma_creditos();
        for (var i = 0; i < $("select[id='materias[]']").length; i++) {
            if($("select[id='materias[]']")[i].value=="" || $("input[id='clave[]']")[i].value=="" || $("input[id='grupo[]']")[i].value=="" || sumatoria>32){
                document.getElementById("generar_doc").disabled=true;
                break;
            }else{
                document.getElementById("generar_doc").disabled=false;
            }
        }
    }

    function diferentes(select) {
        for (var i = 0; i < $("select[id='materias[]']").length; i++) {
            if($("select[id='materias[]']")[i].value==select.value && select.dataset.fila!= $("select[id='materias[]']")[i].dataset.fila){
                select.value="";
                for (var j = 0; j < $("select[id='materias[]']").length; j++) {
                    if(select.dataset.fila==$("input[id='clave[]']")[j].dataset.fila){
                        $("input[id='clave[]']")[j].value="";
                        break;
                    }
                }
                document.getElementById("creditos"+select.dataset.fila).value=null;
                document.getElementById("ver_temario"+select.dataset.fila).disabled=true;
                alert("ya elegiste esta materia en otra fila, verifica tus datos");
                break;
            }
        }
    }

    var sumatoria=0;
    function suma_creditos() {
        sumatoria=0;
        for (var i = 0; i < $("select[id='materias[]']").length; i++) {
            sumatoria+=Number(document.getElementById("creditos"+$("select[id='materias[]']")[i].dataset.fila).value);
        }
        document.getElementById("creditos_totales").value=sumatoria;
    }

    function envio_form_institucion(){
        document.getElementById("contenido_pdf").style.display="none";
        document.getElementById("carga_espera").style.display="block";

        var dataString =new FormData($("#form_horario")[0]);
        $.ajax({
            url:"{{url('/save_form_horario')}}",
            type:'POST',
            dataType:'json',
            data:dataString,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(exito){

            if(exito=="si"){
                document.getElementById("contenido_pdf").style.display="block";
                document.getElementById("carga_espera").style.display="none";
                document.getElementById("visor_pdf").src="{{url('/EQV')}}";
                document.getElementById("ir_otro_lado").href="{{url('/EQV')}}";
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }


    //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        document.getElementById("no_se_mira").style.display="block";
        document.getElementById("no_se_mira_2").style.display="block";
        document.getElementById("no_se_mira_3").style.display="block";
    }else{
        console.log("No estás usando un móvil");
    }


    
</script>

@stop