<?php

   namespace filmhouse\DAOs;


    Class DAO_Amigos{

        private $myDB;

        private $table = "amigos";
        private $columns = array("_id_usuario1", "_id_usuario2");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($amistad) {
            return $this->myDB->insert($this->table, array($amistad->getIDUsu1(), $amistad->getIDUsu2()));
        }

        function read($id_usuario, $id_usuario2) {
            $result1 = $this->myDB->select($this->table, $this->columns, array("_id_usuario1 = '$id_usuario'", "_id_usuario2 = '$id_usuario2'"), 1);
            $result2 = $this->myDB->select($this->table, $this->columns, array("_id_usuario2 = '$id_usuario'", "_id_usuario1 = '$id_usuario2'"), 1);

            if($result1 != NULL) {
                $_id_usuario1  = $result1['_id_usuario1'];
                $_id_usuario2  = $result1['_id_usuario2'];

                $a = new Amistad($_id_usuario1, $_id_usuario2);
                $this->myDB->free();
                return $a;
            }
            else if($result2 != NULL) {
                $_id_usuario1  = $result2['_id_usuario1'];
                $_id_usuario2  = $result2['_id_usuario2'];

                $a = new Amistad($_id_usuario1, $_id_usuario2);
                $this->myDB->free();
                return $a;
            }
        }

        function delete($amistad) {
            $id_usuario = $amistad->getIDUsu1();
            $id_usuario2 = $amistad->getIDUsu2();

            return $this->myDB->delete($this->table, array("_id_usuario1 = '$id_usuario'", "_id_usuario2 = '$id_usuario2'"));
        }

        function readAll($limit, $id_usuario) {

            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario1 = '$id_usuario'","_id_usuario2 = '$id_usuario'"), $limit, "||");

            $amistad = array();

            if($result != NULL) {
                foreach($result as $a) {
                    $_id_usuario2    = $a['_id_usuario2']; 
                    $_id_usuario1    = $a['_id_usuario1'];


                    $amistad[] = new Amistad($_id_usuario1,$_id_usuario2);
                }
                $this->myDB->free();
                return $amistad;
            }
        }

    }
