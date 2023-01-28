@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@stop

@section('content')

<style type="text/css">

    .form-control:disabled, .form-control[readonly] {
        background-color: #ababab !important;
    }
    input[type="file"]{
        background: white;
        outline: none;
     }
      ::-webkit-file-upload-button{
        margin-top: -22px;
        margin-left: -15px;
        background-color: #28a745;
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

    .edit_select{
        color: #fff;
        background-color: #28a745;
        border: 1px solid #28a745;
        font-weight: bold;
        font-size: 1.3rem;
        padding-left: 10px;
        padding-top: 4px;
    }
    .input_edit{
        font-size: 1.3rem;
        font-weight: bold;
    }

    .select2-selection__rendered {
      line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
          height: 35px !important;
    }
    .select2-selection__arrow {
          height: 34px !important;
    }
    
    .select2-selection__rendered{
        margin-top: -5px !important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #28a745 !important;
        border: 1px solid #28a745 !important;
        font-weight: bold !important;
        font-size: 1.3rem !important;
        padding-left: 10px !important;
        padding-top: 4px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #fff !important;
    }
    .select2-selection__arrow{
        color: #fff !important;
    }
</style>

<div>
    <h3 style="color: white; margin-bottom: 45px;">Materias</h3>
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
        @if($proceso->etapa>2)
        <div class="col-md-12" style="text-align: center;">
            <img src="{{url('icons/M1.png')}}" style="width: 25%; height: auto;"><br><br>
            <div style="font-size: 50px; text-align: center;">
                Todos tus documentos y datos fueron aprobados para el paso dos.
            </div>
        </div>
        @elseif($proceso->estatus==1)
        <div class="col-md-2">
            <img src="{{url('icons/M1.png')}}" style="width: 75%; height: auto;">
        </div>
        <div class="col-md-10" style="padding-top: 25px; text-align: left;">
            En este apartado seleccionaras las materias que llevaste en tu institucion universitaria previa.
        </div>
        @elseif($proceso->estatus==2)
        <div class="col-md-2">
            <img src="{{url('icons/M1.png')}}" style="width: 75%; height: auto;">
        </div>
        <div class="col-md-10" style="padding-top: 25px; text-align: left;">
            Bien hecho todas tus materias se cargaron correctamente, ahora solo procede a asignar la calificación que optuviste en cada materia en el apartado de abajo.
        </div>
        @elseif($proceso->estatus==4)
        <div class="col-md-2">
            <img src="{{url('icons/M1.png')}}" style="width: 75%; height: auto;">
        </div>
        <div class="col-md-10" style="padding-top: 25px; text-align: left;">
            Todas tus calificaciones fueron guardadas y has concluido el paso 2, espera a que se te notifique tu aprovacion a travez de la campana o via correo para el siguiente paso a realizar.
        </div>
        <div class="col-md-12" style="text-align: right;">
            <img src="{{url('icons/paloma.png')}}" style="width: 9vh; height: auto; margin-right: -25px; margin-bottom: -35px;">
        </div>
        @endif
    </div>
</div>

@if($proceso->etapa==2)
@if($proceso->estatus==1)
<div class="card-body secciones_body" style=" text-align: left;">
    Seleccione correctamente tu institucion, carrera y ultimo semestre que cursaste.<br><br>
    <button class="btn btn-success" style="font-weight: bold; font-size: 20px;" data-toggle="modal" data-target="#iniciar" id="iniciar_materias">Iniciar</button>
</div>
@elseif($proceso->estatus==2)
<form method="POST" action="{{url('/save_calificaciones')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-body secciones_body" style=" text-align: left;">
        Asigna la calificación correctamente, ejemplo 69.<br><br>
        <div style="margin-bottom: 25px;" id="materias_guardadas">

            <div>
                @for($i=1; $i<= $proceso->semestre; $i++)
                <div class="col-md-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">
                    {{$i}}° Semestre
                </div>
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <div class="row" >
                    <div class="col-md-4" style="margin-bottom: 25px;">
                        <input type="text" class="form-control input_edit" value="{{$materia->nombre}}" disabled>
                        <!-- se creo este hidden para enviar el id y saber a que materia pertenece la calificacion-->
                        <input type="hidden" name="id_materia_guardada[]" id="id_materia_guardada[]" class="form-control input_edit" value="{{$materia->id}}" >
                        
                    </div>
                    <div class="col-md-4" style="margin-bottom: 25px;">
                        <input type="text" class="form-control input_edit" value="{{$materia->matricula}}" disabled>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 25px;">
                        <input type="text" name="calificaciones[]" id="calificaciones[]" class="form-control input_edit" placeholder="Calificación"  inputmode="numeric" onchange=" inputs_empy2();"onkeyup=" inputs_empy2();" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false; " onpaste="return false">
                    </div>
                </div>
                @endif
                @endforeach
                @endfor
            </div>
        </div>
    </div>
    <div class="card-body" style="color: #fff; font-size: 20px;">
        <div class="row">
            <div class="col-md-6" style="margin-bottom:25px; text-align: left;">
                Al terminar preciona el boton de guardar.
            </div>
            <div class="col-md-6" style="margin-bottom:25px; text-align: right;" >
                <button class="btn btn-success"id="button_calificaciones_save" title="Guardar" disabled><img src="{{url('icons/4305589.png')}}" style="width: 45px; height:auto;"></button>
                
            </div>
        </div>     
    </div>
</form>
@elseif($proceso->estatus==4)
<div class="card-body secciones_body" style=" text-align: left;">
    Asigna la calificación correctamente, ejemplo 69.<br><br>
    <div style="margin-bottom: 25px;" id="materias_guardadas">

        <div>
            @for($i=1; $i<= $proceso->semestre; $i++)
            <div class="col-md-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">
                {{$i}}° Semestre
            </div>
            @foreach($materias as $materia)
            @if($materia->semestre==$i)
            <div class="row" >
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text" class="form-control input_edit" value="{{$materia->nombre}}" disabled>
                    <!-- se creo este hidden para enviar el id y saber a que materia pertenece la calificacion-->
                    
                </div>
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text" class="form-control input_edit" value="{{$materia->matricula}}" disabled>
                </div>
                @forelse($materias_cursadas as $materia_cursada)
                @if($materia_cursada->id_materia==$materia->id)
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text" class="form-control input_edit" placeholder="Calificación" pattern="[0-9]+"  inputmode="numeric" disabled value="{{$materia_cursada->calificacion}}">
                </div>
                @break
                @endif
                @empty
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text" class="form-control input_edit" placeholder="Algo salio mal" pattern="[0-9]+"  inputmode="numeric" disabled >
                </div>
                @endforelse
            </div>
            @endif
            @endforeach
            @endfor
        </div>

    </div>
</div>

@endif
<!-- inicio de uno nuevo-->
<div class="modal fade" id="iniciar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow: auto;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registar Materias</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('agregar_materias').reset(); verificar_existencia_materias();">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{url('/save_materias')}}" enctype="multipart/form-data" id="agregar_materias">
            @csrf
            <div class="modal-body" style="border-bottom: 1px solid #193333;">
                <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px;">
                    Selecciona la institucion y carrera a la que pertenecias y el ultimo semestre que cursaste en esta. si tu institucion no esta registrada presiona 
                    <button type="button" class="btn btn-link" style="padding:0px; font-size: 20px;" data-toggle="modal" data-target="#segundo" onclick="redireccionamiento(1); document.getElementById('agregar_materias').reset(); verificar_existencia_materias();">aqui.</button> 

                    Si tu institucion si esta registrada pero tu carrera no, entonces preciona 
                    <button type="button" class="btn btn-link" style="padding:0px; font-size: 20px;" data-toggle="modal" data-target="#segundo" onclick="redireccionamiento(2); document.getElementById('agregar_materias').reset();verificar_existencia_materias();">aqui.</button><br><br>
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 25px">
                            <select class=" form-control edit_select" name="institucion" id="institucion_1" onchange="carreras_recarga(this.value); verificar_existencia_materias();">
                                <option value="" selected disabled>Institución</option>
                                @foreach($instituciones as $institucion)
                                <option value="{{$institucion->id}}">{{$institucion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 25px">
                            <select class=" form-control edit_select" name="carrera" id="carrera_1" onchange=" verificar_existencia_materias();">
                                <option value="" selected disabled>Carrera</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="margin-bottom: 25px">
                            <select class="form-control edit_select" name="semestre" id="semestre_1" onchange=" verificar_existencia_materias();">
                                <option value="" selected disabled>Ultimo semestre</option>
                                @for($i=1;$i<9;$i++)
                                <option value="{{$i}}">{{$i}}° Semestre</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 25px; display: none;" id="texto_si_existe_materias">

                    </div>

                    <div id="semestres_existentes_contenedor" style="margin-bottom: 25px;">
                        
                    </div>

                    <div style="margin-bottom: 25px; display: none;" id="texto_info">
                        Llena el siguiente formulario con lo que se te pide, nombre completo de la materia, clave de la materia y temario de la materia en PDF. el boton con el signo de "+" te permite agregar una materia, agrega solo las que contiene tu semestre, si agregas de mas con el boton del signo de "-" la eliminas.
                    </div>


                    <div id="semestres_contenedor" style="margin-bottom: 25px;">
                        
                    </div>

                </div>
                <input type="hidden" name="cantidad_semestres_registrados" id="cantidad_semestres_registrados">
            </div>
            <div class="card-body" style="border-top: 1px solid #193333; display: none;" id="terminar_div" >
                <div class="row">
                    <div class="col-md-6" style="margin-bottom:25px; text-align: left;">
                        Al terminar preciona el boton de guardar.
                    </div>
                    <div class="col-md-6" style="margin-bottom:25px; text-align: right;" >
                        <button class="btn btn-success"id="button_materias_save" title="Guardar"><img src="{{url('icons/4305589.png')}}" style="width: 25px; height:auto;"></button>
                        
                    </div>
                </div>     
            </div>
        </form>
    </div>
  </div>
</div>

<!-- alerta de si estas seguro-->
<div class="modal fade" id="segundo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; background-color: #111111bd;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">¿Seguro?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" margin-bottom: 0px;">
                ¿Estas completamente seguro que tu institucion o carrera no esta registrado?
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#agregar_institucion" onclick="document.getElementById('iniciar_materias').click();" id="paso_siguiente" onclick="reinicio_modal_check();">Si estoy seguro</button>
        </div>
    </div>
  </div>
</div>

<!-- si no existe institucion -->
<div class="modal fade" id="agregar_institucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registro de nueva institucion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" id="institucion_carrera_form">
            @csrf
            <div class="modal-body" style="border-bottom: 1px solid #193333;">

                <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px;">
                    Escribe el nombre completo de la institucion y carrera tal cual esta en tus registros.<br><br>

                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <input type="text" name="institucion" class="form-control input_edit" placeholder="Institucion" onkeyup="this.value = this.value.toUpperCase(); campos_llenos_modal_institucion();" onchange=" this.value = this.value.toUpperCase(); campos_llenos_modal_institucion();" id="institucion_2" required>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <input type="text" name="carrera" class="form-control input_edit" placeholder="Carrera" onkeyup="this.value = this.value.toUpperCase(); campos_llenos_modal_institucion();" onchange=" this.value = this.value.toUpperCase(); campos_llenos_modal_institucion();" id="carrera_2" required>
                    </div>

                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <input type="text" name="clave_carrera" class="form-control input_edit" placeholder="Clave del plan de estudios" onkeyup="this.value = this.value.toUpperCase(); campos_llenos_modal_institucion();" onchange=" this.value = this.value.toUpperCase(); campos_llenos_modal_institucion();" id="clave_carrera" required>
                    </div>
                    
                </div>
            </div>
            <div class="card-body" style="border-top: 1px solid #193333;">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom:25px; text-align: left;">
                        Al terminar preciona registrar.
                        
                        
                    </div>
                    <div class="col-md-6" style="margin-bottom:25px; text-align: right;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#iniciar" onclick="document.getElementById('institucion_carrera_form').reset();">Cancelar</button>
                        <button type="button" class="btn btn-success" id="button_registro_institucion" disabled data-dismiss="modal" data-toggle="modal" data-target="#exito_guardado" onclick="envio_form_institucion(); document.getElementById('institucion_carrera_form').reset();">Registrar</button>
                        
                    </div>
                </div>     
            </div>
            
        </form>
    </div>
  </div>
</div>


<!-- si no existe carrera -->
<div class="modal fade" id="agregar_carrera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registro de nueva carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" id="carrera_form">
            @csrf
            <div class="modal-body" style="border-bottom: 1px solid #193333;">

                <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px;">
                    Selecciona tu institucion y escribe el nombre completo de tu carrera tal cual esta en tus registros.<br><br>
                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <select class="form-control edit_select" name="institucion" id="institucion_3" required onchange="campos_llenos_modal_carrera();">
                            <option value="" selected disabled>Institución</option>
                            @foreach($instituciones as $institucion)
                            <option value="{{$institucion->id}}">{{$institucion->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <input type="text" name="carrera" id="carrera_3" class="form-control input_edit" placeholder="Carrera" onkeyup="this.value = this.value.toUpperCase(); campos_llenos_modal_carrera();" onchange=" this.value = this.value.toUpperCase(); campos_llenos_modal_carrera();" required>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 25px;">
                        <input type="text" name="clave_carrera" class="form-control input_edit" placeholder="Clave del plan de estudios" onkeyup="this.value = this.value.toUpperCase();campos_llenos_modal_carrera();" onchange=" this.value = this.value.toUpperCase(); campos_llenos_modal_carrera();" id="clave_carrera_2" required>
                    </div>
                </div>
            </div>
            <div class="card-body" style="border-top: 1px solid #193333;">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom:25px; text-align: left;">
                        Al terminar preciona registrar.
                        
                        
                    </div>
                    <div class="col-md-6" style="margin-bottom:25px; text-align: right;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#iniciar" onclick="document.getElementById('carrera_form').reset();">Cancelar</button>
                        <button type="button" class="btn btn-success" id="button_registro_carrera"  title="Guardar" data-dismiss="modal" data-toggle="modal" data-target="#exito_guardado" disabled onclick="envio_form_carrera(); document.getElementById('carrera_form').reset();">Registrar</button>
                        
                    </div>
                </div>     
            </div>
            
        </form>
    </div>
  </div>
</div>


<input type="hidden" id="check_exito" data-toggle="modal" data-target="#exito_guardado">
<!-- agregado con exito -->
<div class="modal fade" id="exito_guardado" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registro exitoso</h5>
            
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px; text-align: center;">
                <div class="col-md-12" id="texto_exito" style="display: none;">
                    El registro fue exitoso, ahora puedes encontrarlo en las opciones.<br><br> 
                </div>
                <div class="col-md-12" id="carga_espera">
                    <img src="{{url('img/cargando_12.gif')}}" style="width: 100%; height: auto; border-radius: 10%; "><br>
                    Espere un momento...
                </div>
            </div>
        </div>
        <div class="card-body" style="border-top: 1px solid #193333;">
            <div class="col-md-12" style="margin-bottom:25px; text-align: right;">
                <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#iniciar" style="display: none;" id="check_off">Aceptar</button>
            </div>    
        </div>
    </div>
  </div>
</div>
@endif


<!-- agregar todo desde cero-->
<div class="modal fade" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registro nueva institución y/o carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" id="salvar_registro">
            @csrf
            <div class="modal-body" style="border-bottom: 1px solid #193333;">

                <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px;">
                    Escribe con su nombre completo y carrera.<br><br>
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom: 25px;">
                            <input type="text" name="institucion"  class="form-control input_edit" placeholder="Institucion" onkeyup="this.value = this.value.toUpperCase(); date_complete();" onchange="this.value = this.value.toUpperCase(); date_complete()">
                        </div>
                        <div class="col-md-4" style="margin-bottom: 25px;">
                            <input type="text" name="Carrera"  class="form-control input_edit" placeholder="Carrera" onkeyup="this.value = this.value.toUpperCase(); date_complete();" onchange="this.value = this.value.toUpperCase(); date_complete()">
                        </div>
                        <div class="col-md-4" style="margin-bottom: 25px;">
                            <select class="form-control edit_select" name="semestre"  onchange="date_complete()">
                                <option value="" selected disabled>Ultimo semestre</option>
                                @for($i=1;$i<9;$i++)
                                <option value="{{$i}}">Semestre {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 25px; display: none;" >
                        Llena el siguiente formulario con lo que se te pide, nombre completo de la materia, clave de la materia y temario de la materia en PDF. el boton con el signo de "+" te permite agregar una materia, agrega solo las que contiene tu semestre, si agregas de mas con el boton del signo de "-" la eliminas.
                    </div>


                    <div  style="margin-bottom: 25px;">
                        
                    </div>


                </div>
            </div>
            <div class="card-body" style="border-top: 1px solid #193333;">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom:25px; text-align: left;">
                        puedes ir guardando tu avance.
                        
                        
                    </div>
                    <div class="col-md-6" style="margin-bottom:25px; text-align: right;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-light" title="puedes ir guardando tu avance, por si no alcanzas a guardar todo." onclick="salvar_registro();" id="salvar_from">guardar avance</button>
                        <button class="btn btn-success" id="button_envio" disabled title="Guardar"><img src="{{url('icons/4305589.png')}}" style="width: 25px; height:auto;"></button>
                        
                    </div>
                </div>     
            </div>
            
        </form>
    </div>
  </div>
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
<!-- estos son para la tabla-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js">
</script>

<!-- este es para el selected2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    
    $(document).ready(function() {
        $('.table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });

        $('.js-example-basic-single').select2({
            dropdownParent: $('#iniciar') //este se agrega para que se despliegue bien en el modal.
        });
    });

    function justNumbers(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ( keynum == 8 ) return true;
        return /\d/.test(String.fromCharCode(keynum));
    }

    //esta es para mostrar el modal de agregar carrea o institucion y carrera 
    function redireccionamiento(tipo){
        if(tipo==1){
            document.getElementById("paso_siguiente").dataset.target="#agregar_institucion";
        }else{
            document.getElementById("paso_siguiente").dataset.target="#agregar_carrera";
        }
    }

    //activa otra vez el gif de carga
    function reinicio_modal_exito(){
        document.getElementById("texto_exito").style.display="none";
        document.getElementById("check_off").style.display="none";
        document.getElementById("carga_espera").style.display="block";
    }

    //funcion de comprovacion de campos vacios en el modal de agregar materias.
    function inputs_empy(){
        salir=false;
        for (var i=1; i <= document.getElementById("semestre_1").value; i++){

            for (var j=0; j <= $("input[id='materia_semestre_"+i+"[]']").length; j++){

               try{

                if($("input[id='clave_semestre_"+i+"[]']")[j].value!="" && $("input[id='temario_semestre_"+i+"[]']")[j].value!="" && $("input[id='materia_semestre_"+i+"[]']")[j].value!=""){

                    document.getElementById("button_materias_save").disabled=false;
                }else{
                    document.getElementById("button_materias_save").disabled=true;
                    salir=true;
                    break;
                }


               }catch(TypeError){


               }


            }
            if (salir==true){break;}
            
        }

    }

    function inputs_empy2(){
        for(var i=0; i < $("input[id='calificaciones[]']").length; i++){

                if($("input[id='calificaciones[]']")[i].value!=""){

                    document.getElementById("button_calificaciones_save").disabled=false;
                }else{
                    document.getElementById("button_calificaciones_save").disabled=true;
                    break;
                }

            
            

        }
    }

// actualizar la lista de las instituciones
    function instituciones_recarga(){
        $.ajax({
            url:"{{url('/consulta_instituciones')}}",
            type:'GET',
            dataType:'json',
            timeout : 80000,
        }).done(function(instituciones){

            if(instituciones!=null){
                $("#institucion_1").empty();
                $("#institucion_1").append('<option value="" selected disabled>Institución</option>');
                $("#institucion_3").empty();
                $("#institucion_3").append('<option value="" selected disabled>Institución</option>');
                for (var i = 0; i < instituciones.length; i++) {
                    $("#institucion_1").append('<option value="'+instituciones[i].id+'">'+instituciones[i].nombre+'</option>');
                    $("#institucion_3").append('<option value="'+instituciones[i].id+'">'+instituciones[i].nombre+'</option>');
                }
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }

//actulizar la lista de la carrera segun la institucion
    function carreras_recarga(id){
        $.ajax({
            url:"{{url('/consulta_carreras')}}"+"/"+id,
            type:'GET',
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(carreras){

            if(carreras!=null){
                $("#carrera_1").empty();
                $("#carrera_1").append('<option value="" selected disabled>Carrera</option>');
                for (var i = 0; i < carreras.length; i++) {
                    $("#carrera_1").append('<option value="'+carreras[i].id+'">'+carreras[i].nombre+'</option>');
                }
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }

// estas funciones son ´para el modal 2, guardar nueva isntitucion y carrera
    function campos_llenos_modal_institucion(){
        if (document.getElementById("institucion_2").value!="" && document.getElementById("carrera_2").value!="" && document.getElementById("clave_carrera").value!=""){
            document.getElementById("button_registro_institucion").disabled=false;
        }else{
            document.getElementById("button_registro_institucion").disabled=true;
        }
        
    }


    function envio_form_institucion(){

        var dataString =new FormData($("#institucion_carrera_form")[0]);
        $.ajax({
            url:"{{url('/save_form_institucion')}}",
            type:'POST',
            dataType:'json',
            data:dataString,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(exito){

            if(exito=="si"){
                document.getElementById("texto_exito").style.display="block";
                document.getElementById("check_off").style.display="block";
                document.getElementById("carga_espera").style.display="none";
                instituciones_recarga();
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }


//estas funciones son para el modal tres, que es para agregar una carrera
    function envio_form_carrera(){

        var dataString =new FormData($("#carrera_form")[0]);
        $.ajax({
            url:"{{url('/save_form_carrera')}}",
            type:'POST',
            dataType:'json',
            data:dataString,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(exito){

            if(exito=="si"){
                document.getElementById("texto_exito").style.display="block";
                document.getElementById("check_off").style.display="block";
                document.getElementById("carga_espera").style.display="none";
                instituciones_recarga();
                document.getElementById('carrera_form').reset();
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }

    function campos_llenos_modal_carrera(){

        if (document.getElementById("institucion_3").value!="" && document.getElementById("carrera_3").value!="" && document.getElementById("clave_carrera_2").value!=""){
            document.getElementById("button_registro_carrera").disabled=false;
        }else{
            document.getElementById("button_registro_carrera").disabled=true;
        }
        
    }

//estas funciones por para el dinamismo de los campos para las materias
    function verificar_existencia_materias() {
        id_institucion=document.getElementById("institucion_1").value;
        id_carrera=document.getElementById("carrera_1").value;
        numero_semestre=document.getElementById("semestre_1").value;


        //reiniciamos todo para evitar posibles errorres.
        ultimo_semestre=0;
        $("#semestres_existentes_contenedor").empty();
        $("#semestres_contenedor").empty();
        semestres_contador=null; //los anulamos cada vez que comprueba cuantos seran
        numero_filas_semestre=null;
        document.getElementById("texto_info").style.display="none";
        document.getElementById("texto_si_existe_materias").style.display="none";

        if (document.getElementById("institucion_1").value != "" && document.getElementById("carrera_1").value != "" && document.getElementById("semestre_1").value != "") {

            $.ajax({
                url:"{{url('/consulta_existencia_materias')}}"+"/"+id_institucion+"/"+id_carrera+"/"+numero_semestre,
                type:'GET',
                dataType:'json',
                timeout : 80000,
            }).done(function(resultados){
                if(resultados!= null){

                    for (var i = 0; i <resultados.length; i++) {

                        if(resultados[i].semestre>ultimo_semestre){
                            ultimo_semestre=resultados[i].semestre;
                        }
                        
                    }

                    for (var i = 1; i <= ultimo_semestre; i++) {

                        $("#semestres_existentes_contenedor").append(

                            '<div id="semestre_conte_existente_'+i+'">'+
                                '<div class="col-md-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">'+
                                    +i+'° Semestre'+
                                '</div>'+
                                '<div class="row" id="fila_registro_existente_'+i+'">'+
                                '</div>'+
                            '</div>'

                        );

                        for (var j = 0; j<resultados.length; j++) {

                            if (i==resultados[j].semestre){

                                $("#fila_registro_existente_"+i).append(

                                    '<div class="col-md-6" style="margin-bottom: 25px;">'+
                                        '<input type="text" name="materia_s_e_'+i+'[]" id="materia_s_e_'+i+'[]" class="form-control input_edit" value="'+resultados[j].nombre+'" disabled>'+
                                        
                                    '</div>'+
                                    '<div class="col-md-6" style="margin-bottom: 25px;">'+
                                        '<input type="text" name="clave_s_e_'+i+'[]" id="clave_s_e_'+i+'[]" class="form-control input_edit" value="'+resultados[j].matricula+'" disabled>'+
                                    '</div>'

                                );

                            }


                        }

                        
                    }


                    document.getElementById("texto_si_existe_materias").style.display="block";
                    if (ultimo_semestre==numero_semestre){
                        document.getElementById("texto_si_existe_materias").innerHTML="Al parecer ya contamos con tadas las materias de esta carrera hasta el semestre que seleccionaste, ahora solo te falta agregar las calificaciones.";
                        document.getElementById("cantidad_semestres_registrados").value="materias_completas";
                        document.getElementById("terminar_div").style.display="block";
                    }else if(ultimo_semestre>=1){
                        document.getElementById("texto_si_existe_materias").innerHTML="Nuestra base de datos solo llega hasta "+ultimo_semestre+"° semestre de esta carrera y tu seleccionales el "+numero_semestre+"° semestre, por lo tanto solo agregaras las materias de los semestres faltantes.";
                        date_complete(ultimo_semestre);
                        document.getElementById("cantidad_semestres_registrados").value=ultimo_semestre;
                        document.getElementById("terminar_div").style.display="block";
                        document.getElementById("button_materias_save").disabled=true;
                    }else{
                        date_complete(ultimo_semestre);
                        document.getElementById("texto_si_existe_materias").style.display="none";
                        document.getElementById("cantidad_semestres_registrados").value=ultimo_semestre+1;
                        document.getElementById("terminar_div").style.display="block";
                        document.getElementById("button_materias_save").disabled=true;
                    }
                    
                    
                }else{
                    document.getElementById("cantidad_semestres_registrados").value=ultimo_semestre+1;
                    document.getElementById("texto_si_existe_materias").style.display="none";
                    alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
                }
            });
                    
        }
    }



    let semestres_contador=null;//este es para saber cuantos son en realidad y son para el back-end de insercion
    let numero_filas_semestre=null; // y estos son para saber cual hay que eliminar y poder dar la url al campo de archivo
    function date_complete(ultimo_semestre_2){
        $("#semestres_contenedor").empty();
        semestres_contador=null; //los anulamos cada vez que comprueba cuantos seran
        numero_filas_semestre=null;

        if (document.getElementById("institucion_1").value != "" && document.getElementById("carrera_1").value != "" && document.getElementById("semestre_1").value != "") {

            document.getElementById("texto_info").style.display="block";

            var semestres_numero=document.getElementById("semestre_1").value;
            semestres_contador= new Array(semestres_numero);
            numero_filas_semestre= new Array(semestres_numero);

            semestres_contador[0]=0;//hay que darle valor de cero, de lo contrario no crea bien el arreglo.
            numero_filas_semestre[0]=0;
            //se coloca la variable que contiene el ultimo semestre para que este empiece del ultimo.
            for (var i = (ultimo_semestre_2+1); i <= semestres_numero; i++) {

                semestres_contador[i]=1;
                numero_filas_semestre[i]=1;
                $("#semestres_contenedor").append(

                    '<div id="semestre_conte'+i+'">'+
                        '<div class="col-md-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">'+
                            +i+'° Semestre'+
                        '</div>'+
                        '<div class="row" id="fila_registro_'+i+'_'+numero_filas_semestre[i]+'">'+
                            
                            '<div class="col-md-4" style="margin-bottom: 25px;">'+
                                '<input type="text" name="materia_semestre_'+i+'[]" id="materia_semestre_'+i+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();" placeholder="Materia">'+
                                
                            '</div>'+
                            '<div class="col-md-4" style="margin-bottom: 25px;">'+
                                '<input type="text" name="clave_semestre_'+i+'[]" id="clave_semestre_'+i+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();" placeholder="Clave">'+
                                
                            '</div>'+

                            '<div class="col-md-3" style="margin-bottom: 25px;">'+
                                '<input type="file" name="temario_semestre_'+i+'[]" id="temario_semestre_'+i+'[]" class="form-control input_edit archivo" onchange="documento_cambio(); inputs_empy();" data-temario="'+numero_filas_semestre[i]+'">'+
                                '<label id="temario_button_'+i+'[]" onclick="activar_file('+i+','+numero_filas_semestre[i]+');" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg> &#160;&#160;Subir temario</label>'+
                                
                            '</div>'+

                            '<div class="col-md-1" style="margin-bottom: 25px;">'+
                                '<a type="button" class="btn btn-success" id="mas_materias_semestre_'+i+'[]" onclick="agregar_fila_semestre('+i+');">+</a>'+
                                
                            '</div>'+
                            
                        '</div>'+

                        '<input type="hidden" name="total_materias_semestre_'+i+'" id="total_materias_semestre_'+i+'" value="1">'+

                    '</div>'

                    );
                semestres_contador[i]++;//sumamos para la proxima iteracion
                numero_filas_semestre[i]++;
            }
            //console.log(document.getElementById("temario_semestre_"+i+"[]"));
        }else{
            document.getElementById("texto_info").style.display="none";
            $("#semestres_contenedor").empty();
            
        }
    }

    function agregar_fila_semestre(semestre){

        $("#semestre_conte"+semestre).append(


                '<div class="row" id="fila_registro_'+semestre+'_'+numero_filas_semestre[semestre]+'">'+
                    '<div class="col-md-4" style="margin-bottom: 25px;">'+
                        '<input type="text" name="materia_semestre_'+semestre+'[]" id="materia_semestre_'+semestre+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();" placeholder="Materia">'+
                        
                    '</div>'+
                    '<div class="col-md-4" style="margin-bottom: 25px;">'+
                        '<input type="text" name="clave_semestre_'+semestre+'[]" id="clave_semestre_'+semestre+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();" placeholder="Clave">'+
                        
                    '</div>'+

                    '<div class="col-md-3" style="margin-bottom: 25px;">'+
                        '<input type="file" name="temario_semestre_'+semestre+'[]" id="temario_semestre_'+semestre+'[]" class="form-control input_edit archivo" onchange="documento_cambio(); inputs_empy();" data-temario="'+numero_filas_semestre[semestre]+'">'+
                        '<label id="temario_button_'+semestre+'[]" onclick="activar_file('+semestre+','+numero_filas_semestre[semestre]+');" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg> &#160;&#160;Subir temario</label>'+
                        
                    '</div>'+

                    '<div class="col-md-1" style="margin-bottom: 25px;">'+
                        '<a type="button" class="btn btn-primary " onclick="eliminar_fila('+semestre+','+numero_filas_semestre[semestre]+');">-</a>'+
                        
                    '</div>'+
                    
                '</div>'
                

            );

        semestres_contador[semestre]++;//sumamos para la proxima iteracion
        numero_filas_semestre[semestre]++;
        document.getElementById("total_materias_semestre_"+semestre).value=numero_filas_semestre[semestre];
        console.log(numero_filas_semestre[semestre]);
        inputs_empy();
    }

    //se uso este metodo puesto que no se podia saber cual era, se uso dataset.
    function activar_file(semestre,fila){
        //console.log("s"+semestre);
        //console.log("f"+fila);
        //console.log("f"+(fila-1));

        try{
            //document.getElementById("temario_semestre_"+semestre)[fila-1].click();
            for (var j = 0; j < $("input[id='temario_semestre_"+semestre+"[]']").length; j++) {
                if ($("input[id='temario_semestre_"+semestre+"[]']")[j].dataset.temario==fila) {

                    $("input[id='temario_semestre_"+semestre+"[]']")[j].click();
                    //console.log("encontrado");
                    break;
                }
            }
            
        }catch(TypeError){
            //console.log("entro_al error"+(fila+1));
            //document.getElementById("temario_semestre_"+semestre)[fila-1].click();
            console.log("no salio");

        }
        
    }

    function eliminar_fila(semestre,fila){
        //alert(semestre+"\ndato_fila"+fila+"\nfila"+numero_filas_semestre[semestre]);
        $('#fila_registro_'+semestre+'_'+fila).remove();
        semestres_contador[semestre]--;//sumamos para la proxima iteracion
        //console.log(numero_filas_semestre);
        inputs_empy();
    }

    //verificamos si hay cambio en el archivo, si lo hay entonces le damos el nombre al label
    function documento_cambio(){
        for (var i = 1; i <= document.getElementById("semestre_1").value; i++) {

            for (var j = 0; j < $("input[id='temario_semestre_"+i+"[]']").length; j++) {

                if ($("input[id='temario_semestre_"+i+"[]']")[j].files[0]!=null){
                    if($("input[id='temario_semestre_"+i+"[]']")[j].value.split('.').pop()=="pdf"){
                        
                        $("label[id='temario_button_"+i+"[]']")[j].innerHTML=$("input[id='temario_semestre_"+i+"[]']")[j].value;
                        //alert(j);
                        //console.log("semestre"+i);
                        //console.log($("input[id='temario_semestre_"+i+"[]']")[j].files[0]);
                    }else{
                        
                        $("label[id='temario_button_"+i+"[]']")[j].innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg> &#160;&#160;Subir temario';
                        alert("EL ARCHIVO DEBE SER PDF");
                        $("input[id='temario_semestre_"+i+"[]']")[j].value=null;
                    }
                }else{
                    
                    $("label[id='temario_button_"+i+"[]']")[j].innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg> &#160;&#160;Subir temario';
                    $("input[id='temario_semestre_"+i+"[]']")[j].value=null;
                }
                //console.log(j);
            }

        }
    }

    function salvar_registro(){

        document.getElementById("salvar_from").disabled=true;
        document.getElementById("salvar_from").style.background= "#111111";
        var url="{{url('icons/carga_2.gif')}}";
        document.getElementById("salvar_from").innerHTML='<img src="'+url+'" style="width: 20%; height:auto; border-radius: 100%;">';
        var dataString =new FormData($("#salvar_registro")[0]);
        $.ajax({
            url:"{{url('/save_form')}}",
            type:'POST',
            dataType:'json',
            data:dataString,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(salvado){
            if(salvado[0]=="si")
            {
                console.log("datos enviados correctamente\n\n");
                document.getElementById("salvar_from").disabled=false;
                document.getElementById("salvar_from").style.background= "#f8f9fa";
                document.getElementById("salvar_from").innerHTML="Guardar avance";
                alert("ya se guardo lo que llevas, puedes estar tranquilo");
            }else{
                console.log("ha habido algun error\n\n");
                document.getElementById("salvar_from").disabled=false;
                document.getElementById("salvar_from").style.background= "#f8f9fa";
                document.getElementById("salvar_from").innerHTML="Algo no esta bien, intenta de nuevo";
            }
            console.log(salvado[1]);
        });

        
    }
    
</script>

@stop