<?php
include '../includes/header.php';
?>

<div class="container">
    <h2>Registro</h2>
    <form id="registerForm">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluir el archivo register.js -->
<script src="../assets/js/register.js"></script>

<?php
include '../includes/footer.php';
?>