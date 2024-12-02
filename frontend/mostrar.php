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

<main role="main" class="container">
    <div class="row mt-5" >
        <div class="col-12">
            <h1>Buscar Manga</h1>
            <h2>Encuentra tus mangas favoritos en nuestra biblioteca virtual.</h2>
            <br><br>
            <div>
                <!-- Barra de búsqueda -->
                <div class="input-group search-bar">
                    <input id="searchInput" type="text" class="form-control" placeholder="Buscar manga por título...">
                </div>
                <br>
                <?php 
                    include_once("../src/config/base.php");
                    $query = "SELECT * FROM mangas";
                    $resultado = $conexion->query($query);
                ?>
                <!-- Lista de mangas -->
                <div id="mangaList" class="row">
                    <?php
                    while ($row = $resultado->fetch_assoc()) {
                        ?>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 manga-item" data-title="<?php echo htmlspecialchars($row['titulo']); ?>">
                            <div class="card">
                                <a href="./manga.php?id=<?php echo $row['id']; ?>" class="card-body card-body-custom">
                                    <img src="data:image/jpg;base64,<?php echo base64_encode($row['portada']); ?>" alt="<?php echo htmlspecialchars($row['titulo']); ?>" height="100%" width="100%">
                                    <h3 class="card-title"><?php echo htmlspecialchars($row['titulo']); ?></h3>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<br><br><br>
<!-- Pie de página -->
<footer class="text-center py-3">
    <p>&copy; 2024 Biblioteca Virtual de Mangas. Todos los derechos reservados.</p>
    <p>
        <a href="#" class="text-white">Política de Privacidad</a> |
        <a href="#" class="text-white">Términos y Condiciones</a>
    </p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>