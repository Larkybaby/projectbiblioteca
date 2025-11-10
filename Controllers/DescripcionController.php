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
        require_once __DIR__ . '/../views/Descripcion/crear.php';//cambiar
    }

    // Procesar creación de facultad
    public function guardar() {
        if ($_POST) {
            //campos de crear en modelo
            $numero_inventario = $_POST['numero_inventario'];
            $id_prestamo = $_POST['id_prestamo'];
            
            if ($this->model->crearDescripcion($numero_inventario,$id_prestamo)) {//cambiar
                header("Location: index.php?controller=DescripcionController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=DescripcionController&action=crear&error=1");//cambiar
            }
        }
    }

    // Mostrar formulario de edición
    public function editar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $Descripcion = $this->model->obtenerDescripcion($id);//cambiar
            require_once __DIR__ . '/../views/Descripcion/editar.php';//cambiar
        } else {
            header("Location: index.php?controller=DescripcionController&action=index");//cambiar
        }
    }

    // Procesar actualización
    public function actualizar() {
        if ($_POST) {//campos de editar en modelo
            $id = $_POST['id'];
            $numero_inventario = $_POST['numero_inventario'];
            $id_prestamo = $_POST['id_prestamo'];
            

            if ($this->model->actualizarFacultad($id,$numero_inventario,$id_prestamo)) {//cambiar
                header("Location: index.php?controller=DescripcionController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=DescripcionController&action=editar&id=$id&error=1");//cambiar
            }
        }
    }

    // Eliminar facultad
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            if ($this->model->eliminarDescripcion($id)) {//cambiar
                header("Location: index.php?controller=DescripcionController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=DescripcionController&action=index&error=1");//cambiar
            }
        }
    }
}
?>