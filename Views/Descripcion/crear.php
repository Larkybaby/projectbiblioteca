<?php require_once __DIR__ . '/../Layouts/header.php'; ?>

<h2>Agregar descripción al préstamo</h2>

<?php if (!isset($_POST['cantidad'])): ?>
    <form method="POST">
        <input type="hidden" name="id_prestamo" value="<?= htmlspecialchars($_GET['id_prestamo']) ?>">
        <label for="cantidad" class="form-label">¿Cuántos libros deseas agregar?</label>
        <input type="number" class="form-control" name="cantidad" id="cantidad" min="1" max="10" required>
        <button type="submit" class="btn btn-primary mt-2">Continuar</button>
    </form>

<?php else: ?>
    <?php 
    $cantidad = (int)$_POST['cantidad']; 
    $id_prestamo = $_POST['id_prestamo']; 
    ?>

    <form method="POST" action="index.php?controllers=DescripcionController&action=guardarMultiple">
        <input type="hidden" name="id_prestamo" value="<?= $id_prestamo ?>">
        <input type="hidden" name="cantidad" value="<?= $cantidad ?>">

        <?php for ($i = 1; $i <= $cantidad; $i++): ?>
            <div class="mb-3 border p-3 rounded">
                <h5>Libro <?= $i ?></h5>

                <label>Seleccionar libro</label>
                <select name="numero_inventario[]" class="form-control" required>
                    <option value="">Seleccionar...</option>
                    <?php
                    $libros->data_seek(0);
                    while ($libro = $libros->fetch_assoc()): ?>
                        <option value="<?= $libro['numero_inventario'] ?>">
                            <?= htmlspecialchars($libro['titulo']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label class="mt-2">Nota</label>
                <input type="text" name="nota[]" class="form-control" placeholder="Ej: buen estado">
            </div>
        <?php endfor; ?>

        <button type="submit" class="btn btn-success mt-3">Guardar todo</button>
    </form>
<?php endif; ?>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>