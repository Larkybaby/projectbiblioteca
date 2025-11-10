<?php
require_once __DIR__ . '/../config/database.php'; //llamo a la base de datos
class DescripcionModel {
    private $db;
    private $table = "PRESTAMO_DESCRIPCION";

    public function __construct() {
        $database = new Database();
        $this->db = $database-> getConnection();
    }
    //funciones
    public function obtenerDescripciones(){
       $sql =  "SELECT * FROM " .$this->table . " ORDER BY ID_PRESTAMO";
       $result = $this->db->query($sql);
       return $result;
    }
    //funcion para id usuario
    public function obtenerDescripcion($id){
        $sql = "SELECT * FROM " . $this->table . " WHERE ID_DESCRIPCION = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //funcion para crear
    public function crearLibro($numero_inventario,$id_prestamo){
        $sql = "INSERT INTO " . $this->table . " (numero_inventario,id_prestamo) VALUES (?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss",$numero_inventario,$id_prestamo);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para editar
    public function editarLibro($id,$numero_inventario,$id_prestamo){
        $sql ="UPDATE " . $this->table . " SET numero_inventario = ?,id_prestamo = ?, WHERE ID_DESCRIPCION= ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iii", $numero_inventario,$id_prestamo,$id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para eliminar
    public function eliminarLibro($id){
        $sql = "DELETE FROM " . $this->table . "WHERE id_descripcion = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}