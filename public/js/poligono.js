document.addEventListener('DOMContentLoaded', () => {
    const poligonoId = document.getElementById('map-container').dataset.poligonoId; // El ID del polígono actual desde Blade
    fetch(`/api/lotes/${poligonoId}`) // Llama a la API con el polígono actual
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Lotes recibidos:", data.lotes);
                const mapContainer = document.getElementById('map-container');
                data.lotes.forEach(lote => {
                    const {
                        id,
                        codigo_lote,
                        precio_lote,
                        direccion,
                        estado,
                        coordenada_x,
                        coordenada_y,
                        superficie_m,
                        pcontado_porcent
                    } = lote;

                    // Convertir precio_lote a número (viene como string)
                    const precioLoteNum = parseFloat(precio_lote) || 0;
                    const porcentajeContado = parseFloat(pcontado_porcent) || 0;

                    // Verifica si el codigo_lote es null
                    if (codigo_lote === null) {
                        return; // No crea el círculo si el código es null
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
                        <div class="circle-name">${codigo_lote}</div>
                    `;

                    // Evento al hacer clic en el círculo
                    circle.addEventListener('click', () => {
                        // Debug: mostrar todos los datos del lote
                        console.log('Datos del lote completos:', lote);
                        console.log('precio_lote:', precio_lote);
                        console.log('pcontado_porcent:', pcontado_porcent);
                        console.log('direccion:', direccion);

                        // Calcular precio al contado con validaciones
                        let precioContado = precio_lote;
                        if (pcontado_porcent && pcontado_porcent > 0) {
                            precioContado = precio_lote - (precio_lote * (pcontado_porcent / 100));
                        }

                        // Llenar el modal con la información del lote
                        document.getElementById('modal-lote-name').textContent = codigo_lote || 'Sin código';
                        document.getElementById('modal-lote-precio').textContent = precio_lote ? `${precio_lote.toLocaleString()}` : 'No disponible';
                        document.getElementById('modal-lote-precio-contado').textContent = precioContado ? `${precioContado.toLocaleString()}` : 'No disponible';
                        document.getElementById('modal-lote-direccion').textContent = direccion && direccion.trim() !== '' ? direccion : 'No especificada';
                        document.getElementById('modal-lote-estado').textContent = estado || 'Sin estado';

                        // Aplica el estado como badge con color
                        setEstadoBadge(estado);

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


function setEstadoBadge(estado) {
  const badge = document.getElementById("modal-lote-estado");
  badge.textContent = estado;

  badge.classList.remove("badge-disponible", "badge-reservado", "badge-vendido");
console.log("Estado del lote:", estado); // Debug: mostrar el estado del lote
  switch (estado) {
    case "Disponible":
      badge.classList.add("badge-disponible");
      break;
    case "Reservado":
      badge.classList.add("badge-reservado");
      break;
    case "Vendido":
      badge.classList.add("badge-vendido");
      break;
    default:
      badge.style.backgroundColor = "#6c757d"; // gris neutro
  }
}