CREATE DATABASE IF NOT EXISTS myDB;

USE myDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phoneNumber VARCHAR(15) NOT NULL UNIQUE,
    passwd VARCHAR(100) NOT NULL,
    avatar VARCHAR(50)
);

create TABLE IF NOT EXISTS contactos (
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    surnames VARCHAR(50),
    phoneNumber VARCHAR(15),
    photo VARCHAR(50),
    userContactId int,
    FOREIGN KEY (userContactId) REFERENCES users(id),
    FOREIGN KEY (phoneNumber) REFERENCES users(phoneNumber)
);

create TABLE IF NOT EXISTS mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remitente_id INT NOT NULL,
    receptor_id INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remitente_id) REFERENCES users(id),
    FOREIGN KEY (receptor_id) REFERENCES users(id)
);

