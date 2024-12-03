document.addEventListener("DOMContentLoaded", function() {
    // Ya no necesitamos el listener para el botón de notificaciones
    /*
    const btnNotificaciones = document.getElementById('btnNotificaciones');
    btnNotificaciones.addEventListener('click', function() {
        // Código anterior que mostraba el sidebar o cargaba notificaciones
    });
    */

    // Código para manejar el cierre del sidebar si aún lo necesitas
    const closeSidebarButton = document.getElementById('closeSidebar');
    closeSidebarButton.addEventListener('click', function() {
        closeSidebar();
    });
});

function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.style.display = 'none';
}

function calculate() {
    const length = document.getElementById('length').value;
    const width = document.getElementById('width').value;
    const depth = document.getElementById('depth').value;

    if (length > 0 && width > 0 && depth > 0) {
        
        var volume = length * width * depth;

        
        var polymerPerCubicMeter = 1.5; 
        var waterPerCubicMeter = 10; 

        var totalPolymer = volume * polymerPerCubicMeter;
        var totalWater = volume * waterPerCubicMeter;

        document.getElementById("aggrebindResult").innerText = "Cantidad de AggreBind necesario: " + totalPolymer.toFixed(2) + " litros.";
        document.getElementById("waterResult").innerText = "Cantidad de agua necesaria: " + totalWater.toFixed(2) + " litros.";

        document.getElementById("result").style.display = "block";
        document.getElementById("summary").style.display = "block";
        document.getElementById("totalResult").innerText = "Para estabilizar " + volume.toFixed(2) + " m³ de suelo, se necesitan " + totalPolymer.toFixed(2) + " litros de AggreBind y " + totalWater.toFixed(2) + " litros de agua.";
        document.getElementsByClassName("buttons")[0].style.display = "block";
    } else {
        alert("Por favor, ingrese todos los valores correctamente.");
    }
}

function sendQuote() {
    const length = parseFloat(document.getElementById('length').value);
    const width = parseFloat(document.getElementById('width').value);
    const depth = parseFloat(document.getElementById('depth').value);
    
    const totalPolymerText = document.getElementById('aggrebindResult').textContent;
    const totalPolymer = parseFloat(totalPolymerText.match(/(\d+(\.\d+)?)/)[0]);

    if (length && width && depth && totalPolymer) {
        const cotizacionData = {
            length: length,
            width: width,
            depth: depth,
            totalPolymer: totalPolymer
        };

        fetch('php/enviarCotizacion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cotizacionData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Cotización enviada correctamente.');
                closeQuote();  
            } else {
                
            }
        })
    }
}
