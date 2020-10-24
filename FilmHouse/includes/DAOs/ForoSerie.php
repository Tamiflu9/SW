<?php

    namespace filmhouse\DAOs;
    
    class ForoSerie {
        
        private $_id_FS;
        private $_id_serie;
        private $_id_usuario;
        private $Mensaje;
        private $Fecha;

        public function __construct($_id_FS, $_id_serie, $_id_usuario, $Mensaje, $Fecha) {
            $this->_id_FS = $_id_FS;
            $this->_id_serie = $_id_serie;
            $this->_id_usuario = $_id_usuario;
            $this->Mensaje = $Mensaje;
            $this->Fecha = $Fecha;
        }

        function getID() {
            return $this->_id_FS;
        }

        function getIDSerie() {
            return $this->_id_serie;
        }

        function getIDUsu() {
            return $this->_id_usuario;
        }

        function getMensaje() {
            return $this->Mensaje;
        }

        function getFecha() {
            return $this->Fecha;
        }

        function setID($_id_FS) {
            $this->_id_FS = $_id_FS;
        }

        function setIDSerie($_id_serie) {
            $this->_id_serie = $_id_serie;
        }

        function setIDUsu($_id_usuario) {
            $this->_id_usuario = $_id_usuario;
        }

        function setMensaje($Mensaje) {
            $this->Mensaje = $Mensaje;
        }

        function setFecha($Fecha) {
            $this->Fecha = $Fecha;
        }

    }
