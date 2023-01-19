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


<div class="card-body secciones_body">
    <div class="row">
        <div class="col-md-2">
            <img src="{{url('icons/M1.png')}}" style="width: 75%; height: auto;">
        </div>
        <div class="col-md-10" style="padding-top: 25px; text-align: left;">
            En este apartado seleccionaras las materias que llevaste en tu institucion universitaria previa.
        </div>
    </div>
</div>

<div class="card-body secciones_body" style=" text-align: left;">
    Seleccione correctamente tu institucion, carrera y ultimo semestre que cursaste.<br><br>
    <button class="btn btn-success" style="font-weight: bold; font-size: 20px;" data-toggle="modal" data-target="#iniciar" id="iniciar_materias">Iniciar</button>
</div>

<!-- inicio de uno nuevo-->
<div class="modal fade" id="iniciar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registar Materias</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px;">
                Selecciona la institucion y carrera a la que pertenecias y el ultimo semestre que cursaste en esta. si tu institucion no esta registrada presiona <button class="btn btn-link" style="padding:0px; font-size: 20px;" data-toggle="modal" data-target="#seguro">aqui.</button><br><br>
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 25px">
                        <select class=" form-control edit_select" name="institucion">
                            <option value="" selected disabled>Institución</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 25px">
                        <select class=" form-control edit_select" name="carrera">
                            <option value="" selected disabled>Carrera</option>
                        </select>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 25px">
                        <select class="form-control edit_select" name="semestre">
                            <option value="" selected disabled>Ultimo semestre</option>
                            @for($i=1;$i<9;$i++)
                            <option value="{{$i}}">Semestre {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" >Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- seguro que no esta tu carrera-->
<div class="modal fade" id="seguro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; background-color: #111111bd;">
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
            <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal"data-target="#nuevo_registro_I_C" onclick="document.getElementById('iniciar_materias').click();">Si estoy seguro</button>
        </div>
    </div>
  </div>
</div>

<!-- agregar todo desde cero-->
<div class="modal fade" id="nuevo_registro_I_C" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto;">
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
                            <input type="text" name="institucion" id="institucion_new" class="form-control input_edit" placeholder="Institucion" onkeyup="this.value = this.value.toUpperCase(); date_complete();" onchange="this.value = this.value.toUpperCase(); date_complete()">
                        </div>
                        <div class="col-md-4" style="margin-bottom: 25px;">
                            <input type="text" name="Carrera" id="carrera_new" class="form-control input_edit" placeholder="Carrera" onkeyup="this.value = this.value.toUpperCase(); date_complete();" onchange="this.value = this.value.toUpperCase(); date_complete()">
                        </div>
                        <div class="col-md-4" style="margin-bottom: 25px;">
                            <select class="form-control edit_select" name="semestre" id="semestre_select" onchange="date_complete()">
                                <option value="" selected disabled>Ultimo semestre</option>
                                @for($i=1;$i<9;$i++)
                                <option value="{{$i}}">Semestre {{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 25px; display: none;" id="texto_info">
                        Llena el siguiente formulario con lo que se te pide, nombre completo de la materia, clave de la materia y temario de la materia en PDF. el boton con el signo de "+" te permite agregar una materia, agrega solo las que contiene tu semestre, si agregas de mas con el boton de "-" la eliminas.
                    </div>


                    <div id="semestres_contenedor" style="margin-bottom: 25px;">
                        
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

    let semestres_contador=null;//este es para saber cuantos son en realidad
    let numero_filas_semestre=null; // y estos son para saber cual hay que eliminar
    function date_complete(){
        $("#semestres_contenedor").empty();
        semestres_contador=null; //los anulamos cada vez que comprueba cuantos seran
        numero_filas_semestre=null;
        if (document.getElementById("institucion_new").value != "" && document.getElementById("carrera_new").value != "" && document.getElementById("semestre_select").value != "") {
            document.getElementById("texto_info").style.display="block";

            var semestres_numero=document.getElementById("semestre_select").value;
            semestres_contador= new Array(semestres_numero);
            numero_filas_semestre= new Array(semestres_numero);

            semestres_contador[0]=0;
            numero_filas_semestre[0]=0;

            for (var i = 1; i <= semestres_numero; i++) {
                semestres_contador[i]=1;//hay que darle valor de cero, de lo contrario no crea bien el arreglo.
                numero_filas_semestre[i]=1;
                $("#semestres_contenedor").append(

                    '<div id="semestre_conte'+i+'">'+

                        '<div class="row" id="fila_registro_'+i+'_'+numero_filas_semestre[i]+'">'+
                            '<div class="col-md-12" style="margin-bottom: 25px;">'+
                                'Semestre '+i+''+
                            '</div>'+
                            '<div class="col-md-4" style="margin-bottom: 25px;">'+
                                '<input type="text" name="materia_semestre_'+i+'[]" id="materia_semestre_'+i+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase();" onchange="this.value = this.value.toUpperCase();" placeholder="Materia">'+
                                
                            '</div>'+
                            '<div class="col-md-4" style="margin-bottom: 25px;">'+
                                '<input type="text" name="clave_semestre_'+i+'[]" id="clave_semestre_'+i+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase();" onchange="this.value = this.value.toUpperCase();" placeholder="Clave">'+
                                
                            '</div>'+

                            '<div class="col-md-3" style="margin-bottom: 25px;">'+
                                '<input type="file" name="temario_semestre_'+i+'[]" id="temario_semestre_'+i+'[]" class="form-control input_edit archivo" onchange="documento_cambio();" data-temario="'+numero_filas_semestre[i]+'">'+
                                '<label id="temario_button_'+i+'[]" onclick="activar_file('+i+','+numero_filas_semestre[i]+');" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg> &#160;&#160;Subir temario</label>'+
                                
                            '</div>'+

                            '<div class="col-md-1" style="margin-bottom: 25px;">'+
                                '<a type="button" class="btn btn-success" id="mas_materias_semestre_'+i+'[]" onclick="agregar_fila_semestre('+i+')">+</a>'+
                                
                            '</div>'+
                            
                        '</div>'+

                        '<input type="hidden" name="total_materias_semestre_'+i+'" value="1">'+
                        
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
                        '<input type="text" name="materia_semestre_'+semestre+'[]" id="materia_semestre_'+semestre+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase();" onchange="this.value = this.value.toUpperCase();" placeholder="Materia">'+
                        
                    '</div>'+
                    '<div class="col-md-4" style="margin-bottom: 25px;">'+
                        '<input type="text" name="clave_semestre_'+semestre+'[]" id="clave_semestre_'+semestre+'[]" class="form-control input_edit" onkeyup="this.value = this.value.toUpperCase();" onchange="this.value = this.value.toUpperCase();" placeholder="Clave">'+
                        
                    '</div>'+

                    '<div class="col-md-3" style="margin-bottom: 25px;">'+
                        '<input type="file" name="temario_semestre_'+semestre+'[]" id="temario_semestre_'+semestre+'[]" class="form-control input_edit archivo" onchange="documento_cambio();" data-temario="'+numero_filas_semestre[semestre]+'">'+
                        '<label id="temario_button_'+semestre+'[]" onclick="activar_file('+semestre+','+numero_filas_semestre[semestre]+');" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg> &#160;&#160;Subir temario</label>'+
                        
                    '</div>'+

                    '<div class="col-md-1" style="margin-bottom: 25px;">'+
                        '<a type="button" class="btn btn-primary " onclick="eliminar_fila('+semestre+','+numero_filas_semestre[semestre]+');">-</a>'+
                        
                    '</div>'+
                    
                '</div>'
                

            );

        semestres_contador[semestre]++;//sumamos para la proxima iteracion
        numero_filas_semestre[semestre]++;
        console.log(numero_filas_semestre[semestre]);
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
    }

    //verificamos si hay cambio en el archivo, si lo hay entonces le damos el nombre al label
    function documento_cambio(){
        for (var i = 1; i <= document.getElementById("semestre_select").value; i++) {

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