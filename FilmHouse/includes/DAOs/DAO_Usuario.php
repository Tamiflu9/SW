<?php

    namespace filmhouse\DAOs;


    Class DAO_Usuario{
        private $myDB;

        private $table = "usuario";
        private $columns = array("_id_usuario", "Nombre", "Email", "Password", "Descripcion", "Imagen", "Rol");

        function __construct() {
            $this->myDB = DB::getInstance();
        }

        function __destruct() {
            $this->myDB = NULL;
        }

        function create($usuario) {

            $result = $this->myDB->insert($this->table, array($usuario->getID(), $usuario->getNombre(), $usuario->getEmail(), $usuario->getPassword(), $usuario->getDescripcion(), $usuario->getImagen(), $usuario->getRol()));
            return $result;
        }

        function read($id_usuario) {
            $result = $this->myDB->select($this->table, $this->columns, array("_id_usuario = '$id_usuario'"), 1);

            if($result != NULL) {
                $_id_usuario = $result['_id_usuario'];
                $Nombre = $result['Nombre'];
                $Email  = $result['Email'];
                $Password  = $result['Password'];
                $Descripción = $result['Descripcion'];
                $Imagen = $result['Imagen'];
                $Rol = $result['Rol'];

                $u = new Usuario($_id_usuario, $Nombre, $Email, $Password, $Descripción, $Imagen, $Rol);
                $this->myDB->free();
                return $u;
            }
        }

        function delete($usuario) {
            $id_usuario = $usuario->getID();
            
            $result = $this->myDB->delete($this->table, array("_id_usuario = '$id_usuario'"));

            return $result;
        }

        function update($usuario){
            $_id_usuario = $usuario->getID(); 
            $Nombre = $usuario->getNombre();
            $Email  = $usuario->getEmail();
            $Password  = $usuario->getPassword();
            $Descripcion = $usuario->getDescripcion();
            $Imagen = $usuario->getImagen();
            $Rol = $usuario->getRol();

            $result = $this->myDB->update($this->table, array("Nombre = '$Nombre'", "Email = '$Email'", "Password = '$Password'", "Descripcion = '$Descripcion'", "Imagen = '$Imagen'", "Rol = $Rol"), array("_id_usuario = '$_id_usuario'"));

            return $result;
        }
    }
