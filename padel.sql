-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2020 a las 17:03:24
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `padel`
--
CREATE DATABASE IF NOT EXISTS `padel` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `padel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `idJug` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `nombreJ` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fec_nacimiento` date DEFAULT NULL,
  `posicion` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'img/default.png',
  `perfil` tinyint(4) NOT NULL DEFAULT 0,
  `api_key` varchar(33) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`idJug`, `email`, `pass`, `nombreJ`, `fec_nacimiento`, `posicion`, `foto`, `perfil`, `api_key`) VALUES
(2, 'paco2@gmail.com', '202cb962ac59075b964b07152d234b70', '123', NULL, 'derecha', 'img/default.png', 0, 'd164a3659f93ef7f7a519b19e2b790dc'),
(4, 'admin@admin.com', '202cb962ac59075b964b07152d234b70', '1234', NULL, 'ambos', 'img/default.png', 1, '375fe3ed3fa3a96f7a501f63bcb45374'),
(6, 'fff@gmail.com', '202cb962ac59075b964b07152d234b70', 'pepito1', '0000-00-00', 'reves', 'img/default.png', 0, '9e1c07d4e14e18b47ff3388bcb6df31a'),
(7, 'paki@a.com', '202cb962ac59075b964b07152d234b70', '123', '0000-00-00', 'derecha', 'img/default.png', 0, NULL),
(15, 'pili@h.com', '202cb962ac59075b964b07152d234b70', 'paki', '2005-01-01', 'reves', 'img/default.png', 0, NULL),
(19, 'lala@h.com', '202cb962ac59075b964b07152d234b70', 'juana', '2000-01-01', 'derecha', 'img/default.png', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `idPartido` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `limite` int(11) NOT NULL DEFAULT 0,
  `idPista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`idPartido`, `nombre`, `fecha`, `hora`, `limite`, `idPista`) VALUES
(2, 'Express Malaga', '2019-11-22', '19:00:00', 1, 3),
(3, 'Almogia Open', '2019-11-29', '15:00:00', 1, 2),
(4, 'Torneo 1', '2019-12-18', '17:00:00', 0, 3),
(5, 'Torneo 2', '2019-12-26', '11:00:00', 0, 2),
(6, 'Torneo 3', '2019-12-23', '18:00:00', 1, 1),
(7, 'Torneo 4', '2019-12-17', '18:00:00', 0, 3),
(8, 'Torneo 5', '2019-12-17', '17:00:00', 3, 1),
(10, 'Torneo 6', '2019-12-10', '21:00:00', 0, 2),
(11, 'Torneo 7', '2019-12-18', '14:00:00', 0, 1),
(12, 'Torneo 8', '2019-12-05', '12:00:00', 2, 3),
(19, 'ajuwdwdw', '2022-02-01', '02:01:00', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido_jugador`
--

CREATE TABLE `partido_jugador` (
  `idPartido` int(11) NOT NULL,
  `idJug` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partido_jugador`
--

INSERT INTO `partido_jugador` (`idPartido`, `idJug`) VALUES
(2, 6),
(3, 6),
(6, 2),
(8, 2),
(8, 6),
(8, 19),
(12, 6),
(12, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pista`
--

CREATE TABLE `pista` (
  `idPista` int(11) NOT NULL,
  `nombreP` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccionP` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pista`
--

INSERT INTO `pista` (`idPista`, `nombreP`, `direccionP`) VALUES
(1, 'BeLife Padel', 'C/ Marie Curie, PTA'),
(2, 'PSM Fantasy', 'c/ Caballito de mar, 10'),
(3, 'El Candado', 'Av. El candado, 16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`idJug`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`idPartido`),
  ADD KEY `idPista` (`idPista`);

--
-- Indices de la tabla `partido_jugador`
--
ALTER TABLE `partido_jugador`
  ADD PRIMARY KEY (`idPartido`,`idJug`),
  ADD KEY `idTorneo` (`idPartido`,`idJug`),
  ADD KEY `idJug` (`idJug`);

--
-- Indices de la tabla `pista`
--
ALTER TABLE `pista`
  ADD PRIMARY KEY (`idPista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `idJug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `idPartido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pista`
--
ALTER TABLE `pista`
  MODIFY `idPista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`idPista`) REFERENCES `pista` (`idPista`);

--
-- Filtros para la tabla `partido_jugador`
--
ALTER TABLE `partido_jugador`
  ADD CONSTRAINT `fk_jugador` FOREIGN KEY (`idJug`) REFERENCES `jugador` (`idJug`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_partido` FOREIGN KEY (`idPartido`) REFERENCES `partido` (`idPartido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
