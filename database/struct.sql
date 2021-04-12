create database `devsalsa`;

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin123456789';
GRANT All Privileges ON devsalsa.* TO 'admin'@'localhost';

create table `usuarios` (`id` int not null auto_increment primary key, `nombre` varchar(255) not null, `correo` varchar(255) not null, `passw` varchar(255) not null, `activo` int not null) ENGINE='MyISAM';
