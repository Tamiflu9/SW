<?php

    namespace filmhouse\DAOs;

    Class DAO_ForoSerie {

        private $myDB;

        private $table = "foro_serie";
        private $columns = array("_id_FS", "_id_serie", "_id_usuario", "Mensaje", "Fecha");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($foroserie) {
            $result = $this->myDB->insert($this->table, array($foroserie->getIDSerie(), $foroserie->getIDUsu(), $foroserie->getMensaje(), $foroserie->getFecha()), array("_id_serie", "_id_usuario", "Mensaje", "Fecha"));
            return $result;
        }

        function read($id_FS) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_FS = $id_FS"), 1);

            if($result != NULL) {
                $_id_FS = $result['_id_FS'];
                $_id_serie = $result['_id_serie'];
                $_id_usuario  = $result['_id_usuario'];
                $Mensaje  = $result['Mensaje'];
                $Fecha = $result['Fecha'];

                $fs = new ForoSerie($_id_FS, $_id_serie, $_id_usuario, $Mensaje, $Fecha);
                $this->myDB->free();
                return $fs;
            }
        }

        function delete($foroserie) {
            $_id_FS = $foroserie->getID();

            $result =  $this->myDB->delete($this->table, array("_id_FS = $_id_FS"));
            return $result;
        }

        function update($foroserie){
            $_id_FS = $foroserie->getID(); 
            $_id_serie = $foroserie->getIDSerie();
            $_id_usuario  = $foroserie->getIDUsu();
            $Mensaje  = $foroserie->getMensaje();
            $Fecha = $foroserie->getFecha();

            $result = $this->myDB->update($this->table, array("_id_serie = '$_id_serie'", "_id_usuario = '$_id_usuario'", "Mensaje = '$Mensaje'", "Fecha = '$Fecha'"), array("_id_FS = $_id_FS"));
            return $result;
        }

        function readMSG($id_s) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_serie = $id_s"), 0);
            $array =array();

            if($result != NULL) {
                foreach ($result as $key) {
                    $_id_FS = $key['_id_FS'];
                    $_id_serie = $key['_id_serie'];
                    $_id_usuario  = $key['_id_usuario'];
                    $Mensaje  = $key['Mensaje'];
                    $Fecha = $key['Fecha'];

                        $array[] = new ForoSerie($_id_FS, $_id_serie, $_id_usuario, $Mensaje, $Fecha);
                }
            return $array;
            }
           
        }

        function readUsuFecha($usu, $fecha) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$usu'", "Fecha='$fecha'"), 1);

            if($result != NULL) {
                $_id_FS = $result['_id_FS'];
                $_id_serie = $result['_id_serie'];
                $_id_usuario  = $result['_id_usuario'];
                $Mensaje  = $result['Mensaje'];
                $Fecha = $result['Fecha'];

                $fs = new ForoSerie($_id_FS, $_id_serie, $_id_usuario, $Mensaje, $Fecha);
                $this->myDB->free();
                return $fs;
            }
        }
    }
