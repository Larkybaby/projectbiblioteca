<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<h2> Nuevo Prestamo</h2><!--cambiar-->
<form method="POST" action="index.php?controllers=PrestamoController&action=guardar">  
    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <select class="form-control" name="id_usuario" required>
            <option value="">Seleccionar usuario...</option>
            <?php while ($Usuario = $Usuarios->fetch_assoc()): ?>
                <option value="<?= $Usuario['id_usuario'] ?>">
                    <?= $Usuario['nombre_completo'] ?> - <?= $Usuario['correo'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Fecha en que se hizo el préstamo</label>
        <input type="date" class="form-control" name="fecha_inicio" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Fecha límite para devolverlo</label>
        <input type="date" class="form-control" name="fecha_esperada_retorno" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Fecha de retorno</label>
        <input type="date" class="form-control" name="fecha_retorno">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Estado del préstamo</label>
        <select class="form-control" name="estado" required>
            <option value="">-- Seleccionar --</option>
            <option value="activo">Activo</option>
            <option value="devuelto">Devuelto</option>
            <option value="retrasado">Retrasado</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Activo</label>
        <select class="form-control" name="activo" required>
            <option value="">-- Seleccionar --</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?controllers=PrestamoController&action=index" class="btn btn-secondary">Cancelar</a>
</form>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>