<?php 
    if(isset($_REQUEST['id'])) {
        $capituloId = intval($_REQUEST['id']); // Convierte la ID a entero
    }else{
        // Redirige a la página de inicio si no se proporciona un ID válido
        header("Location: index.php");
        exit;
    }
    include_once("../src/config/base.php");
    $query = "SELECT Capitulos.id AS capitulo_id, Capitulos.numero AS numero_capitulo, Capitulos.titulo AS titulo_capitulo, Imagenes.id_capitulo, Imagenes.numero_pagina, Imagenes.imagen FROM Capitulos INNER JOIN Imagenes ON Capitulos.id = Imagenes.id_capitulo WHERE Capitulos.id = '$capituloId' ORDER BY `Imagenes`.`numero_pagina` ASC";
    $resultado = $conexion->query($query);
    $query2 = "SELECT numero,titulo FROM capitulos WHERE id = '$capituloId'";
    $resultado2 = $conexion->query($query2);
    $row2 = $resultado2->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Biblioteca de Mangas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">

</head>
<!-- Encabezado -->
<header class="text-center py-4">
    <h1>Bienvenidos a la Biblioteca Virtual</h1>
    <p>Tu colección de mangas favoritos, siempre disponible en línea.</p>
</header>

<body>
    <br>
    <h1 class="text-center">Capitulo <?php echo htmlspecialchars($row2['numero']); ?> : <?php echo htmlspecialchars($row2['titulo']); ?></h1>
    <br>
    <?php 
        while($row = $resultado->fetch_assoc()) {
    ?>
    <div class="main-container">
        <div class="img-containere text-center">
            <img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>" alt="">
        </div>
    </div>
    <?php
        }
    ?>
</body>
<br><br><br>
<!-- Pie de página -->
<footer class="text-center py-3">
    <p>&copy; 2024 Biblioteca Virtual de Mangas. Todos los derechos reservados.</p>
    <p>
        <a href="#" class="text-white">Política de Privacidad</a> |
        <a href="#" class="text-white">Términos y Condiciones</a>
    </p>
</footer>