CREATE DATABASE ACME;

USE ACME;

CREATE TABLE Departamento (
  idDepartamento INT NOT NULL,
  Nome VARCHAR(20) NOT NULL,
  Local VARCHAR(20) NOT NULL,
  idFuncionario INT NULL,
  PRIMARY KEY (idDepartamento)
);

CREATE TABLE  Funcionario (
  idFuncionario INT NOT NULL,
  Nome VARCHAR(40) NOT NULL,
  Sobrenome VARCHAR(20) NOT NULL,
  DataNasc DATE NOT NULL,
  Cargo VARCHAR(20) NOT NULL,
  Salario DECIMAL(12,2) NOT NULL,
  idDepartamento INT NOT NULL,
  PRIMARY KEY (idFuncionario),
  FOREIGN KEY (idDepartamento) REFERENCES Departamento (idDepartamento)
);

CREATE TABLE Projeto (
  idProjeto INT NOT NULL,
  Descricao VARCHAR(40) NOT NULL,
  HorasPrev VARCHAR(45) NOT NULL,
  idFuncionario INT NOT NULL,
  PRIMARY KEY (idProjeto),
  FOREIGN KEY (idFuncionario) REFERENCES Funcionario (idFuncionario)
);

insert into Departamento (idDepartamento,Nome,Local,idFuncionario) values (101,'Administração','Matriz',1006);
insert into Departamento (idDepartamento,Nome,Local,idFuncionario) values (102,'Vendas','Filial',1001);
insert into Departamento (idDepartamento,Nome,Local,idFuncionario) values (103,'Recursos Humanos','Matriz',1008);
insert into Departamento (idDepartamento,Nome,Local,idFuncionario) values (104,'Diretoria','Matriz',1003);
insert into Departamento (idDepartamento,Nome,Local,idFuncionario) values (105,'CPD','Matriz',1009);

insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1001,'Alberto','Silva','1970-01-05','Supervisor',5000,102);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1002,'Silvia','Pires','1985-05-13','Vendedor',2500,102);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1003,'Mário','Oliveira','1970-11-20','Diretor',10000,104);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1004,'Roberto','Albuquerque','1981-03-05','Supervisor',5300,101);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1005,'Horácio','Almeida','1973-10-18','Gerente',8000,103);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1006,'Fabiana','Rossi','1980-08-07','Gerente',8000,101);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1007,'Maria','Silva','1979-03-07','Vendedor',2700,102);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1008,'Joana','Pereira','1965-04-17','Supervisor',8000,103);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1009,'Márcia','Sousa','1968-12-05','Gerente',8500,105);
insert into Funcionario (idFuncionario,Nome,Sobrenome,DataNasc,Cargo,Salario,idDepartamento) values (1010,'Antônio','Santos','1988-02-07','Programador',3500,105);

insert into Projeto (idProjeto,Descricao,HorasPrev,idFuncionario) values (1,'Ampliação do setor de vendas',100,1001);
insert into Projeto (idProjeto,Descricao,HorasPrev,idFuncionario) values (2,'Implantação do sistema de RH',80,1009);
insert into Projeto (idProjeto,Descricao,HorasPrev,idFuncionario) values (3,'Auditoria interna',120,1004);

select * from Departamento;
select * from Funcionario;
select * from Projeto;

select d.nome, f.nome 
from departamento as d, funcionario as f
where d.iddepartamento = f.iddepartamento
order by d.nome, f.nome;

select * from departamento;
select * from funcionario where iddepartamento = 103;

select * from funcionario
where iddepartamento = (select iddepartamento
						from departamento where nome = 'Recursos Humanos');
                        
select f.*
from departamento d, funcionario f where d.iddepartamento = f.iddepartamento and d.nome = 'Recursos Humanos';

select p.*, f.nome, f.sobrenome
from projeto p, funcionario f
where p.idfuncionario = f.idfuncionario;

update funcionario set salario = salario*1.05
where idfuncionario not in 
(select idfuncionario from departamento);
and iddepartamento = ( select iddepartamento from departamento where nome = 'Vendas');

select * from funcionario;


                        