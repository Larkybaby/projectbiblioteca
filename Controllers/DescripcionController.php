<?php
require_once __DIR__ . '/../Models/DescripcionModel.php';//cambiar
//require_once 'models/FacultadModel.php';

class DescripcionController {//cambiar
    private $Models;

    public function __construct() {
        $this->Models = new DescripcionModel();//cambiar
    }

    // Listar todas las facultades
    public function index() {
        $Descripcions = $this->Models->obtenerDescripciones();//cambiar
        require_once __DIR__ . '/../views/Descripcion/index.php';//cambiar
    }

    // Mostrar formulario de creación
    public function crear() {
        $libros = $this->Models->obtenerLibros();
        //$prestamos = $this->Models->obtenerPrestamos();
        $id_prestamo = $_GET['id_prestamo'] ?? null;
        require_once __DIR__ . '/../views/Descripcion/crear.php';//cambiar
    }

    // Procesar creación de facultad
    public function guardar() {
        if ($_POST) {
            //campos de crear en modelo
            $numero_inventario = $_POST['numero_inventario'];
            $id_prestamo = $_POST['id_prestamo'];
            $nota = $_POST['nota'];
            
            if ($this->Models->crearDescripcion($numero_inventario,$id_prestamo,$nota)) {//cambiar
                header("Location: index.php?controllers=DescripcionController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controllers=DescripcionController&action=crear&error=1");//cambiar
            }
        }
    }

    // Mostrar formulario de edición
    public function editar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $descripcion = $this->Models->obtenerDescripcion($id);//cambiar
            $libros = $this->Models->obtenerLibros();
            require_once __DIR__ . '/../views/Descripcion/editar.php';//cambiar
        } else {
            header("Location: index.php?controllers=DescripcionController&action=index");//cambiar
        }
    }

    // Procesar actualización
    public function actualizar() {
        if ($_POST) {
            $id = $_POST['id'] ?? null;
            $numero_inventario = $_POST['numero_inventario'] ?? null;
            $id_prestamo = $_POST['id_prestamo'] ?? null;
            $nota = $_POST['nota'] ?? '';

            if ($this->Models->editarDescripcion($id, $numero_inventario, $id_prestamo, $nota)) {
                header("Location: index.php?controllers=DescripcionController&action=index&success=1");
                exit;
            } else {
                header("Location: index.php?controllers=DescripcionController&action=editar&id=$id&error=1");
                exit;
            }
        }
    }

    // Eliminar facultad
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            if ($this->Models->eliminarDescripcion($id)) {//cambiar
                header("Location: index.php?controllers=DescripcionController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controllers=DescripcionController&action=index&error=1");//cambiar
            }
        }
    }
    public function guardarMultiple() {
    if ($_POST) {
        $id_prestamo = $_POST['id_prestamo'];
        $numeros_inventario = $_POST['numero_inventario'];
        $notas = $_POST['nota'];

        for ($i = 0; $i < count($numeros_inventario); $i++) {
            $num = $numeros_inventario[$i];
            $nota = $notas[$i] ?? null;

            if (!empty($num)) {
                $this->Models->crearDescripcion($num, $id_prestamo, $nota);
            }
        }

        header("Location: index.php?controllers=PrestamoController&action=index&success=1");
        exit();
    }
}
}
?>