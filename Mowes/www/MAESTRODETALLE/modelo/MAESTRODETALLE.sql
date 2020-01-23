-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-05-2013 a las 02:36:25
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `MAESTRODETALLE`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE IF NOT EXISTS `detalle` (
  `ID` int(11) NOT NULL auto_increment,
  `DATO` varchar(100) NOT NULL,
  `IDMAESTRO` varchar(10) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `IDMAESTRO` (`IDMAESTRO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`ID`, `DATO`, `IDMAESTRO`) VALUES
(1, 'DATO1', '1'),
(2, 'DATO2', '1'),
(3, 'DATO3', '1'),
(4, 'DATO4', '2'),
(5, 'DATO5', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestro`
--

CREATE TABLE IF NOT EXISTS `maestro` (
  `IDMAESTRO` varchar(10) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  PRIMARY KEY  (`IDMAESTRO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `maestro`
--

INSERT INTO `maestro` (`IDMAESTRO`, `NOMBRE`) VALUES
('1', 'Hugo'),
('2', 'Paco'),
('3', 'Luis'),
('4', 'ana'),
('5', 'LINA'),
('6', 'rosa');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD CONSTRAINT `detalle_ibfk_1` FOREIGN KEY (`IDMAESTRO`) REFERENCES `maestro` (`IDMAESTRO`);
