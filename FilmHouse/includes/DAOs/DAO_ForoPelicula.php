<?php

    namespace filmhouse\DAOs;

    Class DAO_ForoPelicula {

        private $myDB;

        private $table = "foro_pelicula";
        private $columns = array("_id_FP", "_id_pelicula", "_id_usuario", "Mensaje", "Fecha");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($foropelicula) {
            $result = $this->myDB->insert($this->table, array($foropelicula->getIDPeli(), $foropelicula->getIDUsu(), $foropelicula->getMensaje(), $foropelicula->getFecha()), array("_id_pelicula", "_id_usuario", "Mensaje", "Fecha"));
            return $result;
        }

        function read($id_FP) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_FP = $id_FP"), 1);

            if($result != NULL) {
                $_id_FP = $result['_id_FP'];
                $_id_pelicula = $result['_id_pelicula'];
                $_id_usuario  = $result['_id_usuario'];
                $Mensaje  = $result['Mensaje'];
                $Fecha = $result['Fecha'];

                $fp = new ForoPelicula($_id_FP, $_id_pelicula, $_id_usuario, $Mensaje, $Fecha);
                $this->myDB->free();
                return $fp;
            }
        }

        function delete($foropelicula) {
            $_id_FP = $foropelicula->getID();
            $result = $this->myDB->delete($this->table, array("_id_FP = $_id_FP"));
            return $result;
        }

        function update($foropelicula){
            $_id_FP = $foropelicula->getID(); 
            $_id_pelicula = $foropelicula->getIDPeli();
            $_id_usuario  = $foropelicula->getIDUsu();
            $Mensaje  = $foropelicula->getMensaje();
            $Fecha = $foropelicula->getFecha();

            $result = $this->myDB->update($this->table, array("_id_pelicula = '$_id_pelicula'", "_id_usuario = '$_id_usuario'", "Mensaje = '$Mensaje'", "Fecha = '$Fecha'"), array("_id_FP = $_id_FP"));

            return $result;
        }


        function readAll($limit, $id_p,$id_order = NULL, $asc = NULL) {
            if($id_order === NULL) $order = NULL;
            else $order = $id_order . " " . $asc;

            $result = $this->myDB->select($this->table, $this->columns,  array("_id_pelicula = $id_p"), $limit,"&&", $order);

            $comentarios = array();

            if($result != NULL) {
                foreach($result as $comentarios) {
                    $_id_FP = $comentarios['_id_FP'];
                    $_id_pelicula = $comentarios['_id_pelicula'];
                    $_id_usuario  = $comentarios['_id_usuario'];
                    $Mensaje  = $comentarios['Mensaje'];
                    $Fecha = $comentarios['Fecha'];

                    $comentarios[] = new ForoPelicula($_id_FP, $_id_pelicula, $_id_usuario, $Mensaje, $Fecha);
                }
               
                return $comentarios;
            }
        }


        function readM($id_p) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_pelicula = $id_p"), 0);
            $array =array();

            if($result != NULL) {
                foreach ($result as $key) {
                     $_id_FP = $key['_id_FP'];
                        $_id_pelicula = $key['_id_pelicula'];
                        $_id_usuario  = $key['_id_usuario'];
                        $Mensaje  = $key['Mensaje'];
                        $Fecha = $key['Fecha'];

                        $array[] = new ForoPelicula($_id_FP, $_id_pelicula, $_id_usuario, $Mensaje, $Fecha);
                }
            return $array;
            }
           
        }

        function readUsuFecha($usu, $fecha) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$usu'", "Fecha='$fecha'"), 1);

            if($result != NULL) {
                $_id_FP = $result['_id_FP'];
                $_id_pelicula = $result['_id_pelicula'];
                $_id_usuario  = $result['_id_usuario'];
                $Mensaje  = $result['Mensaje'];
                $Fecha = $result['Fecha'];

                $fp = new ForoPelicula($_id_FP, $_id_pelicula, $_id_usuario, $Mensaje, $Fecha);
                $this->myDB->free();
                return $fp;
            }
        }
    }
