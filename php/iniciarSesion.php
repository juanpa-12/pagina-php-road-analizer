<?php
session_start();
include 'conexion.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $contrasena = trim($_POST['contrasena']);

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (strlen($contrasena) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (empty($errores)) {
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_tipo'] = $usuario['rol'];

                if ($usuario['rol'] === 'administrador') {
                    header("Location: ../pagina_admin.php");
                } else {
                    header("Location: ../inicio.php");
                }
                exit;
            } else {
                $errores[] = "La contraseña es incorrecta.";
            }
        } else {
            $errores[] = "El correo electrónico no está registrado.";
        }

        $stmt->close();
    }

    if (!empty($errores)) {
        header("Location: index.php?alert=" . urlencode(implode(", ", $errores)));
        exit();
    }
}
?>
