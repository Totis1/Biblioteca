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
            $usuario->contraseña = password_hash($data['contraseña'], PASSWORD_DEFAULT);
            $usuario->foto_perfil = $data['foto_perfil'];
            $usuario->fecha_registro = date('Y-m-d H:i:s');
            $this->usuarioRepository->crearUsuario($usuario);
        }
        public function actualizarUsuario($data) {
            $usuario = new Usuario();
            $usuario->id = $data['id'];
            $usuario->nombre = $data['nombre'];
            $usuario->email = $data['email'];
            $usuario->contraseña = password_hash($data['contraseña'], PASSWORD_DEFAULT);
            $usuario->foto_perfil = $data['foto_perfil'];
            $usuario->fecha_registro = date('Y-m-d H:i:s');
            $this->usuarioRepository->actualizarUsuario($usuario);
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
    }
?>