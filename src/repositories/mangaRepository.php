<?php 
    require_once BASEPATH.'../config/database.php';
    require_once BASEPATH.'../interfaces/mangaInterface.php';

    class mangaRepository implements IManga {
        private $conn;
        public function __construct() {
            $database = New Database();
            $this->conn = $database->getConnection();
        }
        public function crearManga($Manga) {

        }
        public function actualizarManga($Manga){

        }
        public function borrarManga($id){

        }
        public function mostrarMangas(){
            $sql = 'SELECT * FROM mangas';
            $resultado = $this->conn->prepare($sql);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        public function mostrarMangasGenero($genero){

        }
        public function mostrarMangasRecientes($fecha){

        }
    }
?>