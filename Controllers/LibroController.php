
<?php
require_once __DIR__ . '/../Models/LibroModel.php';

class LibroController {
    private $Models;

    public function __construct() {
        $this->Models = new LibroModel();
    }

    // Listar todos los libros
    public function index() {
        // Antes: $facultades = $this->Models->obtenerLibros();
        // La vista espera $Libros, así que la definimos aquí:
        $Libros = $this->Models->obtenerLibros();
        require_once __DIR__ . '/../Views/Libro/index.php';
    }

    // Mostrar formulario de creación
    public function crear() {
        require_once __DIR__ . '/../Views/Libro/crear.php';
    }

    // Procesar creación
    public function guardar() {
        if ($_POST) {
            $titulo = $_POST['titulo'] ?? '';
            $autor = $_POST['autor'] ?? '';
            $año_publicacion = $_POST['año_publicacion'] ?? '';
            $editorial = $_POST['editorial'] ?? '';
            $categoria = $_POST['categoria'] ?? '';

            if ($this->Models->crearLibro($titulo, $autor, $año_publicacion, $editorial, $categoria)) {
                header("Location: index.php?controllers=LibroController&action=index&success=1");
                exit;
            } else {
                header("Location: index.php?controllers=LibroController&action=crear&error=1");
                exit;
            }
        }
    }

    // Mostrar formulario de edición
    public function editar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $Libro = $this->Models->obtenerLibro($id);
            require_once __DIR__ . '/../Views/Libro/editar.php';
        } else {
            header("Location: index.php?controllers=LibroController&action=index");
            exit;
        }
    }

    // Procesar actualización
    public function actualizar() {
        if ($_POST) {
            $id = $_POST['id'] ?? null;
            $titulo = $_POST['titulo'] ?? '';
            $autor = $_POST['autor'] ?? '';
            $año_publicacion = $_POST['año_publicacion'] ?? '';
            $editorial = $_POST['editorial'] ?? '';
            $categoria = $_POST['categoria'] ?? '';

            // Llamar al método correcto del modelo
            if ($this->Models->actualizarLibro($id, $titulo, $autor, $año_publicacion, $editorial, $categoria)) {
                header("Location: index.php?controllers=LibroController&action=index&success=1");
                exit;
            } else {
                header("Location: index.php?controllers=LibroController&action=editar&id=$id&error=1");
                exit;
            }
        }
    }

    // Eliminar
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            if ($this->Models->eliminarLibro($id)) {
                header("Location: index.php?controllers=LibroController&action=index&success=1");
                exit;
            } else {
                header("Location: index.php?controllers=LibroController&action=index&error=1");
                exit;
            }
        }
    }
}
?>