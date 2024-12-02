<?php
require_once '../config/base.php'; // Asegúrate de que este archivo contiene la conexión correcta a la base de datos.

// Configura los encabezados para CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Obtiene los datos del formulario
$numero = $_POST['numero'];
$titulo = $_POST['titulo'];
$id_manga = $_POST['manga_id'];
$fecha = $_POST['fecha'];

// Prepara y ejecuta la consulta
$query = "INSERT INTO capitulos (numero, titulo, id_manga, fecha_publicacion) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($query);

// Asocia parámetros para evitar inyecciones SQL
$stmt->bind_param("isis", $numero, $titulo, $id_manga, $fecha);

// Ejecuta la consulta
if ($stmt->execute()) {
    // Obtiene el ID del capítulo recién insertado
    $last_id = $conexion->insert_id;
    
    // Devuelve la respuesta en formato JSON con el ID insertado
    echo json_encode(['mensaje' => 'Capitulo Creado', 'id_capitulo' => $last_id]);
} else {
    // Devuelve un mensaje de error si la inserción falla
    echo json_encode(['mensaje' => 'Capitulo no Creado', 'error' => $stmt->error]);
}

// Cierra la consulta y la conexión
$stmt->close();
$conexion->close();
?>
