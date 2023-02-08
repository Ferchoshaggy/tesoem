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
        <div class="col-md-10">
<label for="" style="font-size:30px">Aprobación de Documentos.</label>
<p>Da clic sobre alguno de los registros para ver la diferentes opciones</p>
    </div>
    <div class="col-md-2">
<img src="{{ url('icons/D4.png') }}" alt="" style="width: 55%; height: 100%;">
    </div>
</div>

</div>

<div class="card-body secciones_body2" style=" text-align: left;">
<div class="table-responsive">
<div id="table-document"></div>

</div>

<!-- Modal Aprobacion documento-->
<div class="modal fade" id="aprobarDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="secciones_body3">
        <Label style="font-size: 25px">Aprobacion de Documentos</Label>
        <p style="font-size: 16px">A continuacion estan las opciones para cada documento del alumno seleccionado para la aprobacion de su documentacion, la cual una vez
            aprobada podra acceder al paso 2
        </p>
<div class="row">

<div class="col-md-6">
<img src="{{ url('icons/D1.png') }}"  style="width: 15%; height: auto; margin-right: 20px" id="img-ha">
Historial academico
</div>

<div class="col-md-2">
<button class="btn btn-success btn2" data-toggle="modal" data-target="#HistorialDoc">Ver Documento</button>
</div>

<div class="col-md-2">
<button class="btn btn-success btn2" id="AproHistorial" data-toggle="modal" data-target="#MAprobarHA">Aprobar</button>
</div>

<div class="col-md-2">
<button class="btn btn-success btn2" data-toggle="modal" data-target="#CancelarDocH" id="btnRechazarH">Rechazar</button>
</div>

</div>
<br>
<div class="row">

    <div class="col-md-6">
    <img src="{{ url('icons/D3.png') }}"  style="width: 15%; height: auto; margin-right: 20px" id="img-cp">
    Comprobante de pago
    </div>

    <div class="col-md-2">
    <button class="btn btn-success btn2" data-toggle="modal" data-target="#ComprobanteDoc">Ver Documento</button>
    </div>

    <div class="col-md-2">
    <button class="btn btn-success btn2" id="AproComprobante" data-toggle="modal" data-target="#MAprobarCP">Aprobar</button>
    </div>

    <div class="col-md-2">
    <button class="btn btn-success btn2" data-toggle="modal" data-target="#CancelarDocP" id="btnRechazarP">Rechazar</button>
    </div>

    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button class="btn" id="aprobarDoc" style="color: white" disabled  data-toggle="modal" data-target="#MFinalizando">Terminar Tramite</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cancelar historial-->
<div class="modal fade" id="CancelarDocH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="secciones_body3">
<div class="row">
<div class="col-md-10">
<label for="" style="font-size: 25px">Motivos de Rechazo para el archivo Historial Academico</label>
</div>
<div class="col-md-2">
    <img src="{{ url('icons/D4.png') }}" style="width: 50%; height: 100%;">
</div>
</div>
<br>
<form id="form-HA-rechazado" action="{{ url("/HArechazado") }}" method="POST">
    @csrf
<textarea name="rechazoH" id="rechazoH" class="form-control" rows="10" style="border-radius: 10px;" onkeyup="rechazadoHA();"></textarea>
<br>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id_ha" id="id_ha">
            <input type="hidden" name="id_ha_pa" id="id_ha_pa">
          <button type="button" class="btn" style="color: white" id="rechazarDocHA" disabled>Rechazar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal Cancelar Comprobante-->
<div class="modal fade" id="CancelarDocP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="secciones_body3">
<div class="row">
<div class="col-md-10">
<label for="" style="font-size: 25px">Motivos de Rechazo para el archivo Comprobante de pago</label>
</div>
<div class="col-md-2">
    <img src="{{ url('icons/D4.png') }}" style="width: 50%; height: 100%;">
</div>
</div>
<br>
<form id="form-CP-rechazado" action="{{ url("/CPrechazado") }}" method="POST">
    @csrf
<textarea name="rechazoP" id="rechazoP" class="form-control" rows="10" style="border-radius: 10px;" onkeyup="rechazadoCP();"></textarea>
<br>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id_cp" id="id_cp">
            <input type="hidden" name="id_cp_pa" id="id_cp_pa">
          <button type="button" class="btn" style="color: white" id="rechazarDocCP" disabled>Rechazar</button>
        </div>
    </form>
      </div>
    </div>
  </div>


<!-- Modal historial-->
<div class="modal fade" id="HistorialDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="secciones_body3">

<embed id="embH" type="application/pdf" style="width:100%; height: 600px;">


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Comprobante-->
<div class="modal fade" id="ComprobanteDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="secciones_body3">

            <embed id="embC" type="application/pdf" style="width:100%; height: 600px;">

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal aviso aprobar historial-->
  <div class="modal fade" id="MAprobarHA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
<label style="font-size: 20px">
Esta Seguro de aprobar el Historial Academico, esta accion no podra ser cambiada
</label>
        </div>
        <form id="form-HA-aprobar" action="{{ url("/HAaceptado") }}" method="POST">
            @csrf
        <div class="modal-footer">
            <input type="hidden" name="id_ha2" id="id_ha2">
            <input type="hidden" name="id_user2" id="id_user2">
        <button type="button" class="btn btn-success" id="btnAprovarHA">Aceptar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- Modal aviso aprobar comprobante-->
  <div class="modal fade" id="MAprobarCP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
<label style="font-size: 20px">
Esta Seguro de aprobar el Comprobante de Pago, esta accion no podra ser cambiada
</label>
        </div>
        <form id="form-CP-aprobar" action="{{ url('/CPaceptado') }}" method="POST">
            @csrf
        <div class="modal-footer">
            <input type="hidden" name="id_cp2" id="id_cp2">
            <input type="hidden" name="id_user3" id="id_user3">
        <button type="button" class="btn btn-success" id="btnAprovarCP">Aceptar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- Modal final de tramite-->
  <div class="modal fade" id="MFinalizando" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
<label style="font-size: 20px">
Esta accion implica que estara aprobando el tramite lo cual dara al alumno de manera automatica acceso al siguiente paso.
</label>
        </div>
        <form id="form-fin-tramite" action="{{ url('/finalizarDoc') }}" method="POST">
            @csrf
        <div class="modal-footer">
            <input type="hidden" name="id_pa_f" id="id_pa_f">
        <button type="button" class="btn" id="btnFinalizado" style="color: white">Continuar</button>
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

.btn2{
  width: 100%;
  height: auto;
  /* centrado vertical */
  position: inherit;
  top: 25%;
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
$('#table-document').empty().html(carreras,usuarios);
}
});

});

//FUNCION PARA RECARGAR TABLA
var tableRE = function(){
    $.ajax({
type:'get',
url:"{{ url('/ADocumentosJax') }}",
success: function(carreras,usuarios){
$('#table-document').empty().html(carreras,usuarios);
}
 });
}

//FUNCION PARA BUSCAR DATOS DEL USUARIO A EDITAR
var id_user=null;

function tomar_id($id_tr){
    id_user=$id_tr;

    $.ajax({
    url: "{{url('/search_doc')}}"+'/'+id_user,
  dataType: "json",
  //context: document.body
}).done(function([datosUser,procesos,comprobante,historial]) {
  if([datosUser==null]){
    jQuery.noConflict();
    document.getElementById('id_cp').value=comprobante.id;
    document.getElementById('id_cp_pa').value=procesos.id;

    document.getElementById('id_ha').value=historial.id;
    document.getElementById('id_ha_pa').value=procesos.id;

    document.getElementById('id_ha2').value=historial.id;
    document.getElementById('id_cp2').value=comprobante.id;

    document.getElementById('id_pa_f').value=procesos.id;

    document.getElementById('id_user2').value=datosUser.id;
    document.getElementById('id_user3').value=datosUser.id;

document.querySelector('#embH').setAttribute('src',"{{ url('/documents_h_academico') }}"+"/"+historial.ruta);
document.querySelector('#embC').setAttribute('src',"{{ url('/documents_c_pago/') }}"+"/"+comprobante.ruta);

if(historial.estatus==3){
    document.getElementById("img-ha").src="{{url('icons/D14.png')}}";
    document.getElementById("AproHistorial").disabled=true;
    document.getElementById("btnRechazarH").disabled=true;
}else if(historial.estatus==5){
    document.getElementById("img-ha").src="{{url('icons/D5.png')}}";
    document.getElementById("AproHistorial").disabled=true;
    document.getElementById("btnRechazarH").disabled=true;
}

if(comprobante.estatus==3){
    document.getElementById("img-cp").src="{{url('icons/D12.png')}}";
    document.getElementById("AproComprobante").disabled=true;
    document.getElementById("btnRechazarP").disabled=true;
}else if(comprobante.estatus==5){
    document.getElementById("img-cp").src="{{url('icons/D8.png')}}";
    document.getElementById("AproComprobante").disabled=true;
    document.getElementById("btnRechazarP").disabled=true;
}

if(comprobante.estatus==5 && historial.estatus==5){
    document.getElementById("aprobarDoc").disabled=false;
}else{
    document.getElementById("aprobarDoc").disabled=true;
}

if(procesos.estatus==5){
    document.getElementById("aprobarDoc").disabled=true;
}

  }else{

  }
});
}

function rechazadoCP(){
    var c=document.getElementById("rechazoP").value;
if(c){
    document.getElementById('rechazarDocCP').disabled=false;
}else{
    document.getElementById('rechazarDocCP').disabled=true;
}
}

function rechazadoHA(){
var h=document.getElementById("rechazoH").value;
if(h){
    document.getElementById('rechazarDocHA').disabled=false;
}else{
    document.getElementById('rechazarDocHA').disabled=true;
}
}

//ajax cancelar Historial

$(document).ready(function() {

$("#rechazarDocHA").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-HA-rechazado")[0]);

     $.ajax({
      url:"{{url('/HArechazado')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            document.getElementById("img-ha").src="{{url('icons/D14.png')}}";
            document.getElementById("AproHistorial").disabled=true;
            document.getElementById("btnRechazarH").disabled=true;
            $('#CancelarDocH').modal('hide');
            tableRE();
            $("#form-HA-rechazado")[0].reset();
        },
        error:function (Response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});

//ajax cancelar comprobante

$(document).ready(function() {

$("#rechazarDocCP").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-CP-rechazado")[0]);

     $.ajax({
      url:"{{url('/CPrechazado')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            document.getElementById("img-cp").src="{{url('icons/D12.png')}}";
            document.getElementById("AproComprobante").disabled=true;
            document.getElementById("btnRechazarP").disabled=true;
            $('#CancelarDocP').modal('hide');
            tableRE();
            $("#form-HA-rechazado")[0].reset();
        },
        error:function (Response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});

//ajax aprobar Historial

$(document).ready(function() {

$("#btnAprovarHA").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-HA-aprobar")[0]);

     $.ajax({
      url:"{{url('/HAaceptado')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function([comprobante,historial]){
            jQuery.noConflict();
            document.getElementById("img-ha").src="{{url('icons/D5.png')}}";
            document.getElementById("AproHistorial").disabled=true;
            document.getElementById("btnRechazarH").disabled=true;
            if(comprobante.estatus==5 && historial.estatus==5){
    document.getElementById("aprobarDoc").disabled=false;
}else{
    document.getElementById("aprobarDoc").disabled=true;
}
            $('#MAprobarHA').modal('hide');
            tableRE();
            $("#form-HA-aprobar")[0].reset();


        },
        error:function (Response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});

//ajax aprobar comprobante

$(document).ready(function() {

$("#btnAprovarCP").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-CP-aprobar")[0]);

     $.ajax({
      url:"{{url('/CPaceptado')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function([comprobante,historial]){
            jQuery.noConflict();
            document.getElementById("img-cp").src="{{url('icons/D8.png')}}";
            document.getElementById("AproComprobante").disabled=true;
            document.getElementById("btnRechazarP").disabled=true;
            if(comprobante.estatus==5 && historial.estatus==5){
    document.getElementById("aprobarDoc").disabled=false;
}else{
    document.getElementById("aprobarDoc").disabled=true;
}
            $('#MAprobarCP').modal('hide');
            tableRE();
            $("#form-CP-aprobar")[0].reset();
        },
        error:function (Response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});

//ajax finalizar tramite

$(document).ready(function() {

$("#btnFinalizado").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-fin-tramite")[0]);

     $.ajax({
      url:"{{url('/finalizarDoc')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#MFinalizando').modal('hide');
            $('#aprobarDocumento').modal('hide');
            tableRE();
            $("#form-fin-tramite")[0].reset();
        },
        error:function (Response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});


</script>


@stop
