/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bdplanificamype

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-12 01:20:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articulo
-- ----------------------------
DROP TABLE IF EXISTS `articulo`;
CREATE TABLE `articulo` (
  `idArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `precioBase` double NOT NULL,
  `stock` double NOT NULL,
  `volumen` double NOT NULL,
  `tiempoHorasAbastecer` int(11) DEFAULT NULL,
  `combinable` tinyint(1) NOT NULL,
  `minimoDivisible` double NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `idTipoCarga` int(11) NOT NULL,
  `idUnidadMedida` int(11) NOT NULL,
  PRIMARY KEY (`idArticulo`),
  KEY `FK_Articulo_Marca_idx` (`idMarca`),
  KEY `FK_Articulo_TipoCarga_idx` (`idTipoCarga`),
  KEY `FK_Articulo_UnidadMedida_idx` (`idUnidadMedida`),
  CONSTRAINT `FK_Articulo_Marca` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Articulo_TipoCarga` FOREIGN KEY (`idTipoCarga`) REFERENCES `tipocarga` (`idTipoCarga`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Articulo_UnidadMedida` FOREIGN KEY (`idUnidadMedida`) REFERENCES `unidadmedida` (`idUnidadMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of articulo
-- ----------------------------
INSERT INTO `articulo` VALUES ('1', 'Cemento sol tipo 1', '28.5', '4445', '0.01', null, '1', '1', '1', '2', '1', '3');
INSERT INTO `articulo` VALUES ('2', 'Arena gruesa', '55.5', '4985', '1', null, '0', '0.5', '1', '6', '1', '2');
INSERT INTO `articulo` VALUES ('3', 'Arena fina', '50', '4996', '1', null, '0', '0.5', '1', '11', '1', '2');
INSERT INTO `articulo` VALUES ('4', 'Ladrillo pandereta', '0.5', '11000', '0.001', null, '1', '1', '1', '8', '1', '5');
INSERT INTO `articulo` VALUES ('5', 'Fierro de 1/2\"', '28.5', '4796', '0.01', null, '1', '1', '1', '9', '3', '4');
INSERT INTO `articulo` VALUES ('6', 'Fierro de 5/8\"', '54', '10950', '0.01', null, '1', '1', '1', '9', '3', '4');
INSERT INTO `articulo` VALUES ('7', 'Clavo 2\"', '4.5', '15000', '0', null, '1', '1', '1', '9', '2', '1');
INSERT INTO `articulo` VALUES ('8', 'Yeso', '0.5', '7000', '0', null, '1', '1', '1', '11', '2', '1');

-- ----------------------------
-- Table structure for cargo
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cargo
-- ----------------------------
INSERT INTO `cargo` VALUES ('1', 'Administrador del sistema', 'Persona que administra el sistema de informacion.');
INSERT INTO `cargo` VALUES ('2', 'Supervisor', 'Persona que se encarga de la planificacion de los pedidos');
INSERT INTO `cargo` VALUES ('3', 'Recepcionista', 'Persona que registra los nuevos pedidos ');
INSERT INTO `cargo` VALUES ('4', 'Chofer', 'Persona que se encarga de enviar los pedidos al cliente');

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `razonSocial` varchar(100) DEFAULT NULL,
  `numeroDocumento` varchar(20) NOT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `genero` tinyint(1) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `credito` tinyint(1) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `FK_Cliente_TipoDocumento_idx` (`idTipoDocumento`),
  KEY `FK_Cliente_Zona_idx` (`idZona`),
  CONSTRAINT `FK_Cliente_TipoDocumento` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`idTipoDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Cliente_Zona` FOREIGN KEY (`idZona`) REFERENCES `zona` (`idZona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES ('1', 'Maria', 'Torres', 'Valencia', null, '88885554', '1999-11-09 00:00:00', '2', '478569856', 'maria@corre.com', 'Mz A1 LT 1', 'cerca', '1', '1', '1');
INSERT INTO `cliente` VALUES ('2', 'Juan', 'Perez', 'Garcia', null, '45877785', '1997-02-04 00:00:00', '1', '222315698', 'juan@correo.com', 'Mz A2 Lt2', 'cerca', '1', '1', '1');
INSERT INTO `cliente` VALUES ('3', 'Edgar', 'Espinza', 'Torres', null, '85558746', '1960-04-06 00:00:00', '1', '222315648', 'edgar@correo.com', 'Mz C3 Lt 3', 'cerca', '0', '1', '2');
INSERT INTO `cliente` VALUES ('4', 'yesenia', 'Perez', 'Aguilar', null, '33365295', '1979-02-13 00:00:00', '2', '236555459', 'yesenia@correo.com', 'Mz D4 Lt 4', 'Cerca', '0', '1', '2');
INSERT INTO `cliente` VALUES ('5', 'luis', 'Rios', 'Alejos', null, '12345678', '1979-02-13 00:00:00', '2', '236555459', 'rios@correo.com', 'av. siempre viva 301', 'Cerca', '0', '1', '3');
INSERT INTO `cliente` VALUES ('6', 'manuel', 'tupia', 'anticona', null, '12345679', '1979-02-13 00:00:00', '2', '236115459', 'tupia@correo.com', 'av. siempre viva 302', 'Cerca', '0', '1', '3');
INSERT INTO `cliente` VALUES ('7', 'juan', 'arenas', 'Iparraguirre', null, '12345671', '1979-02-13 00:00:00', '2', '236665459', 'juan@correo.com', 'av. siempre viva 303', 'Cerca', '0', '1', '3');
INSERT INTO `cliente` VALUES ('8', 'jose', 'arguedas', 'arguedas', null, '12345675', '2018-02-12 00:00:00', '1', '1472589614', '', 'av. siempre viva 309', '', '0', '1', '3');

-- ----------------------------
-- Table structure for detallepedido
-- ----------------------------
DROP TABLE IF EXISTS `detallepedido`;
CREATE TABLE `detallepedido` (
  `idPedido` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `cantidadAtendida` double NOT NULL,
  `precioUnitario` double NOT NULL,
  `monto` double NOT NULL,
  PRIMARY KEY (`idPedido`,`idArticulo`),
  KEY `FK_DetallePedido_Articulo_idx` (`idArticulo`),
  CONSTRAINT `FK_DetallePedido_Articulo` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetallePedido_Pedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detallepedido
-- ----------------------------
INSERT INTO `detallepedido` VALUES ('1', '1', '500', '0', '28.5', '14250');
INSERT INTO `detallepedido` VALUES ('1', '2', '10', '0', '55.5', '555');
INSERT INTO `detallepedido` VALUES ('1', '4', '5000', '0', '0.5', '2500');
INSERT INTO `detallepedido` VALUES ('1', '5', '200', '0', '28.5', '5700');
INSERT INTO `detallepedido` VALUES ('2', '1', '50', '0', '28.5', '1425');
INSERT INTO `detallepedido` VALUES ('2', '2', '4', '0', '55.5', '222');
INSERT INTO `detallepedido` VALUES ('2', '3', '2', '0', '50', '100');
INSERT INTO `detallepedido` VALUES ('3', '2', '1', '0', '55.5', '55.5');
INSERT INTO `detallepedido` VALUES ('3', '3', '2', '0', '50', '100');
INSERT INTO `detallepedido` VALUES ('3', '5', '4', '0', '28.5', '114');
INSERT INTO `detallepedido` VALUES ('3', '6', '50', '0', '54', '2700');
INSERT INTO `detallepedido` VALUES ('4', '1', '5', '0', '28.5', '142.5');

-- ----------------------------
-- Table structure for detalleviaje
-- ----------------------------
DROP TABLE IF EXISTS `detalleviaje`;
CREATE TABLE `detalleviaje` (
  `idPedido` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `cantidadDescargado` double NOT NULL,
  PRIMARY KEY (`idPedido`,`idViaje`,`idArticulo`),
  KEY `FK_DetalleViaje_Articulo_idx` (`idArticulo`),
  KEY `FK_DetalleViaje_viaje_idx` (`idViaje`),
  CONSTRAINT `FK_DetalleViaje_Articulo` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetalleViaje_PedidoXViaje_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidoxviaje` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetalleViaje_PedidoXViaje_2` FOREIGN KEY (`idViaje`) REFERENCES `pedidoxviaje` (`idViaje`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detalleviaje
-- ----------------------------

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(100) NOT NULL,
  `apellidoMaterno` varchar(100) NOT NULL,
  `numeroDocumento` varchar(20) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `sueldo` double NOT NULL,
  `licencia` varchar(50) DEFAULT NULL,
  `fechaIngreso` datetime NOT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `idCargo` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  KEY `FK_Empleado_TipoDocumento_idx` (`idTipoDocumento`),
  KEY `FK_Empleado_Cargo_idx` (`idCargo`),
  CONSTRAINT `FK_Empleado_Cargo` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Empleado_TipoDocumento` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`idTipoDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of empleado
-- ----------------------------
INSERT INTO `empleado` VALUES ('1', 'Henry Antonio', 'Espinoza', 'Torres', '46618582', 'henryespinozat@gmail.com', 'Activo', '500', null, '2016-05-01 00:00:00', null, '1', '1');

-- ----------------------------
-- Table structure for marca
-- ----------------------------
DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of marca
-- ----------------------------
INSERT INTO `marca` VALUES ('1', 'Otro');
INSERT INTO `marca` VALUES ('2', 'Sol');
INSERT INTO `marca` VALUES ('3', 'Andino');
INSERT INTO `marca` VALUES ('4', 'Matusita');
INSERT INTO `marca` VALUES ('5', 'Nicoll');
INSERT INTO `marca` VALUES ('6', 'Molina');
INSERT INTO `marca` VALUES ('7', 'Huachipa');
INSERT INTO `marca` VALUES ('8', 'Lark');
INSERT INTO `marca` VALUES ('9', 'Aceros arequipa');
INSERT INTO `marca` VALUES ('10', 'Eternit');
INSERT INTO `marca` VALUES ('11', 'Generico');

-- ----------------------------
-- Table structure for marcavehiculo
-- ----------------------------
DROP TABLE IF EXISTS `marcavehiculo`;
CREATE TABLE `marcavehiculo` (
  `idMarcaVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idMarcaVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of marcavehiculo
-- ----------------------------
INSERT INTO `marcavehiculo` VALUES ('1', 'otro');
INSERT INTO `marcavehiculo` VALUES ('2', 'toyota');
INSERT INTO `marcavehiculo` VALUES ('3', 'mitsubishi');
INSERT INTO `marcavehiculo` VALUES ('4', 'izuzu');
INSERT INTO `marcavehiculo` VALUES ('5', 'volvo');
INSERT INTO `marcavehiculo` VALUES ('6', 'suzuki');
INSERT INTO `marcavehiculo` VALUES ('7', 'isuzu');

-- ----------------------------
-- Table structure for pedido
-- ----------------------------
DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `fechaRegistro` datetime NOT NULL,
  `fechaEnvio` datetime NOT NULL,
  `montoTotal` double NOT NULL,
  `montoPagado` double NOT NULL,
  `estado` varchar(20) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `idZona` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `FK_Pedido_Cliente_idx` (`idCliente`),
  KEY `FK_Pedido_Empleado_idx` (`idEmpleado`),
  KEY `FK_Pedido_Zona_idx` (`idZona`),
  CONSTRAINT `FK_Pedido_Cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Pedido_Empleado` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Pedido_Zona` FOREIGN KEY (`idZona`) REFERENCES `zona` (`idZona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pedido
-- ----------------------------
INSERT INTO `pedido` VALUES ('1', '2018-02-12 00:41:28', '2018-02-12 00:00:00', '23005', '23000', 'Confirmado', '236115459', 'av. siempre viva 302', 'Cerca', '3', '6', '1');
INSERT INTO `pedido` VALUES ('2', '2018-02-12 00:49:18', '2018-02-12 00:00:00', '1747', '1747', 'Confirmado', '236555459', 'av. siempre viva 301', 'Cerca', '3', '5', '1');
INSERT INTO `pedido` VALUES ('3', '2018-02-12 00:50:41', '2018-02-12 00:00:00', '2969.5', '2970', 'Confirmado', '236665459', 'av. siempre viva 303', 'Cerca', '3', '7', '1');
INSERT INTO `pedido` VALUES ('4', '2018-02-12 01:02:01', '2018-02-12 00:00:00', '142.5', '142.5', 'Confirmado', '1472589614', 'av. siempre viva 309', '', '3', '8', '1');

-- ----------------------------
-- Table structure for pedidoxviaje
-- ----------------------------
DROP TABLE IF EXISTS `pedidoxviaje`;
CREATE TABLE `pedidoxviaje` (
  `idPedido` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `montoCobrado` double DEFAULT NULL,
  `fechaAlmacen` datetime DEFAULT NULL,
  `fechaUbicado` datetime DEFAULT NULL,
  `fechaEntrega` datetime DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idPedido`,`idViaje`),
  KEY `FK_PedidoXViaje_Viaje_idx` (`idViaje`),
  CONSTRAINT `FK_PedidoXViaje_Pedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PedidoXViaje_Viaje` FOREIGN KEY (`idViaje`) REFERENCES `viaje` (`idViaje`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pedidoxviaje
-- ----------------------------

-- ----------------------------
-- Table structure for tipocarga
-- ----------------------------
DROP TABLE IF EXISTS `tipocarga`;
CREATE TABLE `tipocarga` (
  `idTipoCarga` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTipoCarga`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipocarga
-- ----------------------------
INSERT INTO `tipocarga` VALUES ('1', 'Carga normal', 'Es la carga que va en la tolva del camion');
INSERT INTO `tipocarga` VALUES ('2', 'Carga pequeña', 'Es la carga de poco volumen que puede ser transportado en la cabina.');
INSERT INTO `tipocarga` VALUES ('3', 'Carga aerea', 'Es la carga que va en la superior de la tolva.');

-- ----------------------------
-- Table structure for tipodocumento
-- ----------------------------
DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE `tipodocumento` (
  `idTipoDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipodocumento
-- ----------------------------
INSERT INTO `tipodocumento` VALUES ('1', 'DNI', 'Documento nacional de identidad de un ciudadano peruano');
INSERT INTO `tipodocumento` VALUES ('2', 'Pasaporte', 'Documento de identificación para los extranjeros');

-- ----------------------------
-- Table structure for tipovehiculo
-- ----------------------------
DROP TABLE IF EXISTS `tipovehiculo`;
CREATE TABLE `tipovehiculo` (
  `idTipoVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTipoVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipovehiculo
-- ----------------------------
INSERT INTO `tipovehiculo` VALUES ('1', 'Camioneta pequeña', null);
INSERT INTO `tipovehiculo` VALUES ('2', 'Camioneta normal', null);
INSERT INTO `tipovehiculo` VALUES ('3', 'Camioneta grande', null);

-- ----------------------------
-- Table structure for tipovehiculoxtipocarga
-- ----------------------------
DROP TABLE IF EXISTS `tipovehiculoxtipocarga`;
CREATE TABLE `tipovehiculoxtipocarga` (
  `idTipoVehiculo` int(11) NOT NULL,
  `idTipoCarga` int(11) NOT NULL,
  `volumen` double DEFAULT NULL,
  PRIMARY KEY (`idTipoVehiculo`,`idTipoCarga`),
  KEY `FK_TipoVehiculoXTipoCarga_TipoCarga_idx` (`idTipoCarga`),
  CONSTRAINT `FK_TipoVehiculoXTipoCarga_TipoCarga` FOREIGN KEY (`idTipoCarga`) REFERENCES `tipocarga` (`idTipoCarga`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_TipoVehiculoXTipoCarga_TipoVehiculo` FOREIGN KEY (`idTipoVehiculo`) REFERENCES `tipovehiculo` (`idTipoVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipovehiculoxtipocarga
-- ----------------------------
INSERT INTO `tipovehiculoxtipocarga` VALUES ('1', '1', '2');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('1', '2', '0.01');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('1', '3', '1');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('2', '1', '3');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('2', '2', '0.01');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('2', '3', '1.5');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('3', '1', '4');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('3', '2', '0.01');
INSERT INTO `tipovehiculoxtipocarga` VALUES ('3', '3', '1.7');

-- ----------------------------
-- Table structure for tipovehiculoxzona
-- ----------------------------
DROP TABLE IF EXISTS `tipovehiculoxzona`;
CREATE TABLE `tipovehiculoxzona` (
  `idTipoVehiculo` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  `Disponible` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTipoVehiculo`,`idZona`),
  KEY `FK_TipoVehiculoXZona_Zona_idx` (`idZona`),
  CONSTRAINT `FK_TipoVehiculoXZona_TipoVehiculo` FOREIGN KEY (`idTipoVehiculo`) REFERENCES `tipovehiculo` (`idTipoVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_TipoVehiculoXZona_Zona` FOREIGN KEY (`idZona`) REFERENCES `zona` (`idZona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipovehiculoxzona
-- ----------------------------

-- ----------------------------
-- Table structure for unidadmedida
-- ----------------------------
DROP TABLE IF EXISTS `unidadmedida`;
CREATE TABLE `unidadmedida` (
  `idUnidadMedida` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`idUnidadMedida`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unidadmedida
-- ----------------------------
INSERT INTO `unidadmedida` VALUES ('1', 'kg');
INSERT INTO `unidadmedida` VALUES ('2', 'm3');
INSERT INTO `unidadmedida` VALUES ('3', 'bolsa');
INSERT INTO `unidadmedida` VALUES ('4', 'varilla');
INSERT INTO `unidadmedida` VALUES ('5', 'unidad');
INSERT INTO `unidadmedida` VALUES ('6', 'lata');
INSERT INTO `unidadmedida` VALUES ('7', 'balon');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `idEmpleado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  KEY `FK_Usuario_Empleado_idx` (`idEmpleado`),
  CONSTRAINT `FK_Usuario_Empleado` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '46618582', '46618582', '$2y$10$wezuiI.XdVAMmAowTqtvVe9OSJSAx3r4rdhBeg7ehskeIJPwaJ446', null, '1', null, null);

-- ----------------------------
-- Table structure for vehiculo
-- ----------------------------
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `anio` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `idMarcaVehiculo` int(11) NOT NULL,
  `idTipoVehiculo` int(11) NOT NULL,
  PRIMARY KEY (`idVehiculo`),
  KEY `FK_Vehiculo_TipoVehiculo_idx` (`idTipoVehiculo`),
  KEY `FK_Vehiculo_MarcaVehiculo_idx` (`idMarcaVehiculo`),
  CONSTRAINT `FK_Vehiculo_MarcaVehiculo` FOREIGN KEY (`idMarcaVehiculo`) REFERENCES `marcavehiculo` (`idMarcaVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Vehiculo_TipoVehiculo` FOREIGN KEY (`idTipoVehiculo`) REFERENCES `tipovehiculo` (`idTipoVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vehiculo
-- ----------------------------
INSERT INTO `vehiculo` VALUES ('1', 'Azul pequeño 1', '2016', 'PEQ', 'PEQ101', '1', '1');
INSERT INTO `vehiculo` VALUES ('2', 'Azul pequeño 2', '2016', 'PEQ', 'PEQ102', '1', '1');
INSERT INTO `vehiculo` VALUES ('3', 'Azul mediano 1', '2015', 'MED', 'MED201', '1', '2');
INSERT INTO `vehiculo` VALUES ('4', 'Azul mediano 2', '2015', 'MED', 'MED202', '1', '2');
INSERT INTO `vehiculo` VALUES ('5', 'Azul grande 1', '2014', 'GRA', 'GRA301', '1', '3');

-- ----------------------------
-- Table structure for viaje
-- ----------------------------
DROP TABLE IF EXISTS `viaje`;
CREATE TABLE `viaje` (
  `idViaje` int(11) NOT NULL AUTO_INCREMENT,
  `fechaRegistro` datetime NOT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `fechaRetorno` datetime DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `idVehiculo` int(11) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `idTipoVehiculo` int(11) NOT NULL,
  PRIMARY KEY (`idViaje`),
  KEY `FK_Viaje_Empleado_idx` (`idEmpleado`),
  KEY `FK_Viaje_Vehiculo_idx` (`idVehiculo`),
  KEY `FK_Viaje_TipoVehiculo_idx` (`idTipoVehiculo`),
  CONSTRAINT `FK_Viaje_Empleado` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Viaje_TipoVehiculo` FOREIGN KEY (`idTipoVehiculo`) REFERENCES `tipovehiculo` (`idTipoVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Viaje_Vehiculo` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculo` (`idVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of viaje
-- ----------------------------

-- ----------------------------
-- Table structure for zona
-- ----------------------------
DROP TABLE IF EXISTS `zona`;
CREATE TABLE `zona` (
  `idZona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `urbanizacion` varchar(50) NOT NULL,
  `montoFlete` double NOT NULL,
  PRIMARY KEY (`idZona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of zona
-- ----------------------------
INSERT INTO `zona` VALUES ('1', 'Casa blanca', 'Casa blanca', '15');
INSERT INTO `zona` VALUES ('2', 'Montenegro', 'Montenegro', '20');
INSERT INTO `zona` VALUES ('3', 'Cristo rey bajo', 'Cristo rey', '10');
INSERT INTO `zona` VALUES ('4', 'Cristo rey alto', 'Cristo rey', '15');
INSERT INTO `zona` VALUES ('5', '10 de octubre', '10 de octubre', '20');
