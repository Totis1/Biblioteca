<?php 
    require_once BASEPATH.'../config/database.php';
    require_once BASEPATH.'../interfaces/usuarioInterface.php';

    class UsuarioRepository implements IUsuario{
        private $conn;
        public function __construct(){
            $database = New Database();
            $this->conn = $database->getConnection();
        }
        public function crearUsuario($Usuario){
            $sql = "INSERT INTO usuarios(nombre, email, contraseña, foto_perfil, fecha_registro, rol) VALUES (:nombre, :email, :contraseña, :foto_perfil, :fecha_registro/*, :rol*/)";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(":nombre", $Usuario->nombre);
            $resultado->bindParam(":email", $Usuario->email);
            $resultado->bindParam(":contraseña", $Usuario->contraseña);
            $resultado->bindParam(":foto_perfil", $Usuario->foto_perfil);
            $resultado->bindParam(":fecha_registro", $Usuario->fecha_registro);
            //$resultado->bindParam(":rol", $Usuario->rol);
            if($resultado->execute()){
                return ['mensaje' => 'Usuario Creado'];
            }
            return ['mensaje'=> 'Error al crear el Usuario'];
        }
        public function actualizarUsuario($Usuario){
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, contraseña = :contraseña, foto_perfil = :foto_perfil, fecha_registro = :fecha_registro /*, rol = :rol*/ WHERE id = :id";
            $resultado = $this->conn->prepare($sql);
            $resultado->bindParam(":id", $Usuario->id);
            $resultado->bindParam(":nombre", $Usuario->nombre);
            $resultado->bindParam(":email", $Usuario->email);
            $resultado->bindParam(":contraseña", $Usuario->contraseña);
            $resultado->bindParam(":foto_perfil", $Usuario->foto_perfil);
            $resultado->bindParam(":fecha_registro", $Usuario->fecha_registro);
            //$resultado->bindParam(":rol", $Usuario->rol);
            if($resultado->execute()){
                return ['mensaje' => 'Usuario Actualizado'];
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
    }
?>