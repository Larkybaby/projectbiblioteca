<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Gestión de Prestamos</h2> <!--cambiar--> 
    <a href="index.php?controllers=PrestamoController&action=crear" class="btn btn-primary"> Agregar Prestamo</a><!--este es el boton para agregar--><!--cambiar--> 
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><!--creamos una tabla-->
            <!--cambiar con campos de tabla en db--> 
            <th>ID</th>
            <th>Usuario</th>
            <th>Descripcio</th>
            <th>fecha del prestamo</th>
            <th>fecha esperada de retorno</th>
            <th>fecha real del retorno</th>
            <th>estado actual del prestamo</th>
            <th>activo?</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--cambiar--> 
        <?php while ($Prestamo = $Prestamos->fetch_assoc()): ?><!--este es el ciclo-->
        <tr><!--traemos los datos  las cositas asi $ son variables aqui va--> 
            <td><?= $Prestamo['id_prestamo'] ?></td><!--se llena solito :D-->
            <td><?= $Prestamo['id_usuario'] ?></td><!--cambiar nombre tabla y campo--> 
            <td><?= $Prestamo['id_descripcion'] ?></td>
            <td><?= $Prestamo['fecha_inicio'] ?></td>
            <td><?= $Prestamo['fecha_esperada_retorno'] ?></td>
            <td><?= $Prestamo['fecha_retorno'] ?></td>
            <td><?= $Prestamo['estado'] ?></td>
            <td><?= $Prestamo['activo'] ?></td>
            <td><!--cambiar--> 
                <a href="index.php?controllers=PrestamoController&action=editar&id=<?= $Prestamo['id_prestamo'] ?>"  
                   class="btn btn-warning btn-sm"> Editar</a><!--boton para editar-->
                <a href="index.php?controllers=PrestamoController&action=eliminar&id=<?= $Prestamo['id_prestamo'] ?>"  
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('¿Estás seguro de eliminar este Prestamo?')">Eliminar :c</a><!--confirmacion  de eliminar-->
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>