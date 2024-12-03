document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        const correo = document.getElementById('correo').value;
        const contrasena = document.getElementById('contrasena').value;
        const errorMessage = document.getElementById('error-message');
        
        let isValid = true;
        let errorText = '';

        if (!validateEmail(correo)) {
            isValid = false;
            errorText += 'El correo electrónico no es válido.<br>';
        }

        if (contrasena.length < 6) {
            isValid = false;
            errorText += 'La contraseña debe tener al menos 6 caracteres.<br>';
        }

        if (isValid) {
            return true;
        } else {
            errorMessage.innerHTML = errorText;
            errorMessage.style.display = 'block';
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
