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

<!-- Modal para cotizar lote -->
<div class="modal fade" id="cotizarLoteModal" tabindex="-1" aria-labelledby="cotizarLoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header text-white rounded-top-4 px-4 py-3" style="background-color: #538D88;">
        <h5 class="modal-title mx-auto text-center" id="cotizarLoteModalLabel">Información del Lote</h5>
        <button type="button" class="btn-close btn-close-white position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-4 text-center">
        <!-- Código del lote como título -->
        <h3 id="modal-lote-name" class="fw-bold mb-2">-</h3>

        <!-- Estado (con fondo según estado) -->
        <div id="modal-lote-estado" class="badge rounded-pill px-3 py-2 mb-4 text-white" style="font-size: 1rem;">
          -
        </div>

        <!-- Información en filas -->
        <div class="container text-start">
          <div class="row mb-3">
            <div class="col-sm-4 fw-semibold text-secondary text-center text-sm-end">Precio del Lote:</div>
            <div class="col-sm-8 text-center text-sm-start" id="modal-lote-precio">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-semibold text-secondary text-center text-sm-end">Precio al Contado:</div>
            <div class="col-sm-8 text-center text-sm-start" id="modal-lote-precio-contado">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-semibold text-secondary text-center text-sm-end">Superficie (v²):</div>
            <div class="col-sm-8 text-center text-sm-start" id="modal-lote-superficie-vara">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-semibold text-secondary text-center text-sm-end">Superficie (m²):</div>
            <div class="col-sm-8 text-center text-sm-start" id="modal-lote-superficie-metro">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-semibold text-secondary text-center text-sm-end">Dirección:</div>
            <div class="col-sm-8 text-center text-sm-start" id="modal-lote-direccion">-</div>
          </div>
        </div>

        <!-- Comentario de financiamiento -->
        <div class="mt-4 text-muted">
          <i class="bi bi-piggy-bank-fill me-2 text-success"></i>
          Financiamiento disponible hasta de 10 años.
        </div>
      </div>
    </div>
  </div>
</div>



@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/poligono.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script src="{{ asset('js/poligono.js') }}"></script>
@endpush