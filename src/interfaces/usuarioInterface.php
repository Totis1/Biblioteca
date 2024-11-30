<?php 
    interface IUsuario {
        public function crearUsuario($Usuario);
        public function actualizarUsuario($Usuario);
        public function eliminarUsuario($id);
        public function listaUsuarios();
        public function listaUsuariosRol($rol);
        public function loginUsuario($Usuario);
    }
?>