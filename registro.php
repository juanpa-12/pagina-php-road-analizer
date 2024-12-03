<?php
session_start();
include 'php/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="http://localhost/pagina%20final/css/Registrarse.css">
</head>
<body>
    <div class="register-container">
        <h2>Registrarse</h2>

        <?php

        if (isset($_SESSION['error'])) {
            echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); 
        }
        ?>

        <form id="registroForm" action="php/registrarse.php" method="POST">
            <div class="inputBx">
                <input type="text" id="nombres" name="nombres" placeholder="Nombres" required>
            </div>
            <div class="inputBx">
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required>
            </div>
            <div class="inputBx">
                <input type="email" name="correo" placeholder="Correo Electrónico" required>
            </div>
            <div class="inputBx">
                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            </div>
            <div class="inputBx">
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
            </div>

            <div class="inputBx show-password">
                <input type="checkbox" id="mostrar-contrasena">
                <label for="mostrar-contrasena">Mostrar Contraseña</label>
            </div>

            <div class="inputBx">
                <input type="submit" name="registro" value="Registrarse">
            </div>
        </form>
    </div>

    <script src="js/registro.js"></script>

</body>
</html>