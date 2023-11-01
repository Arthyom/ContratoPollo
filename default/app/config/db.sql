-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-11-2023 a las 08:40:13
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
CREATE TABLE `arrendadores` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arrendatarios`
--

DROP TABLE IF EXISTS `arrendatarios`;
CREATE TABLE `arrendatarios` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  `propiedades_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

DROP TABLE IF EXISTS `contratos`;
CREATE TABLE `contratos` (
  `Id` int(11) NOT NULL,
  `IdArrendador` int(11) NOT NULL,
  `IdArrendatario` int(11) NOT NULL,
  `IdPropiedad` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaTermino` date NOT NULL,
  `Valido` tinyint(1) NOT NULL,
  `IdFiador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiadores`
--

DROP TABLE IF EXISTS `fiadores`;
CREATE TABLE `fiadores` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE `propiedades` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Municipio` varchar(100) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

DROP TABLE IF EXISTS `recibos`;
CREATE TABLE `recibos` (
  `Id` int(11) NOT NULL,
  `FechaHoraEmision` datetime NOT NULL,
  `ReceptorNombre` varchar(100) NOT NULL,
  `IdentificadorUnico` varchar(1000) NOT NULL,
  `Concepto` varchar(1000) NOT NULL,
  `PrecioUnitario` decimal(10,0) NOT NULL,
  `Importe` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `PrecioTexto` varchar(100) DEFAULT NULL,
  `arrendatarios_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arrendadores`
--
ALTER TABLE `arrendadores`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `arrendatarios`
--
ALTER TABLE `arrendatarios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `fiadores`
--
ALTER TABLE `fiadores`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arrendadores`
--
ALTER TABLE `arrendadores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arrendatarios`
--
ALTER TABLE `arrendatarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fiadores`
--
ALTER TABLE `fiadores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
