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

INSERT INTO tb_alunos (nome, matricula, email, status, genero, dataNascimento, cpf)
VALUE ('Guilherme', '12', 'guilherme@gmail.com', true, 'Masculino', '1983-03-23', '23445767887'),
('Priscila', '23', 'priscila@gmail.com', true, 'Femenino', '1953-07-03', '84733074394'),
('Leandro', '34', 'leandro@gmail.com', true, 'Masculino', '1983-03-23', '29385473821');

SELECT * FROM tb_alunos;

------------------------------------------

USE db_escola;

CREATE TABLE tb_professores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    endereco VARCHAR(45) UNIQUE NULL,
    formacao VARCHAR(45) UNIQUE NULL,
    status TINYINT NOT NULL,
    cpf CHAR(11)
);

INSERT INTO tb_professores (nome, endereco, formacao, status,cpf)
VALUE ('Alessandro', 'Rua 1', 'PHP', true, '23445767887'),
('Allan', 'Rua 2', 'JavaScript', true, '84733074394'),
('Gledson', 'Rua 3', 'React', true, '29385473821');

SELECT * FROM tb_professores;

---------------------------------------

USE db_escola;

CREATE TABLE tb_cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(55) NOT NULL,
    cargaHoraria VARCHAR(45) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    status TINYINT NOT NULL
);

INSERT INTO tb_cursos (nome, cargaHoraria, descricao, status)
VALUE ('Desenvolvedor Full-Stack', '08:00 às 12:00', 'Curso Tecnico', true),
('Marketing Digital', '13:00 às 16:00', 'Curso Tecnico', true),
('Data Analytics', '18:00 às 22:00', 'Curso Tecnico', true);

SELECT * FROM tb_cursos;
-------------------------------------------

USE db_escola;

CREATE TABLE tb_categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(55) NOT NULL,
    vagas VARCHAR(55) NOT NULL,
    localidade VARCHAR (55) NOT NULL
);

INSERT INTO tb_categorias (nome, vagas, localidade)
VALUE ('Desenvolvedor Full-Stack', '24', 'Aldeota'),
('Marketing Digital', '24', 'Washington Soares'),
('Data Analytics', '24', 'Aldeota');

SELECT * FROM tb_categorias;