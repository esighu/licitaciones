$.ajax({
    url: '/api/notify.php',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({
        to: 'usuario@example.com',
        subject: 'Nueva oferta realizada',
        body: 'Se ha realizado una nueva oferta en tu subasta.'
    }),
    success: function (response) {
        console.log(response.message);
    },
    error: function () {
        console.error('Error al enviar la notificación');
    }
});