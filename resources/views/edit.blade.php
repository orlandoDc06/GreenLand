@extends('home')

@section('title', 'Editar Lotes Disponibles')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Editar </h1>


    {{-- Formulario de Lotes --}}
    <div class="mt-5">
        <h2 class="mb-4">Editar Lotes</h2>

        <form action="{{ route('lotes.update', ['id' => 0]) }}" method="POST" class="card p-4" id="lote-form">
            @csrf
            <div class="mb-3">
                <label for="poligono_id" class="form-label">Seleccionar Polígono</label>
                <select id="poligono_id" name="poligono_id" class="form-select" required>
                    <option value="" selected disabled>Seleccione un polígono</option>
                    @foreach ($poligonos as $poligono)
                        <option value="{{ $poligono->id }}">{{ $poligono->nombre_poligono }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="lote_id" class="form-label">Seleccionar Lote</label>
                <select id="lote_id" name="lote_id" class="form-select" required>
                    <option value="" selected disabled>Seleccione un lote</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del lote" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" class="form-control" placeholder="Precio del lote" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select id="estado" name="estado" class="form-select" required>
                    <option value="Disponible">Disponible</option>
                    <option value="Reservado">Reservado</option>
                    <option value="Vendido">Vendido</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="superficie" class="form-label">Superficie</label>
                <input type="text" id="superficie" name="superficie" class="form-control" placeholder="Superficie del lote" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</div>


@endsection

@push('scripts')
    <script src="{{ asset('js/edit.js') }}"></script>
@endpush
