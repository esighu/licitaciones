<?php
include '../includes/header.php';
?>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <form id="loginForm">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        const data = {
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            url: '/api/login.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = '/pages/index.php'; // Redirigir al usuario
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Error al iniciar sesión');
            }
        });
    });
</script>

<?php
include '../includes/footer.php';
?>