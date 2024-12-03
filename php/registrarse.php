<?php
include('conexion.php');
session_start();

$error = ""; 

if (isset($_POST['registro'])) {
    $nombre = $_POST['nombres'];
    $apellido = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    if ($contrasena === $confirmar_contrasena) {
        $sql_correo = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $resultado_correo = mysqli_query($conn, $sql_correo);

        if (mysqli_num_rows($resultado_correo) > 0) {
            $error = "El correo ya está registrado. Por favor, usa otro correo.";
        } else {
            $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

            $rol = 'cliente';  
            if (strpos($correo, '@empresa.com') !== false) {
                $rol = 'administrador';
            }

            $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, rol) VALUES ('$nombre', '$apellido', '$correo', '$contrasena_encriptada', '$rol')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION['registro_exitoso'] = 'Registro exitoso. Bienvenido, ' . $rol . '!'; 
                header(header: "Location: index.php"); 
                exit;
            } else {
                $error = "Error en la base de datos: " . mysqli_error($conn);
            }
        }
    } else {
        $error = "Las contraseñas no coinciden.";
    }
}

if ($error) {
    $_SESSION['error'] = $error;
    header("Location: ../registro.php"); 
    exit;
}
?>
