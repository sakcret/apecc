SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `ccomputo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ccomputo` ;

-- -----------------------------------------------------
-- Table `ccomputo`.`actividades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`actividades` (
  `idActividad` INT(11) NOT NULL AUTO_INCREMENT ,
  `Actividad` VARCHAR(80) NOT NULL DEFAULT '' ,
  `Color` VARCHAR(7) NULL DEFAULT '#CCCCCC' ,
  `Curso` TINYINT(1) NULL DEFAULT '0' ,
  `NombreCorto` VARCHAR(15) NOT NULL DEFAULT '' ,
  PRIMARY KEY USING BTREE (`idActividad`) )
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`tipo_usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`tipo_usuario` (
  `idtipo` INT(11) NOT NULL AUTO_INCREMENT ,
  `descripcion` VARCHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`idtipo`) )
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`usuarios` (
  `login` VARCHAR(60) NOT NULL DEFAULT '' ,
  `matricula` CHAR(12) NULL DEFAULT NULL ,
  `nombre` VARCHAR(20) NULL DEFAULT NULL ,
  `paterno` VARCHAR(15) NULL DEFAULT NULL ,
  `materno` VARCHAR(15) NULL DEFAULT NULL ,
  `grupo` VARCHAR(5) NULL DEFAULT NULL ,
  `num_cred` INT(11) NOT NULL ,
  `fecha_creacion` DATE NULL DEFAULT NULL ,
  `fecha_expira` DATE NULL DEFAULT NULL ,
  `credito` FLOAT NULL DEFAULT NULL ,
  `impreso` TINYINT(1) NULL DEFAULT NULL ,
  `actualiza` INT(11) NULL DEFAULT '0' ,
  `foto` TINYINT(1) NOT NULL ,
  `idtipo` INT(11) NOT NULL ,
  PRIMARY KEY (`login`) ,
  INDEX `fk_usuarios_tipo_usuario1` (`idtipo` ASC) ,
  CONSTRAINT `fk_usuarios_tipo_usuario1`
    FOREIGN KEY (`idtipo` )
    REFERENCES `ccomputo`.`tipo_usuario` (`idtipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`academicos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`academicos` (
  `NumeroPersonal` INT NOT NULL ,
  `Nombre` VARCHAR(45) NOT NULL ,
  `ApellidoPaterno` VARCHAR(45) NOT NULL ,
  `ApellidoMaterno` VARCHAR(45) NOT NULL ,
  `Login` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`NumeroPersonal`) ,
  INDEX `fk_academico_usuarios1` (`Login` ASC) ,
  CONSTRAINT `fk_academico_usuarios1`
    FOREIGN KEY (`Login` )
    REFERENCES `ccomputo`.`usuarios` (`login` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccomputo`.`actividad_academico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`actividad_academico` (
  `IdActividadAcademico` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `Bloque` INT(11) NOT NULL ,
  `Seccion` INT(11) NOT NULL ,
  `IdActividad` INT(11) NOT NULL ,
  `NumeroPersonal` INT NOT NULL ,
  PRIMARY KEY (`IdActividadAcademico`) ,
  INDEX `fk_actividad_academico_actividades1` (`IdActividad` ASC) ,
  INDEX `fk_actividad_academico_academicos1` (`NumeroPersonal` ASC) ,
  CONSTRAINT `fk_actividad_academico_actividades1`
    FOREIGN KEY (`IdActividad` )
    REFERENCES `ccomputo`.`actividades` (`idActividad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actividad_academico_academicos1`
    FOREIGN KEY (`NumeroPersonal` )
    REFERENCES `ccomputo`.`academicos` (`NumeroPersonal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 54
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`equipos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`equipos` (
  `NumeroSerie` VARCHAR(25) NOT NULL ,
  `Marca` VARCHAR(25) NULL DEFAULT NULL ,
  `Modelo` VARCHAR(25) NULL DEFAULT NULL ,
  `NumeroInventario` VARCHAR(10) NOT NULL ,
  `Procesador` VARCHAR(25) NULL DEFAULT NULL ,
  `RAM` FLOAT NULL ,
  `DiscoDuro` INT(11) NULL DEFAULT NULL ,
  `Comentario` VARCHAR(100) NULL DEFAULT NULL ,
  `Estado` CHAR(1) NOT NULL DEFAULT 'L' COMMENT 'Estado /* L = Libre, O = Ocupado, R = En Reparacion, D = Descompuesto C=tiene alguna Actividad ya sea clase o curso S=sin estado*/' ,
  PRIMARY KEY (`NumeroSerie`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`salas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`salas` (
  `idSala` INT(11) NOT NULL AUTO_INCREMENT ,
  `Sala` VARCHAR(15) NOT NULL DEFAULT '' ,
  `Columnas` INT(11) NOT NULL ,
  `Filas` INT(11) NOT NULL ,
  `Indice` INT(11) NULL DEFAULT NULL ,
  `comentario` VARCHAR(60) NULL COMMENT '/*Este campo servirá para mostrar información acerca de la sala como lo es si tiene una reservación fija o reservaciones de sala completa*/' ,
  PRIMARY KEY (`idSala`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`equipos_salas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`equipos_salas` (
  `Fila` VARCHAR(45) NULL DEFAULT NULL ,
  `Columna` VARCHAR(45) NULL DEFAULT NULL ,
  `NumeroSerie` VARCHAR(25) NOT NULL ,
  `idSala` INT(11) NOT NULL ,
  INDEX `fk_equipos_salas_equipos1` (`NumeroSerie` ASC) ,
  INDEX `fk_equipos_salas_salas1` (`idSala` ASC) ,
  CONSTRAINT `fk_equipos_salas_equipos1`
    FOREIGN KEY (`NumeroSerie` )
    REFERENCES `ccomputo`.`equipos` (`NumeroSerie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipos_salas_salas1`
    FOREIGN KEY (`idSala` )
    REFERENCES `ccomputo`.`salas` (`idSala` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`reservacionesfijas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`reservacionesfijas` (
  `idReservacionesFijas` INT(11) NOT NULL AUTO_INCREMENT ,
  `FechaInicio` DATE NULL DEFAULT NULL ,
  `FechaFin` DATE NULL DEFAULT NULL ,
  `Hora` INT(11) NULL DEFAULT NULL ,
  `Dia` INT(11) NULL DEFAULT NULL ,
  `Sala` INT(11) NOT NULL ,
  `IdActividadAcademico` INT(11) UNSIGNED NOT NULL ,
  PRIMARY KEY (`idReservacionesFijas`) ,
  INDEX `fk_reservacionesfijas_salas1` (`Sala` ASC) ,
  INDEX `fk_reservacionesfijas_actividad_academico1` (`IdActividadAcademico` ASC) ,
  CONSTRAINT `fk_reservacionesfijas_salas1`
    FOREIGN KEY (`Sala` )
    REFERENCES `ccomputo`.`salas` (`idSala` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservacionesfijas_actividad_academico1`
    FOREIGN KEY (`IdActividadAcademico` )
    REFERENCES `ccomputo`.`actividad_academico` (`IdActividadAcademico` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 28
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`reservacionesmomentaneas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`reservacionesmomentaneas` (
  `idReservacionesMomentaneas` CHAR(22) NOT NULL DEFAULT '' COMMENT 'idReservacionesMomentaneas formado por las primeras 6 letras del numero de serie del equipo a asignar seguido de 4 primeros caracteres del login del usuario seguidos de la fecha con formato: yymmdd y la hora actual hhmmss ejemplo: MXJ916MXJ9120410233126' ,
  `Fecha` DATE NOT NULL ,
  `HoraInicio` TIME NOT NULL DEFAULT 00:00:00 ,
  `HoraFin` TIME NOT NULL DEFAULT 00:00:00 ,
  `Horas` VARCHAR(45) NOT NULL DEFAULT 0 ,
  `Importe` FLOAT NULL DEFAULT 0 ,
  `Estado` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Estado /* A= Reservación Activa T=Reservación terminada I= reservación indefinida, es decir se empezó pero no se ha especificado hora de fin es reservación abierta(este estado es temporal ya que al terminarla se asignara hora de fin y el estado cambiara a T)*/' ,
  `EsClase` TINYINT NOT NULL DEFAULT 0 COMMENT '/*Campo que dice si la reservación es de una actividad o es una simple reservación momentánea, en caso de ser reservación por actividad no hay importe*/' ,
  `Login` VARCHAR(60) NOT NULL ,
  `NumeroSerie` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`idReservacionesMomentaneas`) ,
  INDEX `fk_reservacionesmomentaneas_usuarios1` (`Login` ASC) ,
  INDEX `fk_reservacionesmomentaneas_equipos1` (`NumeroSerie` ASC) ,
  CONSTRAINT `fk_reservacionesmomentaneas_usuarios1`
    FOREIGN KEY (`Login` )
    REFERENCES `ccomputo`.`usuarios` (`login` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservacionesmomentaneas_equipos1`
    FOREIGN KEY (`NumeroSerie` )
    REFERENCES `ccomputo`.`equipos` (`NumeroSerie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`grupo_software`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`grupo_software` (
  `idGrupo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(100) NULL ,
  PRIMARY KEY (`idGrupo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccomputo`.`usuariossistema`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`usuariossistema` (
  `login` VARCHAR(15) NOT NULL ,
  `pass` VARCHAR(100) NOT NULL ,
  `nombre` VARCHAR(100) NULL ,
  `correo` VARCHAR(45) NULL ,
  PRIMARY KEY (`login`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccomputo`.`bitacora_cch`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`bitacora_cch` (
  `nombre_tabla` VARCHAR(100) NOT NULL ,
  `actualizacion` CHAR(1) NOT NULL ,
  `fecha_hora` DATETIME NOT NULL ,
  `procesada_server` TINYINT(1) NOT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccomputo`.`sistemasoperativos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`sistemasoperativos` (
  `idSistemaOperativo` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `SistemaOperativo` VARCHAR(45) NULL ,
  PRIMARY KEY (`idSistemaOperativo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccomputo`.`equipos_sistemasoperativos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`equipos_sistemasoperativos` (
  `NumeroSerie` VARCHAR(25) NOT NULL ,
  `idSistemaOperativo` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`NumeroSerie`, `idSistemaOperativo`) ,
  INDEX `fk_equipos_has_sistemasoperativos_sistemasoperativos1` (`idSistemaOperativo` ASC) ,
  INDEX `fk_equipos_has_sistemasoperativos_equipos1` (`NumeroSerie` ASC) ,
  CONSTRAINT `fk_equipos_has_sistemasoperativos_equipos1`
    FOREIGN KEY (`NumeroSerie` )
    REFERENCES `ccomputo`.`equipos` (`NumeroSerie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipos_has_sistemasoperativos_sistemasoperativos1`
    FOREIGN KEY (`idSistemaOperativo` )
    REFERENCES `ccomputo`.`sistemasoperativos` (`idSistemaOperativo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ccomputo`.`software`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`software` (
  `idSoftware` INT NOT NULL ,
  `software` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(45) NULL ,
  `version` VARCHAR(45) NULL ,
  `idGrupo` INT UNSIGNED NOT NULL ,
  `idSistemaOperativo` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`idSoftware`) ,
  INDEX `fk_software_grupo_software1` (`idGrupo` ASC) ,
  INDEX `fk_software_sistemasoperativos1` (`idSistemaOperativo` ASC) ,
  CONSTRAINT `fk_software_grupo_software1`
    FOREIGN KEY (`idGrupo` )
    REFERENCES `ccomputo`.`grupo_software` (`idGrupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_software_sistemasoperativos1`
    FOREIGN KEY (`idSistemaOperativo` )
    REFERENCES `ccomputo`.`sistemasoperativos` (`idSistemaOperativo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ccomputo`.`equipos_software`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ccomputo`.`equipos_software` (
  `NumeroSerie` VARCHAR(25) NOT NULL ,
  `idSoftware` INT NOT NULL ,
  PRIMARY KEY (`NumeroSerie`, `idSoftware`) ,
  INDEX `fk_equipos_has_software_software1` (`idSoftware` ASC) ,
  INDEX `fk_equipos_has_software_equipos1` (`NumeroSerie` ASC) ,
  CONSTRAINT `fk_equipos_has_software_equipos1`
    FOREIGN KEY (`NumeroSerie` )
    REFERENCES `ccomputo`.`equipos` (`NumeroSerie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipos_has_software_software1`
    FOREIGN KEY (`idSoftware` )
    REFERENCES `ccomputo`.`software` (`idSoftware` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `ccomputo`;

DELIMITER $$
USE `ccomputo`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`sala_d`
AFTER DELETE ON `ccomputo`.`salas`
FOR EACH ROW
BEGIN
	UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='salas' and actualizacion='D';
    END$$

USE `ccomputo`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`sala_i`
AFTER INSERT ON `ccomputo`.`salas`
FOR EACH ROW
BEGIN
	UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='salas' AND actualizacion='I';
    END$$

USE `ccomputo`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`sala_u`
AFTER UPDATE ON `ccomputo`.`salas`
FOR EACH ROW
BEGIN
	UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='salas' AND actualizacion='U';
    END$$


DELIMITER ;

DELIMITER $$
USE `ccomputo`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`tipo_usuario_d`
AFTER DELETE ON `ccomputo`.`tipo_usuario`
FOR EACH ROW
BEGIN
 UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='tipo_usuario' AND actualizacion='D';
	END$$

USE `ccomputo`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`tipo_usuario_i`
AFTER INSERT ON `ccomputo`.`tipo_usuario`
FOR EACH ROW
BEGIN
 UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='tipo_usuario' AND actualizacion='I';
	END$$


DELIMITER ;

DELIMITER $$
USE `ccomputo`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`usuario_d`
AFTER DELETE ON `ccomputo`.`usuarios`
FOR EACH ROW
BEGIN
	UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='usuarios' AND actualizacion='D';
    END$$

USE `ccomputo`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`usuario_i`
AFTER INSERT ON `ccomputo`.`usuarios`
FOR EACH ROW
BEGIN
	UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='usuarios' AND actualizacion='I';
    END$$

USE `ccomputo`$$


CREATE
DEFINER=`root`@`localhost`
TRIGGER `ccomputo`.`usuario_u`
AFTER UPDATE ON `ccomputo`.`usuarios`
FOR EACH ROW
BEGIN
	UPDATE bitacora_cch SET procesada_server=0,fecha_hora=CURRENT_TIMESTAMP() WHERE nombre_tabla='usuarios' AND actualizacion='U';
    END$$


DELIMITER ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
