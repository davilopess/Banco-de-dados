-- QUESTÃO 2

create database oficina;

use oficina;

create table Cliente (
  idCliente int not null primary key,
  Nome varchar(45) not null,
  Telefone char(15)
);

create table Veiculo (
  idVeiculo int not null,
  idCliente int not null,
  Placa char(8) not null,
  Marca varchar(20) not null,
  Modelo varchar(20) not null,
  primary key (idVeiculo, idCliente),
  foreign key (idCliente) references Cliente (idCliente)
);

create table OrdemServico (
  idOrdemServico int not null primary key,
  DataEntrada date not null,
  DataConclusao date,
  idVeiculo int not null,
  foreign key (idVeiculo) references Veiculo (idVeiculo)
);

create table Servico (
  idServico int not null primary key,
  Descricao varchar(45) not null,
  Valor decimal(10,2) not null,
  idOrdemServico int not null,
  foreign key (idOrdemServico) references OrdemServico (idOrdemServico)
);

-- QUESTÃO 3 a)

insert into Cliente (idCliente, Nome) values (1, "João");
insert into Veiculo (idVeiculo, idCliente, Placa, Marca, Modelo) values (1, 1, "HPP-1234", "FIAT", "UNO");
insert into OrdemServico (idOrdemServico, DataEntrada, idVeiculo) values (1, "2019-11-11", 1);
insert into Servico (idServico, idOrdemServico, Descricao, Valor) values (1, 1, "Troca de óleo", 250),
(2, 1, "Alinhamento e balanceamento", 120), (3, 1, "Lavagem geral", 20);

-- QUESTÃO 3 b)

select V.*, C.Telefone
from Veiculo V, Cliente C, OrdemServico O
where V.idCliente = C.idCliente
and O.idVeiculo = V.idVeiculo
and O.DataEntrada between "2019-10-01" and "2019-10-31"
and O.DataConclusao is null;

-- QUESTÃO 3 c)

select S.*
from Servico S, OrdemServico O, Veiculo V, Cliente C
where S.idOrdemServico = O.idOrdemServico
and O.idVeiculo = V.idVeiculo
and V.idCliente = C.idCliente
and C.Nome = "João";

-- QUESTÃO 3 d)

select sum(S.Valor)
from Servico S, OrdemServico O, Veiculo V, Cliente C
where S.idOrdemServico = O.idOrdemServico
and O.idOrdemServico = 1;

-- QUESTÃO 3 e)

update Servico set Valor = Valor*0.9
where idOrdemServico = 1;

-- QUESTÃO 3 f)

select O.idOrdemServico, O.DataEntrada, (select sum(S.Valor)
from Servico S where S.idOrdemServico = O.idOrdemServico) as 'Total'
from OrdemServico O
where O.DataConclusao is null
and O.DataEntrada between "2019-11-01" and "2019-11-30";

