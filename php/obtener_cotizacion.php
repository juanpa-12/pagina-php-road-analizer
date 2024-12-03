<?php
// obtener_cotizacion.php

include 'conexion.php'; // Incluye la conexión a la base de datos

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM cotizaciones WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cotizacion = $result->fetch_assoc();
        echo json_encode($cotizacion);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
