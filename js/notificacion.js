fetch('php/notificaciones.php')
    .then(response => response.json())
    .then(data => {
        const notificationsList = document.getElementById('notifications-list');
        if (data.success) {
            if (data.notificaciones.length > 0) {
                data.notificaciones.forEach(notification => {
                    const notificationCard = `
                        <div class="notification-card">
                            <h3>${notification.tipo}</h3>
                            <p>${notification.descripcion}</p>
                            <span>${notification.fecha}</span>
                        </div>
                    `;
                    notificationsList.innerHTML += notificationCard;
                });
            } else {
                notificationsList.innerHTML = '<p>No tienes notificaciones.</p>';
            }
        } else {
            notificationsList.innerHTML = `<p>Error: ${data.message}</p>`;
        }
    })
    .catch(error => {
        document.getElementById('notifications-list').innerHTML = '<p>Error al cargar las notificaciones.</p>';
        console.error('Error al obtener notificaciones:', error);
    });
