<?php
    require_once BASEPATH.'../repositories/generoRepository.php';
    require_once BASEPATH.'../models/generoModel.php';
    class GeneroController{
        private $generoRepository;
        public function __construct(){
            $this->generoRepository = new generoRepository();
        }
        public function crearGenero($data) {
            $genero = new Genero();
            $genero->nombre = $data['nombre'];
            return $this->generoRepository->crearGenero($genero);
        }
        public function actualizarGenero($data) {
            
        }
        public function eliminarGenero($id) {
            
        }
        public function listaGeneros() {
            return $this->generoRepository->listaGeneros();
        }
    }
?>