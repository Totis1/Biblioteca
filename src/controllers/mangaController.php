<?php 
    require_once BASEPATH.'../repositories/mangaRepository.php';
    require_once BASEPATH.'../models/mangaModel.php';
    class MangaController{
        private $mangaRepository;
        public function __construct(){
            $this->mangaRepository = new MangaRepository();
        }
        public function crearManga($Manga) {

        }
        public function actualizarManga($Manga){

        }
        public function borrarManga($id){

        }
        public function mostrarMangas(){
            return $this->mangaRepository->mostrarMangas();
        }
        public function mostrarMangasGenero($genero){

        }
        public function mostrarMangasRecientes($fecha){

        }
    }
?>