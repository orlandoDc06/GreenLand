@extends('home')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Editar Polígonos</h2>

    <div class="alert alert-info">
        Haz clic en la imagen para seleccionar las coordenadas.
    </div>

    <div class="text-center mb-4">
        <img src="{{ asset('../images/mapaC.jpeg') }}" id="map-image" class="img-fluid border" style="cursor: crosshair;" alt="Mapa">
    </div>

    <form id="coordinates-form" action="{{ route('update.poligono') }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="residencial_id">Residencial:</label>
            <select name="residencial_id" id="residencial_id" class="form-control" required>
                <option value="" disabled selected>Selecciona una residencial</option>
                @foreach($residenciales as $residencial)
                    <option value="{{ $residencial->id }}">{{ $residencial->nombre_residencial }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="coordenada_x">Coordenada X:</label>
            <input type="number" name="coordenada_x" id="coordenada_x" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="coordenada_y">Coordenada Y:</label>
            <input type="number" name="coordenada_y" id="coordenada_y" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="nombre_poligono">Nombre del Polígono:</label>
            <input type="text" name="nombre_poligono" id="nombre_poligono" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="total_lotes">Total de Lotes:</label>
            <input type="number" name="total_lotes" id="total_lotes" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="lotes_disponibles">Lotes Disponibles:</label>
            <input type="number" name="lotes_disponibles" id="lotes_disponibles" class="form-control" required>
        </div>



        <button type="submit" class="btn btn-primary">Guardar Polígono</button>
    </form>

</div>

<script>
    document.getElementById('map-image').addEventListener('click', function(event) {
        const rect = this.getBoundingClientRect();
        const x = Math.round(event.clientX - rect.left);
        const y = Math.round(event.clientY - rect.top);

        document.getElementById('coordenada_x').value = x;
        document.getElementById('coordenada_y').value = y;


        alert(`Coordenadas seleccionadas: X = ${x}, Y = ${y}`);
    });
</script>

@endsection
