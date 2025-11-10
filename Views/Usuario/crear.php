<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<h2> Nuevo Usuario</h2><!--cambiar-->
<form method="POST" action="index.php?controllers=UsuarioController&action=guardar">
    <div class="mb-3">
        <label class="form-label">Nombre completo:</label><!--columna nombre-->
        <input type="text" class="form-control" name="nombre_completo" required placeholder="Ej: Alondra Zuñiga Villalobos">
    </div>
    <div class="mb-3">
        <label class="form-label">direccion:</label><!--columna codigo-->
        <input type="text" class="form-control" name="direccion" required placeholder="Ej: calle san cirilo #42 colonia centro">
    </div>
    <div class="mb-3">
        <label class="form-label">numero telefonico:</label><!--columna encargado-->
        <input type="number" class="form-control" name="numero_telefonico" required placeholder="Ej: 47 47 48 98 47">
    </div>
    <div class="mb-3">
        <label class="form-label">correo</label><!--columna encargado-->
        <input type="text" class="form-control" name="correo" required placeholder="Ej: alo@gmail.com">
    </div>
    <button type="submit" class="btn btn-success">Guardar</button><!--boton para guardar :D-->
    <a href="index.php?controllers=UsuarioController&action=index" class="btn btn-secondary">Cancelar</a><!--cambiar-->
</form>

<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>