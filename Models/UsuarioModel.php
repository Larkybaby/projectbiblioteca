<?php
require_once __DIR__ . '/../config/database.php'; //llamo a la base de datos
class UsuarioModel {
    private $db;
    private $table = "USUARIO";

    public function __construct() {
        $database = new Database();
        $this->db = $database-> getConnection();
    }
    //funciones
    public function obtenerUsuarios(){
       $sql =  "SELECT * FROM " .$this->table . " ORDER BY NOMBRE_COMPLETO";
       $result = $this->db->query($sql);
       return $result;
    }
    //funcion para id usuario
    public function obtenerUsuario($id){
        $sql = "SELECT * FROM " . $this->table . " WHERE ID_USUARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //funcion para crear
    public function crearUsuario($nombre_completo,$direccion,$numero_telefonico,$correo){
        $sql = "INSERT INTO " . $this->table . " (nombre_completo,direccion,numero_telefonico,correo) VALUES (?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssis",$nombre_completo,$direccion,$numero_telefonico,$correo);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para editar
    public function actualizarUsuario($id,$nombre_completo,$direccion,$numero_telefonico,$correo){
        $sql ="UPDATE " . $this->table . " SET nombre_completo = ?,direccion = ?,numero_telefonico = ?,correo = ? WHERE ID_USUARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssisi", $nombre_completo, $direccion, $numero_telefonico,$correo, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para eliminar
    public function eliminarUsuario($id){
        $sql = "DELETE FROM " . $this->table . " WHERE ID_USUARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function actualizarTotalPrestamosUsuario($id_usuario) {
    $sql = "UPDATE USUARIO 
            SET total_prestamos = (
                SELECT COUNT(*) FROM PRESTAMO WHERE id_usuario = ?
            )
            WHERE id_usuario = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_usuario);
    $stmt->execute();
}
//actualiza si el usuario tiene un prestamo activo o no
public function actualizarPrestamoActivoUsuario($id_usuario) {
    $sql = "UPDATE USUARIO 
            SET prestamos_activos = (
                CASE 
                    WHEN EXISTS (
                        SELECT 1 FROM PRESTAMO 
                        WHERE id_usuario = ? AND activo = 1
                    ) THEN 1
                    ELSE 0
                END
            )
            WHERE id_usuario = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $id_usuario);
    $stmt->execute();
}

}
