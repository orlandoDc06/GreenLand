// Elementos del DOM
const poligonoSelect = document.getElementById('poligono_id');
const loteSelect = document.getElementById('lote_id');
const loteForm = document.getElementById('lote-form');

// Elementos para cálculos automáticos
const superficieVInput = document.getElementById('superficie_v');
const precioSVInput = document.getElementById('precio_s_v');
const precioLoteInput = document.getElementById('precio_lote');
const pcontadoPorcentInput = document.getElementById('pcontado_porcent');
const vprimaPorcentInput = document.getElementById('vprima_porcent');

// Variables para controlar qué campo fue editado por el usuario
let ultimoCampoEditado = null;

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

                    // Resetear el control de último campo editado
                    ultimoCampoEditado = null;
                } else {
                    console.warn('La respuesta del servidor no contiene datos válidos del lote');
                }
            })
            .catch(error => {
                console.error('Error al cargar los datos del lote:', error);
            });
    }
});

// Función para recalcular precios
function recalcularPrecios() {
    const superficieV = parseFloat(superficieVInput.value) || 0;
    const precioSV = parseFloat(precioSVInput.value) || 0;
    const precioLote = parseFloat(precioLoteInput.value) || 0;

    if (superficieV === 0) {
        console.warn('La superficie en varas cuadradas debe ser mayor a 0 para realizar cálculos');
        return;
    }

    // Si el último campo editado fue precio_lote, recalcular precio_s_v
    if (ultimoCampoEditado === 'precio_lote' && precioLote > 0) {
        const nuevoPrecioSV = precioLote / superficieV;
        precioSVInput.value = nuevoPrecioSV.toFixed(2);
        console.log(`Precio por V² recalculado: ${nuevoPrecioSV.toFixed(2)}`);
    }
    // Si el último campo editado fue precio_s_v, recalcular precio_lote
    else if (ultimoCampoEditado === 'precio_s_v' && precioSV > 0) {
        const nuevoPrecioLote = precioSV * superficieV;
        precioLoteInput.value = nuevoPrecioLote.toFixed(2);
        console.log(`Precio del lote recalculado: ${nuevoPrecioLote.toFixed(2)}`);
    }

    // Recalcular campos derivados si es necesario
    recalcularCamposDerivados();
}

// Función para recalcular campos derivados (para futura implementación si es necesario)
function recalcularCamposDerivados() {
    const precioLote = parseFloat(precioLoteInput.value) || 0;
    const pcontadoPorcent = parseFloat(pcontadoPorcentInput.value) || 0;
    const vprimaPorcent = parseFloat(vprimaPorcentInput.value) || 0;

    if (precioLote > 0) {
        // Los cálculos se realizan en el backend al guardar
        console.log(`Precio del lote actual: ${precioLote.toFixed(2)}`);
    }
}

// Event listeners para detectar cambios en los campos de precio
precioLoteInput.addEventListener('input', () => {
    ultimoCampoEditado = 'precio_lote';
    recalcularPrecios();
});

precioSVInput.addEventListener('input', () => {
    ultimoCampoEditado = 'precio_s_v';
    recalcularPrecios();
});

// Event listener para cambios en superficie_v (puede afectar los cálculos)
superficieVInput.addEventListener('input', () => {
    // Si hay un precio establecido, recalcular basado en el último campo editado
    if (ultimoCampoEditado) {
        recalcularPrecios();
    }
});

// Event listeners para recalcular campos derivados
pcontadoPorcentInput.addEventListener('input', recalcularCamposDerivados);
vprimaPorcentInput.addEventListener('input', recalcularCamposDerivados);

// Event listener para cuando el usuario hace focus en un campo (para mejor UX)
precioLoteInput.addEventListener('focus', () => {
    precioLoteInput.select(); // Selecciona todo el texto al hacer focus
});

precioSVInput.addEventListener('focus', () => {
    precioSVInput.select(); // Selecciona todo el texto al hacer focus
});

// Validación antes del envío del formulario
loteForm.addEventListener('submit', (e) => {
    const superficieV = parseFloat(superficieVInput.value) || 0;
    const precioLote = parseFloat(precioLoteInput.value) || 0;
    const precioSV = parseFloat(precioSVInput.value) || 0;

    if (superficieV <= 0) {
        e.preventDefault();
        alert('La superficie en varas cuadradas debe ser mayor a 0');
        return false;
    }

    if (precioLote <= 0) {
        e.preventDefault();
        alert('El precio del lote debe ser mayor a 0');
        return false;
    }

    if (precioSV <= 0) {
        e.preventDefault();
        alert('El precio por vara cuadrada debe ser mayor a 0');
        return false;
    }

    console.log('Formulario validado, enviando datos...');
});
