CREATE DATABASE IF NOT EXISTS myDB;

USE myDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phoneNumber VARCHAR(15) NOT NULL,
    passwd VARCHAR(20) NOT NULL,
    avatar VARCHAR(50)
);

create TABLE IF NOT EXISTS contactos (
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    surnames VARCHAR(50),
    phoneNumber VARCHAR(15),
    photo VARCHAR(50),
    userContactId int,
    FOREIGN KEY (userContactId) REFERENCES users(id)
);

