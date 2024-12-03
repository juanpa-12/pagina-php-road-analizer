<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/iniciarSesion.css">

</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form id="loginForm" action="iniciarSesion.php" method="POST">
            <div class="input-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="input-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="inputBx">
                <input type="submit" value="Iniciar Sesión">
            </div>
        </form>
        <?php if (isset($_GET['alert'])): ?>
            <div class="error-message">
                <script>
                    alert("<?php echo htmlspecialchars($_GET['alert']); ?>");
                </script>
                <script src="../js/iniciarsesion.Js"></script>

            </div>
        <?php endif; ?>
        <div class="register-link">
        <p>¿No tienes una cuenta? <a href="../registro.php">Registrarse</a></p>

        </div>
    </div>
</body>
</html>