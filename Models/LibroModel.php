<?php
require_once __DIR__ . '/../config/database.php'; //llamo a la base de datos
class LibroModel {
    private $db;
    private $table = "LIBRO";

    public function __construct() {
        $database = new Database();
        $this->db = $database-> getConnection();
    }
    //funciones
    public function obtenerLibros(){
       $sql =  "SELECT * FROM " .$this->table . " ORDER BY TITULO";
       $result = $this->db->query($sql);
       return $result;
    }
    //funcion para id usuario
    public function obtenerLibro($id){
        $sql = "SELECT * FROM " . $this->table . "WHERE NUMERO_INVENTARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    //funcion para crear
    public function crearLibro($titulo,$autor,$año_publicacion,$editorial,$categoria){
        $sql = "INSERT INTO " . $this->table . " (titulo,autor,año_publicacion,editorial,categoria) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssss",$titulo,$autor,$año_publicacion,$editorial,$categoria);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para editar
    public function editarLibro($id,$titulo,$autor,$año_publicacion,$editorial,$categoria){
        $sql ="UPDATE " . $this->table . " SET titulo = ?,autor= ?,año_publicacion = ?,editorial = ?, categoria = ?, WHERE NUMERO_INVENTARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssi", $titulo,$autor,$año_publicacion,$editorial,$categoria,$id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para eliminar
    public function eliminarLibro($id){
        $sql = "DELETE FROM " . $this->table . " WHERE NUMERO_INVENTARIO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}