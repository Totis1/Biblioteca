<?php 
    include_once("../src/config/base.php");
    session_start();
    if (isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $query = "SELECT id FROM usuarios WHERE nombre = '$user'";
        $resultadouser = $conexion->query($query);
        $rower = $resultadouser->fetch_assoc();
    }
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
                        <li><a class="dropdown-item" href="perfil.html?id=<?php echo $rower['id']; ?>">Perfil</a></li>
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

<!-- Sección de mangas destacados -->
<section class="container my-5">
    <h2 class="text-center">Mangas Destacados</h2>
    <p class="text-center mb-4">Descubre los mangas más populares y recomendados.</p>
    <div class="row">
    <?php 
        // Consulta para obtener solo 3 mangas específicos
        $query = "SELECT id, titulo, descripcion, portada FROM Mangas LIMIT 3";
        $resultado = $conexion->query($query);
        // Verificar si hay resultados
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                // Extraer los datos de cada manga
                $titulo = htmlspecialchars($row['titulo']);
                $descripcion = htmlspecialchars($row['descripcion']);
                $portada = 'data:image/jpeg;base64,' . base64_encode($row['portada']);  // Convertir BLOB a base64
    ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="<?php echo $portada; ?>" class="card-img-top" alt="Portada de <?php echo $titulo; ?>">
                <div class="card-body card-body-dest">
                    <h5 class="card-title"><?php echo $titulo; ?></h5>
                    <p class="card-text"><?php echo $descripcion; ?></p>
                    <a href="./manga.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Leer Manga</a>
                </div>
            </div>
        </div>
    <?php
            }
        } else {
            echo "<p>No se encontraron mangas.</p>";
        }
    ?>
    </div>
</section>
<style>
 /* Controles del carrusel */
 .carousel-control-prev,
 .carousel-control-next {
      width: 8%; /* Hacerlos más grandes */
     top: 50%; /* Centrar verticalmente */
     transform: translateY(-50%); /* Asegura que estén centrados verticalmente */
    }

 .carousel-control-prev {
     left: -50px; /* Mover hacia la izquierda fuera del contenido */
    }

 .carousel-control-next {
     right: -50px; /* Mover hacia la derecha fuera del contenido */
    }

 .carousel-control-prev-icon,
 .carousel-control-next-icon {
     background-color: rgba(0, 0, 0, 0.7); /* Fondo oscuro */
     border-radius: 50%; /* Forma circular */
     padding: 15px; /* Tamaño más grande */
    }

 /* Espaciado interno entre tarjetas */
 .carousel-inner .row {
     margin: 0 15px;
    }

 .carousel-inner .card {
     margin: 10px; /* Espaciado entre las tarjetas */
    } 
</style>
<!-- Sección de Nuevos Mangas con Carrusel -->
<section class="container my-5">
    <h2 class="text-center">Nuevos de la Semana</h2>
    <p class="text-center mb-4">Explora las novedades recién agregadas.</p>
    <div id="newMangasCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#newMangasCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#newMangasCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#newMangasCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Contenido del Carrusel -->
        <div class="carousel-inner">
            <!-- Primera diapositiva -->
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/jj.jpg" class="card-img-top" alt="Manga 1">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Jujutsu Kaisen</h5>
                                <p class="card-text">Un joven lucha contra maldiciones usando técnicas de hechicería en un mundo sobrenatural.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/bleach.jpg" class="card-img-top" alt="Manga 2">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Bleach</h5>
                                <p class="card-text">Ichigo se convierte en un shinigami para proteger a los vivos y al mundo espiritual.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/Chainsaw.jpg" class="card-img-top" alt="Manga 3">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Chainsaw Man</h5>
                                <p class="card-text">Un joven cazador de demonios se fusiona con un demonio motosierra para sobrevivir.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/Dandadan.jpg" class="card-img-top" alt="Manga 4">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Dandadan</h5>
                                <p class="card-text">Una mezcla de humor, acción y romance mientras enfrentan fantasmas y alienígenas.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Segunda diapositiva -->
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/DragonBallS.jpg" class="card-img-top" alt="Manga 5">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Dragon Ball Super</h5>
                                <p class="card-text">Goku y sus amigos enfrentan poderosos enemigos mientras exploran nuevos universos.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/hunter.jpg" class="card-img-top" alt="Manga 6">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Hunter x Hunter</h5>
                                <p class="card-text">Gon y sus amigos enfrentan desafíos mientras persiguen sus sueños como cazadores</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/naruto.jpg" class="card-img-top" alt="Manga 7">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Naruto</h5>
                                <p class="card-text">La historia de un ninja soñador que busca convertirse en el líder de su aldea.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/Oshi.jpg" class="card-img-top" alt="Manga 8">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Oshi no Ko</h5>
                                <p class="card-text">Un giro inesperado en la vida de ídolos y sus secretos ocultos.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tercera diapositiva -->
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/pokemon.jpg" class="card-img-top" alt="Manga 9">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Pokemon</h5>
                                <p class="card-text">Entrenadores y sus Pokémon viven aventuras épicas en busca de ser los mejores.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/onepunch.jpg" class="card-img-top" alt="Manga 10">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">One Punch Man</h5>
                                <p class="card-text">Un héroe invencible enfrenta el aburrimiento de derrotar a todos con un solo golpe.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/saiki.jpg" class="card-img-top" alt="Manga 11">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Saiki Kusuo no Psi-nan</h5>
                                <p class="card-text">Un psíquico adolescente intenta vivir una vida normal, pero sus poderes siempre causan caos.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="./images/spy.jpg" class="card-img-top" alt="Manga 12">
                            <div class="card-body card-body-custom">
                                <h5 class="card-title">Spy x Family</h5>
                                <p class="card-text">Un espía debe formar una falsa familia para cumplir una misión, sin saber que su "esposa" es una asesina y su "hija" puede leer mentes.</p>
                                <a href="#" class="btn btn-primary">Leer Más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles del Carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#newMangasCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#newMangasCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</section>


<!-- Sección de Mangas por Géneros -->
<section class="container my-5">
    <h2 class="text-center">Géneros Destacados</h2>
    <p class="text-center mb-4">Elige tus mangas favoritos según el género.</p>
    <div class="row">
        <!-- Acción -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body card-body-dest">
                    <h5 class="card-title">Acción</h5>
                    <p class="card-text">Mangas llenos de adrenalina y aventuras.</p>
                    <a href="#" class="btn btn-primary">Ver Acción</a>
                </div>
            </div>
        </div>
        <!-- Romance -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body card-body-dest">
                    <h5 class="card-title">Romance</h5>
                    <p class="card-text">Las historias de amor más conmovedoras.</p>
                    <a href="#" class="btn btn-primary">Ver Romance</a>
                </div>
            </div>
        </div>
        <!-- Comedia -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body card-body-dest">
                    <h5 class="card-title">Comedia</h5>
                    <p class="card-text">Ríe con los mangas más divertidos.</p>
                    <a href="#" class="btn btn-primary">Ver Comedia</a>
                </div>
            </div>
        </div>
    </div>
</section>

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
