-- MySQL Script generated by MySQL Workbench
-- 10/15/16 18:33:29
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema BDPlanificaMYPE
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BDPlanificaMYPE
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BDPlanificaMYPE` DEFAULT CHARACTER SET utf8 ;
USE `BDPlanificaMYPE` ;

-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`TipoDocumento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`TipoDocumento` (
  `idTipoDocumento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Zona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Zona` (
  `idZona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `urbanizacion` VARCHAR(50) NOT NULL,
  `montoFlete` DOUBLE NOT NULL,
  PRIMARY KEY (`idZona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(100) NULL,
  `apellidoPaterno` VARCHAR(100) NULL,
  `apellidoMaterno` VARCHAR(100) NULL,
  `razonSocial` VARCHAR(100) NULL,
  `numeroDocumento` VARCHAR(20) NOT NULL,
  `fechaNacimiento` DATETIME NULL,
  `genero` TINYINT(1) NULL,
  `telefono` VARCHAR(20) NULL,
  `correo` VARCHAR(100) NULL,
  `direccion` VARCHAR(100) NOT NULL,
  `referencia` VARCHAR(100) NULL,
  `credito` TINYINT(1) NOT NULL,
  `idTipoDocumento` INT NOT NULL,
  `idZona` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  INDEX `FK_Cliente_TipoDocumento_idx` (`idTipoDocumento` ASC),
  INDEX `FK_Cliente_Zona_idx` (`idZona` ASC),
  CONSTRAINT `FK_Cliente_TipoDocumento`
    FOREIGN KEY (`idTipoDocumento`)
    REFERENCES `BDPlanificaMYPE`.`TipoDocumento` (`idTipoDocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Cliente_Zona`
    FOREIGN KEY (`idZona`)
    REFERENCES `BDPlanificaMYPE`.`Zona` (`idZona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Cargo` (
  `idCargo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Empleado` (
  `idEmpleado` INT NOT NULL,
  `nombres` VARCHAR(100) NOT NULL,
  `apellidoPaterno` VARCHAR(100) NOT NULL,
  `apellidoMaterno` VARCHAR(100) NOT NULL,
  `numeroDocumento` VARCHAR(20) NOT NULL,
  `estado` VARCHAR(50) NOT NULL,
  `sueldo` DOUBLE NULL,
  `fechaIngreso` DATETIME NOT NULL,
  `fechaSalida` DATETIME NULL,
  `idCargo` INT NOT NULL,
  `idTipoDocumento` INT NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  INDEX `FK_Empleado_TipoDocumento_idx` (`idTipoDocumento` ASC),
  INDEX `FK_Empleado_Cargo_idx` (`idCargo` ASC),
  CONSTRAINT `FK_Empleado_TipoDocumento`
    FOREIGN KEY (`idTipoDocumento`)
    REFERENCES `BDPlanificaMYPE`.`TipoDocumento` (`idTipoDocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Empleado_Cargo`
    FOREIGN KEY (`idCargo`)
    REFERENCES `BDPlanificaMYPE`.`Cargo` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `fechaRegistro` DATETIME NOT NULL,
  `fechaEnvio` DATETIME NOT NULL,
  `montoTotal` DOUBLE NOT NULL,
  `montoPagado` DOUBLE NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  `idCliente` INT NOT NULL,
  `idEmpleado` INT NOT NULL,
  `idZona` INT NOT NULL,
  PRIMARY KEY (`idPedido`),
  INDEX `FK_Pedido_Cliente_idx` (`idCliente` ASC),
  INDEX `FK_Pedido_Empleado_idx` (`idEmpleado` ASC),
  INDEX `FK_Pedido_Zona_idx` (`idZona` ASC),
  CONSTRAINT `FK_Pedido_Cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `BDPlanificaMYPE`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Pedido_Empleado`
    FOREIGN KEY (`idEmpleado`)
    REFERENCES `BDPlanificaMYPE`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Pedido_Zona`
    FOREIGN KEY (`idZona`)
    REFERENCES `BDPlanificaMYPE`.`Zona` (`idZona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Marca` (
  `idMarca` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idMarca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`TipoCarga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`TipoCarga` (
  `idTipoCarga` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` VARCHAR(100) NULL,
  PRIMARY KEY (`idTipoCarga`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`Articulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`Articulo` (
  `idArticulo` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `precioBase` DOUBLE NOT NULL,
  `stock` DOUBLE NOT NULL,
  `volumen` DOUBLE NOT NULL,
  `tiempoHorasAbastecer` INT NULL,
  `combinable` TINYINT(1) NOT NULL,
  `idMarca` INT NOT NULL,
  `idTipoCarga` INT NOT NULL,
  PRIMARY KEY (`idArticulo`),
  INDEX `FK_Articulo_Marca_idx` (`idMarca` ASC),
  INDEX `FK_Articulo_TipoCarga_idx` (`idTipoCarga` ASC),
  CONSTRAINT `FK_Articulo_Marca`
    FOREIGN KEY (`idMarca`)
    REFERENCES `BDPlanificaMYPE`.`Marca` (`idMarca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Articulo_TipoCarga`
    FOREIGN KEY (`idTipoCarga`)
    REFERENCES `BDPlanificaMYPE`.`TipoCarga` (`idTipoCarga`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BDPlanificaMYPE`.`DetallePedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BDPlanificaMYPE`.`DetallePedido` (
  `idPedido` INT NOT NULL,
  `idArticulo` INT NOT NULL,
  `cantidad` DOUBLE NOT NULL,
  `cantidadAtendida` DOUBLE NOT NULL,
  `precioUnitario` DOUBLE NOT NULL,
  `monto` DOUBLE NOT NULL,
  PRIMARY KEY (`idPedido`, `idArticulo`),
  INDEX `FK_DetallePedido_Articulo_idx` (`idArticulo` ASC),
  CONSTRAINT `FK_DetallePedido_Pedido`
    FOREIGN KEY (`idPedido`)
    REFERENCES `BDPlanificaMYPE`.`Pedido` (`idPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetallePedido_Articulo`
    FOREIGN KEY (`idArticulo`)
    REFERENCES `BDPlanificaMYPE`.`Articulo` (`idArticulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
