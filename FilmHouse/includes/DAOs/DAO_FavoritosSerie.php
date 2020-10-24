<?php

    namespace filmhouse\DAOs;


    Class DAO_FavoritosSerie {
        private $myDB;

        private $table = "fav_usu_serie";
        private $columns = array("_id_usuario", "_id_serie");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($favorito) {

            
            $result = $this->myDB->insert($this->table, array($favorito->getIDUsu(), $favorito->getIDSerie()));
            return $result;
        }

        function read($id_usuario, $id_serie) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$id_usuario'", "_id_serie = $id_serie"), 1);

            if($result != NULL) {
                $_id_usuario  = $result['_id_usuario'];
                $_id_serie = $result['_id_serie'];

                $fp = new FavoritosSerie($_id_usuario, $_id_serie);
                $this->myDB->free();
                return $fp;
            }
        }

        function delete($favorito) {
            $id_usuario = $favorito->getIDUsu();
            $id_serie = $favorito->getIDSerie();

            $result = $this->myDB->delete($this->table, array("_id_usuario = '$id_usuario'", "_id_serie = $id_serie"));
            return $result;
        }

        function readAll($limit, $id_usuario) {

            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$id_usuario'"), $limit);

            $se = array();

            if($result != NULL) {
                foreach($result as $s) {
                    $_id_serie      = $s['_id_serie']; 
                    $_id_usuario    = $s['_id_usuario'];


                    $se[] = new FavoritosSerie($_id_usuario,$_id_serie);
                }
                return $se;
            }
        }

    }
