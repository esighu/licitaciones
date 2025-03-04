// register.js

$(document).ready(function () {
    $('#registerForm').on('submit', function (e) {
        e.preventDefault(); // Evita que el formulario se envíe de forma tradicional

        // Obtener los datos del formulario
        const data = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        // Enviar los datos al servidor usando AJAX
        $.ajax({
            url: '/api/register.php', // Endpoint de la API
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                alert(response.message); // Mostrar mensaje de éxito
            },
            error: function () {
                alert('Error al registrar el usuario'); // Mostrar mensaje de error
            }
        });
    });
});