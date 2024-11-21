<?php 
    interface IManga {
        public function crearManga($Manga);
        public function actualizarManga($Manga);
        public function borrarManga($id);
        public function mostrarMangas();
        public function mostrarMangasGenero($genero);
        public function mostrarMangasRecientes($fecha);
    }
?>