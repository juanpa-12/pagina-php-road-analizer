<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $unidad_medida = $_POST['unidad_medida'];
    $stock = $_POST['stock'];
    $stock_minimo = $_POST['stock_minimo'];

    $sql = "INSERT INTO productos (nombre, descripcion, categoria, precio, unidad_medida, stock, stock_minimo) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssdisi', $nombre, $descripcion, $categoria, $precio, $unidad_medida, $stock, $stock_minimo);

    if (mysqli_stmt_execute($stmt)) {
        echo "Producto agregado con éxito.";
        header("Location: ../pagina_admin.php#inventario"); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
