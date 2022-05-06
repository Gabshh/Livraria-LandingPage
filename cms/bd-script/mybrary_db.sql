create database db_mybrary;

drop table if exists tbl_categorias;

show databases;

use db_mybrary;

create table tbl_contatos (
	id_contato int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(100) NOT NULL,
	sobrenome varchar(100) NOT NULL,
	email varchar(320) NOT NULL,
	celular varchar(19) NOT NULL,
	mensagem text
);

insert into tbl_contatos (nome, sobrenome, email, celular, mensagem) values ('MC', 'Queen', 'LightningMCQueen@gmail.com', '11940028922', 'oi sua livraria é top :)'), 
																			('Josh', 'Door', 'wheresthedoorjosh@gmail.com', '11940028922', 'is right there see'),
                                                                            ('MC', 'Queen', 'LightningMCQueen@gmail.com', '11940028922', 'oi sua livraria é top :)');
show tables;

desc tbl_categorias;

select * from tbl_produtos;

delete from tbl_contatos where id_contato = 1;

create table tbl_categorias (
	id_categoria int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(100) NOT NULL,
	icone varchar(100) NOT NULL
);

insert into tbl_categorias (nome, icone) values ('sus', 'ඞ'), 
												('terror', 'icon..'),
												('Contos', ':D');


create table tbl_usuarios (
	id_usuario int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar(100) NOT NULL,
	email varchar(320) NOT NULL,
    senha varchar(32) NOT NULL
);

insert into tbl_usuarios (nome, email, senha) values ('MrPoopyButtHole', 'owe@gmail.com', 'owe' ), 
													 ('Phoenix Person', 'chirp@gmail.com', 'chirp'),
													 ('BMO', 'yeahbmo@gmail.com', 'yeah');
                                                     
create table tbl_produtos (
	id_produto int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao varchar(45) NOT NULL,
    destaque boolean,
	preco DOUBLE(8,2) default 20,
    avaliacao tinyint default 3,
    desconto DOUBLE(4,3),
    sinopse text
);

insert into tbl_produtos (descricao, destaque, preco, avaliacao, desconto, sinopse) values ('Livro', true, 50, 5, 5, 'sinopse maneira' ), 
																						   ('Livro', true, 100, 5, 2, 'sinopse legal'),
																						   ('Livro', true, 20, 5, 5, 'sinopse FODA');
