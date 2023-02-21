@extends('adminlte::page')

@section('title', 'Catalogo de instituciones')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('content')

<div class="card-body secciones_body">
    <div class="row">
        <div class="col-md-10">
<label for="" style="font-size:30px">Catalogo de instituciones</label>
<p>En este apartado podras Agregar, Editar o Eliminar instituciones de tu sistema.</p>
<p>Has clic en alguno de los registros para ver las opciones</p>
    </div>
    <div class="col-md-2">
<center><img src="{{ url('icons/P1.png') }}" alt="" style="width: 75%; height: auto;"></center>
    </div>
</div>

</div>

<div class="card-body secciones_body2" style=" text-align: left;">
<div class="table-responsive">
<div id="tabla-catIns"></div>
</div>
</div>

<!-- Modal Usuarios-->
<div class="modal fade" id="AgregarIns" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Nueva institcuion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
<form id="form-new-inst" method="POST" action="{{url('/save_instituciones')}}">
            @csrf
<div class="modal-body">
A continuacion se muestra el un campo donde solo deber colocar el nombre de la institcuion para, poder asignarle carreras posteriormente.
         <br><br>

 <div class="card-body secciones_body">

<div class="row">
<div class="col-md-12">
<label for="">institucion</label>
<input type="text" class="form-control" id="escuela" name="escuela" onkeyup="this.value = this.value.toUpperCase();valInts();">
</div>
</div>

    </div>

</div>
        <div class="modal-footer">
          <button class="btn btn-success" id="btnSaveInst" disabled>Guardar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal agregado-->
<div class="modal fade" id="AvisoSaveIns" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
          La institucion Fue agregada con Exito podras editarla o eliminarla precionando sobre su fila
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

      <!--menu de opciones de la tabla-->
      <div id="menu_opciones" class="visible_off " style=" padding: 15px; background-color: #193333;">

        <button type="button" class="close" style="margin-right: -5px; margin-top: -15px; margin-bottom: 10px" onclick="cerrar_menu();">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
        </button>

        <button class="btn marca" style="color:white" data-toggle="modal" data-target="#editar_insti" onclick="institucion_edit();">
            Editar
          </button>
          <br>
        <button class="btn marca" style="color:white" data-toggle="modal" data-target="#eliminar_insti" onclick="institucion_delete();">
            Eliminar
          </button>
          <br>
    </div>


@stop

@section('css')
<style>
    .secciones_body{
        background-color: #234747;
        border-radius: 10px;
        margin-bottom: 10px;
        color: #fff;
    }
    .secciones_body2{
        background-color: #fff;
        border-radius: 10px;
        margin-bottom: 35px;
        color: black
    }
    .modal-content{
        background-color: #193333 !important;
        color:white ;
    }
    .modal-header{
        border-bottom:#193333 !important;
    }
    .modal-footer{
        border-top:#193333  !important;
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.visible_on{
        display: block;
        position: fixed;
        background: white;
        border-radius: 15px;
        width: auto;
    }
    .visible_off{
        display: none;
    }
    .paginate_button{
    position:sticky;
}

    .marca{
        transition: 1s;
        cursor: pointer;
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
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<!-- este es para el selected2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

 //FUNCION PARA MOSTRAR LA TABLA AL ENTRAR A CUENTAS
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
success: function(escuelas){
$('#tabla-catIns').empty().html(escuelas);
}
});

});

//FUNCION PARA RECARGAR TABLA

function tableRE(){
    $.ajax({
type:'get',
url:"{{ url('/view_cat_institucionesJax') }}",
success: function(escuelas){
$('#tabla-catIns').empty().html(escuelas);
}
 });
}

//FUNCION PARA AGREGAR NUEVO USUARIO
$(document).ready(function() {

$("#btnSaveInst").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-new-inst")[0]);

     $.ajax({
        url:"{{url('/save_instituciones')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#AgregarIns').modal('hide');
            tableRE();
            $("#form-new-inst")[0].reset();
            $('#AvisoSaveIns').modal('show');


        }, error:function (response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo O intentalo de nuevo");
        }

    });
});
});

//funcion para validar primeros datos
function valInts(){
    var escu=document.getElementById("escuela").value;

if(escu){
    document.getElementById('btnSaveInst').disabled=false;
}else{
    document.getElementById('btnSaveInst').disabled=true;
}

}

var id_inst=null;
function tomar_id($id_tr){
    id_inst=$id_tr;
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        menu_opciones.style.top=coordenadas_y-15+"px";
        menu_opciones.style.left=coordenadas_x-15+"px";
        menu_opciones.classList.add("visible_on");
        menu_opciones.classList.remove("visible_off");
}
          menu_opciones.addEventListener("mouseleave",function(){
          menu_opciones.classList.remove("visible_on");
          menu_opciones.classList.add("visible_off");
    });
    function cerrar_menu(){
        menu_opciones.classList.remove("visible_on");
        menu_opciones.classList.add("visible_off");
    }


</script>

@stop

