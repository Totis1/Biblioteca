<?php 
    require_once BASEPATH.'../config/database.php';
    require_once BASEPATH.'../interfaces/usuarioInterface.php';

    class UsuarioRepository implements IUsuario{
        private $conn;
        public function __construct(){
            $database = New Database();
            $this->conn = $database->getConnection();
        }
        public function crearUsuario($usuario){
            $sql = "INSERT INTO usuarios(nombre, email, contrasena) VALUES (:nombre, :email, :contrasena)";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(":nombre", $usuario->nombre);
            $resultado->bindParam(":email", $usuario->email);
            $resultado->bindParam(":contrasena", $usuario->contrasena);
            if($resultado->execute()){
                return ['mensaje' => 'Usuario Creado'];
            }
            return ['mensaje'=> 'Error al crear el Usuario'];
        }
        public function actualizarUsuario($Usuario){
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, contrasena = :contrasena WHERE id = :id";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(":id", $Usuario->id);
            $resultado->bindParam(":nombre", $Usuario->nombre);
            $resultado->bindParam(":email", $Usuario->email);
            $resultado->bindParam(":contrasena", $Usuario->contrasena);
            if($resultado->execute()){
                return ['mensaje' => 'Usuario SemiActualizado'];
            }
            return ['mensaje'=> 'Error al actualizar el Usuario'];
        }
        public function eliminarUsuario($id){
            $sql = 'DELETE FROM usuarios WHERE id = :id';
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(':id', $id);
            if($resultado->execute()){
                return ['mensaje' => 'Usuario Eliminado'];
            }
            return ['mensaje'=> 'Error al Borrar el Usuario'];
        }
        public function listaUsuarios(){
            $sql = 'SELECT * FROM usuarios';
            $resultado = $this->conn->prepare($sql);
            $resultado->execute();
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        public function listaUsuariosRol($rol){
            $sql = 'SELECT * FROM usuarios WHERE rol = :rol';
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(':rol', $rol);
            if($resultado->execute()){
                return $resultado->fetchAll(PDO::FETCH_ASSOC);
            }
            return ['mensaje'=> 'Error al consultar la lista de usuarios por rol'];
        }
        public function loginUsuario($correo){
            #echo $correo;
            $sql = 'SELECT * FROM usuarios WHERE email = :email';
            #echo $sql;
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(':email', $correo);
            $resultado->execute();
            return $resultado->fetch(PDO::FETCH_ASSOC);
        }
    }
?>