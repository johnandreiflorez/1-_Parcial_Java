-- phpMyAdmin SQL Dump
-- version 2.11.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-09-2012 a las 18:23:43
-- Versión del servidor: 5.0.45
-- Versión de PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pryclientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `nombre` varchar(50) collate utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `dir` varchar(100) collate utf8_unicode_ci NOT NULL,
  `sex` varchar(1) collate utf8_unicode_ci NOT NULL,
  `fech` varchar(8) collate utf8_unicode_ci NOT NULL,
  `afcdep` tinyint(1) NOT NULL,
  `afclit` tinyint(1) NOT NULL,
  `afctec` tinyint(1) NOT NULL,
  `afcmus` tinyint(1) NOT NULL,
  `afccin` tinyint(1) NOT NULL,
  `afcotr` tinyint(1) NOT NULL,
  `cual` varchar(50) collate utf8_unicode_ci default NULL,
  `doc` varchar(50) collate utf8_unicode_ci default NULL,
  `obs` varchar(4000) collate utf8_unicode_ci default NULL,
  `foto` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcar la base de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nombre`, `id`, `dir`, `sex`, `fech`, `afcdep`, `afclit`, `afctec`, `afcmus`, `afccin`, `afcotr`, `cual`, `doc`, `obs`, `foto`) VALUES
('HUGO', 1, 'CALLE 13', 'M', '01/01/20', 1, 0, 0, 0, 1, 0, 'dormir', 'C:\\PHPMYSQLAPACHE\\Mowes\\www\\pryClientes\\vista\\imag', 'sin Onserbvaciones', 'hugo.jpg'),
('paco', 2, 'carrrera 27 67-456', 'M', '01/01/00', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 'paco.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE IF NOT EXISTS `telefono` (
  `consecutivo` int(11) NOT NULL auto_increment,
  `numero` varchar(15) collate utf8_unicode_ci NOT NULL,
  `fkcliente` int(11) NOT NULL,
  PRIMARY KEY  (`consecutivo`),
  KEY `cons_fkcliente` (`fkcliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=420 ;

--
-- Volcar la base de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`consecutivo`, `numero`, `fkcliente`) VALUES
(416, '111', 1),
(417, '112', 1),
(418, '113', 1),
(419, '211', 2);

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `cons_fkcliente` FOREIGN KEY (`fkcliente`) REFERENCES `cliente` (`id`);
