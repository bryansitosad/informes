-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2024 a las 23:06:33
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
-- Base de datos: `sistema_reportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre_proyecto` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `documentos` text DEFAULT NULL,
  `imagenes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `usuario_id`, `nombre_proyecto`, `descripcion`, `fecha_creacion`, `total`, `documentos`, `imagenes`) VALUES
(1, 1, 'prueba1', 'prueba de almacenamiento de informacion en la base de datos 1 ', '2024-11-18 22:43:50', 3244.00, '[]', '[]'),
(2, 1, 'Paneles', 'Hajdjsba', '2024-11-20 18:29:50', 649488.00, '[]', '[]'),
(3, 3, 'PRUEVA ', 'Se llego y se tomaron fotos para el diagnóstico ', '2024-11-20 22:43:53', 0.00, '[]', '[]'),
(4, 1, 'proyectoprueba', 'hola es una prueba de carga de imagenes', '2024-12-09 01:23:53', 3455.00, '[]', '[]'),
(5, 1, 'asdss', 'asdasdasdasd', '2024-12-09 01:25:34', 3455.00, '[]', '[]'),
(6, 1, 'ASDddss', 'asdasdas', '2024-12-09 01:36:36', 4550.00, '[]', '[]'),
(7, 1, 'prrrb', 'CARGA DE ARCHIVOS', '2024-12-09 16:57:52', 2354.00, '[]', '[]'),
(8, 1, 'lllkkss', 'AIISKKKS', '2024-12-09 17:01:34', 6543.00, '[]', '[]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `role`) VALUES
(1, 'bryan', '$2y$10$fNnda48BXKwSHjsfzeQzIeXBFjkO4vfDPxXMGyTNBYry2xzIlSdZW', 'admin'),
(2, 'antonio', '$2y$10$tDil2B8TNHIJQoKHSds3pO/gQMrLLjqjat9KeYe8DtL.q4UW656NS', 'admin'),
(3, '35842721', '$2y$10$CiMdVcUpfEIsLffe9Rf.a.WGyxcYk5BKx5I8NvQkPtla0XYj8In56', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
