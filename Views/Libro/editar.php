<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="container mt-5">
    <h2>Editar Libro</h2><!--cambiar-->
    <form action="index.php?controllers=LibroController&action=actualizar" method="POST">
        <input type="hidden" name="id" value="<?= $Libro['numero_inventario'] ?>"><!--cambiar-->
        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" 
                   value="<?= $Libro['titulo'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor"
            required
                   value="<?= $Libro['autor'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="año_publicacion" class="form-label">Año de publicacion</label>
            <input type="date" class="form-control" id="año_publicacion" name="año_publicacion" 
                   value="<?= $Libro['año_publicacion'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="editorial" class="form-label">Editorial</label>
            <input type="text" class="form-control" id="editorial" name="editorial" 
                   value="<?= $Libro['editorial'] ?>" required>
        </div> 
        <div class="mb-3">
    <label class="form-label">Categoría</label>
    <select class="form-control" name="categoria" required>
        <option value="">Seleccione una opción...</option>
        <option value="NOVELA" <?= ($Libro['categoria'] == 'NOVELA') ? 'selected' : '' ?>>NOVELA</option>
        <option value="HISTORIA" <?= ($Libro['categoria'] == 'HISTORIA') ? 'selected' : '' ?>>HISTORIA</option>
        <option value="CIENCIA" <?= ($Libro['categoria'] == 'CIENCIA') ? 'selected' : '' ?>>CIENCIA</option>
        <option value="COMIC" <?= ($Libro['categoria'] == 'COMIC') ? 'selected' : '' ?>>COMIC</option>
        <option value="MANGA" <?= ($Libro['categoria'] == 'MANGA') ? 'selected' : '' ?>>MANGA</option>
    </select>
</div>
        

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controllers=LibroController&action=index" class="btn btn-secondary">Cancelar</a><!--cambiar-->
    </form>
</div>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>