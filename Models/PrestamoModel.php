<?php
require_once __DIR__ . '/../config/database.php'; //llamo a la base de datos
class PrestamoModel {
    private $db;
    private $table = "PRESTAMO";

    public function __construct() {
        $database = new Database();
        $this->db = $database-> getConnection();
    }
    //funciones
    public function obtenerPrestamos(){
       $sql =  "SELECT * FROM " .$this->table . " ORDER BY FECHA_ESPERADA_RETORNO";
       $result = $this->db->query($sql);
       return $result;
    }
    //funcion para id usuario
    public function obtenerPrestamo($id){
        $sql = "SELECT * FROM " . $this->table . "WHERE ID_Prestamo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //funcion para crear
    public function crearPrestamo($id_usuario,$fecha_inicio,$fecha_esperada_retorno,$fecha_retorno,$estado,$activo){
        $sql = "INSERT INTO " . $this->table . " (id_usuario,fecha_inicio,fecha_esperada_retorno,fecha_retorno,estado,activo) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isssss",$id_usuario,$fecha_inicio,$fecha_esperada_retorno,$fecha_retorno,$estado,$activo);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para editar
     public function editarPrestamo($id, $id_usuario, $fecha_inicio, $fecha_esperada_retorno, $fecha_retorno, $estado, $activo){
        $sql = "UPDATE " . $this->table . " SET id_usuario = ?, fecha_inicio = ?, fecha_esperada_retorno = ?, fecha_retorno = ?, estado = ?, activo = ? WHERE ID_PRESTAMO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isssssi", $id_usuario, $fecha_inicio, $fecha_esperada_retorno, $fecha_retorno, $estado, $activo, $id);
        return $stmt->execute();
    }
    //funcion para eliminar
    public function eliminarPrestamo($id){
        $sql = "DELETE FROM " . $this->table . " WHERE ID_PRESTAMO= ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}