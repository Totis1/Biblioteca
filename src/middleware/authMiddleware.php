<?php 
    require_once BASEPATH.'../services/tokenService.php';
    class AuthMiddleware{
        public static function verificaToken(){
            $header = apache_request_headers();
            if(!isset($header['Authorization'])){
                return ['mensaje' => 'Token no proporcionado','codigo' => 404];
            }
            $token = str_replace('Bearer','', $header['Authorization']);
            $tokenService = new TokenService();
            if(!$tokenService->verificarToken($token)){
                return ['mensaje'=> 'Token Invalido','codigo'=> 401];
            }
            return ['mensaje' => 'Token Válido','codigo' => 200];
        }
    }
?>