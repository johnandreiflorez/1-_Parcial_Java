-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2012 a las 08:55:12
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `viajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcliente`
--

CREATE TABLE IF NOT EXISTS `tblcliente` (
  `Id_CLI` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Nombre_CLI` varchar(50) collate utf8_unicode_ci NOT NULL,
  `Telefono_CLI` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`Id_CLI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `tblcliente`
--

INSERT INTO `tblcliente` (`Id_CLI`, `Nombre_CLI`, `Telefono_CLI`) VALUES
('', '', ''),
('000', 'felipe', '33333333'),
('10103002', 'Kim García', '2372480'),
('10203696', 'jhony', '5963246'),
('1020445328', 'Karen Muñoz ', '5967207'),
('10204567', 'KREN FEIA', '678960'),
('10206398', 'swe', '4568'),
('1020825673', 'kimsota', '3456677'),
('10208258', 'Jhonny E Giraldo', '4562178'),
('1037975068', 'Daniela Giraldo', '5798636'),
('111905133', 'jolie', '4278995'),
('1152684865', 'Jolie', '3128707077'),
('123', 'Luisa', '5236989'),
('55555', 'dddd', '444'),
('7878', 'Milena', '98765432');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblestado`
--

CREATE TABLE IF NOT EXISTS `tblestado` (
  `Id_EST` int(11) NOT NULL,
  `Descripcion` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`Id_EST`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `tblestado`
--

INSERT INTO `tblestado` (`Id_EST`, `Descripcion`) VALUES
(1, 'Reserva'),
(2, 'Cancelacion'),
(3, 'Pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreserva`
--

CREATE TABLE IF NOT EXISTS `tblreserva` (
  `Id_RES` int(11) NOT NULL auto_increment,
  `Id_VIAje_RES` int(11) NOT NULL,
  `Id_CLIente_RES` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Cantidad_RES` int(11) NOT NULL,
  `Id_ESTado_RES` int(11) NOT NULL,
  PRIMARY KEY  (`Id_RES`),
  KEY `Id_VIAje_RES` (`Id_VIAje_RES`),
  KEY `Id_CLIente_RES` (`Id_CLIente_RES`),
  KEY `Id_ESTado_RES` (`Id_ESTado_RES`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `tblreserva`
--

INSERT INTO `tblreserva` (`Id_RES`, `Id_VIAje_RES`, `Id_CLIente_RES`, `Cantidad_RES`, `Id_ESTado_RES`) VALUES
(1, 8, '10208258', 6, 1),
(2, 8, '10208258', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblruta`
--

CREATE TABLE IF NOT EXISTS `tblruta` (
  `Id_RUT` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Descripcion_RUT` varchar(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`Id_RUT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `tblruta`
--

INSERT INTO `tblruta` (`Id_RUT`, `Descripcion_RUT`) VALUES
('MY10', 'Medellin - Yarumal '),
('YM20', 'Yarumal - Medellin ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltip_veh`
--

CREATE TABLE IF NOT EXISTS `tbltip_veh` (
  `Id_TIP_VEH` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`Id_TIP_VEH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `tbltip_veh`
--

INSERT INTO `tbltip_veh` (`Id_TIP_VEH`, `Descripcion`) VALUES
('10', 'Bus'),
('20', 'Buseta '),
('30', 'Colectivo ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE IF NOT EXISTS `tblusuarios` (
  `strUsuario` varchar(30) collate utf8_unicode_ci NOT NULL,
  `strContrasena` varchar(100) collate utf8_unicode_ci default NULL,
  `TipoUsu` varchar(10) collate utf8_unicode_ci default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`strUsuario`, `strContrasena`, `TipoUsu`) VALUES
('jhony', 'qwe123', '1'),
('karen', 'qwe123', '1'),
('maria', '123', '2'),
('kim', 'qwe123', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblvehiculo`
--

CREATE TABLE IF NOT EXISTS `tblvehiculo` (
  `Id_VEHI` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Descripcion_VEH` varchar(50) collate utf8_unicode_ci NOT NULL,
  `Id_TIP_VEH` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`Id_VEHI`),
  KEY `Id_TIP_VEH` (`Id_TIP_VEH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `tblvehiculo`
--

INSERT INTO `tblvehiculo` (`Id_VEHI`, `Descripcion_VEH`, `Id_TIP_VEH`) VALUES
('1020', 'KML987', '10'),
('1040', 'KJJ987', '10'),
('1050', 'FQW678', '20'),
('1060', 'YKZ675', '20'),
('1070', 'TYX326', '20'),
('1080', 'SAR345', '30'),
('1090', 'JOC321', '30'),
('666', '66666', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblviaje`
--

CREATE TABLE IF NOT EXISTS `tblviaje` (
  `Id_VIAJ` int(11) NOT NULL auto_increment,
  `Id_RUT_VIAJ` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Id_VEH_VIAJ` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Fecha_VIAJ` date NOT NULL,
  `Hora_VIAJ` time NOT NULL,
  PRIMARY KEY  (`Id_VIAJ`),
  KEY `Id_RUT_VIAJ` (`Id_RUT_VIAJ`),
  KEY `Id_VEH_VIAJ` (`Id_VEH_VIAJ`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `tblviaje`
--

INSERT INTO `tblviaje` (`Id_VIAJ`, `Id_RUT_VIAJ`, `Id_VEH_VIAJ`, `Fecha_VIAJ`, `Hora_VIAJ`) VALUES
(8, 'YM20', '1020', '2012-08-03', '16:00:00'),
(9, 'MY10', '1060', '2012-10-22', '11:00:00'),
(10, 'MY10', '1060', '0000-00-00', '06:00:00'),
(11, 'YM20', '1020', '0000-00-00', '06:00:00'),
(12, 'YM20', '1020', '0000-00-00', '06:00:00'),
(13, 'MY10', '1020', '0000-00-00', '08:00:00'),
(14, 'MY10', '1020', '0000-00-00', '08:00:00'),
(15, 'MY10', '1020', '2012-11-19', '09:00:00');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `tblreserva`
--
ALTER TABLE `tblreserva`
  ADD CONSTRAINT `tblreserva_ibfk_1` FOREIGN KEY (`Id_VIAje_RES`) REFERENCES `tblviaje` (`Id_VIAJ`),
  ADD CONSTRAINT `tblreserva_ibfk_2` FOREIGN KEY (`Id_CLIente_RES`) REFERENCES `tblcliente` (`Id_CLI`),
  ADD CONSTRAINT `tblreserva_ibfk_3` FOREIGN KEY (`Id_ESTado_RES`) REFERENCES `tblestado` (`Id_EST`);

--
-- Filtros para la tabla `tblvehiculo`
--
ALTER TABLE `tblvehiculo`
  ADD CONSTRAINT `tblvehiculo_ibfk_1` FOREIGN KEY (`Id_TIP_VEH`) REFERENCES `tbltip_veh` (`Id_TIP_VEH`);

--
-- Filtros para la tabla `tblviaje`
--
ALTER TABLE `tblviaje`
  ADD CONSTRAINT `tblviaje_ibfk_1` FOREIGN KEY (`Id_RUT_VIAJ`) REFERENCES `tblruta` (`Id_RUT`),
  ADD CONSTRAINT `tblviaje_ibfk_2` FOREIGN KEY (`Id_VEH_VIAJ`) REFERENCES `tblvehiculo` (`Id_VEHI`);
