const poligonoSelect = document.getElementById('poligono_id');
const loteSelect = document.getElementById('lote_id');
const loteForm = document.getElementById('lote-form');

// Cargar lotes al seleccionar un polígono
poligonoSelect.addEventListener('change', () => {
    const poligonoId = poligonoSelect.value;

    if (poligonoId) {
        fetch(`/api/lotes/${poligonoId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Limpiar y rellenar el select de lotes
                    loteSelect.innerHTML = '<option value="" disabled selected>Seleccione un lote</option>';
                    data.lotes.forEach(lote => {
                        loteSelect.innerHTML += `<option value="${lote.id}">${lote.name || 'Sin Nombre'}</option>`;
                    });
                } else {
                    alert(data.message);
                    loteSelect.innerHTML = '<option value="" disabled selected>No hay lotes disponibles</option>';
                }
            })
            .catch(error => console.error('Error al cargar los lotes:', error));
    }
});

// Cargar datos del lote seleccionado
loteSelect.addEventListener('change', () => {
    const loteId = loteSelect.value;

    if (loteId) {
        fetch(`/api/lote/${loteId}`) // Nueva ruta para obtener los datos de un lote
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const lote = data.lote; // Datos del lote recibido
                    document.getElementById('name').value = lote.name || '';
                    document.getElementById('precio').value = lote.precio || '';
                    document.getElementById('estado').value = lote.estado || 'Disponible';
                    document.getElementById('superficie').value = lote.superficie || '';
                    loteForm.action = `/lotes/update/${lote.id}`; // Actualizar la acción del formulario
                } else {
                    alert('No se encontraron datos del lote.');
                }
            })
            .catch(error => console.error('Error al cargar los datos del lote:', error));
    }
});
