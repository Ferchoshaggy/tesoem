<table class="table" style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center;">Matricula</th>
        <th style="text-align: center;">Carrera</th>
        <th style="text-align: center;">Nombre</th>
        <th style="text-align: center;">Estatus</th>
      </tr>
    </thead>
    <tbody>
@foreach ($usuarios as $usuario)
@foreach ($carrerass as $carrera)
@foreach ($procesos as $proceso)
@if ($usuario->carrera_tesoem==$carrera->id)
@if($proceso->id_user==$usuario->id)
      <tr onclick="tomar_id({{ $usuario->id }})" data-toggle="modal" data-target="#aprobarDocumento">
        <td style="text-align: center;">{{ $usuario->matricula }}</td>
        <td style="text-align: center;">{{ $carrera->nombre }}</td>
        <td style="text-align: center;">{{ $usuario->name }}</td>
        @if($proceso->estatus==1)
        <td style="text-align: center;"><label style="background-color: #33FFF9; border-radius: 5px; padding: 5px">Inicio</label></td>
        @endif
        @if($proceso->estatus==2)
        <td style="text-align: center;"><label style="background-color: #EEEB21; border-radius: 5px; padding: 5px">Subida de Documentos</label></td>
        @endif
        @if($proceso->estatus==3)
        <td style="text-align: center;"><label style="background-color: #FF1414; border-radius: 5px; padding: 5px">Rechazado</label></td>
        @endif
        @if($proceso->estatus==4)
        <td style="text-align: center;"><label style="background-color: #FA8C1E; border-radius: 5px; padding: 5px">Resubido</label></td>
        @endif
        @if($proceso->estatus==5)
        <td style="text-align: center;"><label style="background-color: #75FD10; border-radius: 5px; padding: 5px">Aceptado</label></td>
        @endif
      </tr>
      @endif
      @endif
@endforeach
@endforeach
@endforeach
    </tbody>
  </table>
