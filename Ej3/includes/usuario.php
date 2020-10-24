<?php

namespace es\fdi\ucm\aw;
use es\fdi\ucm\aw\Aplicacion;

class usuario{
    
    private $id;
    private $nombreUsuario;
    private $nombre;
    private $password;
    private $rol;

    private function __construct($nombreUsuario, $nombre, $password, $rol){
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getid()    {
        return $this->id;
    }

    public function getrol(){
        return $this->rol;
    }

    public function getnombreUsuario(){
        return $this->nombreUsuario;
    }

    public function setPassword($nuevoPassword){
        $this->password = self::hashPassword($nuevoPassword);
    }

    private static function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Devuelve un objeto Usuario con la información del usuario $nombreUsuario, o false si no lo encuentra.
    public static function buscaUsuario($nombreUsuario){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['rol']);
                $user->id = $fila['id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    } 
    // Comprueba si la contraseña introducida coincide con la del Usuario.
    public function compruebaPassword($password){
        return password_verify($password, $this->password);
    }

    // Usando las funciones anteriores, devuelve un objeto Usuario si el usuario existe y coincide su contraseña. En caso contrario, devuelve false
    public static function login($nombreUsuario, $password){
        $user = self::buscaUsuario($nombreUsuario);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }
    // Crea un nuevo usuario con los datos introducidos por parámetro.
    public static function crea($nombreUsuario, $nombre, $password, $rol){
        $user = self::buscaUsuario($nombreUsuario);
        if ($user) {
            return false;
        }
        $user = new usuario($nombreUsuario, $nombre, self::hashPassword($password), $rol);
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();

        if ($usuario->id !== null) {
            $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', rol='%s' WHERE U.id=%i"
                , $conn->real_escape_string($usuario->nombreUsuario)
                , $conn->real_escape_string($usuario->nombre)
                , $conn->real_escape_string($usuario->password)
                , $conn->real_escape_string($usuario->rol)
                , $usuario->id);
            if ( $conn->query($query) ) {
                if ( $conn->affected_rows != 1) {
                    echo "No se ha podido actualizar el usuario: " . $usuario->id;
                    exit();
                }
            } else {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            }
        }else{
            $query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, rol) VALUES('%s', '%s', '%s', '%s')"
                , $conn->real_escape_string($usuario->nombreUsuario)
                , $conn->real_escape_string($usuario->nombre)
                , $conn->real_escape_string($usuario->password)
                , $conn->real_escape_string($usuario->rol));
            if ( $conn->query($query) ) {
               $usuario->id = $conn->insert_id;
            } else {
                echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                exit();
            }
        
        }
        return $usuario;
    }

}
?>