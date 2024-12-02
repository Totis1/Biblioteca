<?php 
    if(isset($_REQUEST['id'])) {
        $mangaId = intval($_REQUEST['id']); // Convierte la ID a entero
    }else{
        // Redirige a la página de inicio si no se proporciona un ID válido
        header("Location: index.php");
        exit;
    }
    include_once("../src/config/base.php");
    #$query = "SELECT * FROM mangas WHERE id = '$mangaId'";
    $query = "SELECT mangas.id,mangas.portada,mangas.titulo,mangas.descripcion,mangas.fecha_publicacion,autor.nombre AS nombre_autor,genero.nombre AS nombre_genero FROM Mangas JOIN Autor ON Mangas.id_autor = Autor.id JOIN Genero ON Mangas.id_genero = Genero.id WHERE mangas.id = '$mangaId';";
    $resultado = $conexion->query($query);
    $row = $resultado->fetch_assoc();
    // Consulta para obtener los capítulos de este manga
    $queryCapitulos = "SELECT id,numero,titulo FROM capitulos WHERE id_manga = '$mangaId' ORDER BY numero";
    $resultadoCapitulos = $conexion->query($queryCapitulos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual de Mangas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
<!-- Encabezado -->
<header class="text-center py-4">
    <h1>Bienvenidos a la Biblioteca Virtual</h1>
    <p>Tu colección de mangas favoritos, siempre disponible en línea.</p>
</header>
<section class="element" style="background-color: blue;">
    <header class="container-fluid element-header manga">
        <div class="background"></div>
        <div class="wallpaper"></div>
        <section class="element-header-content">
            <div class="container h-100">
                <div class="row">
                    <div class="col-12 col-md-3 text-center">
                            <h2 class="book-type bg-manga mt-4">Portada</h2>
                            <div class="element-image my-2">
                                <img src="data:image/jpg;base64,<?php echo base64_encode($row['portada']); ?>" alt="<?php echo htmlspecialchars($row['titulo']); ?>" width="70%">
                            </div>
                    </div>
                    <div class="col-12 col-md-9 element-header-content-text">
                        <h1 class="element-title my-2"><?php echo htmlspecialchars($row['titulo']); ?></h1>
                        <p class="element-description"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                        <h5 class="element-subtitle">Género</h5>
                        <h6 style="display: inline-block;">
                            <a class="badge badge-primary py-2 px-4 mx-1 my-2" href="./index.php" style="background-color: brown;"><?php echo htmlspecialchars($row['nombre_genero']); ?></a>
                        </h6>
                        <h5 class="element-subtitle">Autor</h5>
                        <h6 style="display: inline-block;">
                            <a class="badge badge-primary py-2 px-4 mx-1 my-2" href="./index.php" style="background-color: brown;"><?php echo htmlspecialchars($row['nombre_autor']); ?></a>
                        </h6>
                        <h5 class="element-subtitle">Fecha de Inicio : <?php echo htmlspecialchars($row['fecha_publicacion']); ?></h5>
                    </div>  
                </div>
            </div>
        </section>
        <br><br>
    </header>
</section>
<main role="main" class="container-fluid element-body">
    <div class="container p-0 p-sm-2">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h2>Capitulos</h2>
                    <div class="card">
                        <ul class="list-group list-group-flush">
                        <?php while($capitulo = $resultadoCapitulos->fetch_assoc()) { ?>
                                <li class="list-group-item p-0 upload-link bg-dark">
                                    <h4 class="px-2 py-3 m-0">
                                        <div class="row">
                                            <div class="col-10 text-truncate">
                                                <a style="text-decoration: none;" class="display: block;" href="capitulo.php?id=<?php echo $capitulo['id']; ?>">
                                                    <?php echo htmlspecialchars($capitulo['numero']); ?> : <?php echo htmlspecialchars($capitulo['titulo']); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </h4>
                                </li>
                         <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="sticky-top pt-2">
                        <a href="./subir_capitulo.html?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-lg btn-block" style="display: flow;"><i class="fas fa-upload"></i>Subir capítulo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</main>
<br><br><br>
<!-- Pie de página -->
<footer class="text-center py-3">
    <p>&copy; 2024 Biblioteca Virtual de Mangas. Todos los derechos reservados.</p>
    <p>
        <a href="#" class="text-white">Política de Privacidad</a>
        <a href="#" class="text-white">Términos y Condiciones</a>
    </p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    // Pasar la variable PHP a JavaScript
    const mangaId = <?php echo json_encode($mangaId); ?>
    // Imprimir en la consola del navegador
    console.log("ID del Manga:", mangaId)
</script>