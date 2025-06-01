@extends('home')

@section('title', 'Mapa')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Cotice su lote</h1>
    <p class="text-center">Elija el área de su preferencia para ver los lotes disponibles.</p>

    <div class="mt-4">
        <h5 class="mb-3">Mapa Completo</h5>
        <div class="card">
            <div class="card-body p-0 position-relative">
                <div class="map-wrapper">
                    <div id="map-container"></div>
                    <div id="tooltip" class="tooltip"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
#map-container {
    position: relative;
    width: 1200px;
    height: 1300px;
    background-image: url('{{ asset("images/Modelo.png") }}');
    background-size: cover;
    background-position: center;
    border-radius: 5px;
}
</style>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/maps.css') }}">

@endpush

@push('scripts')
    <script src="{{ asset('js/maps.js') }}"></script>

@endpush
