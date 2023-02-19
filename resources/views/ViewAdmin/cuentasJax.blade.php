
<table class="table" style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center;">Matricula</th>
        <th style="text-align: center;">Nombre</th>
        <th style="text-align: center;">Correo</th>
      </tr>
    </thead>
    <tbody>
@foreach ($usuarios as $usuario)
      @if(Auth::user()->tipo_user==2)
      <tr onclick="tomar_id({{ $usuario->id }})" class="marca">
      @else
      <tr onclick="tomar_id({{ $usuario->id }})" class="marca" data-toggle="modal" data-target="#ConfigUser">
      @endif
        <td style="text-align: center;">{{ $usuario->matricula }}</td>
        <td style="text-align: center;">{{ $usuario->name }}</td>
        <td style="text-align: center;">{{ $usuario->email }}</td>
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
