<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Gestión de Descripciones</h2> <!--cambiar--> 
    <a href="index.php?controller=DescripcionController&action=crear" class="btn btn-primary"> Agregar Descripcion</a><!--este es el boton para agregar--><!--cambiar--> 
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><!--creamos una tabla-->
            <!--cambiar con campos de tabla en db--> 
            <th>ID</th>
            <th>libros</th>
            <th>prestamo al que pertenece</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--cambiar--> 
        <?php while ($Descripcion = $Descripcions->fetch_assoc()): ?><!--este es el ciclo-->
        <tr><!--traemos los datos  las cositas asi $ son variables aqui va--> 
            <td><?= $Descripcion['id_descripcion'] ?></td><!--se llena solito :D-->
            <td><?= $Descripcion['numero_inventario'] ?></td><!--cambiar nombre tabla y campo--> 
            <td><?= $Descripcion['id_prestamo'] ?></td>
            <td><!--cambiar--> 
                <a href="index.php?controller=DescripcionController&action=editar&id=<?= $Descripcion['id_Descripcion'] ?>"  
                   class="btn btn-warning btn-sm"> Editar</a><!--boton para editar-->
                <a href="index.php?controller=DescripcionController&action=eliminar&id=<?= $Descripcion['id_Descripcion'] ?>"  
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('¿Estás seguro de eliminar este Descripcion?')">Eliminar :c</a><!--confirmacion  de eliminar-->
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>