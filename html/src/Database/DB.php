<?php

    function createDB() {
        $host = "db";
        $baseDeDatos = "myDB";
        $usuario = "userdb";
        $pass = "passdb";

        $db = new DB($host, $baseDeDatos, $usuario, $pass);

        return $db;
    }

    class DB {
        private $_host;
        private $_baseDeDatos;
        private $_usuario;
        private $_password;

        public function __construct($host, $baseDeDatos, $usuario, $password) {
            $this->_host = $host;
            $this->_baseDeDatos = $baseDeDatos;
            $this->_usuario = $usuario;
            $this->_password = $password;
        }

        public function getConexion() {
            $conexion = new mysqli(
                $this->_host,
                $this->_usuario,
                $this->_password,
                $this->_baseDeDatos
            );
            return ($conexion);
        }

        public function getArrayFromResult($resultado) {
            $datos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $datos[] = $fila;
            }
            return ($datos);
        }
    }