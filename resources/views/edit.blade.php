@extends('home')

@section('title', 'Editar Polígonos')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Editar Polígono</h1>

    {{-- Botones --}}

    <div class="mt-5">
        <h2 class="mb-4">Editar Lotes</h2>

        <form action="{{ route('lotes.update', ['id' => 0]) }}" data-action-base="{{ route('lotes.update', ['id' => '__ID__']) }}" method="POST" class="card p-4" id="lote-form">

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

            <!-- Contenedor de la imagen del polígono -->
            <div class="mb-4" style="margin-left: 120px;">
                <div id="poligono-imagen-container" class="text-center border p-3 position-relative"
                    style="width: 800px; height: 1200px; overflow: auto; display: none;">
                    <img id="poligono-imagen" src="" alt="Imagen del polígono" style="display: block;">
                    <div class="mt-2">
                        <p class="text-muted small">Haga clic en la imagen para establecer las coordenadas del lote</p>
                    </div>
                    <!-- Coordenadas seleccionadas -->
                    <div id="coordenadas-seleccionadas" class="mt-2 text-success fw-bold"></div>
                </div>
            </div>


            <div class="mb-3">
                <label for="lote_id" class="form-label">Seleccionar Lote</label>
                <select id="lote_id" name="lote_id" class="form-select" required>
                    <option value="" selected disabled>Seleccione un lote</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="codigo_lote" class="form-label">Código de Lote</label>
                <input type="text" id="codigo_lote" name="codigo_lote" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="superficie_m" class="form-label">Superficie (m²)</label>
                    <input type="number" step="0.01" id="superficie_m" name="superficie_m" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="superficie_v" class="form-label">Superficie (v²)</label>
                    <input type="number" step="0.01" id="superficie_v" name="superficie_v" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio_s_v" class="form-label">Precio por V²</label>
                    <input type="number" step="0.01" id="precio_s_v" name="precio_s_v" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="precio_lote" class="form-label">Precio Lote</label>
                    <input type="number" step="0.01" id="precio_lote" name="precio_lote" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pcontado_porcent" class="form-label">porcentaje utilizado para sacar el precio al contado</label>
                    <input type="number" step="0.01" id="pcontado_porcent" name="pcontado_porcent" class="form-control">
                </div>

                <div class="col-md-6 mb-3 d-none">
                    <label for="vprima_porcent" class="form-label">porcentaje utilizado para sacar el valor de la prima</label>
                    <input type="number" step="0.01" id="vprima_porcent" name="vprima_porcent" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control">
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select id="estado" name="estado" class="form-select" required>
                    <option value="Disponible">Disponible</option>
                    <option value="Reservado">Reservado</option>
                    <option value="Vendido">Vendido</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="coordenada_x" class="form-label">Coordenada X</label>
                    <input type="number" id="coordenada_x" name="coordenada_x" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="coordenada_y" class="form-label">Coordenada Y</label>
                    <input type="number" id="coordenada_y" name="coordenada_y" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="descuento" class="form-label d-none">Descuento (%)</label>
                <input type="number" step="0.01" id="descuento" name="descuento" class="form-control" min="0" max="100">
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('edit.map') }}" class="btn btn-warning me-2 d-none">Editar Mapa</a>
                <button type="button" id="btn-eliminar" class="btn btn-danger d-none">Eliminar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/edit.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const poligonoSelect = document.getElementById('poligono_id');
            const poligonoImagenContainer = document.getElementById('poligono-imagen-container');
            const poligonoImagen = document.getElementById('poligono-imagen');
            const coordenadaX = document.getElementById('coordenada_x');
            const coordenadaY = document.getElementById('coordenada_y');
            const coordenadasSeleccionadas = document.getElementById('coordenadas-seleccionadas');

            // Cargar imagen del polígono cuando cambia la selección
            poligonoSelect.addEventListener('change', function() {
                const poligonoId = this.value;

                if (poligonoId) {
                    // Construir la ruta de la imagen basada en el ID del polígono
                    const imagenUrl = `/images/poligonos/${poligonoId}.png`;

                    // Verificar si la imagen existe
                    const img = new Image();
                    img.onload = function() {
                        // La imagen existe, mostrarla
                        poligonoImagen.src = imagenUrl;
                        poligonoImagenContainer.style.display = 'block';
                    };

                    img.onerror = function() {
                        // La imagen no existe
                        poligonoImagenContainer.style.display = 'none';
                        alert('No se encontró la imagen para este polígono');
                    };

                    img.src = imagenUrl;
                } else {
                    // Ocultar el contenedor si no hay polígono seleccionado
                    poligonoImagenContainer.style.display = 'none';
                }
            });

            // Capturar coordenadas al hacer clic en la imagen
            poligonoImagen.addEventListener('click', function(e) {
                // Obtener las coordenadas relativas a la imagen
                const rect = this.getBoundingClientRect();
                const x = Math.round(e.clientX - rect.left);
                const y = Math.round(e.clientY - rect.top);

                // Actualizar los campos de coordenadas en el formulario
                coordenadaX.value = x;
                coordenadaY.value = y;

                // Mostrar las coordenadas seleccionadas
                coordenadasSeleccionadas.textContent = `Coordenadas seleccionadas: X=${x + 20}, Y=${y + 20}`;

                // Función para mostrar un marcador en la posición seleccionada
                mostrarMarcador(x, y);
            });

            // Función para mostrar un marcador visual en la imagen
            function mostrarMarcador(x, y) {
                // Eliminar marcadores anteriores
                const marcadoresAnteriores = document.querySelectorAll('.marcador-coordenada');
                marcadoresAnteriores.forEach(marcador => marcador.remove());

                // Crear nuevo marcador
                const marcador = document.createElement('div');
                marcador.className = 'marcador-coordenada';
                marcador.style.position = 'absolute';
                marcador.style.left = `${x + 20}px`;
                marcador.style.top = `${y + 20}px`;
                marcador.style.width = '10px';
                marcador.style.height = '10px';
                marcador.style.backgroundColor = 'red';
                marcador.style.borderRadius = '50%';
                marcador.style.transform = 'translate(-50%, -50%)';
                marcador.style.zIndex = '1000';

                // Agregar marcador al contenedor
                poligonoImagenContainer.appendChild(marcador);
            }

            // Verificar si hay un polígono preseleccionado al cargar la página
            if (poligonoSelect.value) {
                poligonoSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
    <style>
        #poligono-imagen-container {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            cursor: crosshair;
            width: 800px;
            height: 1200px;
            overflow: auto;
        }

        .marcador-coordenada {
            box-shadow: 0 0 0 2px white, 0 0 0 4px red;
        }
    </style>
@endpush
