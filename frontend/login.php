<?php
    session_start();
    include_once"../src/config/base.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $busca = 'SELECT * FROM usuarios WHERE email = ?';
        $prep = $conexion->prepare($busca);
        $prep->bind_param('s', $email);
        $prep->execute();
        $user = $prep->get_result();
        if($user->num_rows > 0) {
            $dato = $user->fetch_assoc();
            if(password_verify($password, $dato['contrasena'])) {
                $_SESSION['user'] = $dato['nombre'];
                $_SESSION['imagen'] = base64_encode($dato['foto_perfil']);
                header('Location:http://localhost/biblioteca/frontend/index.php');
                exit();
            } else {
                $error = 'Contrasena Incorrecta';
            }
        } else {
            $error = 'Usuario no encontrado';
        }

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión o Registrarse - Biblioteca Virtual de Mangas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    
    <style>
        /* Imagen de fondo que cubre toda la página */
        body {
            background-image: url('./images/fondo2.jpeg'); /* Reemplaza con la URL de tu imagen */
            background-size: cover; /* Ajusta la imagen para cubrir toda la pantalla */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* La imagen de fondo se mantiene fija al hacer scroll */
        }

        /* Estilo para oscurecer el fondo y hacer que el texto sea más legible */
        .overlay {
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente negro */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Coloca la superposición detrás del contenido */
        }
    </style>
</head>
<body>

<!-- Superposición para oscurecer la imagen de fondo -->
<div class="overlay"></div>

<!-- Contenedor principal -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100 justify-content-center">
        <!-- Card de Iniciar Sesión -->
        <div class="col-12 col-md-6">
            <div class="card login-card shadow-lg mb-3">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <!-- Formulario de inicio de sesión -->
                <form id="frmLogin" method="post" actions="">
                    <!-- Correo electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="nombre@correo.com" name="email" required>
                    </div>
                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" required>
                    </div>
                    <!-- Checkbox para recordar sesión -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <!-- Botones -->
                    <button type="submit" class="btn btn-primary w-100 mb-2 login-btn" id="submitBtn">Iniciar Sesión</button>
                    <button type="button" class="btn btn-success w-100 register-btn" onclick="window.location.href='./register.html'">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

