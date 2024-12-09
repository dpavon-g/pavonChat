<?php
    require_once('DB.php');

    class Contacto {
        private $_DB;
        private $_table = "contactos";

        public function __construct($DB) {
            $this->_DB = $DB;
        }

        public function getContactsById($userID) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT * from ${table} WHERE userContactId = (?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('i', $userID);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $stmt->close();
                $conexion->close();
                return $resultado;
            } catch (Exception $e) {
                return false;
            }
        }
    }