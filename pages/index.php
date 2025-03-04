<?php
session_start(); // Iniciar sesión para manejar autenticación
include '../includes/header.php';

// Verificar si el usuario está autenticado
$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? $_SESSION['role'] : null;
?>

<div class="container mt-5">
    <h1>Bienvenido a Seguros Rivadavia</h1>
    <p>Somos una empresa líder en seguros de autos y autopartes. ¡Confía en nosotros para proteger tus bienes!</p>

    <?php if (!$isLoggedIn): ?>
        <!-- Si el usuario no está autenticado, mostrar botones de login y registro -->
        <div class="text-center mt-4">
            <a href="/pages/login.php" class="btn btn-primary me-2">Iniciar Sesión</a>
            <a href="/pages/register.php" class="btn btn-secondary">Registrarse</a>
        </div>
    <?php else: ?>
        <!-- Si el usuario está autenticado, mostrar opciones según su rol -->
        <div class="mt-4">
            <p>Hola, <?= htmlspecialchars($_SESSION['name']) ?>!</p>
            <?php if ($userRole === 'publisher'): ?>
                <!-- Opción para publicar productos si es un publicador -->
                <a href="/pages/publish.php" class="btn btn-success mb-3">Publicar Producto</a>
            <?php endif; ?>

            <!-- Lista de productos disponibles -->
            <h3>Productos Disponibles</h3>
            <div id="product-list">
                <!-- Los productos se cargarán dinámicamente con JavaScript -->
            </div>
        </div>
    <?php endif; ?>
</div>
<script>
$(document).ready(function () {
    // Cargar productos disponibles
    $.ajax({
        url: '/api/items.php',
        method: 'GET',
        success: function (response) {
            const productList = $('#product-list');
            productList.empty();

            response.forEach(item => {
                productList.append(`
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">${item.title}</h5>
                            <p class="card-text">${item.description}</p>
                            <p>Precio Inicial: $${item.starting_bid}</p>
                            <p>Última Oferta: $${item.last_bid || 'Sin ofertas'}</p>
                            <form class="bid-form" data-item-id="${item.id}">
                                <input type="number" class="form-control bid-input" placeholder="Tu oferta" required>
                                <button type="submit" class="btn btn-primary mt-2">Ofertar</button>
                            </form>
                        </div>
                    </div>
                `);
            });

            // Manejar ofertas
            $('.bid-form').on('submit', function (e) {
                e.preventDefault();

                const itemId = $(this).data('item-id');
                const amount = $(this).find('.bid-input').val();

                $.ajax({
                    url: '/api/bid.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ item_id: itemId, user_id: <?= $_SESSION['user_id'] ?>, amount }),
                    success: function (response) {
                        alert(response.message);
                        location.reload(); // Recargar la página para actualizar las ofertas
                    },
                    error: function () {
                        alert('Error al realizar la oferta');
                    }
                });
            });
        },
        error: function () {
            alert('Error al cargar los productos');
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>