-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2012 a las 22:15:47
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `softech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `COD_CATEG` varchar(5) collate utf8_unicode_ci NOT NULL,
  `NOMB_CATEG` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`COD_CATEG`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`COD_CATEG`, `NOMB_CATEG`) VALUES
('CAT01', 'HARDWARE'),
('CAT02', 'SOFTWARE'),
('CAT03', 'REDES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `COD_CIUDAD` varchar(5) collate utf8_unicode_ci NOT NULL,
  `NOMB_CIUDAD` varchar(30) collate utf8_unicode_ci NOT NULL,
  `FKDEPART` varchar(5) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`COD_CIUDAD`),
  KEY `CONS_FKDEPART` (`FKDEPART`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`COD_CIUDAD`, `NOMB_CIUDAD`, `FKDEPART`) VALUES
('C1', 'YARUMAL', 'D1'),
('C10', 'APARTADÓ', 'D1'),
('C2', 'CALDAS', 'D1'),
('C3', 'CISNEROS', 'D1'),
('C4', 'COCORNÁ', 'D1'),
('C5', 'COPACABANA', 'D1'),
('C6', 'AMAGÁ', 'D1'),
('C7', 'GIRARDOTA', 'D1'),
('C8', 'GUARNE', 'D1'),
('C9', 'ITAGÜÍ', 'D1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `COD_DEPART` varchar(5) collate utf8_unicode_ci NOT NULL,
  `NOMB_DEPART` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`COD_DEPART`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`COD_DEPART`, `NOMB_DEPART`) VALUES
('D1', 'ANTIOQUIA'),
('D2', 'BOGOTA'),
('D3', 'VALLE DEL CAUCA'),
('D4', 'CHOCÓ'),
('D5', 'TOLIMA'),
('D6', 'CAQUETÁ'),
('D7', 'CALDAS'),
('D8', 'HUILA'),
('D9', 'CAUCA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `COD_ESTADO` varchar(5) collate utf8_unicode_ci NOT NULL,
  `NOMB_ESTADO` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`COD_ESTADO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `estado`
--

INSERT INTO `estado` (`COD_ESTADO`, `NOMB_ESTADO`) VALUES
('E01', 'EN PROCESO'),
('E02', 'TERMINADO'),
('E03', 'CANCELADO'),
('E04', 'SUSPENDIDO'),
('E05', 'USUARIO AUSENTE'),
('E06', 'CITA USUARIO'),
('E07', 'FUERZA MAYOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidente`
--

CREATE TABLE IF NOT EXISTS `incidente` (
  `COD_INCID` varchar(8) collate utf8_unicode_ci NOT NULL,
  `DESC_INCID` varchar(180) collate utf8_unicode_ci NOT NULL,
  `FECHAREGIS_INCID` varchar(50) collate utf8_unicode_ci NOT NULL,
  `FECHASOLUC_INCID` varchar(50) collate utf8_unicode_ci NOT NULL,
  `FKUSUARIO` varchar(20) collate utf8_unicode_ci NOT NULL,
  `FKPRIORIDAD` varchar(5) collate utf8_unicode_ci NOT NULL,
  `FKESTADO` varchar(5) collate utf8_unicode_ci NOT NULL,
  `FKCATEGORIA` varchar(5) collate utf8_unicode_ci NOT NULL,
  `FKRESPONSABLE` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`COD_INCID`),
  KEY `CONS_FKPRIORIDAD` (`FKPRIORIDAD`),
  KEY `CONS_FKUSUARIO` (`FKUSUARIO`),
  KEY `CONS_FKESTADO` (`FKESTADO`),
  KEY `CONS_FKCATEGORIA` (`FKCATEGORIA`),
  KEY `CONS_FKRESPONSABLE` (`FKRESPONSABLE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `incidente`
--

INSERT INTO `incidente` (`COD_INCID`, `DESC_INCID`, `FECHAREGIS_INCID`, `FECHASOLUC_INCID`, `FKUSUARIO`, `FKPRIORIDAD`, `FKESTADO`, `FKCATEGORIA`, `FKRESPONSABLE`) VALUES
('01', 'CED 88691710, NO TIENE SONIDO', '05/22/2011', '05/22/2011', '88691710', 'PRI01', 'E02', 'CAT03', '1128395399'),
('02', 'CED 89418302, MI EQUIPO NO PRENDE SE QUEDA EN PANTALLA NEGRA', '05/23/2011', '05/23/2011', '89418302', 'PRI01', 'E02', 'CAT01', '1017322576'),
('03', 'CED 54362395, CUANDO ENCIENDO EL EQUIPO APARECE UNA PANTALLA AZUL CON LETRA BLANCA Y NO SIGUE', '05/22/2011', '05/24/2011', '54362395', 'PRI03', 'E03', 'CAT02', '58896968'),
('04', 'CED 60281734, EL EQUIPO ES MUY LENTO PARA ABRIR LOS PROGRAMAS Y SE BLOQUEA CONTINUAMENTE', '05/23/2011', '05/25/2011', '60281734', 'PRI04', 'E04', 'CAT02', '1017322576'),
('05', 'CED 88691710, LOS PROGRAMAS DE WORD, EXCEL, ETC, NO ABREN, SACA UNA ESPECIE DE ERROR CON CD DE INSTALACION', '05/24/2011', '05/26/2011', '88691710', 'PRI02', 'E05', 'CAT02', '1128395399'),
('06', 'CED 49926599, CUANDO PRENDO EL COMPUTADOR, TIENE UN RUIDO FUERTE, SUENA COMO AVION', '05/25/2011', '05/27/2011', '49926599', 'PRI02', 'E01', 'CAT01', '1017322576'),
('07', 'CED 54362395, EL SISTEMA NO ARRANCA, SE QUEDA EN PANTALLA NEGRA CON INFORMACION DEL SISTEMA Y UN GUION EN LA PARTE SUPERIOR IZQUIERDA', '05/26/2011', '05/28/2011', '54362395', 'PRI01', 'E07', 'CAT02', '71287317'),
('08', 'CED 80879865, TIENE CORRIENTE PERO APARECE MENSAJE SIN SEÑAL, NO ARRANCA', '05/27/2011', '05/29/2011', '80879865', 'PRI04', 'E03', 'CAT02', '1128395399'),
('09', 'CED 54362395, NO TIENE SONIDO, NO SE ESCUCHA NADA', '05/28/2011', '05/30/2011', '54362395', 'PRI02', 'E05', 'CAT02', '82416288'),
('10', 'CED 96668625, LA IMPRESORA NO IMPRIME', '05/29/2011', '05/31/2011', '96668625', 'PRI01', 'E01', 'CAT02', '1017322576');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE IF NOT EXISTS `prioridad` (
  `COD_PRIORIDAD` varchar(5) collate utf8_unicode_ci NOT NULL,
  `DESC_PRIORIDAD` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`COD_PRIORIDAD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`COD_PRIORIDAD`, `DESC_PRIORIDAD`) VALUES
('PRI01', 'URGENTE'),
('PRI02', 'PRIORITARIA'),
('PRI03', 'MEDIA'),
('PRI04', 'BAJA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE IF NOT EXISTS `responsable` (
  `ID_RESP` varchar(20) collate utf8_unicode_ci NOT NULL,
  `NOMB_RESP` varchar(20) collate utf8_unicode_ci NOT NULL,
  `APELL_RESP` varchar(20) collate utf8_unicode_ci NOT NULL,
  `EMAIL_RESP` varchar(100) collate utf8_unicode_ci NOT NULL,
  `TEL_RESP` varchar(15) collate utf8_unicode_ci default NULL,
  `CEL_RESP` varchar(20) collate utf8_unicode_ci NOT NULL,
  `CARGO_RESP` varchar(30) collate utf8_unicode_ci NOT NULL,
  `COUNTUSER_RESP` varchar(30) collate utf8_unicode_ci NOT NULL,
  `PASSWORD_RESP` varchar(20) collate utf8_unicode_ci NOT NULL,
  `FOTO_RESP` varchar(20) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`ID_RESP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`ID_RESP`, `NOMB_RESP`, `APELL_RESP`, `EMAIL_RESP`, `TEL_RESP`, `CEL_RESP`, `CARGO_RESP`, `COUNTUSER_RESP`, `PASSWORD_RESP`, `FOTO_RESP`) VALUES
('1017322576', 'JHON MARIO', 'PINEDA', 'jhonpineda23@hotmail.com', '2396437', '3126058963', 'Analista de Software', 'JPineda', '1017322576', '0001.jpg'),
('1128282786', 'LUZ MARY', 'GALEANO', 'luma25fg@hotmail.com', '3471018', '3018574060', 'Soporte Tï¿½cnico', 'LGaleano', '1128282786', '0007.jpg'),
('1128395399', 'JUAN DAVID', 'QUIROS', 'jhondavids0714@yahoo.es', '3471450', '3003411150', 'Coordinador Sistemas', 'JQuiros', '1128395399', '0002.jpg'),
('50350394', 'KATHERINE', 'OCAMPO', 'katheob92@hotmail.com', '3174427', '3116892054', 'Soporte Técnico', 'KOcampo', '50350394', '0003.jpg'),
('55753973', 'LUIS ALFONSO', 'QUIROS', 'luis701025@hotmail.com', '2532513', '3015787910', 'Soporte Técnico', 'LQuiros', '55753973', '0004.jpg'),
('58896968', 'ROBERT ESTID', 'RESTREPO', 'gedeonanciano07@hotmail.com', '5112822', '3157133103', 'Soporte Técnico', 'RRestrep', '58896968', '0005.jpg'),
('68440528', 'FRANK', 'OSORIO', 'frankofadown@hotmail.com', '2855189', '3026426121', 'Soporte Técnico', 'FOsorio', '68440528', '0006.jpg'),
('71287317', 'LUZ MARY', 'GALEANO', 'luma25fg@hotmail.com', '3142423', '3018574060', 'Soporte Tï¿½cnico', 'LGaleano', '1128282786', '0007.jpg'),
('82416288', 'SANDRA MILENA', 'RAMIREZ', 'smramirez@admon.mimos.com.co', '3328692', '3164074164', 'Soporte Técnico', 'SRamirez', '82416288', '0008.jpg'),
('92108322', 'GABRIEL ALBERTO', 'URIBE ', 'gaut512@hotmail.com', '2799576', '3152823406', 'Soporte Técnico', 'GUribe ', '92108322', '0009.jpg'),
('95176293', 'JORGE', 'LOPEZ', 'jlopez95@hotmail.com', '4617427', '3117925657', 'Soporte Técnico', 'JLopez', '95176293', '0010.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USER` varchar(20) collate utf8_unicode_ci NOT NULL,
  `NOMB_USER` varchar(20) collate utf8_unicode_ci NOT NULL,
  `APELL_USER` varchar(20) collate utf8_unicode_ci NOT NULL,
  `EMAIL_USER` varchar(100) collate utf8_unicode_ci default NULL,
  `TEL_USER` varchar(15) collate utf8_unicode_ci default NULL,
  `CEL_USER` varchar(20) collate utf8_unicode_ci NOT NULL,
  `DIR_USER` varchar(100) collate utf8_unicode_ci default NULL,
  `COUNTUSER_USER` varchar(30) collate utf8_unicode_ci NOT NULL,
  `PASSWORD_USER` varchar(20) collate utf8_unicode_ci NOT NULL,
  `FKCIUDAD` varchar(5) collate utf8_unicode_ci NOT NULL,
  `FOTO_USER` varchar(20) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`ID_USER`),
  KEY `CONS_FKCIUDAD` (`FKCIUDAD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USER`, `NOMB_USER`, `APELL_USER`, `EMAIL_USER`, `TEL_USER`, `CEL_USER`, `DIR_USER`, `COUNTUSER_USER`, `PASSWORD_USER`, `FKCIUDAD`, `FOTO_USER`) VALUES
('48787399', 'DANIEL alejandro', 'MARTINEZ', 'wolfman611@hotmail.com', '5808319', '3002373590', 'Circular 35BB No. 211-73', 'DMartinez', '48787399', 'C8', '0001.jpg'),
('49926599', 'ANDRES', 'FLORES', 'joanavanzado4@yahoo.es', '3369416', '3011569917', 'Circular 19G No. 75-12', 'AFlores', '49926599', 'C10', '0002.jpg'),
('54362395', 'JUAN DAVID', 'BUILES', 'builesgrisales@gmail.com', '2755927', '3116581789', 'Avenida 84  No. 879-67', 'JBuiles', '54362395', 'C2', '0003.jpg'),
('60281734', 'MAURICIO', 'CANO', 'mauricio.cano@gmail.com', '3328080', '3013287856', 'Carrera 20F No. 660-51', 'MCano', '60281734', 'C1', '0004.jpg'),
('602817345', 'MAURICIO', 'CANO', 'mauricio.cano@gmail.com', '3328080', '3013287856', 'Carrera 20F No. 660-51', 'MCano', '60281734', 'C1', '0004.jpg'),
('62437247', 'ROBIN DAVID', 'HIGUITA', 'robindh.rm@hotmail.com', '5802938', '3022338346', 'Circular 83AA No. 990-57', 'RHiguita', '62437247', 'C6', '0005.jpg'),
('80879865', 'CARLOS MAURICIO', 'MARIN', 'karlmauro@hotmail.com', '2732862', '3152919357', 'Diagonal 13G No. 337-72', 'CMarin', '80879865', 'C3', '0006.jpg'),
('88691710', 'DIEGO', 'AGUDELO', 'dagudelo@ime.edu.co', '3475293', '3177638011', 'Transversal 64A No. 592-20', 'DAgudelo', '88691710', 'C1', '0007.jpg'),
('89418302', 'ALEXIS', 'AGUDELO', 'alexagu07@hotmail.com', '5802523', '3206864837', 'Calle 48BB No. 323-33', 'AAgudelo', '89418302', 'C3', '0008.jpg'),
('93467782', 'JUAN DAVID', 'ECHEVERRI', 'juanda627@hotmail.com', '3314482', '3027069428', 'Carrera 82DD No. 533-97', 'JEcheverri', '93467782', 'C4', '0009.jpg'),
('96668625', 'JOSE ORLANDO', 'MORALES', 'jomi1117@yahoo.com', '4614048', '3184235437', 'Transversal 81B No. 113-75', 'JMorales', '96668625', 'C6', '0010.jpg');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `CONS_FKDEPART` FOREIGN KEY (`FKDEPART`) REFERENCES `departamento` (`COD_DEPART`);

--
-- Filtros para la tabla `incidente`
--
ALTER TABLE `incidente`
  ADD CONSTRAINT `CONS_FKCATEGORIA` FOREIGN KEY (`FKCATEGORIA`) REFERENCES `categoria` (`COD_CATEG`),
  ADD CONSTRAINT `CONS_FKESTADO` FOREIGN KEY (`FKESTADO`) REFERENCES `estado` (`COD_ESTADO`),
  ADD CONSTRAINT `CONS_FKPRIORIDAD` FOREIGN KEY (`FKPRIORIDAD`) REFERENCES `prioridad` (`COD_PRIORIDAD`),
  ADD CONSTRAINT `CONS_FKRESPONSABLE` FOREIGN KEY (`FKRESPONSABLE`) REFERENCES `responsable` (`ID_RESP`),
  ADD CONSTRAINT `CONS_FKUSUARIO` FOREIGN KEY (`FKUSUARIO`) REFERENCES `usuario` (`ID_USER`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `CONS_FKCIUDAD` FOREIGN KEY (`FKCIUDAD`) REFERENCES `ciudad` (`COD_CIUDAD`);
