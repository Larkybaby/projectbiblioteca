<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Gestión de Usuarios</h2> <!--cambiar--> 
    <a href="index.php?controller=UsuarioController&action=crear" class="btn btn-primary"> Agregar Usuario</a><!--este es el boton para agregar--><!--cambiar--> 
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><!--creamos una tabla-->
            <!--cambiar con campos de tabla en db--> 
            <th>ID</th>
            <th>Nombre</th>
            <th>direccion</th>
            <th>Numero telefonico</th>
            <th>correo</th>
            <th>prestamos activos</th>
            <th>total de prestamos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--cambiar--> 
        <?php while ($Usuario = $Usuarios->fetch_assoc()): ?><!--este es el ciclo-->
        <tr><!--traemos los datos  las cositas asi $ son variables aqui va--> 
            <td><?= $Usuario['id_usuario'] ?></td><!--se llena solito :D-->
            <td><?= $Usuario['nombre_completo'] ?></td><!--cambiar nombre tabla y campo--> 
            <td><?= $Usuario['direccion'] ?></td>
            <td><?= $Usuario['numero_telefonico'] ?></td>
            <td><?= $Usuario['correo'] ?></td>
            <td><?= $Usuario['prestamos_activos'] ? 'Sí' : 'No' ?></td>
            <td><?= $Usuario['total_prestamos'] ?></td>
            <td><!--cambiar--> 
                <a href="index.php?controller=UsuarioController&action=editar&id=<?= $Usuario['id_usuario'] ?>"  
                   class="btn btn-warning btn-sm"> Editar</a><!--boton para editar-->
                <a href="index.php?controller=UsuarioController&action=eliminar&id=<?= $Usuario['id_usuario'] ?>"  
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('¿Estás seguro de eliminar este Usuario?')">Eliminar :c</a><!--confirmacion  de eliminar-->
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>