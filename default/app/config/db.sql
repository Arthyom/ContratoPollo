-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-08-2023 a las 00:27:13
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

CREATE TABLE IF NOT EXISTS `arrendadores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arrendadores`
--

INSERT INTO `arrendadores` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Usuario`, `Pass`, `Municipio`) VALUES
(1, 'Artemio Gonzalez Lemus', 'Av. Benito Juárez #27', 'Centro', 'Artemio', '1234', 'Moroleón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendatarios`
--

CREATE TABLE IF NOT EXISTS `arrendatarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arrendatarios`
--

INSERT INTO `arrendatarios` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Municipio`) VALUES
(1, 'Arrendatario Ejemplo 1', 'Calle ejemplo esquina con demostracion #59', 'Ejemplo', 'Ficticio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`Id`, `IdArrendador`, `IdArrendatario`, `IdPropiedad`, `FechaInicio`, `FechaTermino`, `Valido`, `IdFiador`) VALUES
(1, 1, 1, 1, '2023-08-18', '2023-09-18', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiadores`
--

CREATE TABLE IF NOT EXISTS `fiadores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fiadores`
--

INSERT INTO `fiadores` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Municipio`) VALUES
(1, 'Fiador Ejemplo 1', 'Direccion de fiador de ejemplo 1', 'Ejemplo fiador', 'Municipio fiador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE IF NOT EXISTS `propiedades` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Municipio`, `Precio`, `PrecioTexto`) VALUES
(1, 'Propiedad Ejemplo 1', 'Direccion de ejemplo de propiedad para arrendar #69', 'Ejemplo', 'Ficticio', 3501, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE IF NOT EXISTS `recibos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FechaHoraEmision` datetime NOT NULL,
  `ReceptorNombre` varchar(100) NOT NULL,
  `IdentificadorUnico` varchar(50) NOT NULL,
  `Concepto` varchar(100) NOT NULL,
  `PrecioUnitario` decimal(10,0) NOT NULL,
  `Importe` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
