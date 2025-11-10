<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="container mt-5">
    <h2>Editar Facultad</h2>
    <form action="index.php?controller=FacultadController&action=actualizar" method="POST">
        <input type="hidden" name="id" value="<?= $Usuario['id_usuario'] ?>"><!--cambiar-->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" 
                   value="<?= $facultad['nombre'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="codigo" class="form-label">Direccion</label>
            <input type="text" class="form-control" id="codigo" name="codigo"
            required maxlength="10" 
                   value="<?= $facultad['codigo'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="encargado" class="form-label">numero telefonico</label>
            <input type="text" class="form-control" id="encargado" name="encargado" 
                   value="<?= $facultad['encargado'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="encargado" class="form-label">numero telefonico</label>
            <input type="text" class="form-control" id="encargado" name="encargado" 
                   value="<?= $facultad['encargado'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?controller=UsuarioController&action=index" class="btn btn-secondary">Cancelar</a><!--cambiar-->
    </form>
</div>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>