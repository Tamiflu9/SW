<?php

    namespace filmhouse\DAOs;

    Class DAO_FavoritosPeli{

        private $myDB;

        private $table = "fav_usu_peli";
        private $columns = array("_id_usuario", "_id_pelicula");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($favorito) {

            
            $result = $this->myDB->insert($this->table, array($favorito->getIDUsu(), $favorito->getIDPeli()));
            return $result;
        }

        function read($id_usuario, $id_pelicula) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$id_usuario'", "_id_pelicula = $id_pelicula"), 1);

            if($result != NULL) {
                $_id_usuario  = $result['_id_usuario'];
                $_id_pelicula = $result['_id_pelicula'];

                $fp = new FavoritosPeli($_id_usuario, $_id_pelicula);
                $this->myDB->free();
                return $fp;
            }
        }

        function delete($favorito) {
            $id_usuario = $favorito->getIDUsu();
            $id_pelicula = $favorito->getIDPeli();

            $result = $this->myDB->delete($this->table, array("_id_usuario = '$id_usuario'", "_id_pelicula = $id_pelicula"));
            return $result;
        }

        function readAll($limit, $id_usuario) {

            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$id_usuario'"), $limit);

            $peliculas = array();

            if($result != NULL) {
                foreach($result as $peli) {
                    $_id_pelicula   = $peli['_id_pelicula']; 
                    $_id_usuario    = $peli['_id_usuario'];


                    $peliculas[] = new FavoritosPeli($_id_usuario,$_id_pelicula);
                }
                return $peliculas;
            }
        }

    }
