<?php
    require_once('DB.php');

    class Mensajes {
        private $_DB;
        private $_table = "messages";

        public function __construct($DB) {
            $this->_DB = $DB;
        }

        public function getConversation($remitenteId, $receptorId) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT * 
                        FROM ${table}
                        WHERE 
                            (remitente_id = (?) AND receptor_id = (?)) 
                            OR 
                            (remitente_id = (?) AND receptor_id = (?))
                        ORDER BY fecha_envio ASC;
                        ";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('iiii', $remitenteId, $receptorId, $receptorId, $remitenteId);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $stmt->close();
                $conexion->close();
                return $resultado;
            } catch (Exception $e) {
                return false;
            }
        }

        public function createMessage($mensaje) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "INSERT INTO ${table} (mensaje, remitente_id, receptor_id) VALUES (?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('sii', $mensaje["mensaje"], $mensaje["remitenteId"], $mensaje["receptorId"]);
                $stmt->execute();
                $stmt->close();
                $conexion->close();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

    }