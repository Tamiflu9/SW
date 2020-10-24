<?php

    namespace filmhouse\DAOs;
    
    class Pelicula {
        
        private $_id_pelicula;
        private $Titulo;
        private $Descripcion;
        private $Imagen;
        private $Trailer;
        private $Estreno;

        public function __construct($_id_pelicula, $Titulo, $Descripcion, $Imagen, $Trailer, $Estreno) {
            $this->_id_pelicula = $_id_pelicula;
            $this->Titulo       = $Titulo;
            $this->Descripcion  = $Descripcion;
            $this->Imagen       = $Imagen;
            $this->Trailer      = $Trailer;
            $this->Estreno      = $Estreno;
        }

        function getID() {
            return $this->_id_pelicula;
        }

        function getTitulo() {
            return $this->Titulo;
        }

        function getDescripcion() {
            return $this->Descripcion;
        }

        function getImagen() {
            return $this->Imagen;
        }

        function getTrailer() {
            return $this->Trailer;
        }
        
        function getEstreno() {
            return $this->Estreno;
        }

        function setID($id_pelicula) {
            $this->_id_pelicula = $id_pelicula;
        }

        function setTitulo($Titulo) {
            $this->Titulo = $Titulo;
        }

        function setDescripcion($Descripcion) {
            $this->Descripcion = $Descripcion;
        }
        

        function setImagen($Imagen) {
            $this->Imagen = $Imagen;
        }

        function setTrailer($Trailer) {
            $this->Trailer = $Trailer;
        }

        function setEstreno($Estreno) {
            $this->Estreno = $Estreno;
        }
    }
