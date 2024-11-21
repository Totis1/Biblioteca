<?php 
    interface ICapitulo{
        public function crearCapitulo($capitulo);
        public function borrarCapitulo($id);
        public function obtenerCapitulosAscendente();
        public function obtenerCapitulosDescendente();
    }
?>