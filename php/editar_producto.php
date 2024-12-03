<?php
session_start();
include 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $unidad_medida = $_POST['unidad_medida'];
    $stock = $_POST['stock'];
    $stock_minimo = $_POST['stock_minimo'];

    $sql = "UPDATE productos SET 
                nombre = '$nombre', 
                descripcion = '$descripcion', 
                categoria = '$categoria', 
                precio = '$precio', 
                unidad_medida = '$unidad_medida', 
                stock = '$stock', 
                stock_minimo = '$stock_minimo' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Producto actualizado correctamente";
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
