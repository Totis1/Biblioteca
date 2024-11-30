<?php 
    $conexion = new mysqli("localhost:3310","root","","biblioteca");
    if($conexion){
        
    }else{
        echo "No conectado a la base de datos";
    }
?>