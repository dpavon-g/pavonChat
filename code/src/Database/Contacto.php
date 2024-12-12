<?php
    require_once('DB.php');

    class Contacto {
        private $_DB;
        private $_table = "contacts";

        public function __construct($DB) {
            $this->_DB = $DB;
        }

        public function getFullContactInfo($contactID) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT ${table}.*, users.id AS userId, users.* 
                        FROM ${table} 
                        INNER JOIN users ON ${table}.phoneNumber = users.phoneNumber 
                        WHERE users.id = (?)";
            
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('i', $contactID); 
                $stmt->execute();
                $resultado = $stmt->get_result();
                $stmt->close();
                $conexion->close();
                return $resultado->fetch_assoc();
            } catch (Exception $e) {
                return false;
            }
        }

        public function getContactsById($userID) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "SELECT ${table}.*, users.id AS userId, users.* 
                        FROM ${table} 
                        INNER JOIN users ON ${table}.phoneNumber = users.phoneNumber 
                        WHERE ${table}.userContactId = (?)";
            
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

        public function createContact($contacto) {
            try {
                $table = $this->_table;
                $conexion = $this->_DB->getConexion();
                $sql = "INSERT INTO ${table} (name, surnames, phoneNumber, photo, userContactId) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param('ssssi', $contacto["Name"], $contacto["Surnames"], $contacto["PhoneNumber"], $contacto["Avatar"], $contacto["UserID"]);
                $stmt->execute();
                $stmt->close();
                $conexion->close();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

    }