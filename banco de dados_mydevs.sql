CREATE DATABASE mydevs_db;
USE mydevs_db;
CREATE TABLE usuarios (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255),
    email VARCHAR(255),
    telefone VARCHAR(32),
    data_nasc DATE,
    senha VARCHAR(255),
    foto_usuario VARCHAR(255) NULL,
	 data DATETIME,
    idnt VARCHAR(15),
    descr VARCHAR(500),
    PRIMARY KEY (id_user));

CREATE TABLE posts (
  id_posts INT NOT NULL AUTO_INCREMENT,
  id_user_posts INT,
  titulo VARCHAR(200),
  descricao TEXT(2000),
  imagem VARCHAR(200),
  data VARCHAR(200),
  hora VARCHAR(200),
  PRIMARY KEY (id_posts));
  
CREATE TABLE comentarios (
	id_coment INT AUTO_INCREMENT,
	id_post_coment INT,
	id_user_post_coment INT,
	comentario VARCHAR(2000),
	data_coment VARCHAR(50),
	hora_coment VARCHAR(50),	
	PRIMARY KEY (id_coment));
	
CREATE TABLE favoritos (
	id_fav INT AUTO_INCREMENT,
	id_post_fav INT,
	id_user_fav INT,
	PRIMARY KEY (id_fav));