-- Seleciona o banco de dados
create database deck_royale;
USE deck_royale;

-- Cria a tabela usuario
CREATE TABLE IF NOT EXISTS usuario (
  id INT AUTO_INCREMENT ,
  nome VARCHAR(20) NOT NULL,
  perfil VARCHAR(15) NOT NULL,
  email VARCHAR(50) NOT NULL,
  senha VARCHAR(50) NOT NULL,
  CONSTRAINT pk_usuario PRIMARY KEY(id)
);

-- Insere os dados na tabela usuario
INSERT INTO usuario (id, nome, perfil, email, senha) VALUES
  (1, 'Murilo', 'User', 'murilo@gmail.com', '1234'),
  (2, 'Luan','Admin', 'luan@gmail.com', '4321');
	