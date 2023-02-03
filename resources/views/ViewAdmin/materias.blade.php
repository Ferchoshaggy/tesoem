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
    <table class="table" style="width: 100%">
        <thead>
          <tr>
            <th style="text-align: center;">Semestre</th>
            <th style="text-align: center;">Materia</th>
            <th style="text-align: center;">Clave</th>
            <th style="text-align: center;">Creditos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">Chapulinear a la ruca de tu compa</td>
            <td style="text-align: center;">69XXX</td>
            <td style="text-align: center;">5</td>
          </tr>
        </tbody>
      </table>
      <div class="text-right" style="margin:10px 0 10px 0">
        <button class="btn btn-success" style="" data-toggle="modal" data-target="#agregarMateria">Agregar</button>
      </div>

</div>

<!-- Modal agregar materia-->
<div class="modal fade" id="agregarMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="secciones_body3">
          <div class="row">
<div class="col-md-10">
<label for="" style="font-size: 25px">Agregar Materias</label>
<p style="font-size: 15px">A continuacion agregaras el semestre y las materias que corresponden a este Junyo con su clave y creditos de la misma. El boton con el signo "+"
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
<div class="col-md-6">
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
<div class="col-md-1">
<label for="" style="visibility: hidden">--</label>
<button class="btn btn-success form-control" id="agregarmat">+</button>
</div>
</div>

<div id="masmaterias"></div>

        </div>
        <div class="modal-footer">
           <label for="">Para Finalizar presiona el boton de guardar</label>
          <button class="btn btn-success"><img src="{{ url('icons/C0.png') }}" style="width: 25px; height: auto;"></button>
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
+'<div class="col-md-6" >'
+'<label for="Materias">Materias</label>'
+'<input type="text" class="form-control" id="materias[]" name="materias[]" placeholder="MATERIA">'
+'</div>'
+'<div class="col-md-3">'
+'<label for="Materias">Materias</label>'
+'<input type="text" class="form-control" id="clave[]" name="clave[]" placeholder="CLAVE">'
+'</div>'
+'<div class="col-md-2">'
+'<label style="visibility: hidden">--</label>'
+'<input type="number" class="form-control" name="creditos[]" id="creditos[]" placeholder="CREDITOS">'
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

</script>

@stop
