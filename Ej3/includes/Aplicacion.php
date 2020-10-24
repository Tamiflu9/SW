<?php

namespace es\fdi\ucm\aw;

class Aplicacion{

private static $instancia;
private $inicializada = false;
private $bdDatosConexion;
private $conn;

private function __construct() {
}
private function __clone(){
    parent::__clone();
}
private function __wakeup(){
    return parent::__wakeup();
}

public static function getSingleton(){
    if( !self::$instancia instanceof self){
        self::$instancia = new self;
    }
    return self::$instancia;
}

public function init($dbDatos){
    if(!$this->inicializada){
        $this->dbDatosConexion = $dbDatos;
        session_start();
        $this->inicializada = true;
    }
}

public function conexionBD(){
    if(!$this->inicializada){
        echo "App no inicializada";
        exit();
    }

    if(!$this->conn){
        $this->conn = new \mysqli('localhost', 'root', '', 'ejercicio3');
        if($this->conn->connect_errno){
            //echo "Error de conexión a la BD: (" . $conn->connect_errno . ") " . utf8_encode($conn->connect_error);
            exit();
        }
        /*if(!$this->conn->set_charset("utf8mb4"){
            echo "Error al configurar la codificación de la BD: (" . $conn->errno . ") " . utf8_encode($tconn->error);
            exit();
        }*/
    }
    return $this->conn;
}

public function shutdown()
{
    if(!$this->inicializada){
        echo "App no inicializada";
        exit();
    }

    if ($this->conn !== null) {
        $this->conn->close();
    }
}


}

?>