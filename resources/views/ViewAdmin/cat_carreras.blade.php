@extends('adminlte::page')

@section('title', 'Catalogo de carreras')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- estos son para la tabla-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('content')

<div class="card-body secciones_body">
    <div class="row">
        <div class="col-md-10">
<label for="" style="font-size:30px">Catalogo de carreras</label>
<p>En este apartado podras Agregar, Editar o Eliminar carreras de tu sistema.</p>
<p>Has clic en alguno de los registros para ver las opciones</p>
    </div>
    <div class="col-md-2">
<center><img src="{{ url('icons/P2.png') }}" alt="" style="width: 75%; height: auto;"></center>
    </div>
</div>

</div>

<div class="card-body secciones_body2" style=" text-align: left;">
<div class="table-responsive">
<div id="tabla-cat-carr"></div>
</div>
</div>

<!-- Modal nueva carrera-->
<div class="modal fade" id="AgregarCarrera" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
<form id="form-new-carre" method="POST" action="{{url('/save_carreras')}}">
            @csrf
<div class="modal-body">
A continuacion se muestra el Formulario para agregar una carrera a la institucion que escojas.El boton con el signo "+"
te permite agregar una institucion, si agregas de mas, el boton con el signo "-" la eliminara.
         <br><br>

 <div class="card-body secciones_body">

<div class="row">
    <div class="col-md-4">
        <label for="">institucion</label>
<select name="escuela" id="select_carrera" class="form-control" onchange="valCarr();">
@foreach ($escuelas as $escuela)
    <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
@endforeach
</select>
        </div>

<div class="col-md-4">
<label for="">Carrera</label>
<input type="text" class="form-control" id="carrera" name="carrera" onkeyup="this.value = this.value.toUpperCase();valCarr();">
</div>
<div class="col-md-3">
    <label for="">Clave</label>
    <input type="text" class="form-control" id="clave" name="clave" onkeyup="this.value = this.value.toUpperCase();valCarr();">
    </div>


<div class="col-md-1">
    <label for="" style="visibility: hidden">----</label>
    <button class="btn btn-primary form-control" id="mascarreras">+</button>
</div>
</div>

<div id="carrerasD"></div>

    </div>

</div>
        <div class="modal-footer">
          <button class="btn btn-success" id="btnSaveCarr" disabled>Guardar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal aviso save carrera-->
  <div class="modal fade" id="AvisoSaveCarr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
          La Carrera Fue guardada con Exito
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

        <button class="btn marca" style="color:white" data-toggle="modal" data-target="#editar_carrera" onclick="carrera_edit();">
            Editar
          </button>
          <br>
        <button class="btn marca" style="color:white" data-toggle="modal" data-target="#eliminar_carrera" onclick="carrera_delete();">
            Eliminar
          </button>
          <br>
    </div>

<!-- Modal editar carrera-->
<div class="modal fade" id="editar_carrera" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Editar Carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
<form id="form-update-carre" method="POST" action="{{url('/update_carrera')}}">
            @csrf
<div class="modal-body">
A continuacion se muestra la carrera que editaras
         <br><br>

 <div class="card-body secciones_body">

<div class="row">
    <div class="col-md-4">
        <label for="">institucion</label>
<select name="escuela" id="select_carreraE" class="form-control" onchange="valCarr();">

</select>
        </div>

<div class="col-md-4">
<label for="">Carrera</label>
<input type="text" class="form-control" id="carreraE" name="carrera" onkeyup="this.value = this.value.toUpperCase();valCarr();">
</div>
<div class="col-md-4">
    <label for="">Clave</label>
    <input type="text" class="form-control" id="claveE" name="clave" onkeyup="this.value = this.value.toUpperCase();valCarr();">
    </div>

</div>
    </div>

</div>
        <div class="modal-footer">
            <input type="hidden" name="id_carre" id="id_carre">
          <button class="btn btn-success" id="btnUpdateCarr">Editar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal aviso update carrera-->
<div class="modal fade" id="AvisoUpdateCarr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
          La Carrera Fue Editada con Exito
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal delete carrera-->
  <div class="modal fade" id="eliminar_carrera" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar Carrera</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
<form id="form-delete-carr" method="POST" action="{{url('/delete_carrera')}}">
            @csrf
<div class="modal-body">
 <div class="card-body secciones_body" style="text-align: center; font-size: 20px">

<label>Esta Completamente seguro de eliminar La Carrera:</label><br>
<label id="labelDC"></label><br>
<label for="">Que corresponde a la Institucion:</label><br>
<label id="labelDI"></label><br>
<label style="color: red">Esta accion no es reversible</label>

</div>
</div>
        <div class="modal-footer">
            <input type="hidden" name="id_carre" id="id_carre2">
          <button class="btn btn-success" id="btnDeleteCarr">Eliminar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- Modal aviso delete carrera-->
<div class="modal fade" id="AvisoDeleteCarr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
          La Carrera Fue Eliminada con Exito
        </div>
        <div class="modal-footer">
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
        margin-bottom: 15px;
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

//FUNCION PARA MOSTRAR LA TABLA AL ENTRAR
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
success: function(escuelas,carreras){
$('#tabla-cat-carr').empty().html(escuelas,carreras);
}
});

});

//FUNCION PARA RECARGAR TABLA

function tableRE(){
    $.ajax({
type:'get',
url:"{{ url('/view_cat_carrerasJax') }}",
success: function(escuelas,carreras){
$('#tabla-cat-carr').empty().html(escuelas,carreras);
}
 });
}

 //Campos dinamicos de materias
 $(function () {
    var i = 0;
    $('#mascarreras').click(function (e) {
      e.preventDefault();
        i++;
$('#carrerasD').append('<div class="row dinamic-row" id="newRow'+i+'">'

+'<div class="col-md-4">'
+'<label for="">Institucion</label>'
+'<select name="escuelaD[]" id="select_carreraD[]" class="form-control">'
+'@foreach ($escuelas as $escuela)'
+'<option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>'
+'@endforeach'
+'</select>'
+'</div>'


+'<div class="col-md-4" >'
+'<label for="Materias">Carrera</label>'
+'<input type="text" class="form-control" id="carreraD[]" name="carreraD[]" onkeyup="this.value = this.value.toUpperCase();" required>'
+'</div>'

+'<div class="col-md-3">'
+'<label for="">Clave</label>'
+'<input type="text" class="form-control" id="claveD[]" name="claveD[]" onkeyup="this.value = this.value.toUpperCase();" required>'
+'</div>'

+'<div class="col-md-1">'
+'<label style="visibility: hidden">--</label>'
+'<button type="button" class="removeCar btn btn-danger form-control" id="'+i+'">-</button>'
+'</div>'
+'</div>'

        );
    });

     $(document).on('click', '.removeCar', function(e) {
       e.preventDefault();
        var id = $(this).attr("id");
         $('#newRow'+id+'').remove();
      });

  });

//FUNCION PARA AGREGAR carrera
$(document).ready(function() {

$("#btnSaveCarr").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-new-carre")[0]);

     $.ajax({
        url:"{{url('/save_carreras')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#AgregarCarrera').modal('hide');
            tableRE();
            $("#form-new-carre")[0].reset();
            $('.dinamic-row').remove();
            $('#AvisoSaveCarr').modal('show');


        }, error:function (response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo O intentalo de nuevo");
        }

    });
});
});

function valCarr(){
    var escu=document.getElementById("select_carrera").value;
    var carr=document.getElementById("carrera").value;
    var cla=document.getElementById("clave").value;

if(escu && carr && cla){
    document.getElementById('btnSaveCarr').disabled=false;
}else{
    document.getElementById('btnSaveCarr').disabled=true;
}
}

var id_carre=null;
function tomar_id($id_tr){
    id_carre=$id_tr;
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

function carrera_edit(){
    $.ajax({
    url: "{{url('/search_carrera')}}"+'/'+id_carre,
  dataType: "json",
  //context: document.body
}).done(function([carreras,escuelas,escuelas2]) {
  if(carreras==null){
document.getElementById("carreraE").value=null;
document.getElementById("claveE").value=null;
document.getElementById("id_carre").value=null;
  }else{
document.getElementById("carreraE").value=carreras.nombre;
document.getElementById("claveE").value=carreras.clave;
document.getElementById("id_carre").value=carreras.id;

$("#select_carreraE").empty();
                for (var i = 0; i <escuelas2.length; i++) {
                    $("#select_carreraE").append('<option value="'+escuelas2[i].id+'">'+escuelas2[i].nombre+'</option>');
                }
$('#select_carreraE').append('<option selected value="' + escuelas.id + '">' + escuelas.nombre + '</option>');

  }
});
}

//FUNCION PARA Editar carrera
$(document).ready(function() {

$("#btnUpdateCarr").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-update-carre")[0]);

     $.ajax({
        url:"{{url('/update_carrera')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#editar_carrera').modal('hide');
            tableRE();
            $("#form-update-carre")[0].reset();
            $('#AvisoUpdateCarr').modal('show');


        }, error:function (response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo O intentalo de nuevo");
        }

    });
});
});

function carrera_delete(){
    $.ajax({
    url: "{{url('/search_carrera')}}"+'/'+id_carre,
  dataType: "json",
  //context: document.body
}).done(function([carreras,escuelas,escuelas2]) {
  if(carreras==null){
document.getElementById("labelDC").innerHTML="";
document.getElementById("labelDI").innerHTML="";
document.getElementById("id_carre2").value=null;
  }else{
document.getElementById("labelDC").innerHTML=carreras.nombre;
document.getElementById("labelDI").innerHTML=escuelas.nombre;
document.getElementById("id_carre2").value=carreras.id;

  }
});
}

//FUNCION PARA Elimnar carrera
$(document).ready(function() {

$("#btnDeleteCarr").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-delete-carr")[0]);

     $.ajax({
        url:"{{url('/delete_carrera')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#eliminar_carrera').modal('hide');
            tableRE();
            $("#form-delete-carr")[0].reset();
            $('#AvisoDeleteCarr').modal('show');


        }, error:function (response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo O intentalo de nuevo");
        }

    });
});
});

</script>

@stop
