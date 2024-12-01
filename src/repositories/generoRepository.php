<?php 
    require_once BASEPATH.'../config/database.php';
    require_once BASEPATH.'../interfaces/generoInterface.php';

    class generoRepository implements IGenero {
        private $conn;
        public function __construct() {
            $database = New Database();
            $this->conn = $database->getConnection();
        }
        public function crearGenero($Genero){
            $sql = "INSERT INTO genero(nombre) VALUES (:nombre)";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(":nombre", $Genero->nombre);
            if($resultado->execute()){
                return ['mensaje' => 'Genero Creado'];
            }else{
                return ['mensaje' => 'Error al crear el Genero'];
            }
        }
        public function actualizarGenero($Genero){

        }
        public function borrarGenero($id){

        }
        public function listaGeneros(){
            $sql = 'SELECT * FROM genero';
            $resultado = $this->conn->prepare($sql);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>