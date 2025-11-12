<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="container mt-5">
    <h2>Editar Usuario</h2><!--cambiar-->
    <form action="index.php?controller=UsuarioController&action=actualizar" method="POST">
        <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>"><!--cambiar-->
        <div class="mb-3">
            <label for="nombre_completo" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" 
                   value="<?= $usuario['nombre_completo'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion"
            required
                   value="<?= $usuario['direccion'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="numero_telefonico" class="form-label">numero telefonico</label>
            <input type="number" class="form-control" id="numero_telefonico" name="numero_telefonico" 
                   value="<?= $usuario['numero_telefonico'] ?>" required min="1000000000" max="9999999999">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="text" class="form-control" id="correo" name="correo" 
                   value="<?= $usuario['correo'] ?>" required>
</div>
        

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controller=UsuarioController&action=index" class="btn btn-secondary">Cancelar</a><!--cambiar-->
    </form>
</div>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>