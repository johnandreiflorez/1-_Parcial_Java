SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `help`;

CREATE DATABASE `help`
  CHARACTER SET `latin1`
  COLLATE `latin1_swedish_ci`;

USE `help`;

/* Tables */
DROP TABLE IF EXISTS `area`;

CREATE TABLE `area` (
  `idArea`   int(3) NOT NULL,
  `nombre`   varchar(30) NOT NULL,
  `fkEmple`  int,
  PRIMARY KEY (`idArea`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `idempleado`  int NOT NULL,
  `nombre`      varchar(30) NOT NULL,
  `telefono`    int(12) NOT NULL,
  `email`       varchar(50) NOT NULL,
  `cargo`       varchar(30) NOT NULL,
  `fkarea`      int NOT NULL,
  `fkemple`     int,
  PRIMARY KEY (`idempleado`)
) ENGINE = InnoDB;

/* Indexes */
CREATE UNIQUE INDEX `iddepartamento`
  ON `area`
  (`idArea`);

CREATE INDEX `foreign_area_emple`
  ON `empleado`
  (`fkarea`);

/* Foreign Keys */
ALTER TABLE `area`
  ADD CONSTRAINT `foreign_emple_area`
  FOREIGN KEY (`fkEmple`)
    REFERENCES `empleado`(`idempleado`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

ALTER TABLE `empleado`
  ADD CONSTRAINT `foreign_area_emple`
  FOREIGN KEY (`fkarea`)
    REFERENCES `area`(`idArea`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

ALTER TABLE `empleado`
  ADD CONSTRAINT `foreign_emple_emple`
  FOREIGN KEY (`fkemple`)
    REFERENCES `empleado`(`idempleado`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;

/* Data for table "area" */
INSERT INTO `area` (`idArea`, `nombre`, `fkEmple`) VALUES (1, 'Sistemas', NULL);
COMMIT;


/* Data for table "empleado" */
COMMIT;
