<?php
    require_once('DB.php');

    class Mensajes {
        private $_DB;
        private $_table = "mensajes";

        public function __construct($DB) {
            $this->_DB = $DB;
        }

        // public function getConversation($userID) {
        //     try {
        //         $table = $this->_table;
        //         $conexion = $this->_DB->getConexion();
        //         $sql = "SELECT * from ${table} WHERE userContactId = (?)";
        //         $stmt = $conexion->prepare($sql);
        //         $stmt->bind_param('i', $userID);
        //         $stmt->execute();
        //         $resultado = $stmt->get_result();
        //         $stmt->close();
        //         $conexion->close();
        //         return $resultado;
        //     } catch (Exception $e) {
        //         return false;
        //     }
        // }

        public function createMessage($mensaje) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "INSERT INTO ${table} (remitente_id, receptor_id, mensaje) VALUES (?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('iis', $mensaje["mensaje"], $mensaje["remitenteId"], $mensaje["receptorId"]);
                $stmt->execute();
                $stmt->close();
                $conexion->close();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

    }