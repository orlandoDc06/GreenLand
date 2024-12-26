
const mapContainer = document.getElementById('map-container');
const tooltip = document.getElementById('tooltip');

fetch('/api/poligonos')
    .then(response => response.json())
    .then(data => {
        
        //console.log(data);

        if (data.success) {
            data.poligonos.forEach(poligono => {
                const { id, nombre_poligono, total_lotes, lotes_disponibles, coordenada_x, coordenada_y } = poligono;

                const circle = document.createElement('div');
                circle.className = 'circle text-center';
                circle.style.left = `${coordenada_x + 45}px`;
                circle.style.top = `${coordenada_y }px`;

                circle.innerHTML = `
                    <div class="circle-name">${nombre_poligono}</div>
                    <div class="circle-available"><span class="small-text">Libres: ${lotes_disponibles}</span></div>
                `;

                mapContainer.appendChild(circle);

                circle.addEventListener('click', () => {
                    window.location.href = `/poligonos/${id}`;
                });
                
            });
        } else {
            console.error(data.message);
        }
    })
    .catch(err => console.error('Error:', err));
