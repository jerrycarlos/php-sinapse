<?php 

$createDatabase = "create database if not exists sinapse";
$createUser = "create table if not exists usuario (id int autoincrement primary key, nome varchar(100) not null, email varchar(100) not null unique, senha varchar(100) not null)";
?>