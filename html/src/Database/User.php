<?php
    require_once('DB.php');

    class User {
        private $_DB;
        private $_table = "users";

        public function __construct($DB) {
            $this->_DB = $DB;
        }

        public function checkUser($username, $password) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT * from ${table} WHERE phoneNumber = (?) AND passwd = (?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $stmt->close();
                $conexion->close();
                return ($resultado->num_rows);
            } catch (Exception $e) {
                return false;
            }
        }


        public function checkUserByUsername($username) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT * from ${table} WHERE phoneNumber = (?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $stmt->close();
                $conexion->close();
                return ($resultado->num_rows);
            } catch (Exception $e) {
                return false;
            }
        }

        public function createAccount($user) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "INSERT INTO ${table} (phoneNumber, passwd, avatar) VALUES (?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('sss', $user["Username"], $user["Password"], $user["Avatar"]);
                $stmt->execute();
                $stmt->close();
                $conexion->close();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        public function getUserByPhoneNumber($phoneNumber) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT * from ${table} WHERE phoneNumber = (?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('s', $phoneNumber);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $stmt->close();
                $conexion->close();
                return $resultado->fetch_assoc();
            } catch (Exception $e) {
                return false;
            }
        }
    }