<?php 
    require_once BASEPATH.'../config/database.php';
    require_once BASEPATH.'../interfaces/autorInterface.php';

    class AutorRepository implements IAutor {
        private $conn;
        public function __construct() {
            $database = New Database();
            $this->conn = $database->getConnection();
        }
        public function crearAutor($Autor){
            $sql = "INSERT INTO autor(nombre, nacionalidad) VALUES (:nombre, :nacionalidad)";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(":nombre", $Autor->nombre);
            $resultado->bindParam(":nacionalidad", $Autor->nacionalidad);
            if($resultado->execute()){
                return ['mensaje' => 'Autor Creado'];
            }else{
                return ['mensaje' => 'Error al crear el Autor'];
            }
        }
        public function actualizarAutor($Autor){

        }
        public function borrarAutor($id){

        }
        public function obtenerAutores(){
            $sql = 'SELECT * FROM autor';
            $resultado = $this->conn->prepare($sql);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>