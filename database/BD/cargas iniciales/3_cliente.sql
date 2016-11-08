-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2016 a las 02:09:01
-- Versión del servidor: 10.1.16-MariaDB

-- Base de datos: `bdplanificamype`


INSERT INTO `cliente` ( `nombres`, `apellidoPaterno`, `apellidoMaterno`, `razonSocial`, `numeroDocumento`, `fechaNacimiento`, `genero`, `telefono`, `correo`, `direccion`, `referencia`, `credito`, `idTipoDocumento`, `idZona`) VALUES
( 'Henry', 'Espinoza', 'Torres', NULL, '46618582', '1990-11-20 00:00:00', 1, '930414373', 'henryespinozat@gmail.com', 'Mz f4 tl 11', 'cerca a la comiseria de 10 de octubre', 0, 1, 5),
( 'Edgar', 'Espinoza', 'Torres', NULL, '12345678', '1986-03-31 00:00:00', 1, '123456789', 'edgarespinozat@gmail.com', 'mz a 14 lt 22', 'cerca a la losa deportiva de 10 de octubre', 0, 1, 5),
( 'Maria', 'Torres', 'Valencia', NULL, '78965412', '1975-06-28 00:00:00', 2, '789654132', 'mariatorresval@gmail.com', 'mz f4 lt 11', 'cerca a la comisaria', 1, 1, 5),
( 'Jaime', 'Torres', 'Torres', NULL, '58423658', '1989-07-28 00:00:00', 1, '78542365', 'jaimetorrest@gmail.com', 'mz z lt 40', 'Cerca a la curva de motupe', 0, 1, 1),
( 'Angel', 'Sandoval', 'Linares', NULL, '55521456', '2002-11-04 00:00:00', 1, '222541875', 'angelsandoval@gmail.com', 'mz r5 lt 19', 'nada', 1, 1, 4),
( 'nuevo', 'ap', 'ma', NULL, '44635241', '1999-11-03 00:00:00', 2, '256325412', 'rgdtrt@dasd.com', 'algo', 'algo', 1, 1, 4);

