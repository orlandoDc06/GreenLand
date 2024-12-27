document.addEventListener('DOMContentLoaded', () => {
    const poligonoId = document.getElementById('map-container').dataset.poligonoId; // El ID del polígono actual desde Blade

    fetch(`/api/lotes/${poligonoId}`) // Llama a la API con el polígono actual
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Lotes recibidos:", data.lotes);
                const mapContainer = document.getElementById('map-container');

                data.lotes.forEach(lote => {
                    const { id, name, precio, estado, coordenada_x, coordenada_y, superficie } = lote;

                    // Verifica si el nombre es null
                    if (name === null) {
                        return; // No crea el círculo si el nombre es null
                    }

                    // Define el color según el estado
                    const colorClass = {
                        'Disponible': 'green',
                        'Reservado': 'yellow',
                        'Vendido': 'red'
                    }[estado] || 'gray';

                    // Crea el círculo
                    const circle = document.createElement('div');
                    circle.className = `circle text-center ${colorClass}`;
                    circle.style.left = `${coordenada_x - 20}px`; // Ajusta el desplazamiento
                    circle.style.top = `${coordenada_y - 20}px`;

                    // Contenido del círculo
                    circle.innerHTML = `
                        <div class="circle-name">${name}</div>
                    `;

                    // Evento al hacer clic en el círculo
                    circle.addEventListener('click', () => {
                        // Llenar el modal con la información del lote
                        document.getElementById('modal-lote-name').textContent = name;
                        document.getElementById('modal-lote-precio').textContent = precio;
                        document.getElementById('modal-lote-superficie').textContent = superficie;
                        document.getElementById('modal-lote-estado').textContent = estado;

                        // Mostrar el modal
                        const modal = new bootstrap.Modal(document.getElementById('cotizarLoteModal'));
                        modal.show();
                    });

                    // Agrega el círculo al contenedor del mapa
                    mapContainer.appendChild(circle);
                });
            }
        })
        .catch(error => console.error('Error al obtener los lotes:', error));
});
