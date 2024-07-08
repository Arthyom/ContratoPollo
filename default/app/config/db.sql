-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-01-2024 a las 00:27:20
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contratos`
--
CREATE DATABASE IF NOT EXISTS `contratos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `contratos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendadores`
--

DROP TABLE IF EXISTS `arrendadores`;
CREATE TABLE IF NOT EXISTS `arrendadores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendatarios`
--

DROP TABLE IF EXISTS `arrendatarios`;
CREATE TABLE IF NOT EXISTS `arrendatarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  `propiedades_id` int(11) DEFAULT NULL,
  `Finalizado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

DROP TABLE IF EXISTS `contratos`;
CREATE TABLE IF NOT EXISTS `contratos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdArrendador` int(11) NOT NULL,
  `IdArrendatario` int(11) NOT NULL,
  `IdPropiedad` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaTermino` date NOT NULL,
  `Valido` tinyint(1) NOT NULL,
  `IdFiador` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desalojos`
--

DROP TABLE IF EXISTS `desalojos`;
CREATE TABLE IF NOT EXISTS `desalojos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaDesalojo` date DEFAULT NULL,
  `Arrendatarios_id` int(11) DEFAULT NULL,
  `Propiedades_id` int(11) DEFAULT NULL,
  `total` varchar(150) DEFAULT NULL,
  `mesesAdeudo` varchar(150) DEFAULT NULL,
  `anio` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiadores`
--

DROP TABLE IF EXISTS `fiadores`;
CREATE TABLE IF NOT EXISTS `fiadores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE IF NOT EXISTS `propiedades` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(100) DEFAULT NULL,
  `Ocupado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

DROP TABLE IF EXISTS `recibos`;
CREATE TABLE IF NOT EXISTS `recibos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FechaHoraEmision` datetime NOT NULL,
  `ReceptorNombre` varchar(100) NOT NULL,
  `IdentificadorUnico` varchar(1000) NOT NULL,
  `Concepto` varchar(1000) NOT NULL,
  `PrecioUnitario` decimal(10,0) NOT NULL,
  `Importe` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(100) DEFAULT NULL,
  `arrendatarios_id` int(11) DEFAULT NULL,
  `Pagado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

if not exists(select * from `arrendadores`)
begin
  INSERT INTO `arrendadores` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Usuario`, `Pass`, `Municipio`) VALUES (NULL, 'ARTEMIO GONZALEZ LEMUS', 'BENITO JUAREZ #27', 'CENTRO', '1', '1234', 'MOROLEON');
end
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
