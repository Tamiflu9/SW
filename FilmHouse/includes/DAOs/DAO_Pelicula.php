<?php

    namespace filmhouse\DAOs;

    Class DAO_Pelicula{

        private $myDB;

        private $table = "peliculas";
        private $columns = array("_id_pelicula", "Titulo", "Descripcion", "Imagen", "Trailer", "Estreno");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($pelicula) {
            $result = $this->myDB->insert($this->table, array($pelicula->getTitulo(), $pelicula->getDescripcion(), $pelicula->getImagen(), $pelicula->getTrailer(), $pelicula->getEstreno()), array("Titulo", "Descripcion", "Imagen", "Trailer", "Estreno"));

            return $result;
        }

        function read($id_pelicula) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_pelicula = $id_pelicula"), 1);

            if($result != NULL) {
                $_id_pelicula   = $result['_id_pelicula']; 
                $Titulo         = $result['Titulo'];
                $Descripcion    = $result['Descripcion'];
                $Imagen         = $result['Imagen'];
                $Trailer        = $result['Trailer'];
                $Estreno        = $result['Estreno'];

                $p = new Pelicula($_id_pelicula, $Titulo, $Descripcion, $Imagen, $Trailer, $Estreno);
                $this->myDB->free();
                return $p;
            }
        }
        function readTitulo($titulo) {
            $result = $this->myDB->select($this->table, $this->columns, array("Titulo = '$titulo'"), 1);

            if($result != NULL) {
                $_id_serie      = $result['_id_serie'];
                $Titulo         = $result['Titulo'];
                $Descripcion    = $result['Descripcion'];
                $Imagen         = $result['Imagen'];
                $Trailer        = $result['Trailer'];
                $Estreno        = $result['Estreno'];

                $s = new Serie($_id_pelicula, $Titulo, $Descripcion, $Imagen, $Trailer, $Estreno);
                $this->myDB->free();
                return $s;
            }
        }

        function readAll($limit, $id_order = NULL, $asc = NULL) {
            if($id_order === NULL) $order = NULL;
            else $order = $id_order . " " . $asc;

            $result = $this->myDB->select($this->table, $this->columns, array("1"), $limit,"&&", $order);

            $peliculas = array();

            if($result != NULL) {
                foreach($result as $peli) {
                    $_id_pelicula   = $peli['_id_pelicula']; 
                    $Titulo         = $peli['Titulo'];
                    $Descripcion    = $peli['Descripcion'];
                    $Imagen         = $peli['Imagen'];
                    $Trailer        = $peli['Trailer'];
                    $Estreno        = $peli['Estreno'];

                    $peliculas[] = new Pelicula($_id_pelicula, $Titulo, $Descripcion, $Imagen, $Trailer, $Estreno);
                }
                return $peliculas;
            }
        }

        function delete($pelicula) {
            $id_pelicula = $pelicula->getID();
            $result = $this->myDB->delete($this->table, array("_id_pelicula = $id_pelicula"));
            return $result;
        }

        function dameId($titulo) {
            $result = $this->myDB->select($this->table, $this->columns, array("Titulo = '$titulo'"), 1) ;

            if($result != NULL) {
                $_id_pelicula   = $result['_id_pelicula']; 
                return $_id_pelicula;
            }
        }

        function update($pelicula){
            $_id_pelicula   = $pelicula->getID(); 
            $Titulo         = $pelicula->getTitulo();
            $Descripcion    = $pelicula->getDescripcion();
            $Imagen         = $pelicula->getImagen();
            $Trailer        = $pelicula->getTrailer();
            $Estreno        = $pelicula->getEstreno();

            $result = $this->myDB->update($this->table, array("Titulo = '$Titulo'", "Descripcion = '$Descripcion'", "Imagen = '$Imagen'", "Trailer = '$Trailer'",  "Estreno = '$Estreno'"), array("_id_pelicula = $_id_pelicula"));
            return $result;
        }		
    }
