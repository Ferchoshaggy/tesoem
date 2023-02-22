<table class="table" style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center;">id</th>
        <th style="text-align: center;">Nombre</th>
      </tr>
    </thead>
    <tbody>
@foreach ($escuelas as $escuela)

      <tr class="marca" onclick="tomar_id({{ $escuela->id }})">
        <td style="text-align: center;">{{ $escuela->id }}</td>
        <td style="text-align: center;">{{ $escuela->nombre }}</td>
      </tr>

@endforeach

    </tbody>
  </table>
  {{ $escuelas->links() }}
  @if (Auth::user()->tipo_user==1)
    <div class="d-flex justify-content-end" style="padding: 10px">
  <button class="btn btn-success" data-toggle="modal" data-target="#AgregarIns">Agregar</button>
    </div>
    @endif
