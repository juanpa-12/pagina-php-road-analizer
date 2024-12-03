document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('enviarNotificacion').addEventListener('click', function() {
        const tipoNotificacion = document.getElementById('tipoNotificacion').value;
        const descripcionNotificacion = document.getElementById('descripcionNotificacion').value;

        if (tipoNotificacion.trim() !== '' && descripcionNotificacion.trim() !== '') {
            alert('Notificación enviada con éxito'); 
        }
    });
});


function verCotizacion(cotizacionId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "php/obtener_cotizacion.php?id=" + cotizacionId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const datosCotizacion = JSON.parse(xhr.responseText);
            mostrarDetallesCotizacion(datosCotizacion); // Llama a la función para mostrar los detalles
        }
    };
    xhr.send();
}

function mostrarDetallesCotizacion(cotizacion) {
    const detalles = `
        <p><strong>ID Cotización:</strong> ${cotizacion.id}</p>
        <p><strong>Cliente:</strong> ${cotizacion.cliente}</p>
        <p><strong>Cantidad de Polímero:</strong> ${cotizacion.cantidad} litros</p>
        <p><strong>Fecha:</strong> ${cotizacion.fecha}</p>
        <p><strong>Estado:</strong> ${cotizacion.estado}</p>
        <p><strong>Comentarios:</strong> ${cotizacion.comentarios || "Sin comentarios"}</p>
    `;
    document.getElementById('detallesCotizacion').innerHTML = detalles;
    document.getElementById('cotizacionModal').style.display = "block"; // Muestra el modal con detalles
}
$('#habilitar_compra').on('click', function() {
    var cotizacionId = $(this).data('id');  // Obtener el ID de la cotización
    console.log("Enviando ID: ", cotizacionId);  // Verificar el ID

    $.ajax({
        url: 'habilitar_cotizacion.php',
        type: 'POST',
        data: { id: cotizacionId },
        success: function(response) {
            console.log(response);  // Verificar la respuesta del servidor
            var res = JSON.parse(response);
            if (res.success) {
                alert('Cotización habilitada exitosamente.');
            } else {
                alert('Error: ' + res.error);  // Verificar si hay errores
            }
        }
    });
});

