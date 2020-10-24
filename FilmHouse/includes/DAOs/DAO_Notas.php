<?php

    namespace filmhouse\DAOs;

    Class DAO_Notas{

        private $myDB;

        private $table = "notas";
        private $columns = array("_id_nota", "_id_usuario", "_id_elemento", "nota");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($nota) {
            $result = $this->myDB->insert($this->table, array($nota->getUsuario(), $nota->getTitulo(), $nota->getNota()), array("_id_usuario", "_id_elemento", "nota"));

            return $result;
        }

        function read($titulo, $id_usuario) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$id_usuario'","_id_elemento = '$titulo'"), 1);

            if($result != NULL) {
                $_id_nota   = $result['_id_nota']; 
                $Titulo     = $result['_id_elemento'];
                $Usuario    = $result['_id_usuario'];
                $Nota       = $result['nota'];


                $n = new Notas($_id_nota, $Titulo, $Usuario, $Nota);
                $this->myDB->free();
                return $n;
            }
        }

        function readAll($limit,$titulo, $id_order = NULL, $asc = NULL) {
            if($id_order === NULL) $order = NULL;
            else $order = $id_order . " " . $asc;

            $result = $this->myDB->select($this->table, $this->columns, array("_id_elemento = '$titulo'"), $limit,"&&", $order);

            $notas = array();

            if($result != NULL) {
                foreach($result as $nota) {
                    $_id_nota   = $nota['_id_nota']; 
                    $Titulo     = $nota['_id_elemento'];
                    $Usuario    = $nota['_id_usuario'];
                    $Nota       = $nota['nota'];

                    $notas[] = new Notas($_id_nota, $Titulo, $Usuario, $Nota);
                }

                return $notas;
            }
        }

        function delete($nota) {
            $id_nota = $nota->getID();
            $result = $this->myDB->delete($this->table, array("_id_nota = $id_nota"));
            return $result;
        }

        function update($nota){
            $_id_nota       = $nota->getID(); 
            $Titulo         = $nota->getTitulo();
            $Usuario        = $nota->getUsuario();
            $Nota           = $nota->getNota();


            $result = $this->myDB->update($this->table, array("_id_elemento = '$Titulo'", "_id_usuario = '$Usuario'", "nota = $Nota", "_id_nota = $_id_nota"), array("_id_nota = $_id_nota"));
            return $result;
        }
    }
