@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
<!--este es para el selected2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')

<div class="card-body secciones_body">
    <div class="col-md-12" style="text-align: center;">
        <img src="{{url('icons/vacio.png')}}" style="width: 25%; height: auto;"><br><br>
        <div style="font-size: 30px; text-align: center;">
            Faltan datos importantes en los formatos, espera a que el administrador los acomplete.
        </div>
    </div>
</div>
@stop

@section('css')

<style type="text/css">
    .secciones_body{
        background-color: #234747;
        border-radius: 10px; 
        margin-bottom: 35px; 
        color: #fff; 
        text-align: center; 
        font-size: 20px;
    }
    /*este es para el diseño del archivo */
    .archivo{
      display: none;
    }

    .boton_file{
      display: inline-block;
      cursor: pointer;
      width: 50%;
      font-size: 1.3rem; 
      font-weight: bold;
    }
    html{
        background-color: #193333;
    }
</style>

@stop

@section('js')



<script type="text/javascript">

@stop