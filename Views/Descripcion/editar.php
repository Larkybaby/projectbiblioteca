<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<h2>Editar Descripción de Préstamo</h2>

<form method="POST" action="index.php?controllers=DescripcionController&action=actualizar">
<input type="hidden" name="id" value="<?= $descripcion['id_descripcion'] ?>">    
<div class="mb-3">
    <label class="form-label">Libro</label>
    <select name="numero_inventario" class="form-control" required>
        <option value="">Seleccionar libro...</option>
        <?php while ($libro = $libros->fetch_assoc()): ?>
            <option value="<?= $libro['numero_inventario'] ?>"
                <?= ($libro['numero_inventario'] == $descripcion['numero_inventario']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($libro['titulo']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>

    <div class="mb-3">
        <label class="form-label">Préstamo id</label>
       <p class="form-control-plaintext"><strong><?= $descripcion['id_prestamo'] ?></strong></p>
    </div>
    <div class="mb-3">
            <label for="nota" class="form-label">Nota(opcional)</label>
            <input type="text" class="form-control" id="nota" name="nota" 
                   value="<?= $descripcion['nota'] ?>">
        </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?controllers=DescripcionController&action=index" class="btn btn-secondary">Cancelar</a>
</form>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>