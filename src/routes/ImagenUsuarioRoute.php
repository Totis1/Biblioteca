<?php 
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
?>