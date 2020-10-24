<?php

    namespace filmhouse\DAOs;
    
    class ForoUsuario{
        
        private $_id_FU;
        private $_id_usu1;
        private $_id_usu2;
        private $Asunto;
        private $Mensaje;
        private $Estado;
        private $Fecha;
        private $Tipo;

        public function __construct($_id_FU, $_id_usu1, $_id_usu2, $Asunto, $Mensaje, $Estado, $Fecha, $Tipo) {
            $this->_id_FU = $_id_FU;
            $this->_id_usu1 = $_id_usu1;
            $this->_id_usu2 = $_id_usu2;
            $this->Asunto = $Asunto;
            $this->Mensaje = $Mensaje;
            $this->Estado = $Estado;
            $this->Fecha = $Fecha;
            $this->Tipo = $Tipo;

        }

        function getID() {
            return $this->_id_FU;
        }

        function getIDUsu1() {
            return $this->_id_usu1;
        }

        function getIDUsu2() {
            return $this->_id_usu2;
        }

        function getAsunto() {
            return $this->Asunto;
        }

        function getMensaje() {
            return $this->Mensaje;
        }

        function getEstado() {
            return $this->Estado;
        }

        function getFecha() {
            return $this->Fecha;
        }

        function getTipo() {
            return $this->Tipo;
        }

        function setID($_id_FU) {
            $this->_id_FU = $_id_FU;
        }

        function setIDUsu1($_id_usu1) {
            $this->_id_usu1 = $_id_usu1;
        }

        function setIDUsu2($_id_usu2) {
            $this->_id_usu2 = $_id_usu2;
        }

        function setAsunto($Asunto) {
            $this->Asunto = $Asunto;
        }

        function setMensaje($Mensaje) {
            $this->Mensaje = $Mensaje;
        }

        function setEstado($Estado) {
            $this->Estado = $Estado;
        }

        function setFecha($Fecha) {
            $this->Fecha = $Fecha;
        }

        function setTipo($Tipo) {
            $this->Tipo = $Tipo;
        }

    }
