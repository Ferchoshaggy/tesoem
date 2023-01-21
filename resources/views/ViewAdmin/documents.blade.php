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
        <div class="col align-self-start">
<label for="" style="font-size:30px">Aprobación de Documentos.</label>
    </div>
</div>

<div class="row">
    <div class="col align-self-start">
<p>Da clic sobre alguno de los registros para ver la diferentes opciones</p>
</div>
</div>

</div>

<div class="card-body secciones_body" style=" text-align: left;">
<div class="table-responsive">
    <table class="table" style="width: 100%">
        <thead>
          <tr>
            <th style="text-align: center;">Semestre</th>
            <th style="text-align: center;">Grupo</th>
            <th style="text-align: center;">Nombre</th>
            <th style="text-align: center;">Estatus</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: center;">1</td>
            <td style="text-align: center;">3s11</td>
            <td style="text-align: center;">pablito ruiz</td>
            <td style="text-align: center;">pendiente</td>
          </tr>
        </tbody>
      </table>
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
