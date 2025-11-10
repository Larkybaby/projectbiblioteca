<?php
// Front Controller - Maneja todas las rutas
session_start();

// Cargar automáticamente los controladores
function cargarControlador($controllers) {
    $controllerFile = '../controllers/' . $controllers . '.php';
    if (file_exists($controllerFile)) { // <-- corregido aquí
        require_once $controllerFile;   // <-- corregido aquí
        return new $controllers();
    }
    return null;
}

// Obtener controller y action de la URL
$controllerName = $_GET['controllers'] ?? 'UsuarioController';
$action = $_GET['action'] ?? 'index';

// Cargar el controlador
$controller = cargarControlador($controllerName);

if ($controller && method_exists($controller, $action)) {
    $controller->$action();
} else {
    // Página de error 404
    http_response_code(404);
    echo "<h1>Error 404 - Página no encontrada</h1>";
    echo "<p>El controlador o acción solicitada no existe.</p>";
}
?>