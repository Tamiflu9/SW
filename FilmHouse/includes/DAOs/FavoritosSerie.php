<?php

    namespace filmhouse\DAOs;
    
    class FavoritosSerie{
        
        private $_id_usuario;
        private $_id_serie;

        public function __construct($_id_usuario, $_id_serie){
            $this->_id_usuario = $_id_usuario;
            $this->_id_serie = $_id_serie;
        }

        function getIDUsu(){
            return $this->_id_usuario;
        }

        function getIDSerie(){
            return $this->_id_serie;
        }

        function setIDUsu($_id_usuario){
            $this->_id_usuario = $_id_usuario;
        }

        function setIDSerie($_id_serie){
            $this->_id_serie = $_id_serie;
        }
    }
