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
    require_once BASEPATH.'/middleware/authMiddleware.php';

    $router = new SimpleRouter();
    $usuarioController = new usuarioController();

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

    $router->get('/login',function() use($usuarioController){
        $correo = json_decode(file_get_contents('php://input'), true);
        return json_encode($usuarioController->loginUsuario($correo));
    });

    $router->dispatch();
?>