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
    /*public function obtenerPrestamos(){
       $sql = "SELECT p.*, u.nombre_completo as UsuarioNombre
                FROM " . $this->table . " p
                JOIN usuario u ON p.id_usuario = u.id_usuario 
                ORDER BY u.nombre_completo";
       $result = $this->db->query($sql);
       return $result;
    }*/
    //funcion para id usuario
    public function obtenerPrestamo($id){
        $sql = "SELECT p.*, u.nombre_completo as UsuarioNombre
                FROM " . $this->table . " p
                JOIN usuario u ON p.id_usuario = u.id_usuario 
                WHERE p.id_prestamo = ?";
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
    $insert_id = $this->db->insert_id;

    // Actualizar el total de préstamos del usuario
    require_once __DIR__ . '/UsuarioModel.php';
    $usuarioModel = new UsuarioModel();
    $usuarioModel->actualizarTotalPrestamosUsuario($id_usuario);
    $usuarioModel->actualizarPrestamoActivoUsuario($id_usuario);

    return $insert_id;
}
        return false;
    }
    //funcion para editar
     public function actualizarPrestamo($id, $id_usuario, $fecha_inicio, $fecha_esperada_retorno, $fecha_retorno, $estado, $activo){
        $sql = "UPDATE " . $this->table . " SET id_usuario = ?, fecha_inicio = ?, fecha_esperada_retorno = ?, fecha_retorno = ?, estado = ?, activo = ? WHERE ID_PRESTAMO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isssssi", $id_usuario, $fecha_inicio, $fecha_esperada_retorno, $fecha_retorno, $estado, $activo, $id);
        $resultado = $stmt->execute();

    if ($resultado) {
    require_once __DIR__ . '/UsuarioModel.php';
    $usuarioModel = new UsuarioModel();
    $usuarioModel->actualizarTotalPrestamosUsuario($id_usuario);
    $usuarioModel->actualizarPrestamoActivoUsuario($id_usuario);
}

    return $resultado;
}
    //funcion para eliminar(si se elimina el prestamo se debe eliminar la descripcion)
    public function eliminarPrestamo($id_prestamo) {
        // Primero eliminamos las descripciones asociadas al préstamo
        $sql_desc = "DELETE FROM PRESTAMO_DESCRIPCION WHERE id_prestamo = ?";
        $stmt_desc = $this->db->prepare($sql_desc);
        $stmt_desc->bind_param("i", $id_prestamo);
        $stmt_desc->execute();

        // Luego obtenemos el ID del usuario al que pertenece el préstamo
        $sql = "SELECT id_usuario FROM PRESTAMO WHERE id_prestamo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_prestamo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_usuario = $row['id_usuario'];

            // Eliminamos el préstamo
            $sql_delete = "DELETE FROM PRESTAMO WHERE id_prestamo = ?";
            $stmt_delete = $this->db->prepare($sql_delete);
            $stmt_delete->bind_param("i", $id_prestamo);
            $resultado = $stmt_delete->execute();

            // Si se eliminó correctamente, actualizamos el usuario
            if ($resultado) {
                require_once __DIR__ . '/UsuarioModel.php';
                $usuarioModel = new UsuarioModel();
                $usuarioModel->actualizarTotalPrestamosUsuario($id_usuario);
                $usuarioModel->actualizarPrestamoActivoUsuario($id_usuario);
            }

            return $resultado;
        }

        return false; // Si no se encontró el préstamo
    }
    //encontrar por usuarios
    public function obtenerUsuarios() {
    $sql = "SELECT u.id_usuario, u.nombre_completo, u.correo
            FROM USUARIO u 
            ORDER BY u.nombre_completo";
    $result = $this->db->query($sql);
    return $result;
}
//para mostrar los libros
public function obtenerLibrosPorPrestamo($id_prestamo) {
    $sql = "SELECT l.titulo 
            FROM prestamo_descripcion d
            INNER JOIN libro l ON d.numero_inventario = l.numero_inventario
            WHERE d.id_prestamo = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $id_prestamo);
    $stmt->execute();
    return $stmt->get_result();
}
//funcion para mostrar los libros de el prestamo
public function obtenerPrestamosConLibros() {
    $sql = "SELECT 
                p.*,
                COALESCE(GROUP_CONCAT(DISTINCT l.titulo ORDER BY l.titulo SEPARATOR ', '), '') AS libros
            FROM PRESTAMO p
            LEFT JOIN PRESTAMO_DESCRIPCION d ON p.id_prestamo = d.id_prestamo
            LEFT JOIN LIBRO l ON d.numero_inventario = l.numero_inventario
            GROUP BY p.id_prestamo
            ORDER BY p.id_prestamo DESC";

    $result = $this->db->query($sql);
    if (!$result) {
        // depuración si falla la consulta SQL
        throw new Exception("Error SQL obtenerPrestamosConLibros: " . $this->db->error);
    }
    return $result;
}
//top 5 libros mas prestados
 public function topLibros() {
    $sql = "
        SELECT 
            libro.titulo, 
            libro.autor, 
            COUNT(prestamo_descripcion.numero_inventario) AS veces_prestado
        FROM 
            libro
        JOIN 
            prestamo_descripcion ON libro.numero_inventario = prestamo_descripcion.numero_inventario
        GROUP BY 
            libro.numero_inventario, libro.titulo, libro.autor
        ORDER BY 
            veces_prestado DESC
        LIMIT 5;
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
//funcion para obtener usuarios activos y que no hayan usuarios con 2 prestamos a a la vez
public function obtenerUsuariosSinP() {
    $sql = "
        SELECT * FROM usuario 
        WHERE id_usuario NOT IN (
            SELECT id_usuario FROM prestamo WHERE activo = 1
        )
    ";
    $result = $this->db->query($sql);
    return $result;
}
}