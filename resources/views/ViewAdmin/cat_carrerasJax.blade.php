<table class="table">
    <thead>
      <tr>
        <th style="text-align: center;">id</th>
        <th style="text-align: center;">Nombre</th>
      </tr>
    </thead>
    <tbody>


      <tr>
        <td style="text-align: center;">{{ $escuela->id }}</td>
        <td style="text-align: center;">{{ $escuela->nombre }}</td>
      </tr>



    </tbody>
  </table>

  @if (Auth::user()->tipo_user==1)
    <div class="d-flex justify-content-end" style="padding: 10px">
  <button class="btn btn-success" onclick="carrera_tec();" data-toggle="modal" data-target="#AgregarIns">Agregar</button>
    </div>
    @endif
