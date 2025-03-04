<?php
include '../includes/header.php';
?>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<div class="container">
    <h2>Publicar Producto</h2>
    <form id="publishForm">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select class="form-select" id="category" required>
                <option value="car">Auto</option>
                <option value="part">Autoparte</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="starting_bid" class="form-label">Precio Inicial</label>
            <input type="number" class="form-control" id="starting_bid" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="min_increment" class="form-label">Incremento Mínimo</label>
            <input type="number" class="form-control" id="min_increment" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" required>
        </div>
        



<div class="container">
    <h2>Subir Imagen</h2>
    <input type="file" class="filepond" name="image" />
</div>
<button type="submit" class="btn btn-success">Publicar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#publishForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('user_id', <?= $_SESSION['user_id'] ?>);
        formData.append('title', $('#title').val());
        formData.append('description', $('#description').val());
        formData.append('category', $('#category').val());
        formData.append('starting_bid', $('#starting_bid').val());
        formData.append('min_increment', $('#min_increment').val());
        formData.append('image', $('#image')[0].files[0]);

        $.ajax({
            url: '/api/publish.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert(response.message);
                window.location.href = '/pages/index.php';
            },
            error: function () {
                alert('Error al publicar el producto');
            }
        });
    });
</script>


<script>
    FilePond.create(document.querySelector('.filepond'), {
        server: '/api/upload.php'
    });
</script>

<?php
include '../includes/footer.php';
?>