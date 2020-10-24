<?php

    namespace filmhouse\DAOs;
    
    Class DB {

        private $mysqli_connection = NULL;
        private $mysqli_result     = NULL;     

        private $DEBUG             = true;
        static private $instance   = NULL;

        private $mysqli_ip;
        private $mysqli_username;
        private $mysqli_password;
        private $mysqli_database;
        private $ultimo_id;

        public static function init($bdDatosConexion) { 
            //Datos cogidos de Aplicacion.php y config.php
            self::$instance = new self($bdDatosConexion);
        }

        public static function getInstance(){
            
            return self::$instance;
        }

        private function __construct($bdDatosConexion) {
            // Creamos la conexión con la base de datos
            if (isset($bdDatosConexion)) {
                $this->mysqli_ip = $bdDatosConexion['host'];
                $this->mysqli_database = $bdDatosConexion['bd'];
                $this->mysqli_username = $bdDatosConexion['user'];
                $this->mysqli_password = $bdDatosConexion['pass'];
            }

            $this->mysqli_connection = new \mysqli($this->mysqli_ip, $this->mysqli_username, $this->mysqli_password, $this->mysqli_database);
            
            // Comprobación de errores
            if($this->mysqli_connection->connect_errno) {
                if ($this->DEBUG)
                    error_log("Error en la conexión con la base de datos: " . $this->mysqli_connection->connect_error . ".");
                exit();
            }
            else if ($this->DEBUG) {
                error_log("Conectado.");
            }
            
        }

        function __destruct() {
            // Cerramos la conexión con la base de datos
            if($this->mysqli_connection) {
                mysqli_close($this->mysqli_connection);

                if ($this->DEBUG)
                    error_log("Conexión cerrada.");
            }
            
            // Destruimos la conexión
            $this->mysqli_connection = NULL;
        }
        function free() {
            // Cerramos la conexión con la base de datos
            if($this->mysqli_connection) {
               $this->mysqli_result->free();
               if ($this->DEBUG)
                    error_log("Se ha liberado correctamente.");
            }
            else{
                if ($this->DEBUG)
                    error_log("Error al liberar.");
            }
        }

        private function arrayToString($array, $encapsulator, $separator) {
            $result = "";
            
            for($i = 0; $i < count($array) - 1; ++$i) {
                $result .= $encapsulator . $array[$i] . $encapsulator . " $separator ";
            }

            $result .= $encapsulator . $array[count($array) - 1] . $encapsulator;

            return $result;
        }

        function insert($table, $values, $columns = NULL) {
            if (!isset($table, $values))
                return false;
            if($columns == NULL)
            {
                $sql = sprintf("INSERT INTO $table values (" . $this->arrayToString($values, "'", ",") . ");");
            }
            else
            {
                $sql = sprintf("INSERT INTO $table (" .$this->arrayToString($columns, "", ","). ") values (" . $this->arrayToString($values, "'", ",") . ");");
            }
            if ($this->DEBUG)
                error_log("Consulta ejecutada: ". $sql .".");
            $this->mysqli_result = $this->mysqli_connection->query($sql);
            if(!$this->mysqli_result) {
                if ($this->DEBUG)
                    error_log("Error en la inserción en la base de datos: " . $this->mysqli_connection->error . ".");
                return false;
            }

            return true;
        }

        function select($table, $columns, $conditions, $limit ,$ifclause = "&&", $order = NULL) {
            if (!isset($table, $columns, $conditions))
                return NULL;
            
            if (!isset($limit) || $limit < 0)
                $limit = 1;
            
            if($order !== NULL)
                $orderby = " ORDER BY ". $order;
            else 
                $orderby = NULL;

            $sql = sprintf("SELECT " . $this->arrayToString($columns, "", ",") . " FROM $table WHERE " . $this->arrayToString($conditions, "", $ifclause) . $orderby);

            if ($limit != 0)
                $sql .= sprintf(" LIMIT $limit");
            
            $sql .= sprintf(";");

            if ($this->DEBUG)
                error_log("Consulta ejecutada: ". $sql .".");

            $this->mysqli_result = $this->mysqli_connection->query($sql); 
            if(!$this->mysqli_result) {
                if ($this->DEBUG)
                    error_log("Error en la lectura de la base de datos.");

                return NULL;
            }
            else {
                if ($limit != 1)
                    return $this->mysqli_result->fetch_all(MYSQLI_ASSOC);
                else
                    return $this->mysqli_result->fetch_array();
            }
        }

        function delete($table, $conditions) {
            if (!isset($table, $conditions))
                return false;
            
            $sql = sprintf("DELETE FROM $table WHERE " . $this->arrayToString($conditions, "", "&&") . ";");

            if ($this->DEBUG)
                error_log("Consulta ejecutada: ". $sql .".");
            $this->mysqli_result=$this->mysqli_connection->query($sql);
            if(!$this->mysqli_result) {
                if ($this->DEBUG)
                    error_log("Error al borrar en la base de datos.");

                return false;
            }
            return true;
        }

        function update($table, $values, $conditions) {
            if (!isset($table, $values, $conditions))
                return false;

            $sql = sprintf("UPDATE $table SET " . $this->arrayToString($values, "", ",") . " WHERE " . $this->arrayToString($conditions, "", "&&") . ";");

            if ($this->DEBUG)
                error_log("Consulta ejecutada: ". $sql .".");
            $this->mysqli_result = $this->mysqli_connection->query($sql);
            if(!$this->mysqli_result) {
                if ($this->DEBUG)
                    error_log("Error en la actualización de la base de datos.");

                return false;
            }

            return true;
        }
    }
