<?php
session_start();
include('conexion.php');

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No se ha iniciado sesión.']);
    exit();
}

$cliente_id = $_SESSION['usuario_id'];

$sql = "SELECT tipo, descripcion, fecha FROM notificaciones WHERE cliente_id = '$cliente_id' ORDER BY fecha DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . mysqli_error($conn)]);
    exit();
}

$notificaciones = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notificaciones[] = $row;
    }
}

echo json_encode(['success' => true, 'notificaciones' => $notificaciones]);
?>
