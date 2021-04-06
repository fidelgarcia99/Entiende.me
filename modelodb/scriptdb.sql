-- MySQL Script generated by MySQL Workbench
-- Mon Apr  5 18:49:54 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Persona` (
  `idPersona` INT NOT NULL,
  `pnombre` VARCHAR(45) NOT NULL,
  `snombre` VARCHAR(45) NULL,
  `papellido` VARCHAR(45) NOT NULL,
  `sapellido` VARCHAR(45) NULL,
  `email` VARCHAR(50) NOT NULL,
  `telefono` VARCHAR(20) NULL,
  `sexo` VARCHAR(45) NULL,
  `fecha_nacimiento` DATE NOT NULL,
  PRIMARY KEY (`idPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`EmpresaDesarrollo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`EmpresaDesarrollo` (
  `idEmpresaDesarrollo` INT NOT NULL,
  `nombre_empresa` VARCHAR(100) NOT NULL,
  `direccion_empresa` VARCHAR(100) NULL,
  `correo_empresa` VARCHAR(50) NOT NULL,
  `fecha_ingreso` DATE NULL,
  PRIMARY KEY (`idEmpresaDesarrollo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Desarrollador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Desarrollador` (
  `idDesarrollador` INT NOT NULL,
  `d_idPersona` INT NOT NULL,
  `fecha_registro` DATE NOT NULL,
  `mensaje_atributos` VARCHAR(1000) NOT NULL,
  `d_idEmpresaDesarrollo` INT NULL,
  PRIMARY KEY (`idDesarrollador`, `d_idPersona`),
  INDEX `fk_Desarrollador_Persona_idx` (`d_idPersona` ASC),
  INDEX `fk_Desarrollador_EmpresaDesarrollo1_idx` (`d_idEmpresaDesarrollo` ASC),
  CONSTRAINT `fk_Desarrollador_Persona`
    FOREIGN KEY (`d_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Desarrollador_EmpresaDesarrollo1`
    FOREIGN KEY (`d_idEmpresaDesarrollo`)
    REFERENCES `mydb`.`EmpresaDesarrollo` (`idEmpresaDesarrollo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cliente` (
  `idCliente` INT NOT NULL,
  `c_idPersona` INT NOT NULL,
  `fecha_registro` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCliente`, `c_idPersona`),
  INDEX `fk_Cliente_Persona1_idx` (`c_idPersona` ASC),
  CONSTRAINT `fk_Cliente_Persona1`
    FOREIGN KEY (`c_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PlataformaTrabajo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`PlataformaTrabajo` (
  `idPlataformaTrabajo` INT NULL,
  `nombre_plataforma` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPlataformaTrabajo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`SolicitudTrabajo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`SolicitudTrabajo` (
  `idSolicitudTrabajo` INT NOT NULL,
  `nombre_solicitudtrab` VARCHAR(45) NOT NULL,
  `especificacion_trabajo` VARCHAR(1000) NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  `tiempo_requerido` VARCHAR(45) NULL,
  `idPlataformaTrabajo` INT NOT NULL,
  `idCliente` INT NOT NULL,
  `c_idPersona` INT NOT NULL,
  PRIMARY KEY (`idSolicitudTrabajo`, `idPlataformaTrabajo`, `idCliente`, `c_idPersona`),
  INDEX `fk_SolicitudTrabajo_PlataformaTrabajo1_idx` (`idPlataformaTrabajo` ASC),
  INDEX `fk_SolicitudTrabajo_Cliente1_idx` (`idCliente` ASC, `c_idPersona` ASC),
  CONSTRAINT `fk_SolicitudTrabajo_PlataformaTrabajo1`
    FOREIGN KEY (`idPlataformaTrabajo`)
    REFERENCES `mydb`.`PlataformaTrabajo` (`idPlataformaTrabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SolicitudTrabajo_Cliente1`
    FOREIGN KEY (`idCliente` , `c_idPersona`)
    REFERENCES `mydb`.`Cliente` (`idCliente` , `c_idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`LenguajeProg`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`LenguajeProg` (
  `idLenguajeProg` INT NOT NULL,
  `nombre_lenguaje` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idLenguajeProg`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Trabajo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Trabajo` (
  `idTrabajo` INT NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_entrega` DATE NULL,
  `costo_trabajo` FLOAT NOT NULL,
  `idDesarrollador` INT NOT NULL,
  `d_idPersona` INT NOT NULL,
  `idSolicitudTrabajo` INT NOT NULL,
  `idLenguajeProg` INT NOT NULL,
  PRIMARY KEY (`idTrabajo`, `idDesarrollador`, `d_idPersona`, `idSolicitudTrabajo`, `idLenguajeProg`),
  INDEX `fk_Trabajo_Desarrollador1_idx` (`idDesarrollador` ASC, `d_idPersona` ASC),
  INDEX `fk_Trabajo_SolicitudTrabajo1_idx` (`idSolicitudTrabajo` ASC),
  INDEX `fk_Trabajo_LenguajeProg1_idx` (`idLenguajeProg` ASC),
  CONSTRAINT `fk_Trabajo_Desarrollador1`
    FOREIGN KEY (`idDesarrollador` , `d_idPersona`)
    REFERENCES `mydb`.`Desarrollador` (`idDesarrollador` , `d_idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Trabajo_SolicitudTrabajo1`
    FOREIGN KEY (`idSolicitudTrabajo`)
    REFERENCES `mydb`.`SolicitudTrabajo` (`idSolicitudTrabajo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Trabajo_LenguajeProg1`
    FOREIGN KEY (`idLenguajeProg`)
    REFERENCES `mydb`.`LenguajeProg` (`idLenguajeProg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
