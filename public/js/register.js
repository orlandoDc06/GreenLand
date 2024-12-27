document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();

    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;

    // Primero validar si las contraseñas coinciden
    if (password !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Contraseñas no coinciden',
            text: 'Las contraseñas ingresadas no son iguales.',
            showConfirmButton: true
        });
        return; // Salir de la función
    }

    // Luego validar si la contraseña cumple con el patrón
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/;
    if (!passwordRegex.test(password)) {
        Swal.fire({
            icon: 'error',
            title: 'Contraseña inválida',
            text: 'La contraseña debe tener al menos 8 caracteres, una letra mayúscula, un número y un carácter especial.',
            showConfirmButton: true
        });
        return; // Salir de la función
    }

    // Si ambas validaciones pasan, proceder con el envío del formulario
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

document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;

    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
    const confirmPasswordField = document.getElementById('password_confirmation');
    const icon = document.getElementById('toggleConfirmPasswordIcon');
    const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
    confirmPasswordField.type = type;

    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
});
