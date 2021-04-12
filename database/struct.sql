create database `devsalsa`;

create table `usuarios` (`id` int not null auto_increment primary key, `nombre` varchar(255) not null, `correo` varchar(255) not null, `passw` varchar(255) not null, `activo` int not null) ENGINE='MyISAM';
