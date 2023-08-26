-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-08-2023 a las 04:15:00
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arrendadores`
--

INSERT INTO `arrendadores` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Usuario`, `Pass`, `Municipio`) VALUES
(1, 'Artemio Gonzalez Lemus', 'Av. Benito Juárez #27', 'Centro', 'Artemio', '1234', 'Moroleón');

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
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
  `PrecioTexto` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
  `PrecioTexto` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
