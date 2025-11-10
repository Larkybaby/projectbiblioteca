<?php
class Database {
//variables privadas solo disponibles en la propia clase
private $host = "localhost";//elhost
private $user = "root";//usuario
private $password = "";
private $base_datos ="dos";
private $conn;
//funcion publica
  public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->base_datos);
            $this->conn->set_charset("utf8");
            
            if ($this->conn->connect_error) {
                throw new Exception("Error de conexión: " . $this->conn->connect_error);//mensaje de error de coneccion
            }
        } catch (Exception $e) {
            die("Error de base de datos: " . $e->getMessage());//mensaje en caso de error
        }
        return $this->conn;
    }
}
?>