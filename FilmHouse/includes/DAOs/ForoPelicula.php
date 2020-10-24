<?php

    namespace filmhouse\DAOs;
    
    class ForoPelicula{
        
        private $_id_FP;
        private $_id_pelicula;
        private $_id_usuario;
        private $Mensaje;
        private $Fecha;

        public function __construct($_id_FP, $_id_pelicula, $_id_usuario, $Mensaje, $Fecha){
            $this->_id_FP = $_id_FP;
            $this->_id_pelicula = $_id_pelicula;
            $this->_id_usuario = $_id_usuario;
            $this->Mensaje = $Mensaje;
            $this->Fecha = $Fecha;
        }

        function getID(){
            return $this->_id_FP;
        }

        function getIDPeli(){
            return $this->_id_pelicula;
        }

        function getIDUsu(){
            return $this->_id_usuario;
        }

        function getMensaje(){
            return $this->Mensaje;
        }

        function getFecha(){
            return $this->Fecha;
        }

        function setID($_id_FP){
            $this->_id_FP = $_id_FP;
        }

        function setIDPeli($_id_pelicula){
            $this->_id_pelicula = $_id_pelicula;
        }

        function setIDUsu($_id_usuario){
            $this->_id_usuario = $_id_usuario;
        }

        function setMensaje($Mensaje){
            $this->Mensaje = $Mensaje;
        }

        function setFecha($Fecha){
            $this->Fecha = $Fecha;
        }

    }
