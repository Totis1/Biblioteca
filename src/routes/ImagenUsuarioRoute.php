<?php 
/*
    require_once '../config/base.php';
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    $id = $_POST['id'];
    #echo $id;
    $imagen = addslashes(file_get_contents($_FILES['foto_perfil']['tmp_name']));
    $query = "UPDATE usuarios SET foto_perfil = '$imagen' WHERE id = '$id'";
    $res = $conexion->query($query);
    if($res){
        echo json_encode(['mensaje' => 'Usuario Actualizado']);
    }else{
        echo json_encode(['mensaje' => 'Usuario no acutualizado']);
    }
*/
require_once '../config/database.php'; // Incluye la clase de base de datos

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Obtiene la conexión usando la clase Database
$database = new Database();
$conexion = $database->getConnection();

try {
    // Verifica si los datos necesarios están presentes
    if (isset($_POST['id']) && isset($_FILES['foto_perfil'])) {
        $id = $_POST['id'];
        $imagen = file_get_contents($_FILES['foto_perfil']['tmp_name']); // Obtener el contenido del archivo de imagen

        // Prepara la consulta SQL con parámetros
        $query = "UPDATE usuarios SET foto_perfil = :imagen WHERE id = :id";
        $stmt = $conexion->prepare($query);

        // Asocia los valores a los parámetros
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB); // Datos binarios
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo json_encode(['mensaje' => 'Usuario Actualizado']);
        } else {
            echo json_encode(['mensaje' => 'Usuario no actualizado']);
        }
    } else {
        echo json_encode(['mensaje' => 'Datos insuficientes']);
    }
} catch (PDOException $e) {
    echo json_encode(['mensaje' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>