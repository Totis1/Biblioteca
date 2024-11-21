<?php 
    interface IImagen {
        public function crearImagen($Imagen);
        public function actualizarImagen($Imagen);
        public function borrarImagen($id);
        public function mostrarImagenes();
    }
?>