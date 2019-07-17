-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
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
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `password` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`grupo`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `marcel`.`Canciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Canciones` (
  `nombreCancion` VARCHAR(50) NOT NULL,
  `grupo` VARCHAR(50) NULL DEFAULT NULL,
  `ubicacion` VARCHAR(150) NULL,
  PRIMARY KEY (`nombreCancion`),
  INDEX `idGrupo_idx` (`grupo` ASC) ,
  CONSTRAINT `idGrupo`
    FOREIGN KEY (`grupo`)
    REFERENCES `marcel`.`Proyectos` (`grupo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `marcel`.`Comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Comentarios` (
  `idComentario` INT(11) NOT NULL AUTO_INCREMENT,
  `nomCancion` VARCHAR(50) NULL DEFAULT NULL,
  `comentario` LONGTEXT NULL DEFAULT NULL,
  `inicio` VARCHAR(10) NULL DEFAULT NULL,
  `fin` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`idComentario`),
  INDEX `cancion_idx` (`nomCancion` ASC) ,
  CONSTRAINT `cancion`
    FOREIGN KEY (`nomCancion`)
    REFERENCES `marcel`.`Canciones` (`nombreCancion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `marcel`.`Tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `marcel`.`Tokens` (
  `token` VARCHAR(50) NOT NULL,
  `grupo` VARCHAR(50) NULL DEFAULT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`token`),
  INDEX `grupo_idx` (`grupo` ASC) ,
  CONSTRAINT `grupo`
    FOREIGN KEY (`grupo`)
    REFERENCES `marcel`.`Proyectos` (`grupo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

ALTER TABLE `marcel`.`Comentarios` 
ADD COLUMN `idregion` VARCHAR(45) NULL AFTER `fin`;


INSERT INTO Proyectos VALUES ('Pink Floyd', 'pink@gmail.com', '');
INSERT INTO Canciones VALUES ('Echoes-mix1', 'Pink Floyd', 'mp3/Primal_Scream_-_Loaded.mp3' );
