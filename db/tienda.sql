-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2024 a las 18:08:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagenes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`id`, `nombre`, `precio`, `cantidad`, `imagenes`) VALUES
(1, 'crab', 150, 3, '../../assets/images/crab.png'),
(2, 'dolphin', 100, 4, '../../assets/images/dolphin.png'),
(3, 'jellyfish', 50, 2, '../../assets/images/jellyfish.png'),
(4, 'octopus', 20, 5, '../../assets/images/octopus.png'),
(5, 'shark', 200, 1, '../../assets/images/shark.png'),
(6, 'starfish', 10, 6, '../../assets/images/starfish.png'),
(7, 'tortoise', 25, 7, '../../assets/images/tortoise.png'),
(9, 'wile', 150, 4, '../../assets/images/wile.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `estado` enum('activo','bloqueado') DEFAULT 'activo',
  `privilegios` enum('user','admin') DEFAULT 'user',
  `dinero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `user`, `password`, `estado`, `privilegios`, `dinero`) VALUES
(1, 'Nico', 'Mesa', 'nicomm161', '4c4f50aab5ec58a20d862165fae255de07230119c8d1cd1b82ae6a001c0769af', 'activo', 'admin', 100),
(2, 'John', 'Quispe', 'jquispe123', '59e798bd329543d8d8c64c5ddae8b4d423aa585517b20580940db2bc5c48d29f', 'activo', 'user', 150),
(3, 'Iker', 'Alvarez', 'ialvarez10', '1a2936c31817036e91a72cbd744bb13235c981e2fb0ce043584feac25d810b1d', 'activo', 'user', 200),
(4, 'Hassan', 'Hassan', 'hhassan9', 'c98f1a38cf158a1b1ffc98b188e23ff7ac5727ab73ecda1f5663bf976ffd791b', 'bloqueado', 'user', 250),
(5, 'Nico', 'Mesa', 'nicomm16', '1234', 'activo', 'admin', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `valoracion` int(255) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `user`, `valoracion`, `comentario`) VALUES
(2, 'nicomm16', 4, 'Muy buena web'),
(3, 'nicomm161', 1, 'malisima');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
