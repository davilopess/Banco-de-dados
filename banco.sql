create database banco;

use banco;

create table tipoconta (
	idtipoconta int primary key,
    descricao varchar(45) not null
);

create table cliente (
	idcliente int primary key,
    nome varchar(45) not null,
    data_nascimento date
);

create table conta (
	idconta int primary key,
    data_abertura date not null,
    saldo decimal(10,2) not null,
    idtipoconta int not null,
    idcliente int not null,
    foreign key(idtipoconta) references tipoconta(idtipoconta),
	foreign key(idcliente) references cliente(idcliente)
);

create table movimento (
	idmovimento int primary key,
    data_hora datetime not null,
    credito_debito char(1) not null,
    numero_documento varchar(20) not null,
    valor decimal(10,2) not null,
    idconta int not null,
    foreign key(idconta) references conta(idconta)
);

show tables;

alter table cliente add column cpf char(14) not null; 

describe movimento;

create table tipomovimento (
	idtipomovimento int primary key,
    descricao varchar(20) not null
);

alter table movimento change column numero_documento nr_doc varchar(20); 

alter table movimento modify column nr_doc varchar(20) not null; 

alter table movimento drop column credito_debito;

alter table movimento add column idtipomovimento int not null;

alter table movimento add foreign key (idtipomovimento) references tipomovimento (idtipomovimento);