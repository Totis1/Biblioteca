<?php
require_once '../config/base.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
$id_capitulo = $_POST['id_capitulo'];
$numero_pagina = $_POST['numero_pagina'];
$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
$query = "INSERT INTO imagenes(id_capitulo,numero_pagina,imagen) VALUES('$id_capitulo','$numero_pagina','$imagen')";
$res = $conexion->query($query);
if($res){
    echo json_encode(['mensaje' => 'Imagen Subida']);
}else{
    echo json_encode(['mensaje' => 'Capitulo no Creado']);
}
?>