<?php

    namespace filmhouse\DAOs;

    class Amistad {
        
        private $_id_usuario1;
        private $_id_usuario2;

        public function __construct($_id_usuario1, $_id_usuario2) {
            $this->_id_usuario1 = $_id_usuario1;
            $this->_id_usuario2 = $_id_usuario2;
        }

        function getIDUsu1() {
            return $this->_id_usuario1;
        }

        function getIDUsu2() {
            return $this->_id_usuario2;
        }

        function setIDUsu1($_id_usuario1) {
            $this->_id_usuario1 = $_id_usuario1;
        }

        function setIDUsu2($_id_usuario2) {
            $this->_id_usuario2 = $_id_usuario2;
        }
    }
