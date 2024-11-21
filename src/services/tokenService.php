<?php 
    class TokenService{
        private $secretKey = "secretpass";
        private $expirationTime = 108000; //30 dias
        public function generateToken($data){
            $payload = [
                'data' => $data,
                'exp' => time() + $this->expirationTime
            ];
            return JWT::encode($payload, $this->secretKey);
        }
        public function verificarToken($token){
            try {
                $decode = JWT::decode($token, $this->secretKey, ['HS256']);
                return (array) $decode;
            } catch (Exception $e) {
                return false;
            }
        }
    }
?>