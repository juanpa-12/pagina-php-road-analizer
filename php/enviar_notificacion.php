<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id = $_POST['cliente'];
    $tipo_notificacion = $_POST['tipoNotificacion'];
    $descripcion_notificacion = $_POST['descripcionNotificacion'];

    $sql = "INSERT INTO notificaciones (cliente_id, tipo, descripcion, fecha) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $cliente_id, $tipo_notificacion, $descripcion_notificacion);

    if ($stmt->execute()) {
        echo "Notificación enviada con éxito.";
    } else {
    }

    $stmt->close();
    $conn->close();
    header("Location: ../pagina_admin.php");
    exit();
}
?>
