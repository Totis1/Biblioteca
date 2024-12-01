<?php
    require_once BASEPATH.'../repositories/usuarioRepository.php';
    require_once BASEPATH.'../models/usuarioModel.php';
    class UsuarioController{
        private $usuarioRepository;
        public function __construct(){
            $this->usuarioRepository = new UsuarioRepository();
        }
        public function crearUsuario($data) {
            $usuario = new Usuario();
            $usuario->nombre = $data['nombre'];
            $usuario->email = $data['email'];
            $usuario->contrasena = password_hash($data['contrasena'], PASSWORD_BCRYPT);
            return $this->usuarioRepository->crearUsuario($usuario);
        }
        public function actualizarUsuario($data) {
            $usuario = new Usuario();
            $usuario->id = $data['id'];
            $usuario->nombre = $data['nombre'];
            $usuario->email = $data['email'];
            // Actualización condicional de la contraseña
            if (!empty($data['contrasena'])) {
                $usuario->contrasena = password_hash($data['contrasena'], PASSWORD_BCRYPT);
            }
            return $this->usuarioRepository->actualizarUsuario($usuario);
        }
        public function eliminarUsuario($id) {
            return $this->usuarioRepository->eliminarUsuario($id['id']);
        }
        public function listaUsuarios() {
            return $this->usuarioRepository->listaUsuarios();
        }
        public function listaUsuariosRol($rol) {
            return $this->usuarioRepository->listaUsuariosRol($rol);
        }
        public function loginUsuario($correo) {
            return $this->usuarioRepository->loginUsuario($correo['email']);
        }
    }
?>