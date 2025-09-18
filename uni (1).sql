-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2025 a las 07:59:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uni`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Telefono` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`Codigo`, `Nombre`, `Apellidos`, `Edad`, `Telefono`) VALUES
(0, 'Madeline', 'MArtin', 23, '656-467-68'),
(12345, 'Brayan', 'Mata Garay', 23, '656-467-68'),
(123356, 'Caballerito', 'Garay', 23, '765-343-45'),
(207890, 'Carlos', 'Mata Garay', 20, '656-467-68'),
(208780, 'Federico', 'Garcia Lorca', 30, '656-467-68'),
(274532, 'Arely', 'Medina', 22, '656-467-68'),
(274537, 'Arely', 'Medina', 22, '656-467-68');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`Codigo`, `Nombre`) VALUES
(1, 'Diseño Digital de Medios Interactivos'),
(2, 'Diseño Grafico'),
(3, 'Diseño de Interiores'),
(4, 'Arquitectura'),
(5, 'Diseño Industrial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `ID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `CodigoAlumno` int(11) DEFAULT NULL,
  `CodigoCarrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`ID`, `Fecha`, `CodigoAlumno`, `CodigoCarrera`) VALUES
(1, '2025-09-18', 208780, 3),
(2, '2025-09-18', 208780, 3),
(3, '2025-09-18', 12345, 1),
(4, '2025-09-18', 12345, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CodigoAlumno` (`CodigoAlumno`),
  ADD KEY `CodigoCarrera` (`CodigoCarrera`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`CodigoAlumno`) REFERENCES `alumnos` (`Codigo`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`CodigoCarrera`) REFERENCES `carreras` (`Codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
