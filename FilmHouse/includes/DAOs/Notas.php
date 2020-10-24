<?php

    namespace filmhouse\DAOs;
    
    class Notas {
        
        private $_id_nota;
        private $Titulo;
        private $Usuario;
        private $Nota;


        public function __construct($_id_nota, $Titulo, $Usuario, $Nota) {
            $this->_id_nota = $_id_nota;
            $this->Titulo       = $Titulo;
            $this->Usuario  = $Usuario;
            $this->Nota         = $Nota;
        }

        function getID() {
            return $this->_id_nota;
        }

        function getTitulo() {
            return $this->Titulo;
        }

        function getUsuario() {
            return $this->Usuario;
        }

        function getNota() {
            return $this->Nota;
        }


        function setID($id_pelicula) {
            $this->_id_nota = $id_pelicula;
        }

        function setTitulo($Titulo) {
            $this->Titulo = $Titulo;
        }

        
        function setNota($Nota) {
            $this->Nota = $Nota;
        }

        function setUsuario() {
            return $this->Usuario;
        }


    }
