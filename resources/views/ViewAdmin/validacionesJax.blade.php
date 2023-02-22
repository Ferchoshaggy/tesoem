<table class="table" style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center;">Matricula</th>
        <th style="text-align: center;">Nombre</th>
        <th style="text-align: center;">Ins. Previa</th>
        <th style="text-align: center;">Estatus</th>
      </tr>
    </thead>
    <tbody>
    @foreach($alumnos as $alumno)
    @if($alumno->estatus==4)
      <tr onclick="tomar_id({{$alumno->id}})" data-toggle="modal" data-target="#validar_modal" class="marca" style="cursor: pointer;">
        <td style="text-align: center;">{{$alumno->matricula}}</td>
        <td style="text-align: center;">{{$alumno->name}}</td>
        <td style="text-align: center;">{{$alumno->nombre}}</td>
        <td style="text-align: center;"><p style="color: #fff;background-color: #007bff; border-radius: 5px; padding: 5px;">pendiente</p></td>
      </tr>
      @endif
     @endforeach
    </tbody>
  </table>

  {{ $alumnos->links() }}
