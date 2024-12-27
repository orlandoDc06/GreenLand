@extends('home')

@section('title', 'Cotice su lote')

@section('content')
<div class="container py-4">
    <h1 class="text-center">Cotice su lote</h1>

    <div class="container d-flex flex-column align-items-center mt-4">
        <div class="breadcrumb mt-4">
            <p class="breadcrumb-item">Mapa Polígono</p>
            <span class="breadcrumb-item active">{{ $poligono->nombre_poligono }}</span>
        </div>
    
        <div class="legend mt-3 d-flex justify-content-center">
            <span class="badge bg-success me-2">Disponible</span>
            <span class="badge bg-warning me-2">Reservado</span>
            <span class="badge bg-danger">Vendido</span>
        </div>

        <!-- Contenedor desplazable y centrado -->
        <div class="scrollable-container d-flex justify-content-center mt-5">
            <div id="map-container" 
                class="position-relative" 
                data-poligono-id="{{ $poligono->id }}">
                <!-- Imagen del mapa -->
                <img src="{{ asset('images/poligonos/' . $poligono->id . '.png') }}" 
                    alt="{{ $poligono->nombre_poligono }}" 
                    class="map-image">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cotizarLoteModal" tabindex="-1" aria-labelledby="cotizarLoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cotizarLoteModalLabel">Cotizar Lote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Lote:</strong> <span id="modal-lote-name"></span></p>
                <p><strong>Precio:</strong> $<span id="modal-lote-precio"></span></p>
                <p><strong>Superficie:</strong> <span id="modal-lote-superficie"></span></p>
                <p><strong>Estado:</strong> <span id="modal-lote-estado"></span></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/poligono.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush

@push('scripts')
    <script src="{{ asset('js/poligono.js') }}"></script>
@endpush
