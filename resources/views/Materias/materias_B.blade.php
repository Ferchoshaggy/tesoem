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
            <img src="{{url('icons/M13.png')}}" style="width: 25%; height: auto;"><br><br>
            <div style="font-size: 50px; text-align: center;">
                Todas tus materias fueron aprobados para el paso dos.
            </div>
        </div>
        @elseif($proceso->estatus==2 || $proceso->estatus==1)
        <div class="col-md-2" style="text-align: center;">
            <img src="{{url('icons/M1.png')}}" style="width: 75%; height: auto;">
        </div>
        <div class="col-md-10" style="padding-top: 25px; text-align: justify;">
            Bienvenido nuevamente al apartado de materias, debido a que ya estas inscrito en la institución tus materias que se asignaron para cursar en tu horario aparecerán por defecto aquí, esta vez ya no tienes que hacer registros desde cero, solo debes colocar las calificaiones que obtuvistes en cada una de tus materias que ycursaste eneste semestre.
        </div>
        @elseif($proceso->estatus==4)
        <div class="col-md-2" style="text-align: center;">
            <img src="{{url('icons/M1.png')}}" style="width: 75%; height: auto;">
        </div>
        <div class="col-md-10" style="padding-top: 25px; text-align: justify;">
            Todas tus calificaciones fueron guardadas y has concluido el paso 2, espera a que se te notifique tu aprovacion a travez de la campana o via correo para el siguiente paso a realizar.
        </div>
        <div class="col-md-12" style="text-align: right;">
            <img src="{{url('icons/paloma.png')}}" style="width: 9vh; height: auto; margin-right: -25px; margin-bottom: -35px;">
        </div>
        @endif
    </div>
</div>

@if($proceso->etapa==2)
@if($proceso->estatus==2 || $proceso->estatus==1)
<form method="POST" action="{{url('/save_calificaciones_b')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-body secciones_body" style=" text-align: justify;">
        Asigna la calificación correctamente, ejemplo 69.<br><br>
        <div style="margin-bottom: 25px;" id="materias_guardadas">

            <div>
                @for($i=1; $i<= $numero_semestres; $i++)
                @foreach($materias as $materia)
                @if($materia->semestre==$i)
                <div class="col-md-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">
                    {{$i}}° Semestre
                </div>
                @break
                @endif
                @endforeach
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
<div class="card-body secciones_body" style=" text-align: justify;">
    Asigna la calificación correctamente, ejemplo 69.<br><br>
    <div style="margin-bottom: 25px;" id="materias_guardadas">

        <div>
            @for($i=1; $i<= $numero_semestres; $i++)
            @foreach($materias as $materia)
            @if($materia->semestre==$i)
            <div class="col-md-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">
                {{$i}}° Semestre
            </div>
            @break
            @endif
            @endforeach
            @foreach($materias as $materia)
            @if($materia->semestre==$i)
            <div class="row" >
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text" class="form-control input_edit" value="{{$materia->nombre}}" disabled>
                    
                </div>
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text" class="form-control input_edit" value="{{$materia->matricula}}" disabled>
                </div>
                <div class="col-md-4" style="margin-bottom: 25px;">
                    <input type="text"  class="form-control input_edit" placeholder="Calificación"  inputmode="numeric" onchange=" inputs_empy2();"onkeyup=" inputs_empy2();" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false; " onpaste="return false" disabled value="{{$materia->calificacion}}">
                </div>
            </div>
            @endif
            @endforeach
            @endfor
        </div>

    </div>
</div>

@endif
@endif



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

    
</script>

@stop