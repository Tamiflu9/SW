<?php

    namespace filmhouse\DAOs;
    
    class Serie {
        
        private $id_serie;
        private $Titulo;
        private $Descripcion;
        private $Imagen;
        private $Trailer;
        private $N_Temporadas;
        private $Estreno;

        public function __construct($id_serie, $Titulo, $Descripcion, $Imagen, $Trailer, $N_Temporadas, $Estreno) {
            $this->id_serie = $id_serie; 
            $this->Titulo = $Titulo;
            $this->Descripcion = $Descripcion;
            $this->Imagen = $Imagen;
            $this->Trailer = $Trailer;
            $this->N_Temporadas = $N_Temporadas;
            $this->Estreno = $Estreno;
        }

        function getID() {
            return $this->id_serie;
        }

        function getTitulo() {
            return $this->Titulo;
        }

        function getTrailer() {
            return $this->Trailer;
        }

        function getDescripcion() {
            return $this->Descripcion;
        }

        function getImagen() {
            return $this->Imagen;
        }

        function getEstreno() {
            return $this->Estreno;
        }
        function getN_Temporadas() {
            return $this->N_Temporadas;
        }

        function setID($id_serie) {
            $this->id_serie = $id_serie;
        }

        function setTitulo($Titulo) {
            $this->Titulo = $Titulo;
        }

        function setTrailer($Trailer) {
            $this->Trailer = $Trailer;
        }

        function setDescripcion($Descripcion) {
            $this->Descripcion = $Descripcion;
        }

        function setImagen($Imagen) {
            $this->Imagen = $Imagen;
        }

        function setEstreno($Estreno) {
            $this->Estreno = $Estreno;
        }
        function setN_Temporadas($N_Temporadas) {
            $this->N_Temporadas = $N_Temporadas;
        }
    }
