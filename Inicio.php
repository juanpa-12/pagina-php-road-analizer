<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgreeBind</title>
    <link rel="stylesheet" href="css/inicio.css">
</head>
<body>
    
    <nav class="nav">
        <div class="container">
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                    <li><a href="quienesSomos.html">¿Quiénes somos?</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="notificaciones.html" id="btnNotificaciones">Notificaciones</a></li> 
                    <li><a href="php/cerrarSesion.php">Cerrar sesión</a></li>
                </ul>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </div>
    </nav>

    <section class="home"></section>
    
    <div class="containere">
        <h1>Calculadora de AggreBind</h1>
        <label for="length">Longitud del camino (en metros):</label>
        <input type="number" id="length" placeholder="Ingrese la longitud" required>
        
        <label for="width">Ancho del camino (en metros):</label>
        <input type="number" id="width" placeholder="Ingrese el ancho" required>
        
        <label for="depth">Profundidad del camino (en metros):</label>
        <input type="number" id="depth" placeholder="Ingrese la profundidad" required>
        
        <button onclick="calculate()">Calcular</button>
        
        <div id="result" class="result" style="display: none;">
            <h2>Resultados</h2>
            <p id="aggrebindResult"></p>
            <p id="waterResult"></p>
        </div>

        <div id="summary" class="summary" style="display: none;">
            <h2>Resumen</h2>
            <p id="totalResult"></p>
        </div>

        <div class="buttons" style="display: none;">
            <button id="sendQuote" onclick="sendQuote()">Enviar Cotización</button> 
            <button id="closeQuote" onclick="closeQuote()">Cerrar Cotización</button> 
        </div>
    </div>

    <script src="js/inicio.js"></script>    
</body>
</html>
