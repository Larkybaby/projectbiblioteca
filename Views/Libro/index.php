<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Gestión de Libros</h2> <!--cambiar--> 
    <a href="index.php?controllers=LibroController&action=crear" class="btn btn-primary"> Agregar Libro</a><!--este es el boton para agregar--><!--cambiar--> 
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><!--creamos una tabla-->
            <!--cambiar con campos de tabla en db--> 
            <th>ID</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Año de publicacion</th>
            <th>Editorial</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--cambiar--> 
        <?php while ($Libro = $Libros->fetch_assoc()): ?><!--este es el ciclo-->
        <tr><!--traemos los datos  las cositas asi $ son variables aqui va--> 
            <td><?= $Libro['numero_inventario'] ?></td><!--se llena solito :D-->
            <td><?= $Libro['titulo'] ?></td><!--cambiar nombre tabla y campo--> 
            <td><?= $Libro['autor'] ?></td>
            <td><?= $Libro['año_publicacion'] ?></td>
            <td><?= $Libro['editorial'] ?></td>
            <td><?= $Libro['categoria'] ?></td>
            <td><!--cambiar--> 
                <a href="index.php?controllers=LibroController&action=editar&id=<?= $Libro['numero_inventario'] ?>"  
                   class="btn btn-warning btn-sm"> Editar</a><!--boton para editar-->
                <a href="index.php?controllers=LibroController&action=eliminar&id=<?= $Libro['numero_inventario'] ?>"  
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('¿Estás seguro de eliminar este Libro?')">Eliminar :c</a><!--confirmacion  de eliminar-->
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>