-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema marcel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema marcel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `marcel` DEFAULT CHARACTER SET utf8 ;
USE `marcel` ;

-- -----------------------------------------------------
-- Table `marcel`.`Proyectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Proyectos` (
  `grupo` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NULL,
  `password` VARCHAR(50) NULL,
  PRIMARY KEY (`grupo`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marcel`.`Canciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Canciones` (
  `nomCancion` VARCHAR(45) NOT NULL,
  `grupo` VARCHAR(50) NULL,
  INDEX `idGrupo_idx` (`grupo` ASC) ,
  PRIMARY KEY (`nomCancion`),
  CONSTRAINT `idGrupo`
    FOREIGN KEY (`grupo`)
    REFERENCES `marcel`.`Proyectos` (`grupo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marcel`.`Mixes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Mixes` (
  `idMix` INT NOT NULL AUTO_INCREMENT,
  `nomMix` VARCHAR(45) NULL,
  `nomCancion` VARCHAR(45) NULL,
  `ubicacion` VARCHAR(100) NULL,
  PRIMARY KEY (`idMix`),
  INDEX `cancion_idx` (`nomCancion` ASC) ,
  CONSTRAINT `cancion`
    FOREIGN KEY (`nomCancion`)
    REFERENCES `marcel`.`Canciones` (`nomCancion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marcel`.`Comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Comentarios` (
  `idComentario` INT NOT NULL,
  `idMix` INT NULL,
  `comentario` LONGTEXT NULL,
  `inicio` VARCHAR(10) NULL,
  `fin` VARCHAR(10) NULL,
  PRIMARY KEY (`idComentario`),
  INDEX `mix_idx` (`idMix` ASC) ,
  CONSTRAINT `mix`
    FOREIGN KEY (`idMix`)
    REFERENCES `marcel`.`Mixes` (`idMix`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `marcel`.`Tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Tokens` (
  `token` VARCHAR(50) NOT NULL,
  `grupo` VARCHAR(50) NULL,
  `fecha` DATE NULL,
  PRIMARY KEY (`token`),
  INDEX `grupo_idx` (`grupo` ASC) ,
  CONSTRAINT `grupo`
    FOREIGN KEY (`grupo`)
    REFERENCES `marcel`.`Proyectos` (`grupo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO proyectos VALUES ('Pink Floyd', 'pink@gmail.com', '');
INSERT INTO canciones VALUES ('Echoes', 'Pink Floyd' );
INSERT INTO mixes VALUES (null, 'Mix1', 'Echoes', 'mp3/Primal_Scream_-_Loaded.mp3' );