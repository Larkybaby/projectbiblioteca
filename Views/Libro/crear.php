<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<h2> Nuevo Libro</h2><!--cambiar-->
<form method="POST" action="index.php?controllers=LibroController&action=guardar">
    <div class="mb-3">
        <label class="form-label">Titulo</label><!--columna nombre-->
        <input type="text" class="form-control" name="titulo" required placeholder="Ej: La bella y la bestia">
    </div>
    <div class="mb-3">
        <label class="form-label">Autor</label><!--columna codigo-->
        <input type="text" class="form-control" name="autor" required placeholder="Ej: Gabriel Garcia Marquez">
    </div>
    <div class="mb-3">
        <label class="form-label">Año de publicacion</label><!--columna encargado-->
        <input type="date" class="form-control" name="año_publicacion" required placeholder="Ej: 2023-05-12">
    </div>
    <div class="mb-3">
        <label class="form-label">Editorial</label><!--columna encargado-->
        <input type="text" class="form-control" name="editorial" required placeholder="Ej: Penguin Random House">
    </div>
     <div class="mb-3">
        <label class="form-label">Caegoria</label>
        <select class="form-control" name="categoria" required>
                    <option value="seleccione">seleccione una opcion..</option>
                    <option value="NOVELA">NOVELA</option>
                    <option value="HISTORIA">HISTORIA</option>
                    <option value="CIENCIA">CIENCIA</option>
                    <option value="COMIC">COMIC</option>
                    <option value="MANGA">MANGA</option>
                </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button><!--boton para guardar :D-->
    <a href="index.php?controllers=LibroController&action=index" class="btn btn-secondary">Cancelar</a><!--cambiar-->
</form>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>