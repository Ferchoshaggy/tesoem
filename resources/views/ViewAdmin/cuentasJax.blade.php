
<table class="table" style="width: 100%">
    <thead>
      <tr>

        @if(Auth::user()->tipo_user==1)
        <th style="text-align: center;">Rol</th>
        @endif
        <th style="text-align: center;">Matricula</th>
        <th style="text-align: center;">Nombre</th>
        <th style="text-align: center;">Correo</th>
        <th style="text-align: center;">Paso</th>
        @if(Auth::user()->tipo_user==2)
        <th style="text-align: center;">Folio</th>
        @endif
      </tr>
    </thead>
    <tbody>
@foreach ($usuarios as $usuario)

      @if(Auth::user()->tipo_user==2)
      <tr onclick="tomar_id({{ $usuario->id }})" class="marca">
      @else
      <tr onclick="tomar_id({{ $usuario->id }})" class="marca" data-toggle="modal" data-target="#ConfigUser">
      @endif

      @if(Auth::user()->tipo_user==1)
@if ($usuario->tipo_user==2)
<td style="text-align: center;">Docente</td>
@elseif($usuario->tipo_user==3)
<td style="text-align: center;">Alumno</td>
@endif
      @endif

        <td style="text-align: center;">{{ $usuario->matricula }}</td>
        <td style="text-align: center;">{{ $usuario->name }}</td>
        <td style="text-align: center;">{{ $usuario->email }}</td>


@foreach ($procesos as $proceso)
@if($proceso->id == $usuario->id_proceso_activo)
@if($proceso->etapa==1)
<td style="text-align: center;">Documentos</td>
@elseif($proceso->etapa==2)
<td style="text-align: center;">Materias</td>
@elseif($proceso->etapa>=3)
<td style="text-align: center;">Formatos/Horario</td>
@endif
@if(Auth::user()->tipo_user==2)
<td style="text-align: center;"> @if($proceso->folio==null) <label style="color: red;">Sin folio</label> @else {{$proceso->folio}} @endif </td>
@endif
@endif

@endforeach

@if($usuario->id_proceso_activo==null)
<td style="text-align: center;">No tiene Etapa</td>
@endif

      </tr>


@endforeach
    </tbody>
  </table>
{{ $usuarios->links() }}
@if (Auth::user()->tipo_user==1)
  <div class="d-flex justify-content-end" style="padding: 10px">
<button class="btn btn-success" onclick="Carrera_tec();" data-toggle="modal" data-target="#AgregarUser">Agregar</button>
  </div>
  @endif
