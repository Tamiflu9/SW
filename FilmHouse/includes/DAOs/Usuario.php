<?php

    namespace filmhouse\DAOs;
    
    class Usuario{
        
        private $id_usuario;
        private $Nombre;
        private $Email;
        private $Password;
        private $Descripcion;
        private $Imagen;
        private $Rol;

        public function __construct($id_usuario, $Nombre, $Email, $Password, $Descripcion, $Imagen, $Rol) {
            $this->id_usuario = $id_usuario;
            $this->Email = $Email;
            $this->Nombre = $Nombre;
            $this->Password = $Password;
            $this->Descripcion = $Descripcion;
            $this->Imagen = $Imagen;
            $this->Rol = $Rol;
        }

        public function compruebaPassword($password){
            return password_verify($password, $this->Password);
        }

        function getID() {
            return $this->id_usuario;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function getEmail() {
            return $this->Email;
        }

        function getPassword() {
            return $this->Password;
        }

        function getDescripcion() {
            return $this->Descripcion;
        }

        function getImagen() {
            return $this->Imagen;
        }

        function getRol() {
            return $this->Rol;
        }

        function setID($id_usuario) {
            $this->id_usuario = $id_usuario;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

        function setEmail($Email) {
            $this->Email = $Email;
        }

        function setPassword($Password) {
            $this->Password = $Password;
        }

        function setDescripcion($Descripcion) {
            $this->Descripcion = $Descripcion;
        }

        function setImagen($Imagen) {
            $this->Imagen = $Imagen;
        }

        function setRol($Rol) {
            $this->Rol = $Rol;
        }
        public function anadirPeliFav($id)
        {
            $app = \filmhouse\Aplicacion::getInstance();
            if(!$app->usuarioLogueado()){
                header('Location: '.$app->resuelve('fallo.php'));
            }
            
            $dao = new DAO_FavoritosPeli();
            $entry = $dao->read($this->getID(),$id);
            if(! isset($entry)){
                $fp = new FavoritosPeli($this->getID(),$id);
                $dao->create($fp);
            }

        }

        public function borrarPeliFav($id)
        {
            $app = \filmhouse\Aplicacion::getInstance();
            if(!$app->usuarioLogueado()){
                header('Location: '.$app->resuelve('fallo.php'));
            }
            
            $dao = new DAO_FavoritosPeli();
            $entry = $dao->read($this->getID(),$id);
            if(isset($entry)){
                $fp = new FavoritosPeli($this->getID(),$id);
                $dao->delete($fp);
            }

        }


        public function anadirSerieFav($id)
        {
            $app = \filmhouse\Aplicacion::getInstance();
            if(!$app->usuarioLogueado()){
                header('Location: '.$app->resuelve('fallo.php'));
            }
            
            $dao = new DAO_FavoritosSerie();
            $entry = $dao->read($this->getID(),$id);
            if(! isset($entry)){
                $fs = new FavoritosSerie($this->getID(),$id);
                $dao->create($fs);
            }

        }

        public function borrarSerieFav($id)
        {
            $app = \filmhouse\Aplicacion::getInstance();
            if(!$app->usuarioLogueado()){
                header('Location: '.$app->resuelve('fallo.php'));
            }
            
            $dao = new DAO_FavoritosSerie();
            $entry = $dao->read($this->getID(),$id);
            if( isset($entry)){
                $fs = new FavoritosSerie($this->getID(),$id);
                $dao->delete($fs);
            }

        }

        public function anadirAmigo($idUsu)
        {
            $app = \filmhouse\Aplicacion::getInstance();
            $dao = new DAO_Amigos();
            $entry = $dao->read($this->getID(),$idUsu);
            if(! isset($entry)){
                $a = new Amistad($this->getID(),$idUsu);
                $dao->create($a);
                header('Location: '.$app->resuelve('index.php'));
            }
        }

        function borrarAmigo($idUsu){
            $app = \filmhouse\Aplicacion::getInstance();
            $dao = new DAO_Amigos();
            $idUsuario =  $app->idUsuario();
        
            $amistad = $dao->read($this->getID(), $idUsu);
            if(isset($amistad)){
                $dao->delete($amistad);
            }
        }
    }
