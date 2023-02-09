@extends('adminlte::page')

@section('title', 'Catalogo de Materias')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@stop

@section('content')


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


<div class="card-body secciones_body">
    <div class="row">
        <div class="col-md-10">
<label for="" style="font-size:30px">Catalogo de Materias</label>
<p>En este apartado podras agregar las materias y semestres acorde a la carrera que administras</p>
    </div>
    <div class="col-md-2">
<center><img src="{{ url('icons/M1.png') }}" alt="" style="width: 75%; height: auto;"></center>
    </div>
</div>

</div>

<div class="card-body secciones_body2" style=" text-align: left;">
<div class="table-responsive">
<div id="table-materias"></div>


</div>

<!-- Modal agregar materia-->
<div class="modal fade" id="agregarMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form id="form-save-materias" action="{{ url('/save_catmaterias') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="secciones_body3">
          <div class="row">
<div class="col-md-10">
<label for="" style="font-size: 25px">Agregar Materias</label>
<p style="font-size: 15px">A continuacion agregaras el semestre y las materias que corresponden a este Junto con su clave y creditos de la misma. El boton con el signo "+"
   te permite agregar una materia, agrega solo las que contiene el semestre, si agregas de mas, el boton con el signo "-" la eliminara.
</p>
</div>
<div class="col-md-2">
    <center><img src="{{ url('icons/M1.png') }}" alt="" style="width: 70%; height: auto;"></center>
</div>
          </div>


<div class="row">
    <div class="col-md-2">
<label for="SEMESTRE">Semestre Numero</label>
</div>
<div class="col-md-2">
    <input type="number" id="semestre" class="form-control" name="semestre" min="1" pattern="^[0-9]+">
</div>

</div>
<br>

<div class="row">
<div class="col-md-3">
<label for="Materias">Materias</label>
<input type="text" class="form-control" id="materias" name="materias" placeholder="MATERIA" onkeyup="this.value = this.value.toUpperCase();">
</div>
<div class="col-md-3">
<label for="" style="visibility: hidden">--</label>
<input type="text" class="form-control" id="clave" name="clave" placeholder="CLAVE" onkeyup="this.value = this.value.toUpperCase();">
</div>
<div class="col-md-2">
<label for="" style="visibility: hidden">--</label>
<input type="number" class="form-control" name="creditos" id="creditos" placeholder="CREDITOS">
</div>
<div class="col-md-3">
<label for="" style="visibility: hidden">--</label>

<input type="file" name="temario" id="foto_archivo2" class="form-control input_edit archivo" onchange="cambio_foto(this);">
<label id="button_file2" for="foto_archivo2" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>

</div>
<div class="col-md-1">
<label for="" style="visibility: hidden">--</label>
<button class="btn btn-success form-control" id="agregarmat">+</button>
</div>
</div>

<div id="masmaterias"></div>

        </div>
        <div class="modal-footer">
           <label for="">Para Finalizar presiona el boton de guardar</label>
          <button class="btn btn-success" id="btnsavemat" disabled><img src="{{ url('icons/C0.png') }}" style="width: 25px; height: auto;"></button>
        </div>
      </div>
    </form>
    </div>
  </div>


<!-- Modal guardado con exito-->
<div class="modal fade" id="modal-exitoG" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="col" style="margin-top: 15px">
     <center><img src="{{ url('icons/M1T.png') }}" alt="" style="width: 70%; height: auto;"></center>
         </div>
         <div class="col" style="margin-top: 5px">
    <center><label for="guardado" id="labelguardado"></label></center>
                </div>
     <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
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
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
   -webkit-appearance: none;
    margin: 0;
    }

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


<script>
    //Campos dinamicos de materias
    $(function () {
    var i = 0;
    $('#agregarmat').click(function (e) {
      e.preventDefault();
        i++;
$('#masmaterias').append('<div class="row dinamic-row" id="newRow'+i+'">'
+'<div class="col-md-3" >'
+'<label for="Materias">Materias</label>'
+'<input type="text" class="form-control" id="materiasD[]" name="materiasD[]" placeholder="MATERIA" onkeyup="this.value = this.value.toUpperCase();">'
+'</div>'
+'<div class="col-md-3">'
+'<label  style="visibility: hidden">--</label>'
+'<input type="text" class="form-control" id="claveD[]" name="claveD[]" placeholder="CLAVE" onkeyup="this.value = this.value.toUpperCase();">'
+'</div>'
+'<div class="col-md-2">'
+'<label style="visibility: hidden">--</label>'
+'<input type="number" class="form-control" name="creditosD[]" id="creditosD[]" placeholder="CREDITOS">'
+'</div>'

+'<div class="col-md-3">'
+'<label style="visibility: hidden">--</label>'
+'<input type="file" name="temarioD[]" id="foto_archivo[]" class="form-control input_edit archivo" onchange="cambio_archivo(this);" data-temario="'+i+'">'
+'<label id="button_file_'+i+'" onclick="temario_edit('+i+');" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>'
+'</div>'

+'<div class="col-md-1">'
+'<label style="visibility: hidden">--</label>'
+'<button type="button" class="removeMat btn btn-primary form-control" id="'+i+'">-</button>'
+'</div>'
+'</div>'

        );
    });

     $(document).on('click', '.removeMat', function(e) {
       e.preventDefault();
        var id = $(this).attr("id");
         $('#newRow'+id+'').remove();
      });

  });

//FUNCION PARA MOSTRAR LA TABLA AL ENTRAR A DOCUMENTOS
$(document).ready(function() {
    tableRE();
});

//FUNCION PARA LA PAGINACION
$(document).on("click",".pagination li a",function(e){
e.preventDefault();
var url=$(this).attr("href");

$.ajax({
type:'get',
url:url,
success: function(carreras,usuarios){
$('#table-materias').empty().html(carreras,usuarios);
}
});

});

//FUNCION PARA RECARGAR TABLA
var tableRE = function(){
    $.ajax({
type:'get',
url:"{{ url('/AMateriasJax') }}",
success: function(carreras,usuarios){
$('#table-materias').empty().html(carreras,usuarios);
}
 });
}

//agregar temario PDF

function cambio_foto(file){
    var url_img=null;
    if (file.files[0]!=null){
        if(file.value.split('.').pop()=="pdf"){
          document.getElementById("button_file2").innerHTML=file.value;
        }else{

            document.getElementById("button_file2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            alert("EL ARCHIVO NO ES ACEPTADO");
            file.value=null;

        }
    }else{
        document.getElementById("button_file2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
        file.value=null;
    }
  }

//funcion para input file dinamico

function temario_edit($fila_file){
    try{
            //document.getElementById("temario_semestre_"+semestre)[fila-1].click();
            for (var j = 0; j < $("input[id='foto_archivo[]']").length; j++) {
                if ($("input[id='foto_archivo[]']")[j].dataset.temario==$fila_file) {

                    $("input[id='foto_archivo[]']")[j].click();
                    //console.log("encontrado");
                    break;
                }
            }

        }catch(TypeError){

        }

}

function cambio_archivo($fila_input){
    try{
var filaa=$fila_input.dataset.temario;
    var url_img=null;
    if ($fila_input.files[0]!=null){
        if($fila_input.value.split('.').pop()=="pdf"){
          document.getElementById("button_file_"+filaa).innerHTML=$fila_input.value;
        }else{

            document.getElementById("button_file_"+filaa).innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            alert("EL ARCHIVO NO ES ACEPTADO");
            $fila_input.value=null;

        }
    }else{
        document.getElementById("button_file_"+filaa).innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
        $fila_input.value=null;
    }


        }catch(TypeError){

        }
}

//ajax para guardar materias
$(document).ready(function() {

$("#btnsavemat").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-save-materias")[0]);

     $.ajax({
        url:"{{url('/save_catmaterias')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function([semestre]){
            jQuery.noConflict();
            $('#agregarMateria').modal('hide');
            document.getElementById("button_file2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            $('.dinamic-row').remove();
            $("#form-save-materias")[0].reset();
            tableRE();
            document.getElementById("labelguardado").innerHTML="Las materias fueron correctamente Guardadas para el semestre numero "+semestre;
            $('#modal-exitoG').modal('show');

        }, error:function ([semestre]){
            alert("Ocurrio un Problema y no se guardaron tus campos dinamicos solo se guardo la primea fila de campos intentalo de nuevo");
            $('#agregarMateria').modal('hide');
            document.getElementById("button_file2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            $('.dinamic-row').remove();
            $("#form-save-materias")[0].reset();
            tableRE();
        }

    });
});
});

//jquery para desvanecer el mensage
$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
</script>

@stop
