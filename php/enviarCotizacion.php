<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'error' => 'Cliente no autenticado.']);
    exit;
}

include 'conexion.php';  

$data = json_decode(file_get_contents("php://input"), true);

$cliente_id = $_SESSION['usuario_id'];  
$longitud = $data['length'];
$ancho = $data['width'];
$profundidad = $data['depth'];
$polimero_necesario = floatval($data['totalPolymer']);

$sql = "INSERT INTO cotizaciones (cliente_id, longitud, ancho, profundidad, polimero_necesario) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("idddd", $cliente_id, $longitud, $ancho, $profundidad, $polimero_necesario);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
