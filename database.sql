CREATE DATABASE IF NOT EXISTS recircula_simples CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE recircula_simples;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE objetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(120) NOT NULL,
    descricao VARCHAR(1000) NOT NULL,
    tipo ENUM('doacao', 'troca') NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);