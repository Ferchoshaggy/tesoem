@extends('adminlte::page')

@section('title', 'Cuentas')

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
<div id="tabla-reload"></div>

</div>

<!-- Modal Usuarios-->
<div class="modal fade" id="ConfigUser" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Datos de la cuenta</h5>
        </div>
<form id="form-user" method="POST" action="{{url('/cambios_user')}}">
            @csrf
        <div class="modal-body">
          A continuacion se muestran los datosde la cuentapuede editar los datos rescribiendo los campos y guardando los cambios o eliminar la cuenta en casode ser necesario.
         <br><br>
         <div class="row">
<div class="col-md-2">
    <div class="card-body secciones_body">
     <center><img src="" alt="foto" id="fotoP"></center>
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
    <input type="password" class="form-control" id="contraseña" name="contraseña" onkeyup="passVerficar()">
    </div>

    <div class="col-md-4">
    <label for="">Confirmar contraseña</label>
    <input type="password" class="form-control" id="contraseña2" name="contraseña2" onkeyup="passVerficar()">
    </div>

    </div>

    </div>
</div>
         </div>

        </div>
        <div class="modal-footer">
            <input type="hidden" name="id_user" id="id_user">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#avisoEliminar">Eliminar Cuenta</button>
          <button class="btn btn-success" id="btnSaveUs">Guardar Cambios</button>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal Aviso-->
<div class="modal fade" id="avisoEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border:1px solid white">
        <div class="modal-body">
          Esta Completamente seguro de eliminar esta cuenta, una vez eliminado no habra manera de recuperarla y esto obligara de ser
          necesario a realizar todo el proceso de esta cuenta desde cero. de clic en continuar para eliminar la cuenta definitivamente o
          en cancelar para salir del proceso de eliminacion.
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-dismiss="modal">Cancelar</button>
          <form id="form-user-delete" method="POST" action="{{url('/delete_user')}}">
            @csrf
            <input type="hidden" name="id_user" id="id_userD">
           <button id="ConfDelete" class="btn" style="color:white">Continuar</button>
        </form>
        </div>

      </div>
    </div>
  </div>

<!-- Modal eliminado-->
<div class="modal fade" id="AvisoDelectEx" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
          La cuenta fue Eliminada satisfactoriamente por lo que ya no se encuentra entre nuestros registros.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal agregado-->
<div class="modal fade" id="AvisoAgregado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px;">
        <div class="modal-body">
          La cuenta fue Agregada con exito a nuestros registros.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal agregar Usuarios-->
<div class="modal fade" id="AgregarUser" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar cuenta</h5>
        </div>
<form id="form-user-agregar" method="POST" action="{{url('/nuevo_user')}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
          A continuacion se muestra el formulario para agregar a nuevos administradores de carrera para llevar el manejo de los alumnos inscriptos en respectivas carreras.
         <br><br>
         <div class="row">
<div class="col-md-2">
    <div class="card-body secciones_body">
     <center><img src="" alt="foto" id="foto"></center>
     <input type="file" name="foto" id="foto_archivo" class="input_edit archivo" onchange="cambio_foto(this);">
    <center><label id="button_file" for="foto_archivo" class="boton_file" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; background-color:"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;</label></center>
    </div>
</div>
<div class="col-md-10">
    <div class="card-body secciones_body">

<div class="row">

<div class="col-md-4">
<label for="">Matricula</label>
<input type="number" class="form-control" id="Matricula" name="matricula" onkeyup="validarForm();">
</div>

<div class="col-md-4">
<label for="">Nombre</label>
<input type="text" class="form-control" id="Nombre" name="nombre" onkeyup="validarForm();">
</div>

<div class="col-md-4">
    <label for="">Correo</label>
    <input type="email" class="form-control" id="Correo" name="correo" onkeyup="validarForm();">
    </div>

</div>

<div class="row">
    <div class="col-md-4">
        <label for="">Carrera</label>
        <select name="carrera_tesoem" class="form-control"  id="select_carrera" onkeyup="validarForm();">
            <option value="" selected disabled>Seleccione Carrera</option>

        </select>
        </div>

    <div class="col-md-4">
    <label for="">Cambiar Contraseña</label>
    <input type="password" class="form-control" id="Contraseña" name="contraseña" onkeyup="validarForm();">
    </div>

    <div class="col-md-4">
    <label for="">Confirmar contraseña</label>
    <input type="password" class="form-control" id="Contraseña2" name="contraseña2" onkeyup="validarForm();">
    </div>

    </div>

<div class="d-flex justify-content-end">
    <div id="conf" style="display: none">
        <h5 style="color: red">Las contraseñas no Coinciden</h5>
    </div>

    <div id="cont" style="display: none">
        <h5 style="color: green">Las contraseñas Coinciden</h5>
    </div>
</div>

    </div>
</div>
         </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-success" id="btnSaveUsuario" disabled>Guardar Usuario</button>
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
#foto{
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
success: function(carreras,usuarios){
$('#tabla-reload').empty().html(carreras,usuarios);
}
});

});

//FUNCION PARA RECARGAR TABLA
var tableRE = function(){
    $.ajax({
type:'get',
url:"{{ url('/ACuentasJax') }}",
success: function(carreras,usuarios){
$('#tabla-reload').empty().html(carreras,usuarios);
}
 });
}

//FUNCION PARA BUSCAR DATOS DEL USUARIO A EDITAR
var id_user=null;

function tomar_id($id_tr){
    id_user=$id_tr;

    $.ajax({
    url: "{{url('/search_user')}}"+'/'+id_user,
  dataType: "json",
  //context: document.body
}).done(function(datosUser) {
  if(datosUser==null){
    document.getElementById("matricula").value=null;
    document.getElementById("nombre").value=null;
    document.getElementById("correo").value=null;
    document.getElementById("fotoP").src=null;
    document.getElementById("id_user").value=null;
    document.getElementById("id_userD").value=null;
  }else{
    document.getElementById("matricula").value=datosUser.matricula;
    document.getElementById("nombre").value=datosUser.name;
    document.getElementById("correo").value=datosUser.email;
    document.getElementById("fotoP").src="/fotos_users/"+datosUser.foto;
    document.getElementById("id_user").value=datosUser.id;
    document.getElementById("id_userD").value=datosUser.id;
  }
});
}


//ajax editar usuarios

$(document).ready(function() {

$("#btnSaveUs").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-user")[0]);

     $.ajax({
      url:"{{url('/cambios_user')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#ConfigUser').modal('hide');
            tableRE();
        },
        error:function (Response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});

//ajax para eliminar al usuario

$(document).ready(function() {

$("#ConfDelete").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-user-delete")[0]);

     $.ajax({
        url:"{{url('/delete_user')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#avisoEliminar').modal('hide');
            $('#ConfigUser').modal('hide');
            tableRE();
           $('#AvisoDelectEx').modal( 'show');

        }, error:function (response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});

//FUNCION PARA AGREGAR NUEVO USUARIO
$(document).ready(function() {

$("#btnSaveUsuario").click(function(e){
    e.preventDefault();  //evita recargar la pagina


    var dataString =new FormData($("#form-user-agregar")[0]);

     $.ajax({
        url:"{{url('/nuevo_user')}}",
        type:'POST',
        dataType:'json',
        data:dataString,
        cache: false,
        contentType: false,
        processData: false,
        success:function(Response){
            jQuery.noConflict();
            $('#AgregarUser').modal('hide');
            tableRE();
            $('#AvisoAgregado').modal( 'show');
            $("#form-user-agregar")[0].reset();

        }, error:function (response){
            alert("Ocurrio un Problema Por favor de reportarlo para solucionarlo");
        }

    });
});
});


//FUNCION PARA COLOCAR CARRERA EN EL SELECT DE CARRERA
function Carrera_tec(){
    $.ajax({
              url: "{{url('/carreras_tesoem')}}",
              dataType: "json",
              timeout : 80000,
              //context: document.body
            }).done(function(carreras) {

              if(carreras==null){
                console.log("sin carreras, por favor de avisar del problema");
              }else{
                for (var i = 0; i <carreras.length; i++) {
                    $("#select_carrera").append('<option value="'+carreras[i].id+'">'+carreras[i].nombre+'</option>');
                }
              }
            });
}
//FUNCION PARA AGREGAR LA FOTO EN NUEVO USUARIO
function cambio_foto(file){
    var url_img=null;
    if (file.files[0]!=null){
        if(file.value.split('.').pop()=="gif" || file.value.split('.').pop()=="png" || file.value.split('.').pop()=="jpg" || file.value.split('.').pop()=="ico"){

          document.getElementById("foto").src= (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
          document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;';

        }else{

            document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;';
            alert("EL ARCHIVO NO ES DE TIPO IMAGEN");
            file.value=null;

            document.getElementById("foto").src=url_img;
        }
    }else{

        document.getElementById("button_file").innerHTML='<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16"><path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg> &#160;&#160;';
        file.value=null;
        document.getElementById("foto").src=url_img;

    }
  }

function validarForm(){

    let contra=document.getElementById("Contraseña").value;
    let rContra=document.getElementById("Contraseña2").value;
    var contraIgual=false;

    if(contra && rContra){
    if(contra != rContra){
document.getElementById("cont").style.display="none";
document.getElementById("conf").style.display="block";
    }else{
 document.getElementById("conf").style.display="none";
 document.getElementById("cont").style.display="block";
 contraIgual=true;
    }
}else{
    document.getElementById("cont").style.display="none";
    document.getElementById("conf").style.display="none";
}

let mat=document.getElementById("Matricula").value;
let nom=document.getElementById("Nombre").value;
let corr=document.getElementById("Correo").value;
let carr=document.getElementById("select_carrera").value;

if(mat && nom && corr && carr && contraIgual){
    document.getElementById('btnSaveUsuario').disabled=false;
}else{
    document.getElementById('btnSaveUsuario').disabled=true;
}

}

function passVerficar(){

let PN=document.getElementById("contraseña").value;
let PR=document.getElementById("contraseña2").value;

if( PN!="" || PR!=""){
    document.getElementById('btnSaveUs').disabled=true;
    if(PN && PR){
if(PN != PR){
document.getElementById("cont").style.display="none";
document.getElementById("conf").style.display="block";
}else{
document.getElementById("conf").style.display="none";
document.getElementById("cont").style.display="block";
if(PN && PR)
document.getElementById('btnSaveUs').disabled=false;
}
}else{
 document.getElementById("cont").style.display="none";
 document.getElementById("conf").style.display="none";
}
 }else{
    document.getElementById('btnSaveUs').disabled=false;
 }
}

</script>


@stop
