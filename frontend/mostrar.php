<?php 
    session_start();
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

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Biblioteca de Mangas</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./mostrar.php">Biblioteca</a>
                </li>
            </ul>
        </div>
        <!-- Verificar si el usuario está autenticado -->
        <?php if (isset($_SESSION['user'])): ?>
            <!-- Menú desplegable para usuario autenticado -->
            <div class="dropdown ms-auto">
                <button class="btn btn-dark dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="data:image/*;base64,<?php echo htmlspecialchars($_SESSION['imagen'] ?? 'images/default.jpg'); ?>" alt="Imagen de usuario" width="30" height="30" class="rounded-circle me-2">
                    <?php echo htmlspecialchars($_SESSION['user']); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    <li><a class="dropdown-item" href="perfil.html">Perfil</a></li>
                    <li><a class="dropdown-item" href="crear_manga.html">Subir Manga</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                </ul>
            </div>
        <?php else: ?>
            <!-- Botón de login para usuarios no autenticados -->
            <a href="login.php" class="btn btn-primary ms-auto">Iniciar Sesión</a>
        <?php endif; ?>
    </div>
</nav>

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