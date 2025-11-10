<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Municipal "Lectura Viva" - MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand { font-weight: bold; }
        .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px 0; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"> Biblioteca Municipal "Lectura Viva"</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php?controllers=UsuarioController&action=index">Usuarios</a>
                <a class="nav-link" href="index.php?controllers=LibroController&action=index">Libros</a>
                <a class="nav-link" href="index.php?controllers=PrestamoController&action=index">Prestamos</a>
                <a class="nav-link" href="index.php?controllers=DescripcionController&action=index">descripcion de prestamos</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Operación realizada bien muy bien </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"> Error al realizar la operación</div>
        <?php endif; ?><!--como funciona este codigo??-->