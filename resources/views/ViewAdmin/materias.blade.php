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

<form id="form-save-materias" action="{{ url('/save_catmaterias') }}" method="POST" enctype="multipart/form-data">
@csrf
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
<input type="text" class="form-control" id="materias" name="materias" placeholder="MATERIA">
</div>
<div class="col-md-3">
<label for="" style="visibility: hidden">--</label>
<input type="text" class="form-control" id="clave" name="clave" placeholder="CLAVE">
</div>
<div class="col-md-2">
<label for="" style="visibility: hidden">--</label>
<input type="number" class="form-control" name="creditos" id="creditos" placeholder="CREDITOS">
</div>
<div class="col-md-3">
<label for="" style="visibility: hidden">--</label>

<input type="file" name="temario" id="foto_archivo" class="form-control input_edit archivo" onchange="cambio_foto(this);">
<label id="button_file" for="foto_archivo" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>

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
          <button class="btn btn-success" id="btnsavemat"><img src="{{ url('icons/C0.png') }}" style="width: 25px; height: auto;"></button>
        </div>
    </form>
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
$('#masmaterias').append('<div class="row" id="newRow'+i+'">'
+'<div class="col-md-3" >'
+'<label for="Materias">Materias</label>'
+'<input type="text" class="form-control" id="materiasD[]" name="materiasD[]" placeholder="MATERIA">'
+'</div>'
+'<div class="col-md-3">'
+'<label  style="visibility: hidden">--</label>'
+'<input type="text" class="form-control" id="claveD[]" name="claveD[]" placeholder="CLAVE">'
+'</div>'
+'<div class="col-md-2">'
+'<label style="visibility: hidden">--</label>'
+'<input type="number" class="form-control" name="creditosD[]" id="creditosD[]" placeholder="CREDITOS">'
+'</div>'

+'<div class="col-md-3">'
+'<label style="visibility: hidden">--</label>'
+'<input type="file" name="temarioD[]" id="foto_archivo" class="form-control input_edit archivo" onchange="cambio_foto(this);">'
+'<label id="button_file" for="foto_archivo" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>'
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
          document.getElementById("button_file").innerHTML=file.value;
        }else{

            document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            alert("EL ARCHIVO NO ES ACEPTADO");
            file.value=null;

        }
    }else{
        document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
        file.value=null;
    }
  }



</script>

@stop
