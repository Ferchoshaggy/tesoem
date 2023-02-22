<table class="table" style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center;">Institucion</th>
        <th style="text-align: center;">Nombre</th>
      </tr>
    </thead>
    <tbody>

@foreach ($escuelas as $escuela)
 @foreach ($carreras as $carrera)
@if($carrera->id_institucion==$escuela->id)
      <tr class="marca" onclick="tomar_id({{ $carrera->id }})">
        <td style="text-align: center;">{{ $escuela->nombre }}</td>
        <td style="text-align: center;">{{ $carrera->nombre }}</td>
      </tr>
@endif
@endforeach
@endforeach

    </tbody>
  </table>
  {{ $carreras->links() }}
  @if (Auth::user()->tipo_user==1)
    <div class="d-flex justify-content-end" style="padding: 10px">
  <button class="btn btn-success" data-toggle="modal" data-target="#AgregarCarrera">Agregar</button>
    </div>
    @endif
