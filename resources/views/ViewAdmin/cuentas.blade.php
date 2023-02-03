@extends('adminlte::page')

@section('title', 'Cuentas')

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
<label for="" style="font-size:30px">Cuentas</label>
<p>En este apartado podras editar o eliminar las cuentas de los alumnos registrados en la carrera que administras.</p>
<p>Has clic en alguno de los registros para ver las opciones</p>
    </div>
    <div class="col-md-2">
<center><img src="{{ url('icons/C1.png') }}" alt="" style="width: 75%; height: auto;"></center>
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
          <tr onclick="tomar_id()" data-toggle="modal" data-target="#ConfigUser">
            <td style="text-align: center;">2</td>
            <td style="text-align: center;">Chapulinear a la ruca de tu compa</td>
            <td style="text-align: center;">69XXX</td>
            <td style="text-align: center;">5</td>
          </tr>
        </tbody>
      </table>
</div>

<!-- Modal Usuarios-->
<div class="modal fade" id="ConfigUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Datos de la cuenta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          A continuacion se muestran los datosde la cuentapuede editar los datos rescribiendo los campos y guardando los cambios o eliminar la cuenta en casode ser necesario.
         <br><br>
         <div class="row">
<div class="col-md-2">
    <div class="card-body secciones_body">
     <center><img src="{{ url('img/C4.jpg') }}" alt="foto" id="fotoP"></center>
    </div>
</div>
<div class="col-md-10">
    <div class="card-body secciones_body">

<div class="row">

<div class="col-md-4">
<label for="">Matricula</label>
<input type="number" class="form-control" id="matricula" name="matricula">
</div>

<div class="col-md-4">
<label for="">Nombre</label>
<input type="text" class="form-control" id="nombre" name="nombre">
</div>

<div class="col-md-4">
    <label for="">Correo</label>
    <input type="email" class="form-control" id="correo" name="correo">
    </div>

</div>

<div class="row">

    <div class="col-md-4">
    <label for="">Cambiar Contraseña</label>
    <input type="password" class="form-control" id="contraseña" name="contraseña">
    </div>

    <div class="col-md-4">
    <label for="">Confirmar contraseña</label>
    <input type="password" class="form-control" id="contraseña2" name="contraseña2">
    </div>

    </div>

    </div>
</div>
         </div>


        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-toggle="modal" data-target="#avisoEliminar">Eliminar Cuenta</button>
          <button class="btn btn-success">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Aviso-->
<div class="modal fade" id="avisoEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border:1px solid white">
        <div class="modal-body">
          Esta Completamente seguro de eliminar esta cuenta, una vez eliminado no habra manera de recuperarla y esto obligara de ser
          necesario a realizar todo el proceso de esta cuenta desde cero. de clic en continuar para eliminar la cuenta definitivamente o
          en cancelar para salir del proceso de eliminacion.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn" style="color:white">Continuar</button>
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
#fotoP{
     /* cambia estos dos valores para definir el tamaño de tu círculo */
     height: 140px;
    width: 140px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    background-size: 100% auto;
    align-content: center;
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
var id_user=null;

function tomar_id(){
console.log("1");
}

</script>


@stop
