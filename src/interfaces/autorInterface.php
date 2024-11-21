<?php
    interface IAutor {
        public function crearAutor($Autor);
        public function actualizarAutor($Autor);
        public function borrarAutor($id);
        public function obtenerAutores();
    }
?>