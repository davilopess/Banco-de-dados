CREATE DATABASE db_clientes;

USE db_clientes;

CREATE TABLE table_clientes
(
  cliente_id INT(11)
  AUTO_INCREMENT,
  nome VARCHAR
  (100)     NOT NULL,
  data_nasc DATE        NOT NULL,
  telefone VARCHAR
  (14)  NOT NULL,
  foto VARCHAR
  (255),

  PRIMARY KEY
  (cliente_id)
)
