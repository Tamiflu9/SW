<?php

    namespace filmhouse\DAOs;

    Class DAO_Serie {

        private $myDB;

        private $table = "series";
        private $columns = array("_id_serie", "Titulo", "Descripcion", "Imagen", "Trailer", "N_Temporadas", "Estreno");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($serie) {
            $result =  $this->myDB->insert($this->table, array($serie->getTitulo(), $serie->getDescripcion(), $serie->getImagen(), $serie->getTrailer(), $serie->getN_Temporadas(), $serie->getEstreno()), array("Titulo", "Descripcion", "Imagen", "Trailer", "N_Temporadas", "Estreno"));
            return $result;
        }

        function read($id_serie) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_serie = $id_serie"), 1);

            if($result != NULL) {
                $_id_serie      = $result['_id_serie'];
                $Titulo         = $result['Titulo'];
                $Descripcion    = $result['Descripcion'];
                $Imagen         = $result['Imagen'];
                $Trailer        = $result['Trailer'];
                $N_Temporadas   = $result['N_Temporadas'];
                $Estreno        = $result['Estreno'];

                $s = new Serie($_id_serie, $Titulo, $Descripcion, $Imagen, $Trailer, $N_Temporadas, $Estreno);
                $this->myDB->free();
                return $s;
            }
        }
         function readTitulo($titulo) {
            $result = $this->myDB->select($this->table, $this->columns, array("Titulo = $titulo"), 1);

            if($result != NULL) {
                $_id_serie      = $result['_id_serie'];
                $Titulo         = $result['Titulo'];
                $Descripcion    = $result['Descripcion'];
                $Imagen         = $result['Imagen'];
                $Trailer        = $result['Trailer'];
                $N_Temporadas   = $result['N_Temporadas'];
                $Estreno        = $result['Estreno'];

                $s = new Serie($_id_serie, $Titulo, $Descripcion, $Imagen, $Trailer, $N_Temporadas, $Estreno);
                $this->myDB->free();
                return $s;
            }
        }

        function delete($serie) {
            $id_serie = $serie->getID();
            $result = $this->myDB->delete($this->table, array("_id_serie = $id_serie"));
            return $result;
        }

        function update($serie){
            $_id_serie      = $serie->getID(); 
            $Titulo         = $serie->getTitulo();
            $Descripcion    = $serie->getDescripcion();

            $Imagen         = $serie->getImagen();
            $Trailer        = $serie->getTrailer();
            $N_Temporadas   = $serie->getN_Temporadas();
            $Estreno        = $serie->getEstreno();

            $result = $this->myDB->update($this->table, array("Titulo = '$Titulo'", "Descripcion = '$Descripcion'", "Imagen = '$Imagen'", "Trailer = '$Trailer'", "N_Temporadas = $N_Temporadas", "Estreno = '$Estreno'"), array("_id_serie = $_id_serie"));
            return $result;
        }

        function readAll($limit, $id_order = NULL, $asc = NULL) {
            if($id_order === NULL) $order = NULL;
            else $order = $id_order . " " . $asc;

            $result = $this->myDB->select($this->table, $this->columns, array("1"), $limit,"&&", $order);

            $serie = array();

            if($result != NULL) {
                foreach($result as $ser) {
                    $_id_serie      = $ser['_id_serie']; 
                    $Titulo         = $ser['Titulo'];
                    $Descripcion    = $ser['Descripcion'];
                    $Imagen         = $ser['Imagen'];
                    $Trailer        = $ser['Trailer'];
                    $N_Temporadas   = $ser['N_Temporadas'];
                    $Estreno        = $ser['Estreno'];

                    $serie[] = new Serie($_id_serie, $Titulo, $Descripcion, $Imagen, $Trailer, $N_Temporadas, $Estreno);
                }
                return $serie;
            }
        }

        function dameId($titulo) {
            $result = $this->myDB->select($this->table, $this->columns, array("Titulo = '$titulo'"), 1) ;

            if($result != NULL) {
                $_id_serie   = $result['_id_serie']; 
                return $_id_serie;
            }
        }
    }
