-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-08-2023 a las 00:59:18
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
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
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
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arrendatarios`
--

INSERT INTO `arrendatarios` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Municipio`) VALUES
(1, 'Arrendatario Ejemplo 1', 'Calle ejemplo esquina con demostracion #59', 'Ejemplo', 'Ficticio'),
(5, 'Alejandra Nava Osorio', 'Calle Pipila #54A int 4', 'Centro', 'Moroleon'),
(6, 'Alejandra Nava Osorio', 'Calle Pipila #54A int 4', 'Centro', 'Moroleon');

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

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`Id`, `IdArrendador`, `IdArrendatario`, `IdPropiedad`, `FechaInicio`, `FechaTermino`, `Valido`, `IdFiador`) VALUES
(1, 1, 1, 1, '2023-08-18', '2023-09-18', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiadores`
--

DROP TABLE IF EXISTS `fiadores`;
CREATE TABLE IF NOT EXISTS `fiadores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fiadores`
--

INSERT INTO `fiadores` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Municipio`) VALUES
(1, 'Fiador Ejemplo 1', 'Direccion de fiador de ejemplo 1', 'Ejemplo fiador', 'Municipio fiador'),
(2, 'Alfredo Gonzalez Gavina', 'Av Benito Juarez #27', 'colonia centro, casa amarilla de 3 pisos', 'Moroleon'),
(3, 'Alfredo Gonzalez Gaviña', 'Av Benito Juarez #27', 'colonia centro, casa amarilla de 3 pisos', 'Moroleon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE IF NOT EXISTS `propiedades` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `Municipio` varchar(50) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`Id`, `Nombre`, `Direccion`, `Colonia`, `Municipio`, `Precio`, `PrecioTexto`) VALUES
(1, 'Propiedad Ejemplo 1', 'Direccion de ejemplo de propiedad para arrendar #69', 'Ejemplo', 'Ficticio', 3501, ''),
(5, NULL, 'Calle Queretaro #57A Int 2', 'Centro', 'Moroleon', 3000, 'TRES MIL'),
(6, NULL, 'Calle Queretaro #57A Int 2', 'Centro', 'Moroleon', 3000, 'TRES MIL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

DROP TABLE IF EXISTS `recibos`;
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`Id`, `FechaHoraEmision`, `ReceptorNombre`, `IdentificadorUnico`, `Concepto`, `PrecioUnitario`, `Importe`, `Total`, `PrecioTexto`) VALUES
(28, '2023-08-24 18:46:52', 'Alejandra Nava Osorio', '64e7f9fc467ea - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3000, 3000, 3000, 'Tres mill'),
(29, '2023-08-24 18:52:07', 'Alejandra Nava Osorio', '64e7fb379619f - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3000, 3000, 3000, 'Tres mill'),
(30, '2023-08-24 18:52:51', 'Alejandra Nava Osorio', '64e7fb63b929a - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3000, 3000, 3000, 'Tres mill'),
(31, '2023-08-25 22:05:58', 'Alejandra Nava Osorio', '64e933d6a2d58 - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3000, 3000, 3000, 'tres mil'),
(32, '2023-08-25 22:06:48', 'Alejandra Nava Osorio', '64e93408c5d5f - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3501, 3501, 3501, 'tres mil quinientos punto cinco'),
(33, '2023-08-25 22:07:53', 'Alejandra Nava Osorio', '64e934490d771 - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3500, 3500, 3500, 'tres mil quinientos'),
(34, '2023-08-25 22:56:27', 'Alejandra Nava Osorio', '64e93fabf1b1f - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3000, 3000, 3000, 'TRES MIL'),
(35, '2023-08-25 23:28:17', 'Alejandra Nava Osorio', '64e94721c0b00 - renta Queretaro #57A enero 2023', 'renta Queretaro #57A enero 2023', 3000, 3000, 3000, 'TRES MIL');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
