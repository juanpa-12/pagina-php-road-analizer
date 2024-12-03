<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        
        error_log("ID recibido: " . $id);  

        $sql = "UPDATE cotizaciones SET estado = 'Habilitada' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);  
        } else {
            error_log("Error al ejecutar el UPDATE: " . $stmt->error);
            echo json_encode(['success' => false, 'error' => $stmt->error]);  
        }
        

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'ID no recibido']);
    }
}

$conn->close();
?>
