@extends('home')

@section('title', 'Mapa')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Cotice su lote</h1>
    <p class="text-center">Elija el área de su preferencia para ver los lotes disponibles.</p>

    <h5 class="mb-3">Mapa Completo</h5>
    <div class="mt-4 d-flex justify-content-center">
        <div class="card">
            <div class="card-body p-0 position-relative">
                <div class=" map-wrapper">
                    <div id="map-container"></div>
                    <div id="tooltip" class="tooltip"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">
            <i class="bi bi-info-circle me-2"></i>
            Haga clic en cualquier área del mapa para ver más detalles
        </p>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/maps.css') }}">

@endpush

@push('scripts')
    <script src="{{ asset('js/maps.js') }}"></script>

@endpush


