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
    <table class="table" style="width: 100%">
        <thead>
          <tr>
            <th style="text-align: center;">Carrera</th>
            <th style="text-align: center;">Semestre</th>
            <th style="text-align: center;">Grupo</th>
            <th style="text-align: center;">Nombre</th>
            <th style="text-align: center;">Estatus</th>
          </tr>
        </thead>
        <tbody>
          <tr onclick="tomar_id()" style="background-color: rgb(49, 146, 238)" data-toggle="modal" data-target="#aprobarDocumento">
            <td style="text-align: center;">Pica culos</td>
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">3s11</td>
            <td style="text-align: center;">pablito ruiz</td>
            <td style="text-align: center;">pendiente</td>
          </tr>
        </tbody>
      </table>
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
<img src="{{ url('icons/D1.png') }}"  style="width: 15%; height: auto; margin-right: 20px">
Historial academico
</div>

<div class="col-md-2">
<button class="btn btn-success btn2">Ver Documento</button>
</div>

<div class="col-md-2">
<button class="btn btn-success btn2">Aprobar</button>
</div>

<div class="col-md-2">
<button class="btn btn-success btn2" data-toggle="modal" data-target="#CancelarDoc">Rechazar</button>
</div>

</div>
<br>
<div class="row">

    <div class="col-md-6">
    <img src="{{ url('icons/D3.png') }}"  style="width: 15%; height: auto; margin-right: 20px">
    Comprobante de pago
    </div>

    <div class="col-md-2">
    <button class="btn btn-success btn2">Ver Documento</button>
    </div>

    <div class="col-md-2">
    <button class="btn btn-success btn2">Aprobar</button>
    </div>

    <div class="col-md-2">
    <button class="btn btn-success btn2" data-toggle="modal" data-target="#CancelarDoc">Rechazar</button>
    </div>

    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button class="btn" id="aprobarDoc" style="color: white" disabled>Terminar Tramite</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cancelar-->
<div class="modal fade" id="CancelarDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="secciones_body3">
<div class="row">
<div class="col-md-10">
<label for="" style="font-size: 25px">Motivos de Rechazo para el archivo</label>
</div>
<div class="col-md-2">
    <img src="{{ url('icons/D4.png') }}" style="width: 50%; height: 100%;">
</div>
</div>
<br>
<textarea name="rechazo" id="rechazo" class="form-control" rows="10" style="border-radius: 10px;"></textarea>
<br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" style="color: white" id="rechazarDoc" disabled>Rechazar</button>
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

@stop
