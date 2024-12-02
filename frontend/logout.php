<?php
    // Inicia la sesión
    session_start();

    // Elimina todas las variables de sesión
    session_unset();

    // Destruye la sesión
    session_destroy();

    // Redirige al usuario a la página de inicio (puedes cambiar esto a cualquier otra página)
    header("Location: index.php");
    exit;
?>