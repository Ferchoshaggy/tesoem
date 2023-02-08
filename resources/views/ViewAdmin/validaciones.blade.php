@extends('adminlte::page')

@section('title', 'Aprobacion de documentos')

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
              <tr onclick="tomar_id({{$alumno->id}})" data-toggle="modal" data-target="#validar_modal">
                <td style="text-align: center;">{{$alumno->matricula}}</td>
                <td style="text-align: center;">{{$alumno->name}}</td>
                <td style="text-align: center;">{{$alumno->nombre}}</td>
                <td style="text-align: center;"><p class="btn btn-primary">pendiente</p></td>
              </tr>
             @endforeach
            </tbody>
          </table>
    </div>
</div>

<!-- validar -->
<div class="modal fade" id="validar_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: #fff; overflow: auto;">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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

            <div class="row row-cols-" style="margin-top: 15px; border-top: 3px solid #B9B9B9; padding-top: 15px;">

                <div class="col-xl-6">

                    <!-- campos de arriba-->
                    <div class="row">
                        <div class="col-xl-5" style="margin-bottom: 5px;">
                            Materias institucion previa
                        </div>
                        <div class="col-xl-4" style="margin-bottom: 5px;">
                            <div class="row">
                                <div class="col-xl-3" style="margin-bottom: 5px;">
                                    clave:
                                </div>
                                <div class="col-xl-9" style="margin-bottom: 5px;">
                                    <input type="text" name="clave_carrera" id="clave_carrera_old" class="form-control input_edit" >
                                </div>
                            </div>
                             
                        </div>
                        <div class=" col-xl-3" style="margin-bottom: 5px;">
                            <button type="button" class="btn btn-primary">Corregir</button>
                        </div>
                    </div>

                    <!-- div que contiene todos los semetres de las materias old-->
                    <div class="secciones_body col-xl-12" id="div_principal_1" style="padding: 10px; margin-top: 25px;">
                        
                    </div>
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
                                    <input type="text" name="clave_carrera" id="clave_carrera" class="form-control input_edit" disabled value="{{$carrera->clave}}">
                                </div>
                            </div>
                             
                        </div>
                        <div class="col-xl-3" style="margin-bottom: 5px;">
                            <button type="button" class="btn" style="background-color: #FF66FF; color: #fff;">Recordar</button>
                        </div>
                    </div>

                    <!-- div que contiene todos los semetres de las materias teso-->
                    <div class="secciones_body col-xl-12" id="div_principal_2" style="padding: 10px; margin-top: 25px;">
                        
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer" style="border-top: 1px solid #193333;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-link" data-dismiss="modal" >Terminar</button>
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
    var id_registro=null;

    function tomar_id(id){
        id_registro=id;
        materias_cursadas();
    }

    function pasar_url_pdf(url_temario) {
        var url="{{url('/temarios')}}"+"/"+url_temario;
        document.getElementById("embad").src=url;
        document.getElementById("ver").href=url;
    }

    function materias_cursadas() {
        $.ajax({
            url:"{{url('/AMaterias_cursadas')}}"+"/"+id_registro,
            type:'get',
            dataType:'json',
        }).done(function(materias_cursadas){

            if(materias_cursadas!=null){
                console.log(materias_cursadas);


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

                        for (var j = 0; j <= materias_cursadas[0].length; j++) {

                            try{

                                if(materias_cursadas[0][j].semestre==i){

                                    $("#"+i+"_s_old").append(
                                        '<div class="row" style="text-align: center;">'+
                                            '<div class="col-xl-5" style="margin-bottom: 10px;">'+
                                                '<input type="text" name="materia_old" class="form-control input_edit" id="materia_old" value="'+materias_cursadas[0][j].nombre+'"  onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();">'+
                                            '</div>'+
                                            '<div class="col-xl-3" style="margin-bottom: 10px;">'+
                                                '<input type="text" name="clave_old" class="form-control input_edit" id="clave_old" value="'+materias_cursadas[0][j].matricula+'"  onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();">'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px;">'+
                                                '<input type="number" name="calificacion_old" class="form-control input_edit" id="calificacion_old" value="'+materias_cursadas[0][j].calificacion+'"  onkeyup="this.value = this.value.toUpperCase(); inputs_empy();" onchange="this.value = this.value.toUpperCase(); inputs_empy();">'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px; text-align: ;">'+
                                                '<button type="button" id="pdf_temario_old" class="btn btn-primary btn-sm" onclick="pasar_url_pdf(\''+materias_cursadas[0][j].temario+'\');" data-toggle="modal" data-target="#pdf_visor">VER</button>'+
                                            '</div>'+
                                        '</div>'
                                    );


                                    $("#"+i+"_s_new").append(
                                        '<div class="row" style="text-align: center;">'+
                                            '<div class="col-xl-3" style="margin-bottom: 10px;">'+
                                                '<select class="form-control edit_select" id="carrera_new">'+
                                                    '<option value="" disabled selected>.:Materias:.</option>'+
                                                    '@foreach($materias_new as $materia_new)'+
                                                    '<option value="{{$materia_new->id}}">{{$materia_new->nombre}}</option>'+
                                                    '@endforeach'+
                                                '</select>'+
                                            '</div>'+
                                            '<div class="col-xl-3" style="margin-bottom: 10px;">'+
                                                '<select class="form-control edit_select" id="matricula_c_new">'+
                                                    '<option value="" disabled selected>.:Claves Mat.:.</option>'+
                                                    '@foreach($materias_new as $materia_new)'+
                                                    '<option value="{{$materia_new->id}}">{{$materia_new->matricula}}</option>'+
                                                    '@endforeach'+
                                                '</select>'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px;">'+
                                                '<input type="number" name="valor" class="form-control input_edit" id="valor" placeholder="%">'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px;">'+
                                                '<button type="button" id="pdf_temario_old" class="btn btn-warning btn-sm">Validar</button>'+
                                            '</div>'+
                                            '<div class="col-xl-2" style="margin-bottom: 10px;">'+
                                                '<button type="button" id="pdf_temario_old" class="btn btn-primary btn-sm" onclick="pasar_url_pdf(\''+materias_cursadas[0][j].temario+'\');" data-toggle="modal" data-target="#pdf_visor">VER</button>'+
                                            '</div>'+
                                        '</div>'
                                    );


                                }

                            }catch(TypeError){

                                console.log("no existe "+i);

                            }

                            
                        }

                        document.getElementById("clave_carrera_old").value=materias_cursadas[2].clave;
                    }


                }

                

            }else{
                alert("algo salio mal, te sugiro que vuelvas en unos minutos, el servidor esta fallando");
            }
        });
    }

    //este es para saber que dispositivo se esta usando y mandarlo a otro lado al usuario ya que no se mira bien el pdf
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
        document.getElementById("no_se_mira").style.display="block";
    }else{
        document.getElementById("no_se_mira").style.display="none";
    }
</script>
@stop
