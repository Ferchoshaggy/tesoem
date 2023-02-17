@extends('adminlte::page')

@section('title', 'Validacion')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@stop

@section('content')

<div class="card-body secciones_body">
    <div class="row">
        <div class="col-md-10" style="text-align: left;">
            <label for="" style="font-size:30px">Validaciones</label>
            <p>En este apartado validaras las materias de cada alumno según su situación para acreditar el paso dos del alumno. Da clic sobre alguno de los registros para ver las distintas opciones.</p>
        </div>
        <div class="col-md-2" style="text-align: center;">
            <img src="{{ url('icons/validacion.png') }}" style="width: 75%; height: auto;">
        </div>
    </div>
</div>

<div class="card-body secciones_body2" style=" text-align: left;">
    <div class="table-responsive">
        <table class="table" style="width: 100%">
            <thead>
              <tr>
                <th style="text-align: center;">Matricula</th>
                <th style="text-align: center;">Nombre</th>
                <th style="text-align: center;">Ins. Previa</th>
                <th style="text-align: center;">Estatus</th>
              </tr>
            </thead>
            <tbody>
            @foreach($alumnos as $alumno)
              <tr onclick="tomar_id({{$alumno->id}})" data-toggle="modal" data-target="#validar_modal" class="marca" style="cursor: pointer;">
                <td style="text-align: center;">{{$alumno->matricula}}</td>
                <td style="text-align: center;">{{$alumno->name}}</td>
                <td style="text-align: center;">{{$alumno->nombre}}</td>
                <td style="text-align: center;"><p style="color: #fff;background-color: #007bff; border-radius: 5px; padding: 5px;">pendiente</p></td>
              </tr>
             @endforeach
            </tbody>
          </table>
    </div>
</div>

<!-- validar -->
<div class="modal fade" id="validar_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow: auto;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Revision de materias</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">
            <div class="row">
                <div class="col-md-10" style="text-align: left;">
                    <p>
                     Atencion, acontinuación realizaras el proceso para validar las materias del alumno seleccionado y verificar si la materia es transferible de un plan de estudios a otro, de lado izquierdo podrás ver las materias cargadas por el alumno y del lado derecho podrás colocar la materia que necesites segun el plan de estudios del TESOEM, agrega las que necesites y evalua su similitud y si es apta o no para ser validada.
                    </p>
                </div>
                <div class="col-md-2" style="text-align: center;">
                    <img src="{{ url('icons/validacion.png') }}" style="width: 55%; height: auto;">
                </div>
            </div>
            <form  method="POST" action="" id="envio_form" enctype="multipart/form-data">
                @csrf
                <div class="row" style="margin-top: 15px; border-top: 3px solid #B9B9B9; padding-top: 15px;">

                    <div class="col-xl-6">
                            <!-- campos de arriba-->
                            <div class="row">
                                <div class="col-xl-4" style="margin-bottom: 5px;">
                                    Materias institucion previa
                                </div>
                                <div class="col-xl-4" style="margin-bottom: 5px;">
                                    <div class="row">
                                        <div class="col-xl-3" style="margin-bottom: 5px;">
                                            clave:
                                        </div>
                                        <div class="col-xl-9" style="margin-bottom: 5px;">
                                            <input type="text" name="clave_carrera_old" id="clave_carrera_old" class="form-control input_edit" >
                                        </div>
                                    </div>
                                     
                                </div>
                                <div class=" col-xl-2" style="margin-bottom: 5px;">
                                    <button type="button" class="btn btn-primary" id="button_corregir"  data-toggle="modal" data-target="#exito_guardado" onclick="envio_form_actualizacion_datos();">Corregir</button>
                                </div>
                                <div class="col-xl-2" style="margin-bottom: 5px;">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#historial">Hist.</button>
                                </div>
                            </div>

                            <!-- div que contiene todos los semetres de las materias old-->
                            <div class="secciones_body col-xl-12" id="div_principal_1" style="padding: 10px; margin-top: 25px;">
                                
                            </div>
                            <input type="hidden" name="tipo_proceso" id="tipo_proceso">
                    </div>
                        
                    

                    <div class="col-xl-6" >

                        <!-- campos de arriba-->
                        <div class="row">
                            <div class="col-xl-5" style="margin-bottom: 5px;">
                                Materias TESOEM
                            </div>
                            <div class="col-xl-4" style="margin-bottom: 5px;">
                                <div class="row">
                                    <div class="col-xl-3" style="margin-bottom: 5px;">
                                        clave:
                                    </div>
                                    <div class="col-xl-9" style="margin-bottom: 5px;">
                                        <input type="text" name="clave_carrera" id="clave_carrera" class="form-control input_edit" readonly value="{{$carrera->clave}}">
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="col-xl-3" style="margin-bottom: 5px;">
                                <button type="button" class="btn" style="background-color: #FF66FF; color: #fff;" onclick="recordar_materias();" data-toggle="modal" data-target="#exito_guardado">Recordar</button>
                            </div>
                        </div>

                        <!-- div que contiene todos los semetres de las materias teso-->
                        <div class="secciones_body col-xl-12" id="div_principal_2" style="padding: 10px; margin-top: 25px;">
                            
                        </div>
                    </div>

                </div>
                <input type="hidden" name="id_alumno" id="id_alumno">
            </form>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#seguro">Terminar</button>
        </div>
    </div>
  </div>
</div>


<!-- ver temario -->
<div class="modal fade" id="pdf_visor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; background-color: #111111bd;">
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
            <div class="col-xl-12" style="text-align: center;display: none;" id="no_se_mira">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; SI NO SE DESCARGO PRECIONA EL BOTON!</p>
                <a class="btn btn-success" target="_blank" href="" id="ver">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="" style="width:100%; height: 720px;" id="embad">
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>

<!-- ver historial -->
<div class="modal fade" id="historial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; background-color: #111111bd;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Historial Academico</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">
            <div class="col-xl-12" style="text-align: center;display: none;" id="no_se_mira_2">
                <p>UPss! &nbsp;&nbsp; !CREO QUE NO SE VE BIEN EL PDF; SI NO SE DESCARGO PRECIONA EL BOTON!</p>
                <a class="btn btn-success" target="_blank" href="" id="ver_2">¡VAMOS! <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/></svg></a>
            </div>
            <embed type="application/pdf" src="" style="width:100%; height: 720px;" id="embad_2">
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>


<input type="hidden" id="check_exito" data-toggle="modal" data-target="#exito_guardado">
<!-- agregado con exito modal de espera de carga-->
<div class="modal fade" id="exito_guardado" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto; background-color: #111111bd;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registro exitoso</h5>
            
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px; text-align: center;">

                <div class="col-md-12" id="texto_exito" style="display: none;">
                    El registro fue exitoso, ya puedes continuar con mas procesos.<br><br> 
                </div>
                <div class="col-md-12" id="texto_exito_2" style="display: none;">
                     
                </div>
                <div class="col-md-12" id="carga_espera">
                    <img src="{{url('img/cargando_12.gif')}}" style="width: 100%; height: auto; border-radius: 10%; "><br>
                    Espere un momento...
                </div>
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#iniciar" style="display: none;" id="check_off">Aceptar</button>  
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="seguro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow-y: auto; background-color: #111111bd;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #193333;">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Registro exitoso</h5>
            
        </div>
        <div class="modal-body" style="border-bottom: 1px solid #193333;">

            <div class="card-body secciones_body" style=" text-align: left; margin-bottom: 0px; text-align: center;">
                ¿Estas seguro de terminar el proceso de validacion para este alumno?
            </div>
        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="campos_empy();">Aceptar</button>  
        </div>
    </div>
  </div>
</div>

@stop

@section('css')
<style>
    .secciones_body{
        background-color: #234747;
        border-radius: 10px;
        margin-bottom: 35px;
        color: #fff;
    }
    .secciones_body2{
        background-color: #fff;
        border-radius: 10px;
        margin-bottom: 35px;
        color: black
    }
    .secciones_body3{
        background-color: #234747;
        border-radius: 10px;
        color: #fff;
        margin: 20px;
        padding: 10px;
    }
    .modal-content{
        background-color: #193333 !important;
        color:white ;
    }
    .modal-footer{
        border-top:#193333  !important;
    }

    .btn2{
      width: 100%;
      height: auto;
      /* centrado vertical */
      position: inherit;
      top: 25%;
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

    @media (min-width: 1200px) {
        .modal-xl {
            max-width: 1700px !important;
        }
    }

    .marca{
        transition: 1s;
    }
    .marca:hover{
        background: #797d8b80;
        transition: 1s;
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

    var materias_admin_c=null;

    $(document).ready(function() {
        $.ajax({
            url:"{{url('/AMaterias_admin')}}",
            type:'GET',
            dataType:'json',
            timeout : 80000,
        }).done(function(materias_admin){

            if(materias_admin!=null){
                materias_admin_c=materias_admin;
                //console.log(materias_admin_c);
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    });


    //envio de formulario para actualizar los datos que el alumno subio y talvez la cago

    function envio_form_actualizacion_datos(){

        document.getElementById("texto_exito").style.display="none";
        document.getElementById("texto_exito_2").style.display="none";
        document.getElementById("check_off").style.display="none";
        document.getElementById("carga_espera").style.display="block";

        var dataString =new FormData($("#envio_form")[0]);
        $.ajax({
            url:"{{url('/Asave_form_datos_alumno_up')}}",
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
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
                document.getElementById("check_off").style.display="block";
            }
        });
    }

    function envio_form_validacion(){

        document.getElementById("texto_exito").style.display="none";
        document.getElementById("texto_exito_2").style.display="none";
        document.getElementById("check_off").style.display="none";
        document.getElementById("carga_espera").style.display="block";

        var dataString =new FormData($("#envio_form")[0]);
        $.ajax({
            url:"{{url('/Asave_form_validacion')}}",
            type:'POST',
            dataType:'json',
            data:dataString,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function(exito){

            if(exito[0]=="si"){
                document.getElementById("texto_exito").style.display="block";
                document.getElementById("check_off").style.display="block";
                document.getElementById("carga_espera").style.display="none";
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando "+exito[1]);
                document.getElementById("check_off").style.display="block";
                console.log(exito[2]);
            }
        });
    }

    function campos_empy(){
        var envio=true;
        for (var i = 0; i < $("select[id='materia_new[]']").length; i++) {
            if($("select[id='materia_new[]']")[i].value=="" || $("select[id='matricula_c_new[]']")[i].value=="" || $("input[id='valor[]']")[i].value==""){
                envio=false;
                alert("te falta campos por llenar o seleccionar");
                break;
            }
        }
        if (envio){
            document.getElementById("check_exito").click();
            envio_form_validacion();
        }
    }

    var id_registro=null;

    function tomar_id(id){
        id_registro=id;
        materias_cursadas();
        document.getElementById("id_alumno").value=id_registro;
    }

    function cambio_color(input) {
        if (input.value<=69){
            input.style.backgroundColor="#FF7663";
        }else{
            input.style.backgroundColor="#B1F9D8"; //FFF886
        }
    }

    function pasar_url_pdf(url_temario) {
        var url="{{url('/temarios')}}"+"/"+url_temario;
        document.getElementById("embad").src=url;
        document.getElementById("ver").href=url;
    }

    function pasar_url_pdf_2(fila) {
        var url="{{url('/temarios')}}"+"/"+document.getElementById("temario_new_"+fila).value;
        document.getElementById("embad").src=url;
        document.getElementById("ver").href=url;
     } 

    function activar_check(lavel) {

        for (var i = 0; i < $("input[id='validacion[]']").length; i++) {
            if($("input[id='validacion[]']")[i].dataset.fila==lavel.dataset.fila){
                $("input[id='validacion[]']")[i].click();
                //console.log($("select[id='matricula_c_new[]'] option:selected")[i].text);
                break;
            }
        }
    }

    function cambio_texto_lavel(check) {

        for (var i = 0; i < $("label[id='label_check[]']").length; i++) {
            if($("label[id='label_check[]']")[i].dataset.fila==check.dataset.fila){
                if(check.checked){
                    check.value="si";
                    $("label[id='label_check[]']")[i].innerHTML="SI";
                }else{
                    $("label[id='label_check[]']")[i].innerHTML="NO";
                    check.value="no";
                }
                break;
            }
        }
    }

    function varificar_porcentaje(input){
        for (var i = 0; i < $("select[id='matricula_c_new[]']").length; i++) {
            if($("select[id='matricula_c_new[]']")[i].dataset.fila==input.dataset.fila){

                if(input.value>=80 && $("input[id='calificacion_old[]']")[i].value>=70){
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#B1F9D8";
                    /*
                    $("input[id='validacion[]']")[i].checked=true;
                    $("label[id='label_check[]']")[i].innerHTML="SI";
                    */
                }
                if(input.value>=80 && $("input[id='calificacion_old[]']")[i].value<70){
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FFF886";
                    /*
                    $("input[id='validacion[]']")[i].checked=true;
                    $("label[id='label_check[]']")[i].innerHTML="SI";
                    */
                }
                if(input.value<80){
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FF7663";
                    /*
                    $("input[id='validacion[]']")[i].checked=false;
                    $("label[id='label_check[]']")[i].innerHTML="NO";
                    */
                }
                break;
            }
        }
    }

    function buscar_temario(materia_select){

        detectar_mismo_primero(materia_select);
        //al otro select tambien seleccionamos el campo
        for (var i = 0; i < $("select[id='matricula_c_new[]']").length; i++) {
            if($("select[id='matricula_c_new[]']")[i].dataset.fila==materia_select.dataset.fila){
                $("select[id='matricula_c_new[]']")[i].value=materia_select.value;
                //console.log($("select[id='matricula_c_new[]'] option:selected")[i].text);

                //esta es para verificar si las claves son iguales
                if($("input[id='clave_old[]']")[i].value==$("select[id='matricula_c_new[]'] option:selected")[i].text){
                    console.log("si");
                    $("input[id='valor[]']")[i].value=100;
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#B1F9D8";
                    if ($("input[id='calificacion_old[]']")[i].value<70){
                        $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FFF886";
                    }
                }else{
                    $("input[id='valor[]']")[i].value=0;
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FF7663";
                }

                if(materia_select.value==""){
                    $("input[id='valor[]']")[i].value="";
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#fff";

                }
                break;
            }
        }

        for (var i = 0; i < materias_admin_c.length; i++) {
            if (materia_select.value==materias_admin_c[i].id){
                document.getElementById("temario_new_"+materia_select.dataset.fila).value=materias_admin_c[i].temario;
                document.getElementById("pdf_temario_"+materia_select.dataset.fila).disabled=false;
                break;
            }
        }
    }

    function cambio_select(select) {
        detectar_mismo_segundo(select);
        /*
        for (var i = 0; i < $("select[id='materia_new[]']").length; i++) {
            if($("select[id='materia_new[]']")[i].dataset.fila==select.dataset.fila){
                
                break;
            }
        }
        */
        //cpmparamos claves si son iguales
        for (var i = 0; i < $("input[id='clave_old[]']").length; i++) {
            if($("input[id='clave_old[]']")[i].dataset.fila==select.dataset.fila){
                $("select[id='materia_new[]']")[i].value=select.value;
                if($("input[id='clave_old[]']")[i].value==select.options[select.selectedIndex].text){
                    console.log("si");
                    $("input[id='valor[]']")[i].value=100;
                    select.style.backgroundColor="#B1F9D8";
                    if ($("input[id='calificacion_old[]']")[i].value<70){
                        select.style.backgroundColor="#FFF886";
                    }
                }else{
                    $("input[id='valor[]']")[i].value=0;
                    select.style.backgroundColor="#FF7663";
                }

                if(select.value==""){
                    $("input[id='valor[]']")[i].value="";
                    select.style.backgroundColor="#fff";
                    $("select[id='materia_new[]']")[i].style.backgroundColor="#fff";
                }
                break;
            }
        }

        for (var i = 0; i < materias_admin_c.length; i++) {
            if (select.value==materias_admin_c[i].id){
                document.getElementById("temario_new_"+select.dataset.fila).value=materias_admin_c[i].temario;
                document.getElementById("pdf_temario_"+select.dataset.fila).disabled=false;
                break;
            }
        }

    }


    function detectar_mismo_primero(select){
        if(select.value!=-1){
            for (var i = 0; i < $("select[id='materia_new[]']").length; i++) {
                if($("select[id='materia_new[]']")[i].value==select.value && $("select[id='materia_new[]']")[i].dataset.fila!=select.dataset.fila){
                    select.value="";
                    break;
                }
            }
        }
        
    }

    function detectar_mismo_segundo(select){
        if(select.value!=-1){
            for (var i = 0; i < $("select[id='matricula_c_new[]']").length; i++) {
                if($("select[id='matricula_c_new[]']")[i].value==select.value && $("select[id='matricula_c_new[]']")[i].dataset.fila!=select.dataset.fila){
                    select.value="";
                    break;
                }
            }
        }
        
    }

    function carreras_iguales(){
        if (document.getElementById("clave_carrera_old").value==document.getElementById("clave_carrera").value){

            for (var i = 0; i < $("select[id='materia_new[]']").length; i++) {
                /*
                $("select[id='materia_new[]']")[i].value=$("input[id='id_materia_id[]']")[i].value;
                $("select[id='matricula_c_new[]']")[i].value=$("input[id='id_materia_id[]']")[i].value;
                */
                //como se va a seleccionar por texto, entonces se hace de esta froma ya que la matricula, no esta en el value pero no funciona por que estamos usando un arreglo
                //$("select[id='matricula_c_new[] option:contains("+$("input[id='clave_old[]']")[i].value+")")[i].attr('selected', true);
                //$("select[id='materia_new[]']")[i].value=$("select[id='matricula_c_new[]']")[i].value;
                //esta es una forma mas tardada.
                for (var j = 0; j < materias_admin_c.length; j++) {
                    if ($("input[id='clave_old[]']")[i].value==materias_admin_c[j].matricula){
                        $("select[id='materia_new[]']")[i].value=materias_admin_c[j].id;
                        $("select[id='matricula_c_new[]']")[i].value=materias_admin_c[j].id;
                        break;
                    }
                }
                //este es para que se active el boton de ver el pdf del lado del tesoem
                buscar_temario($("select[id='materia_new[]']")[i]);
                if($("input[id='clave_old[]']")[i].value==$("select[id='matricula_c_new[]'] option:selected")[i].text){
                    $("input[id='valor[]']")[i].value=100;
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#B1F9D8";
                    if ($("input[id='calificacion_old[]']")[i].value<70){
                        $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FFF886";
                    }
                }else{
                    $("input[id='valor[]']")[i].value=0;
                    $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FF7663";
                }
            }
        }
    }

    function recordar_materias(){
        document.getElementById("texto_exito").style.display="none";
        document.getElementById("texto_exito_2").style.display="none";
        document.getElementById("check_off").style.display="none";
        document.getElementById("carga_espera").style.display="block";
        var calve_1=document.getElementById("clave_carrera_old").value;
        var calve_2=document.getElementById("clave_carrera").value;
        $.ajax({
            url:"{{url('/Amaterias_recuerdo')}}"+"/"+calve_1+"/"+calve_2,
            type:'get',
            dataType:'json',
        }).done(function(materias_recuerdo){
            //console.log(materias_recuerdo.length);
            if(materias_recuerdo.length!=0){
                
                for (var i = 0; i < $("select[id='materia_new[]']").length; i++) {
                    for (var j = 0; j < materias_recuerdo.length; j++) {
                        if(materias_recuerdo[j].id_materia_old==$("input[id='id_materia_id[]']")[i].value){
                            $("select[id='materia_new[]']")[i].value=materias_recuerdo[j].id_materia_new;
                            $("select[id='matricula_c_new[]']")[i].value=materias_recuerdo[j].id_materia_new;
                            $("input[id='valor[]']")[i].value=materias_recuerdo[j].porcentaje_r;
                            //este es para que se active el boton de ver el pdf del lado del tesoem
                            buscar_temario($("select[id='materia_new[]']")[i]);

                            if($("input[id='valor[]']")[i].value>=80 && $("input[id='calificacion_old[]']")[i].value>=70){
                                $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#B1F9D8";
                                /*
                                $("input[id='validacion[]']")[i].checked=true;
                                $("label[id='label_check[]']")[i].innerHTML="SI";
                                */
                            }
                            if($("input[id='valor[]']")[i].value>=80 && $("input[id='calificacion_old[]']")[i].value<70){
                                $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FFF886";
                                /*
                                $("input[id='validacion[]']")[i].checked=true;
                                $("label[id='label_check[]']")[i].innerHTML="SI";
                                */
                            }
                            if($("input[id='valor[]']")[i].value<80){
                                $("select[id='matricula_c_new[]']")[i].style.backgroundColor="#FF7663";
                                /*
                                $("input[id='validacion[]']")[i].checked=false;
                                $("label[id='label_check[]']")[i].innerHTML="NO";
                                */
                            }
                            break;
                        }
                    }
                }
                document.getElementById("texto_exito").style.display="none";
                document.getElementById("texto_exito_2").style.display="block";
                document.getElementById("check_off").style.display="block";
                document.getElementById("carga_espera").style.display="none";
                document.getElementById("texto_exito_2").innerHTML="ya se cargo el recurdo de la validacion entre estas carreras";

            }else{
                //alert("al parecer no contamos con ningun registro o talvez el servidor esta fallando");
                document.getElementById("check_off").style.display="block";
                document.getElementById("texto_exito_2").style.display="block";
                document.getElementById("carga_espera").style.display="none";
                document.getElementById("texto_exito_2").innerHTML="Al parecer no contamos con ningun recurdo de dichas carreras";
            }
        });
    }

    function materias_cursadas() {
        $.ajax({
            url:"{{url('/AMaterias_cursadas')}}"+"/"+id_registro,
            type:'get',
            dataType:'json',
        }).done(function(materias_cursadas){

            if(materias_cursadas!=null){
                console.log(materias_cursadas);
                $("#div_principal_1").empty();
                $("#div_principal_2").empty();
                if (materias_cursadas[1].tipo_proceso==1){

                    for (var i = 1; i <= materias_cursadas[1].semestre; i++) {

                        $("#div_principal_1").append(
                            '<div class="col-xl-12" id="'+i+'_s_old" style="background-color: #387171; border-radius: 10px;     margin-bottom: 10px;">'+
                                    '<div class="col-xl-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">'+
                                        +i+'° Semestre'+
                                    '</div>'+
                                '</div>'
                        );

                        $("#div_principal_2").append(
                            '<div class="col-xl-12" id="'+i+'_s_new" style="background-color: #387171; border-radius: 10px;     margin-bottom: 10px;">'+
                                    '<div class="col-xl-12" style="margin-bottom: 25px; font-size: 24px; font-weight: bold;">'+
                                        '<br>'+
                                    '</div>'+
                                '</div>'
                        );

                        for (var j = 0; j <= materias_cursadas[0].length; j++){

                            try{

                                if(materias_cursadas[0][j].semestre==i){

                                    if(materias_cursadas[0][j].calificacion<=69){
                                        var color="#FF7663";

                                    }else{
                                        var color="#B1F9D8";
                                        
                                    }

                                    $("#"+i+"_s_old").append(
                                        '<div class="row" style="text-align: center;">'+
                                            '<div class="col-xl-5" style="margin-bottom: 10px;">'+
                                                '<input type="text" name="materia_old[]" class="form-control input_edit" id="materia_old[]" value="'+materias_cursadas[0][j].nombre+'"  onkeyup="this.value = this.value.toUpperCase();" onchange="this.value = this.value.toUpperCase();" data-fila="'+j+'" title="MATERIA">'+
                                            '</div>'+
                                            '<div class="col-xl-3" style="margin-bottom: 10px;">'+
                                                '<input type="text" name="clave_old[]" class="form-control input_edit" id="clave_old[]" value="'+materias_cursadas[0][j].matricula+'" onkeyup="this.value = this.value.toUpperCase(); " onchange="this.value = this.value.toUpperCase(); " data-fila="'+j+'" title="CALVE DE LA MATERIA">'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px;">'+
                                                '<input type="text" name="calificacion_old[]" class="form-control input_edit" id="calificacion_old[]" value="'+materias_cursadas[0][j].calificacion+'" inputmode="numeric" onchange=" cambio_color(this);" data-fila="'+j+'" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false; " onpaste="return false" style="background-color: '+color+';" min="0" title="CALIFICACION">'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px; font-size: 1.3rem; font-weight: bold;">'+
                                                '<button type="button" id="pdf_temario_old" class="btn btn-primary " onclick="pasar_url_pdf(\''+materias_cursadas[0][j].temario+'\');" data-toggle="modal" data-target="#pdf_visor" title="VER TEMARIO">VER</button>'+
                                                '<input type="hidden" id="id_registro_materia[]" name="id_registro_materia[]" value="'+materias_cursadas[0][j].id+'"></input>'+
                                                '<input type="hidden" id="id_materia_id[]" name="id_materia_id[]" value="'+materias_cursadas[0][j].id_materia+'"></input>'+
                                            '</div>'+
                                        '</div>'
                                    );


                                    $("#"+i+"_s_new").append(
                                        '<div class="row" style="text-align: center;">'+
                                            '<div class="col-xl-4" style="margin-bottom: 10px;">'+
                                                '<select class="form-control edit_select" id="materia_new[]" name="materia_new[]" data-fila="'+j+'" onchange="buscar_temario(this);" title="MATERIA">'+
                                                    '<option value="" disabled selected style="background-color: #fff;">Materias</option>'+
                                                    '@foreach($materias_new as $materia_new)'+
                                                    '<option value="{{$materia_new->id}}" style="background-color: #fff;">{{$materia_new->nombre}}</option>'+
                                                    '@endforeach'+
                                                    '<option value="-1"style="background-color: #fff;">SIN COMPARATIVA</option>'+
                                                '</select>'+
                                            '</div>'+
                                            '<div class="col-xl-4" style="margin-bottom: 10px;">'+
                                                '<select class="form-control edit_select" id="matricula_c_new[]" name="matricula_c_new[]" data-fila="'+j+'" onchange="cambio_select(this);" title="CALVE DE LA MATERIA">'+
                                                    '<option value="" disabled selected style="background-color: #fff;">Claves Mat.</option>'+
                                                    '@foreach($materias_new as $materia_new)'+
                                                    '<option value="{{$materia_new->id}}" style="background-color: #fff;">{{$materia_new->matricula}}</option>'+
                                                    '@endforeach'+
                                                    '<option value="-1"style="background-color: #fff;">---</option>'+
                                                '</select>'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px;">'+
                                                '<input type="text" name="valor[]" class="form-control input_edit" id="valor[]" placeholder="%" onchange="varificar_porcentaje(this);" title="% DE SIMILITUD" data-fila="'+j+'" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false; " onpaste="return false" inputmode="numeric">'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px; font-size: 1.3rem; font-weight: bold;">'+
                                                '<button type="button" id="pdf_temario_'+j+'" class="btn btn-primary" onclick="pasar_url_pdf_2('+j+');" data-toggle="modal" data-target="#pdf_visor" disabled title="VER TEMARIO">VER</button>'+
                                                '<input type="hidden" id="temario_new_'+j+'" name="temario_new_'+j+'"></input>'+
                                            '</div>'+
                                        '</div>'
                                    );


                                }

                            }catch(TypeError){

                                console.log("no existe "+i);

                            }

                            
                        }

                    }


                }
                document.getElementById("clave_carrera_old").value=materias_cursadas[2].clave;
                var url="{{url('/documents_h_academico')}}"+"/"+materias_cursadas[3].ruta;
                document.getElementById("embad_2").src=url;
                document.getElementById("ver_2").href=url;
                document.getElementById("tipo_proceso").value=materias_cursadas[1].tipo_proceso;
                //verificar si son las mismas clavez
                carreras_iguales();
            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }

    //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        document.getElementById("no_se_mira").style.display="block";
        document.getElementById("no_se_mira_2").style.display="block";
    }else{
        document.getElementById("no_se_mira").style.display="none";
        document.getElementById("no_se_mira_2").style.display="none";
    }
</script>
@stop
