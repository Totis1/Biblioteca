<?php
    require_once BASEPATH.'../repositories/autorRepository.php';
    require_once BASEPATH.'../models/autorModel.php';
    class AutorController{
        private $autorRepository;
        public function __construct(){
            $this->autorRepository = new AutorRepository();
        }
        public function crearAutor($data) {
            $autor = new Autor();
            $autor->nombre = $data['nombre'];
            $autor->nacionalidad = $data['nacionalidad'];
            return $this->autorRepository->crearAutor($autor);
        }
        public function actualizarAutor($data) {
            return $this->autorRepository->actualizarAutor($data);
        }
        public function eliminarAutor($id) {
            return $this->autorRepository->borrarAutor($id['id']);
        }
        public function listaAutores() {
            return $this->autorRepository->obtenerAutores();
        }
    }
?>