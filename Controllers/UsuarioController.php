<?php
require_once __DIR__ . '/../Models/UsuarioModel.php';//cambiar
//require_once 'models/FacultadModel.php';

class UsuarioController {//cambiar
    private $Models;

    public function __construct() {
        $this->Models = new UsuarioModel();//cambiar
    }

    // Listar todas las facultades
    public function index() {
        $Usuarios = $this->Models->obtenerUsuarios();//cambiar
        require_once __DIR__ . '/../views/Usuario/index.php';//cambiar
    }

    // Mostrar formulario de creación
    public function crear() {
        require_once __DIR__ . '/../views/Usuario/crear.php';//cambiar
    }

    // Procesar creación de facultad
    public function guardar() {
        if ($_POST) {
            //campos de crear en modelo
            $nombre_completo = $_POST['nombre_completo'];
            $direccion = $_POST['direccion'];
            $numero_telefonico = $_POST['numero_telefonico'];
            $correo = $_POST['correo'];
            if ($this->Models->crearUsuario($nombre_completo,$direccion,$numero_telefonico,$correo)) {//cambiar
                header("Location: index.php?controllers=UsuarioController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controllers=UsuarioController&action=crear&error=1");//cambiar
            }
        }
    }

    // Mostrar formulario de edición
    public function editar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $usuario = $this->Models->obtenerUsuario($id);//cambiar
            require_once __DIR__ . '/../views/Usuario/editar.php';//cambiar
        } else {
            header("Location: index.php?controller=UsuarioController&action=index");//cambiar
        }
    }

    // Procesar actualización
    public function actualizar() {
        if ($_POST) {//campos de editar en modelo
            $id = $_POST['id'];
            $nombre_completo = $_POST['nombre_completo'];
            $direccion = $_POST['direccion'];
            $numero_telefonico = $_POST['numero_telefonico'];
            $correo = $_POST['correo'];

            if ($this->Models->actualizarUsuario($id,$nombre_completo,$direccion,$numero_telefonico,$correo)) {//cambiar
                header("Location: index.php?controllers=UsuarioController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controllers=UsuarioController&action=editar&id=$id&error=1");//cambiar
            }
        }
    }

    // Eliminar facultad
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            if ($this->Models->eliminarUsuario($id)) {//cambiar
                header("Location: index.php?controller=UsuarioController&action=index&success=1");//cambiar
            } else {
                header("Location: index.php?controller=UsuarioController&action=index&error=1");//cambiar
            }
        }
    }
    
}
?>