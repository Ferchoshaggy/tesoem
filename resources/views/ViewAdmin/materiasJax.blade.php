<table class="table" style="width: 100%">
    <thead>
      <tr>
        <th style="text-align: center;">Semestre</th>
        <th style="text-align: center;">Materia</th>
        <th style="text-align: center;">Clave</th>
        <th style="text-align: center;">Creditos</th>
      </tr>
    </thead>
    <tbody>
@foreach ($materias as $materia)
      <tr>
        <td style="text-align: center;">{{ $materia->semestre }}</td>
        <td style="text-align: center;">{{ $materia->nombre }}</td>
        <td style="text-align: center;">{{ $materia->matricula }}</td>
        <td style="text-align: center;">{{ $materia->creditos }}</td>
      </tr>
@endforeach
    </tbody>
  </table>
  {{ $materias->links() }}
<div class="d-flex justify-content-end" style="padding: 10px">
    <button class="btn btn-success" data-toggle="modal" data-target="#agregarMateria">Agregar</button>
      </div>
