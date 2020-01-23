-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-03-2013 a las 00:13:54
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `agencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `IDCLIENTE` int(11) NOT NULL,
  `NOMBRE` varchar(100) collate utf8_unicode_ci NOT NULL,
  `CELULAR` int(11) NOT NULL,
  PRIMARY KEY  (`IDCLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IDCLIENTE`, `NOMBRE`, `CELULAR`) VALUES
(0, 'Cliente de Prueba', 381456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE IF NOT EXISTS `vivienda` (
  `IDVIVIENDA` int(11) NOT NULL,
  `DIRECCION` varchar(200) collate utf8_unicode_ci NOT NULL,
  `TELEFONO` varchar(13) collate utf8_unicode_ci NOT NULL,
  `TIPO` varchar(1) collate utf8_unicode_ci NOT NULL,
  `FKCLIENTE` int(11) default NULL,
  PRIMARY KEY  (`IDVIVIENDA`),
  KEY `FKCLIENTE` (`FKCLIENTE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `vivienda`
--

INSERT INTO `vivienda` (`IDVIVIENDA`, `DIRECCION`, `TELEFONO`, `TIPO`, `FKCLIENTE`) VALUES
(1, '  Calle 13', '6789654', 'C', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendacliente`
--

CREATE TABLE IF NOT EXISTS `viviendacliente` (
  `FKCLIENTE` int(11) NOT NULL,
  `FKVIVIENDA` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  PRIMARY KEY  (`FKCLIENTE`,`FKVIVIENDA`),
  KEY `FKCLIENTE` (`FKCLIENTE`),
  KEY `FKVIVIENDA` (`FKVIVIENDA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `viviendacliente`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD CONSTRAINT `vivienda_ibfk_1` FOREIGN KEY (`FKCLIENTE`) REFERENCES `cliente` (`IDCLIENTE`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `viviendacliente`
--
ALTER TABLE `viviendacliente`
  ADD CONSTRAINT `viviendacliente_ibfk_4` FOREIGN KEY (`FKVIVIENDA`) REFERENCES `vivienda` (`IDVIVIENDA`) ON UPDATE CASCADE,
  ADD CONSTRAINT `viviendacliente_ibfk_3` FOREIGN KEY (`FKCLIENTE`) REFERENCES `cliente` (`IDCLIENTE`) ON UPDATE CASCADE;
