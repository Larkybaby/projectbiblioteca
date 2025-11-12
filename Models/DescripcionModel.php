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
       /*$sql = "SELECT d.id_descripcion, 
                        d.nota, 
                       l.titulo AS libro, 
                       p.id_prestamo
                FROM " . $this->table . " d
                INNER JOIN libro l ON d.numero_inventario = l.numero_inventario
                INNER JOIN prestamo p ON d.id_prestamo = p.id_prestamo
                ORDER BY d.id_descripcion";*/
        $sql = "SELECT d.id_descripcion, 
             l.titulo AS titulo_libro, 
            p.id_prestamo,
            d.nota
            FROM prestamo_descripcion d
            INNER JOIN libro l ON d.numero_inventario = l.numero_inventario
            INNER JOIN prestamo p ON d.id_prestamo = p.id_prestamo
            ORDER BY d.id_descripcion";
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
    public function crearDescripcion($numero_inventario,$id_prestamo,$nota){
        $sql = "INSERT INTO " . $this->table . " (numero_inventario,id_prestamo,nota) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis",$numero_inventario,$id_prestamo,$nota);
        if ($stmt->execute()) {
            //return true;
            return $this->db->insert_id;
        }
        return false;
    }
    //funcion para editar
   public function editarDescripcion($id, $numero_inventario, $id_prestamo, $nota){
        $sql ="UPDATE " . $this->table . " SET numero_inventario = ?, id_prestamo = ?, nota = ? WHERE ID_DESCRIPCION = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            error_log("Prepare editarDescripcion failed: " . $this->db->error);
            return false;
        }
        // tipos: numero_inventario (i), id_prestamo (i), nota (s), id (i)
        $stmt->bind_param("iisi", $numero_inventario, $id_prestamo, $nota, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //funcion para eliminar
    public function eliminarDescripcion($id){
        $sql = "DELETE FROM " . $this->table . " WHERE id_descripcion = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //obtener listas para selects
    public function obtenerLibros() {
        $sql = "SELECT numero_inventario, titulo FROM libro ORDER BY titulo";
        return $this->db->query($sql);

}
 public function obtenerPrestamos() {
        $sql = "SELECT id_prestamo FROM prestamo ORDER BY id_prestamo";
        return $this->db->query($sql);
    }
}