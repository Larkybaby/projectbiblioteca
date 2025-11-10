<?php
require_once __DIR__ . '/../Models/PrestamoModel.php';//cambiar
//require_once 'models/FacultadModel.php';

class PrestamoController {//cambiar
    private $Models;

    public function __construct() {
        $this->Models = new PrestamoModel();//cambiar
    }

    // Listar todas las facultades
    public function index() {
        $Prestamos = $this->Models->obtenerPrestamos();//cambiar
        require_once __DIR__ . '/../views/Prestamo/index.php';//cambiar
    }

    // Mostrar formulario de creación
    public function crear() {
        $usuario = $this->Models->obtenerUsuarios();
        require_once __DIR__ . '/../views/Prestamo/crear.php';//cambiar
    }

    // Procesar creación de facultad
    public function guardar() {
        if ($_POST) {
            //campos de crear en modelo
            $id_usuario = $_POST['id_usuario'] ?? null;
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_esperada_retorno = $_POST['fecha_esperada_retorno'];
            $fecha_retorno = $_POST['fecha_retorno'];
            $estado = $_POST['estado'];
            $activo = $_POST['activo'];
            if ($this->Models->crearPrestamo($id_usuario,$fecha_inicio,$fecha_esperada_retorno,$fecha_retorno,$estado,$activo)) {//cambiar
                header("Location: index.php?controller=PrestamoController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=PrestamoController&action=crear&error=1");//cambiar
            }
        }
    }

    // Mostrar formulario de edición
    public function editar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $prestamo = $this->Models->obtenerPrestamo($id);//cambiar
            require_once __DIR__ . '/../views/Prestamo/editar.php';//cambiar
        } else {
            header("Location: index.php?controller=PrestamoController&action=index");//cambiar
        }
    }

    // Procesar actualización
    public function actualizar() {
        if ($_POST) {//campos de editar en modelo
            $id = $_POST['id'];
            $id_usuario = $_POST['id_usuario'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_esperada_retorno = $_POST['fecha_esperada_retorno'];
            $fecha_retorno = $_POST['fecha_retorno'];
            $estado = $_POST['estado'];
            $activo = $_POST['activo'];

            if ($this->Models->actualizarPrestamo($id,$id_usuario,$fecha_inicio,$fecha_esperada_retorno,$fecha_retorno,$estado,$activo)) {//cambiar
                header("Location: index.php?controller=PrestamoController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=PrestamoController&action=editar&id=$id&error=1");//cambiar
            }
        }
    }

    // Eliminar facultad
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            if ($this->Models->eliminarPrestamo($id)) {//cambiar
                header("Location: index.php?controller=PrestamoController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=PrestamoController&action=index&error=1");//cambiar
            }
        }
    }
}
?>