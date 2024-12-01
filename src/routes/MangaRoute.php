<?php
require_once '../config/base.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
#$id = $_POST['id'];
$titulo = $_POST['Titulo'];
$descripcion = $_POST['Descripcion'];
$fecha = $_POST['Fecha'];
$id_autor = $_POST['Autor'];
$id_genero = $_POST['Genero'];
#echo $id;
$portada = addslashes(file_get_contents($_FILES['Portada']['tmp_name']));
$query = "INSERT INTO mangas(titulo,descripcion,fecha_publicacion,id_autor,id_genero,portada) VALUES('$titulo','$descripcion','$fecha','$id_autor','$id_genero','$portada')";
$res = $conexion->query($query);
if($res){
    echo json_encode(['mensaje' => 'Manga Creado']);
}else{
    echo json_encode(['mensaje' => 'Manga no Creado']);
}
?>