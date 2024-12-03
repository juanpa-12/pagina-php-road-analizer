document.getElementById('nombres').addEventListener('input', function() {
    this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
});

document.getElementById('apellidos').addEventListener('input', function() {
    this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
});

const mostrarContrasena = document.getElementById('mostrar-contrasena');
const contrasena = document.getElementById('contrasena');
const confirmarContrasena = document.getElementById('confirmar_contrasena');

mostrarContrasena.addEventListener('change', function() {
    const type = mostrarContrasena.checked ? 'text' : 'password';
    contrasena.type = type;
    confirmarContrasena.type = type;
});