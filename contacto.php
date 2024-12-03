<?php
session_start();
include 'php/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
    <link rel="stylesheet" href="http://localhost/pagina%20final/css/contacto.css">
</head>
<body>

<nav class="nav">
    <div class="container">
        <div class="logo">
            <img src="/imagenes/AggreBind-White-logo.png" alt="Logo">
        </div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                <li><a href="QuienesSomos.html">¿Quienes somos?</a></li>
                <li><a href="Inicio.php">Inicio</a></li>
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

<div class="container">
    <section class="contact-form">
        <h1>Contáctanos</h1>
        <form id="contactForm" action="php/enviar_mensaje.php" method="post">
            <label for="subject">Asunto:</label>
            <input type="text" id="subject" name="subject" required>
            
            <label for="message">Mensaje:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
            
            <button type="submit">Enviar</button>
        </form>        
</div>

<script src="/Js/Contacto.js"></script>
</body>
</html>
