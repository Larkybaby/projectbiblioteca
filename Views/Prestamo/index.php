<?php require_once __DIR__ . '/../Layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2> Gestión de Prestamos</h2> <!--cambiar--> 
    <a href="index.php?controllers=PrestamoController&action=crear" class="btn btn-primary"> Agregar Prestamo</a><!--este es el boton para agregar--><!--cambiar--> 
</div>
<div>
    <h3>Libros mas prestados</h3>
    <table class="table table-striped table-hover">
    <tr>
        <th>Posición</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Veces prestado</th>
    </tr>

    <?php 
    $posicion = 1; 
    foreach ($toplibros as $libro): 
    ?>
    <tr>
        <td><?= $posicion ?></td>
        <td><?= htmlspecialchars($libro['titulo']) ?></td>
        <td><?= htmlspecialchars($libro['autor']) ?></td>
        <td><?= htmlspecialchars($libro['veces_prestado']) ?></td>
    </tr>
    <?php 
        $posicion++; 
    endforeach; 
    ?>
</table>
</div>
<br><br>
<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><!--creamos una tabla-->
            <!--cambiar con campos de tabla en db--> 
            <th>ID</th>
            <th>Usuario</th>
            <th>fecha del prestamo</th>
            <th>fecha esperada de retorno</th>
            <th>fecha real del retorno</th>
            <th>estado actual del prestamo</th>
            <th>activo?</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--cambiar--> 
        <?php while ($Prestamo = $Prestamos->fetch_assoc()): ?><!--este es el ciclo-->
        <tr><!--traemos los datos  las cositas asi $ son variables aqui va--> 
            <td><?= $Prestamo['id_prestamo'] ?></td><!--se llena solito :D-->
            <td><?= $Prestamo['id_usuario'] ?></td><!--cambiar nombre tabla y campo--> 
            <td><?= $Prestamo['fecha_inicio'] ?></td>
            <td><?= $Prestamo['fecha_esperada_retorno'] ?></td>
            <td><?= $Prestamo['fecha_retorno'] ?></td>
            <td><?= $Prestamo['estado'] ?></td>
            <td><?= $Prestamo['activo'] ? 'Sí' : 'No' ?></td>
            <td><?= !empty($Prestamo['libros']) ? htmlspecialchars($Prestamo['libros']) : 'Sin libros' ?></td>
            <td><!--cambiar--> 
                <a href="index.php?controllers=PrestamoController&action=editar&id=<?= $Prestamo['id_prestamo'] ?>"  
                   class="btn btn-warning btn-sm"> Editar</a><!--boton para editar-->
                <a href="index.php?controllers=PrestamoController&action=eliminar&id=<?= $Prestamo['id_prestamo'] ?>"  
                   class="btn btn-danger btn-sm" 
                   onclick="return confirm('¿Estás seguro de eliminar este Prestamo?')">Eliminar :c</a><!--confirmacion  de eliminar-->
                <a href="index.php?controllers=DescripcionController&action=crear&id_prestamo=<?= $Prestamo['id_prestamo'] ?>" 
                   class="btn btn-sm btn-success">
                 Agregar Libro
                </a>            
                </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../Layouts/footer.php'; ?>