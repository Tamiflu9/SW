<?php

    namespace filmhouse\DAOs;
    class FavoritosPeli {
        
        private $_id_usuario;
        private $_id_pelicula;

        public function __construct($_id_usuario, $_id_pelicula) {
            $this->_id_usuario = $_id_usuario;
            $this->_id_pelicula = $_id_pelicula;
        }

        function getIDUsu() {
            return $this->_id_usuario;
        }

        function getIDPeli() {
            return $this->_id_pelicula;
        }

        function setIDUsu($_id_usuario) {
            $this->_id_usuario = $_id_usuario;
        }

        function setIDPeli($_id_pelicula) {
            $this->_id_pelicula = $_id_pelicula;
        }
    }