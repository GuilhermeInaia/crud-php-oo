CREATE DATABASE db_escola;

USE db_escola;

CREATE TABLE tb_alunos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NULL,
    matricula VARCHAR(20) UNIQUE NULL,
    email VARCHAR(100) UNIQUE NULL,
    status TINYINT NOT NULL,
    genero VARCHAR(20),
    dataNascimento DATETIME NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL
);

CREATE TABLE tb_professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    endereco VARCHAR(45) UNIQUE NULL,
    formacao VARCHAR(45) UNIQUE NULL,
    status TINYINT NOT NULL,
    cpf CHAR(11)
);

CREATE TABLE tb_cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(55) NOT NULL,
    cargaHoraria VARCHAR(45) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    status TINYINT NOT NULL
);

CREATE TABLE tb_categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(55) NOT NULL,
    vagas VARCHAR(55) NOT NULL,
    localidade VARCHAR (55) NOT NULL
);

CREATE TABLE tb_user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(55) NOT NULL,
    email VARCHAR(55)UNIQUE NOT NULL,
    senha VARCHAR (255) NOT NULL,
    perfil VARCHAR (55) NOT NULL
);
