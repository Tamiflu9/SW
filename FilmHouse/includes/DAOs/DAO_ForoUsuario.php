<?php

    namespace filmhouse\DAOs;

    Class DAO_ForoUsuario {

        private $myDB;

        private $table = "foro_usuario";
        private $columns = array("_id_FU", "_id_usu1", "_id_usu2", "Asunto", "Mensaje", "Estado", "Fecha", "Tipo");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($forousuario) {
            $result = $this->myDB->insert($this->table, array($forousuario->getIDUsu1(), $forousuario->getIDUsu2(), $forousuario->getAsunto(), $forousuario->getMensaje(), $forousuario->getEstado(), $forousuario->getFecha(), $forousuario->getTipo()), array("_id_usu1", "_id_usu2", "Asunto", "Mensaje", "Estado", "Fecha", "Tipo"));
            return $result;
        }

        function read($_id_FU) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_FU = $_id_FU"), 1);

            if($result != NULL) {
                $_id_FU = $result['_id_FU'];
                $_id_usu1 = $result['_id_usu1'];
                $_id_usu2  = $result['_id_usu2'];
                $Asunto  = $result['Asunto'];
                $Mensaje  = $result['Mensaje'];
                $Estado = $result['Estado'];
                $Fecha = $result['Fecha'];
                $Tipo = $result['Tipo'];

                $fu = new ForoUsuario($_id_FU, $_id_usu1, $_id_usu2, $Asunto, $Mensaje, $Estado, $Fecha, $Tipo);
                $this->myDB->free();

                return $fu;
            }

        }

        function delete($forousuario) {
            $_id_FU = $forousuario->getID();
            $result = $this->myDB->delete($this->table, array("_id_FU = $_id_FU"));

            return $result;
        }

        function update($forousuario){
            $_id_FU = $forousuario->getID(); 
            $_id_usu1 = $forousuario->getIDUsu1();
            $_id_usu2  = $forousuario->getIDUsu2();
            $Asunto  = $forousuario->getAsunto();
            $Mensaje  = $forousuario->getMensaje();
            $Estado = $forousuario->getEstado();
            $Fecha = $forousuario->getFecha();
            $Tipo = $forousuario->getTipo();

            $result = $this->myDB->update($this->table, array("_id_usu1 = '$_id_usu1'", "_id_usu2 = '$_id_usu2'", "Asunto = '$Asunto'", "Mensaje = '$Mensaje'", "Estado = '$Estado'", "Fecha = '$Fecha'", "Tipo = '$Tipo'"), array("_id_FU = $_id_FU"));

            return $result;
        }

        function readAll($limit, $id_usuario) {

            $result = $this->myDB->select($this->table, $this->columns, array("_id_usu2 = '$id_usuario'"), $limit);

            $mensaje = array();

            if($result != NULL) {
                foreach($result as $a) {
                    $_id_FU = $a['_id_FU'];
                    $_id_usu1 = $a['_id_usu1'];
                    $_id_usu2  = $a['_id_usu2'];
                    $Asunto  = $a['Asunto'];
                    $Mensaje  = $a['Mensaje'];
                    $Estado = $a['Estado'];
                    $Fecha = $a['Fecha'];
                    $Tipo = $a['Tipo'];


                    $mensaje[] = new ForoUsuario($_id_FU, $_id_usu1, $_id_usu2, $Asunto, $Mensaje, $Estado, $Fecha, $Tipo);
                }
                $this->myDB->free();
                return $mensaje;
            }
        }

        function readTipo($tipo) {

            $result = $this->myDB->select($this->table, $this->columns, array("Tipo = '$tipo'"), 0);

            $mensaje = array();

            if($result != NULL) {
                foreach($result as $a) {
                    $_id_FU = $a['_id_FU'];
                    $_id_usu1 = $a['_id_usu1'];
                    $_id_usu2  = $a['_id_usu2'];
                    $Asunto  = $a['Asunto'];
                    $Mensaje  = $a['Mensaje'];
                    $Estado = $a['Estado'];
                    $Fecha = $a['Fecha'];
                    $Tipo = $a['Tipo'];


                    $mensaje[] = new ForoUsuario($_id_FU, $_id_usu1, $_id_usu2, $Asunto, $Mensaje, $Estado, $Fecha, $Tipo);
                }
                $this->myDB->free();
                return $mensaje;
            }
        }

        function readSolicitud($id1, $id2) {

            $result1 = $this->myDB->select($this->table, $this->columns, array("Tipo = 'Solicitud'" , "_id_usu1='$id1' ","_id_usu2='$id2'"), 1);


            $mensaje = array();

            if($result1 != NULL) {
                $_id_FU = $result1['_id_FU'];
                $_id_usu1 = $result1['_id_usu1'];
                $_id_usu2  = $result1['_id_usu2'];
                $Asunto  = $result1['Asunto'];
                $Mensaje  = $result1['Mensaje'];
                $Estado = $result1['Estado'];
                $Fecha = $result1['Fecha'];
                $Tipo = $result1['Tipo'];
                
                $mensaje[] = new ForoUsuario($_id_FU, $_id_usu1, $_id_usu2, $Asunto, $Mensaje, $Estado, $Fecha, $Tipo);
                $this->myDB->free();
                return $mensaje;
            }else {
                $result2 = $this->myDB->select($this->table, $this->columns, array("Tipo = 'Solicitud'" , "_id_usu1='$id2' ","_id_usu2='$id1'"), 1);

                 $mensaje = array();
                 
                if($result2 != NULL) {

                    $_id_FU = $result2['_id_FU'];
                    $_id_usu1 = $result2['_id_usu1'];
                    $_id_usu2  = $result2['_id_usu2'];
                    $Asunto  = $result2['Asunto'];
                    $Mensaje  = $result2['Mensaje'];
                    $Estado = $result2['Estado'];
                    $Fecha = $result2['Fecha'];
                    $Tipo = $result2['Tipo'];

                    $mensaje[] = new ForoUsuario($_id_FU, $_id_usu1, $_id_usu2, $Asunto, $Mensaje, $Estado, $Fecha, $Tipo);
                    $this->myDB->free();
                    return $mensaje;
                }
            }
        }
    }
