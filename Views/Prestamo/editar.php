<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<h2> Editar Prestamo</h2><!--cambiar-->
<form action="index.php?controllers=PrestamoController&action=actualizar" method="POST">  
<input type="hidden" name="id" value="<?= $prestamo['id_prestamo'] ?? '' ?>">    
<div class="mb-3">
    <label class="form-label">Usuario</label>
    <select class="form-control" name="id_usuario" required>
        <option value="">Seleccionar usuario...</option>
        <?php while ($usuario = $usuarios->fetch_assoc()): ?>
            <option value="<?= $usuario['id_usuario'] ?>"
                <?= ($usuario['id_usuario'] == $prestamo['id_usuario']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($usuario['nombre_completo']) ?> - <?= htmlspecialchars($usuario['correo']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>
    <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha en que se hizo el préstamo</label>
            <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                   value="<?= $prestamo['fecha_inicio'] ?>" required>
        </div> 
    
    <div class="mb-3">
        <label class="form-label">Fecha límite para devolverlo</label>
        <input type="date" class="form-control" name="fecha_esperada_retorno" 
        value="<?= $prestamo['fecha_esperada_retorno'] ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Fecha de retorno</label>
        <input type="date" class="form-control" name="fecha_retorno"
        value="<?= $prestamo['fecha_retorno'] ?>" >
    </div>
    
    <div class="mb-3">
        <label class="form-label">Estado del préstamo</label>
        <select class="form-control" name="estado" required>
            <option value="">-- Seleccionar --</option>
            <option value="vigente" <?= ($prestamo['estado'] == 'vigente') ? 'selected' : '' ?>>vigente</option>
            <option value="devuelto" <?= ($prestamo['estado'] == 'devuelto') ? 'selected' : '' ?>>Devuelto</option>
            <option value="retrasado" <?= ($prestamo['estado'] == 'retrasado') ? 'selected' : '' ?>>Retrasado</option>
        </select>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Activo</label>
        <select class="form-control" name="activo" required>
            <option value="">-- Seleccionar --</option>
            <option value="1" <?= ($prestamo['activo'] == '1') ? 'selected' : '' ?>>Sí</option>
            <option value="0" <?= ($prestamo['activo'] == '0') ? 'selected' : '' ?>>No</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php?controllers=PrestamoController&action=index" class="btn btn-secondary">Cancelar</a><!--cambiar-->
</form>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>