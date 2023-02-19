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

@if(Session::get('tipo')== "agregado")
    <div class="alert alert-{{ Session::get('color') }}" role="alert" style="font-weight: bold; margin-bottom: 45px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
          <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
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

<div class="row justify-content-md-center" style="margin-bottom: 15px">
<div class="col-xl-12">
<button class="btn btn-success form-control" data-toggle="modal" data-target="#modal_horario">Cargar Horario</button>
</div>
</div>

<div class="card-body secciones_body2" style=" text-align: left;">
<div class="table-responsive">
<div id="table-materias"></div>

</div>

<!-- Modal subir horario-->
<div class="modal fade" id="modal_horario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="secciones_body3">

@if($horarios!=null) <!-- segunda vez vez subiendo el horario-->
<form action="{{ url('/update_horario') }}" method="POST" enctype="multipart/form-data">
@csrf
   <div class="row">
    <div class="col-md-12">
        <label for="">Seleccione el Archivo de horarios</label>
        <input type="file" name="horario" id="horario2" class="form-control input_edit archivo" onchange="cambio_horario(this); valiHora();">
        <label id="button_horario2" for="horario2" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>
    </div>
</div>
<div class="d-flex justify-content-end" style="padding: 10px">
    <input type="hidden" name="id_horarioE" value="{{ $horarios->id }}">
    <label for="">El usuario {{ $horarios->usuario_h }} ya subio un horario anteriormente y al subir otro horario solo remplazaria su archivo</label>
    <button class="btn btn-primary" id="btnsavehorario2" disabled>Aceptar</button>
</div>
</form>

    @else <!-- primera vez subiendo el horario-->
<form action="{{ url('/save_horario') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
    <div class="col-md-12">
        <label for="">Seleccione el Archivo de horarios</label>
        <input type="file" name="horario" id="horario2" class="form-control input_edit archivo" onchange="cambio_horario(this); valiHora();">
        <label id="button_horario2" for="horario2" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>
    </div>
</div>
    <div class="d-flex justify-content-end" style="padding: 10px">
    <button class="btn btn-primary" id="btnsavehorario2" disabled>Aceptar</button>
    </div>
</form>

    @endif

        </div>
      </div>
    </div>
  </div>



<!-- Modal agregar materia-->
<div class="modal fade" id="agregarMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h3>Agregar Materias</h3>
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
<p style="font-size: 18px">A continuacion agregaras el semestre y las materias que corresponden a este Junto con su clave y creditos de la misma. El boton con el signo "+"
   te permite agregar una materia, agrega solo las que contiene el semestre, si agregas de mas, el boton con el signo "-" la eliminara.
</p>
</div>
<div class="col-md-2">
    <center><img src="{{ url('icons/M1.png') }}" alt="" style="width: 70%; height: auto;"></center>
</div>
          </div>
<hr style="background-color: white">
<br>
<div class="row">
    <div class="col-md-2">
<label for="SEMESTRE">Semestre Numero</label>
</div>
<div class="col-md-2">
    <input type="number" id="semestre" class="form-control" name="semestre" min="1" pattern="^[0-9]+" onkeyup="valMate();">
</div>

</div>
<br>

<div class="row">
<div class="col-md-3">
<label for="Materias">Materias</label>
<input type="text" class="form-control" id="materias" name="materias" placeholder="MATERIA" onkeyup="this.value = this.value.toUpperCase(); valMate();">
</div>
<div class="col-md-3">
<label for="" style="visibility: hidden">--</label>
<input type="text" class="form-control" id="clave" name="clave" placeholder="CLAVE" onkeyup="this.value = this.value.toUpperCase(); valMate();">
</div>
<div class="col-md-2">
<label for="" style="visibility: hidden">--</label>
<input type="number" class="form-control" name="creditos" id="creditos" placeholder="CREDITOS" onkeyup="valMate();">
</div>
<div class="col-md-3">
<label for="" style="visibility: hidden">--</label>

<input type="file" name="temario" id="foto_archivo2" class="form-control input_edit archivo" onchange="cambio_foto(this); valMate();">
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

    <!--menu de opciones de la tabla-->
    <div id="menu_opciones" class="visible_off " style=" padding: 15px; background-color: #193333;">

        <button type="button" class="close" style="margin-right: -5px; margin-top: -15px; margin-bottom: 10px" onclick="cerrar_menu();">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
              </svg>
        </button>

        <button class="btn marca" style="color:white" data-toggle="modal" data-target="#editar_materia" onclick="materia_edit();">
            Editar
          </button>
          <br>
        <button class="btn marca" style="color:white" data-toggle="modal" data-target="#eliminar_materia" onclick="materia_delete();">
            Eliminar
          </button>
          <br>
    </div>


<!-- Modal Editar materia-->
<div class="modal fade" id="editar_materia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h3>Editar Materia</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <form id="form-update-materia" action="{{ url('/update_materia') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="secciones_body3">
            <div class="row">
                <div class="col-md-10">
                <p style="font-size: 20px">A continuacion Editaras el semestre y las materias que corresponden a este Junto con su clave y creditos de la misma.
                </p>
                </div>
                <div class="col-md-2">
                    <center><img src="{{ url('icons/M1.png') }}" alt="" style="width: 70%; height: auto;"></center>
                </div>
            </div>
            <hr style="background-color: white">
<br>

                <div class="row">
                    <div class="col-md-2">
                <label for="SEMESTRE">Semestre Numero</label>
                </div>
                <div class="col-md-2">
                    <input type="number" id="semestre2" class="form-control" name="semestre" min="1" pattern="^[0-9]+">
                </div>
                </div>
                <br>

                <div class="row">
                <div class="col-md-3">
                <label for="Materias">Materias</label>
                <input type="text" class="form-control" id="materias2" name="materias" placeholder="MATERIA" onkeyup="this.value = this.value.toUpperCase();" >
                </div>
                <div class="col-md-3">
                <label for="" style="visibility: hidden">--</label>
                <input type="text" class="form-control" id="clave2" name="clave" placeholder="CLAVE" onkeyup="this.value = this.value.toUpperCase();">
                </div>
                <div class="col-md-2">
                <label for="" style="visibility: hidden">--</label>
                <input type="number" class="form-control" name="creditos" id="creditos2" placeholder="CREDITOS">
                </div>
                <div class="col-md-3">
                <label for="" style="visibility: hidden">--</label>

                <input type="file" name="temario" id="foto_archivo22" class="form-control input_edit archivo" onchange="editar_archivo(this)"; >
                <label id="button_file22" for="foto_archivo22" class="form-control boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario</label>

                </div>
                </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id_updatemat" id="id_updatemat">
            <label for="">Para Finalizar presiona el boton de Editar</label>
            <button class="btn btn-success" id="btneditmat2"><img src="{{ url('icons/C0.png') }}" style="width: 25px; height: auto;"></button>
        </div>
      </div>
    </form>
    </div>
  </div>


<!-- Modal Eliminar materia-->
<div class="modal fade" id="eliminar_materia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #193333;">
            <h3>Eliminar Materia</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16" style="color: #fff;">
                  <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
        </div>
        <div class="secciones_body3">
          <div style="text-align: center; font-size: 25px">
          <label>Estas seguro de Eliminar la materia</label><br>
          <label for="" id="labelconfma"></label><br>
          <label for="" id="labelclavee"></label><br>
          <label for="" style="color:red">Esta accion no es reversible</label>
           </div>
        </div>
        <div class="modal-footer">
        <form id="form-delete-mate" action="{{ url('/delete_materia') }}" method="POST">
            @csrf
            <input type="hidden" name="id_matDELE" id="id_matDELE">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="btndelemate">Continuar</button>
        </form>
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
        margin-bottom: 15px;
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

  //agregar temario PDF

function editar_archivo(file){
    var url_img=null;
    if (file.files[0]!=null){
        if(file.value.split('.').pop()=="pdf"){
          document.getElementById("button_file22").innerHTML=file.value;
        }else{

            document.getElementById("button_file22").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            alert("EL ARCHIVO NO ES ACEPTADO");
            file.value=null;

        }
    }else{
        document.getElementById("button_file22").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
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
            jQuery.noConflict();
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


//funcion para validar primeros datos
function valMate(){
    let semnue=document.getElementById("semestre").value;
    let mate=document.getElementById("materias").value;
    let cla=document.getElementById("clave").value;
    let cred=document.getElementById("creditos").value;
    let tema=document.getElementById("foto_archivo2").value;

if(semnue && mate && cla && cred && tema){
    document.getElementById('btnsavemat').disabled=false;
}else{
    document.getElementById('btnsavemat').disabled=true;
}

}

//funcione para mostrar cuadro de opciones

var id_mate=null;
    function tomar_id($id_tr) {
        id_mate=$id_tr;
        var coordenadas_y=event.clientY; //odtenemos el valor de la posicion del boton
        var coordenadas_x=event.clientX; //odtenemos el valor de la posicion del boton
        menu_opciones.style.top=coordenadas_y-15+"px";
        menu_opciones.style.left=coordenadas_x-15+"px";
        menu_opciones.classList.add("visible_on");
        menu_opciones.classList.remove("visible_off");
      //alert($id_tr);
    }
    menu_opciones.addEventListener("mouseleave",function(){
          menu_opciones.classList.remove("visible_on");
          menu_opciones.classList.add("visible_off");
    });
    function cerrar_menu(){
        menu_opciones.classList.remove("visible_on");
        menu_opciones.classList.add("visible_off");
    }

//funciones eliminar la materia

function materia_delete(){

    $.ajax({
  url: "{{url('/search_mate')}}"+'/'+id_mate,
  dataType: "json",
  //context: document.body
}).done(function(materia) {
  if(materia==null){
document.getElementById('labelconfma').innerHTML=null;
document.getElementById('labelclavee').innerHTML=null;
document.getElementById('id_matDELE').value=null;

  }else{
document.getElementById('labelconfma').innerHTML=materia.nombre;
document.getElementById('labelclavee').innerHTML="con la matricula: "+materia.matricula;
document.getElementById('id_matDELE').value=materia.id;
  }
});
}

//ajax para eliminar materias
$(document).ready(function() {

$("#btndelemate").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-delete-mate")[0]);

     $.ajax({
        url:"{{url('/delete_materia')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(response){
            jQuery.noConflict();
            $('#eliminar_materia').modal('hide');
            $("#form-delete-mate")[0].reset();
            tableRE();

        }, error:function (response){
            jQuery.noConflict();
            $('#eliminar_materia').modal('hide');
            alert("Ocurrio un Problema y no se elimino intentalo de nuevo");

        }
    });
});
});

//funciones para editar materia
function materia_edit(){

    $.ajax({
  url: "{{url('/search_mate')}}"+'/'+id_mate,
  dataType: "json",
  //context: document.body
}).done(function(materia) {
  if(materia==null){
document.getElementById('semestre2').value=null;
document.getElementById('materias2').value=null;
document.getElementById('clave2').value=null;
document.getElementById('creditos2').value=null;
document.getElementById('id_updatemat').value=null;
document.getElementById('button_file22').innerHTML=null;

  }else{
document.getElementById('semestre2').value=materia.semestre;
document.getElementById('materias2').value=materia.nombre;
document.getElementById('clave2').value=materia.matricula;
document.getElementById('creditos2').value=materia.creditos;
document.getElementById('id_updatemat').value=materia.id;
document.getElementById('button_file22').innerHTML=materia.temario;

  }
});

}

//ajax para editar materias
$(document).ready(function() {

$("#btneditmat2").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-update-materia")[0]);

     $.ajax({
        url:"{{url('/update_materia')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(response){
            jQuery.noConflict();
            $('#editar_materia').modal('hide');
            tableRE();

        }, error:function (response){
            jQuery.noConflict();
            $('#editar_materia').modal('hide');
            alert("Ocurrio un Problema y no se edito intentalo de nuevo");

        }
    });
});
});

//agregar horario PDF

function cambio_horario(file){
    var url_img=null;
    if (file.files[0]!=null){
        if(file.value.split('.').pop()=="pdf"){
          document.getElementById("button_horario2").innerHTML=file.value;
        }else{

            document.getElementById("button_horario2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
            alert("EL ARCHIVO NO ES ACEPTADO");
            file.value=null;

        }
    }else{
        document.getElementById("button_horario2").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707L6.354 9.854z"/></svg>  &#160;&#160;Subir Temario';
        file.value=null;
    }
  }

  function valiHora(){

    let hora=document.getElementById("horario2").value;

if(hora){
    document.getElementById('btnsavehorario2').disabled=false;
}else{
    document.getElementById('btnsavehorario2').disabled=true;
}

}

    //jquery para desvanecer el mensage
    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
});
</script>

@stop
