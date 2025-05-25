// Elementos del DOM
const poligonoSelect = document.getElementById('poligono_id');
const loteSelect = document.getElementById('lote_id');
const loteForm = document.getElementById('lote-form');


// Cargar lotes al seleccionar un polígono
poligonoSelect.addEventListener('change', () => {
    const poligonoId = poligonoSelect.value;

    if (poligonoId) {
        // Mostrar mensaje de carga
        loteSelect.innerHTML = '<option value="" disabled selected>Cargando lotes...</option>';

        // Cambiamos la URL para que coincida con la ruta definida en Laravel
        fetch(`/api/lotes/${poligonoId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                // Limpiar y rellenar el select de lotes
                loteSelect.innerHTML = '<option value="" disabled selected>Seleccione un lote</option>';

                if (data.success && data.lotes && data.lotes.length > 0) {
                    data.lotes.forEach(lote => {
                        loteSelect.innerHTML += `<option value="${lote.id}">${lote.codigo_lote || 'Lote ID: ' + lote.id}</option>`;
                    });
                    console.log(`Cargados ${data.lotes.length} lotes del polígono ${poligonoId}`);
                } else {
                    loteSelect.innerHTML = '<option value="" disabled selected>No hay lotes disponibles</option>';
                    console.warn('No se encontraron lotes para este polígono');
                }
            })
            .catch(error => {
                console.error('Error al cargar los lotes:', error);
                loteSelect.innerHTML = '<option value="" disabled selected>Error al cargar lotes</option>';
            });
    }
});

// Cargar datos del lote seleccionado
loteSelect.addEventListener('change', () => {
    const loteId = loteSelect.value;

    if (loteId) {
        console.log(`Intentando cargar datos del lote ID: ${loteId}`);

        // Cambiamos la URL para que coincida con la ruta definida en Laravel
        fetch(`/api/lote/${loteId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos recibidos del servidor:', data);

                if (data.success && data.lote) {
                    const lote = data.lote;

                    // Cargar datos en el formulario
                    document.getElementById('codigo_lote').value = lote.codigo_lote || '';
                    document.getElementById('superficie_m').value = lote.superficie_m || '';
                    document.getElementById('superficie_v').value = lote.superficie_v || '';
                    document.getElementById('precio_s_v').value = lote.precio_s_v || '';
                    document.getElementById('precio_lote').value = lote.precio_lote || '';
                    document.getElementById('pcontado_porcent').value = lote.pcontado_porcent || '';
                    document.getElementById('vprima_porcent').value = lote.vprima_porcent || '';
                    document.getElementById('direccion').value = lote.direccion || '';
                    document.getElementById('estado').value = lote.estado || 'Disponible';
                    document.getElementById('coordenada_x').value = lote.coordenada_x || '';
                    document.getElementById('coordenada_y').value = lote.coordenada_y || '';
                    document.getElementById('descuento').value = lote.descuento || '';

                    // Actualizar la acción del formulario
                    loteForm.action = `/lotes/update/${lote.id}`;
                    console.log('Datos del lote cargados correctamente en el formulario');
                } else {
                    console.warn('La respuesta del servidor no contiene datos válidos del lote');
                }
            })
            .catch(error => {
                console.error('Error al cargar los datos del lote:', error);
            });
    }
});


