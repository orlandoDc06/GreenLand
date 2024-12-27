document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault(); 

    const form = this;
    const formData = new FormData(form);

    Swal.fire({
        title: 'Procesando...',
        text: 'Estamos registrando tu información. Por favor, espera.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading(); 
        }
    });

    fetch(form.action, {
        method: form.method, 
        body: formData, 
        headers: {
            'X-Requested-With': 'XMLHttpRequest', 
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    })
    .then(response => response.json()) 
    .then(data => {

        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Registro exitoso!',
                text: data.message,
                showConfirmButton: true,
                confirmButtonText: 'Ir al login'
            }).then(() => {
                window.location.href = loginUrl; 
            });
        } else {

            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: data.message,
                showConfirmButton: true
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Ocurrió un problema al procesar la solicitud. Por favor, inténtalo de nuevo.',
            showConfirmButton: true
        });
    });
});
