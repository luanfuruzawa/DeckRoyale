-- Seleciona o banco de dados
create database deck_royale;
USE deck_royale;

-- Cria a tabela usuario
CREATE TABLE IF NOT EXISTS usuario (
  id INT AUTO_INCREMENT ,
  perfil VARCHAR(15) NOT NULL,
  email VARCHAR(50) NOT NULL,
  senha VARCHAR(50) NOT NULL,
  CONSTRAINT pk_usuario PRIMARY KEY(id)
);

-- Insere os dados na tabela usuario
INSERT INTO usuario (id, perfil, email, senha) VALUES
  (1, 'User', 'murilo@gmail.com', '1234'),
  (2, 'Admin', 'luan@gmail.com', '4321');
	