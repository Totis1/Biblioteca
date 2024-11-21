<?php 
    interface IGenero {
        public function crearGenero($Genero);
        public function actualizarGenero($Genero);
        public function borrarGenero($id);
        public function listaGeneros();
    }
?>