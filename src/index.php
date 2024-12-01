<?php 
    define('BASEPATH',__DIR__);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

    if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
        http_response_code(200);
        exit();
    }

    require_once BASEPATH.'/simpleRouter.php';
    require_once BASEPATH.'/controllers/usuarioController.php';
    require_once BASEPATH.'/controllers/generoController.php';
    require_once BASEPATH.'/controllers/autorController.php';
    require_once BASEPATH.'/controllers/mangaController.php';
    require_once BASEPATH.'/middleware/authMiddleware.php';

    $router = new SimpleRouter();
    $usuarioController = new usuarioController();
    $generoController = new generoController();
    $autorController = new autorController();
    $mangaController = new mangaController();

    $router->post('/usuarios',function() use($usuarioController){
        $data = json_decode(file_get_contents('php://input'), true);
        return json_encode($usuarioController->crearUsuario($data));
    });

    $router->put('/usuarios', function() use($usuarioController){
        $data = json_decode(file_get_contents('php://input'), true);
        return json_encode($usuarioController->actualizarUsuario($data));
    });

    $router->delete('/usuarios',function() use($usuarioController){
        $data = json_decode(file_get_contents('php://input'), true);
        return json_encode($usuarioController->eliminarUsuario($data['id']));
    });

    $router->get('/usuarios',function() use($usuarioController){
        return json_encode($usuarioController->listaUsuarios());
    });

    $router->post('/usuarios/roles',function() use($usuarioController){
        $rol = json_decode(file_get_contents('php://input'), true);
        return json_encode($usuarioController->listaUsuariosRol($rol));
    });

    $router->post('/login',function() use($usuarioController){
        $correo = json_decode(file_get_contents('php://input'), true);
        return json_encode($usuarioController->loginUsuario($correo));
    });
    
    $router->post('/generos',function() use($generoController){
        $data = json_decode(file_get_contents('php://input'), true);
        return json_encode($generoController->crearGenero($data));
    });

    $router->get('/generos',function() use($generoController){
        return json_encode($generoController->listaGeneros());
    });

    $router->post('/autores',function() use($autorController){
        $data = json_decode(file_get_contents('php://input'), true);
        return json_encode($autorController->crearAutor($data));
    });

    $router->get('/autores',function() use($autorController){
        return json_encode($autorController->listaAutores());
    });

    $router->get('/mangas',function() use($mangaController){
        return json_encode($mangaController->mostrarMangas());
    });

    $router->dispatch();
?>