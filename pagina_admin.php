<?php
session_start();
include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="http://localhost/pagina%20final/css/PaginaAdmi.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Fijo en la pantalla */
            z-index: 1; /* Sobre el resto */
            left: 0;
            top: 0;
            width: 100%; /* Ancho completo */
            height: 100%; /* Alto completo */
            overflow: auto; /* Habilitar desplazamiento si es necesario */
            background-color: rgba(0, 0, 0, 0.4); /* Fondo semitransparente */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% desde arriba y centrado */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Ancho del modal */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Panel de Administración</h1>
            <form action="php/cerrarSesion.php" method="post" class="cerrar-sesion-form">
                <button type="submit" class="cerrar-sesion-btn">Cerrar Sesión</button>
            </form>
        </header>
        
        <nav>
            <ul>
                <li><a href="#cotizaciones">Revisar Cotizaciones</a></li>
                <li><a href="#inventario">Revisar/Actualizar Inventario</a></li>
                <li><a href="#enviarNotificacion">Enviar Notificaciones</a></li>
                <li><a href="#importaciones">Estado de Importaciones</a></li>
            </ul>
        </nav>
        
        <section id="cotizaciones">
            <h2>Cotizaciones</h2>
            <table id="tablaCotizaciones">
                <thead>
                    <tr>
                        <th>ID Cotización</th>
                        <th>Cliente</th>
                        <th>Cantidad de Polímero</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    // Consulta para obtener las cotizaciones
    $sql = "SELECT c.id, u.nombre, u.apellido, c.polimero_necesario, c.fecha, c.estado 
        FROM cotizaciones c 
        JOIN usuarios u ON c.cliente_id = u.id";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nombre'] . " " . $row['apellido'] . "</td>
                    <td>" . $row['polimero_necesario'] . " litros</td>
                    <td>" . $row['fecha'] . "</td>
                    <td id='estado-" . $row['id'] . "'>" . $row['estado'] . "</td>
                    <td>
                        <button onclick=\"verCotizacion(" . htmlspecialchars($row['id']) . ")\">Ver Cotización</button>
                        <button onclick=\"habilitarCompra(" . htmlspecialchars($row['id']) . ")\">Habilitar Compra</button>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hay cotizaciones disponibles</td></tr>";
    }
    ?>
                </tbody>
            </table>
        </section>

        <!-- Modal para ver detalles de la cotización -->
        <div id="cotizacionModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">&times;</span>
                <h2>Detalles de la Cotización</h2>
                <div id="detallesCotizacion"></div>
            </div>
        </div>

        <section id="inventario">
            <h2>Gestión de Inventario</h2>
            <div class="inventario-formularios">
                <h3>Agregar Producto</h3>
                <form id="formAgregarProducto" method="post" action="php/agregar_producto.php">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoría:</label>
                        <input type="text" id="categoria" name="categoria" required>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio por litro:</label>
                        <input type="number" step="0.01" id="precio" name="precio" required>
                    </div>
                    <div class="form-group">
                        <label for="unidad_medida">Unidad de Medida:</label>
                        <input type="text" id="unidad_medida" name="unidad_medida" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock:</label>
                        <input type="number" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_minimo">Stock Mínimo:</label>
                        <input type="number" id="stock_minimo" name="stock_minimo" required>
                    </div>
                    <button type="submit" class="btn-agregar">Agregar Producto</button>
                </form>
            </div>

            <div class="inventario-tabla">
                <h3>Lista de Productos</h3>
                <table id="tablaProductos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Unidad</th>
                            <th>Stock</th>
                            <th>Stock Mínimo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM productos";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['nombre'] . "</td>
                                        <td>" . $row['descripcion'] . "</td>
                                        <td>" . $row['categoria'] . "</td>
                                        <td>" . number_format($row['precio'], 2) . "</td>
                                        <td>" . $row['unidad_medida'] . "</td>
                                        <td>" . $row['stock'] . "</td>
                                        <td>" . $row['stock_minimo'] . "</td>
                                        <td>
                                            <button onclick=\"editarProducto(" . $row['id'] . ")\">Editar</button>
                                            <button onclick=\"eliminarProducto(" . $row['id'] . ")\">Eliminar</button>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No hay productos disponibles</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="movimientos-inventario">
                <h3>Registrar Movimiento de Inventario</h3>
                <form id="formRegistrarMovimiento" method="post" action="php/registrar_movimiento.php">
                    <div class="form-group">
                        <label for="producto_id">Producto:</label>
                        <select id="producto_id" name="producto_id" required>
                            <option value="">Selecciona un producto</option>
                            <?php
                            $sql = "SELECT * FROM productos";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_movimiento">Tipo de Movimiento:</label>
                        <select id="tipo_movimiento" name="tipo_movimiento" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-registrar">Registrar Movimiento</button>
                </form>
            </div>
        </section>
        
        <section id="enviarNotificacion">
            <h2>Enviar Notificaciones</h2>
            <form method="post" action="php/enviar_notificacion.php">
                <div class="form-group">
                    <label for="cliente_id">Selecciona Cliente:</label>
                    <select id="cliente_id" name="cliente_id" required>
                        <option value="">Selecciona un cliente</option>
                        <?php
                        // Consulta para obtener los usuarios
                        $sql = "SELECT * FROM usuarios WHERE rol = 'cliente'";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>
                </div>
                <button type="submit" class="btn-enviar">Enviar Notificación</button>
            </form>
        </section>
        
        <section id="importaciones">
            <h2>Estado de Importaciones</h2>
            <!-- Aquí puedes agregar contenido relacionado con las importaciones -->
        </section>
    </div>

    <script>
        function verCotizacion(id) {
            var detallesCotizacion = document.getElementById('detallesCotizacion');
            // Hacer una solicitud AJAX para obtener los detalles de la cotización
            fetch('php/get_cotizacion.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    detallesCotizacion.innerHTML = `
                        <p>ID Cotización: ${data.id}</p>
                        <p>Cliente: ${data.cliente}</p>
                        <p>Cantidad de Polímero: ${data.polimero_necesario} litros</p>
                        <p>Fecha: ${data.fecha}</p>
                        <p>Estado: ${data.estado}</p>
                    `;
                    // Mostrar el modal
                    document.getElementById('cotizacionModal').style.display = 'block';
                });
        }

        function cerrarModal() {
            document.getElementById('cotizacionModal').style.display = 'none';
        }

        function habilitarCompra(id) {
            // Aquí puedes agregar la lógica para habilitar la compra
            var estadoElement = document.getElementById('estado-' + id);
            estadoElement.innerHTML = 'Habilitada'; // Ejemplo: cambiar el estado a 'Habilitada'
            alert('La cotización ha sido habilitada para la compra.');
        }
    </script>
</body>
</html>
