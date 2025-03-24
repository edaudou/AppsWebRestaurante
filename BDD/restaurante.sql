-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2025 a las 12:49:36
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
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `log_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `log_time`) VALUES
(2, 8, 'User Created', '2025-01-20 11:23:54'),
(3, 10, 'User Created', '2025-01-20 11:39:48'),
(4, 11, 'User Created', '2025-02-10 08:19:55'),
(5, 12, 'User Created', '2025-02-10 08:49:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `num_people` int(11) NOT NULL CHECK (`num_people` > 0),
  `special_request` text DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `table_id`, `reservation_date`, `reservation_time`, `num_people`, `special_request`, `create_date`) VALUES
(1, 1, 5, '2025-03-30', '19:00:00', 4, 'Mesa cerca de la ventana', '2025-03-24 10:12:29'),
(2, 2, 10, '2025-03-31', '20:30:00', 6, 'Cumpleaños', '2025-03-24 10:12:29'),
(3, 3, 2, '2025-04-01', '21:00:00', 4, 'Vegetariano en el grupo', '2025-03-24 10:12:29'),
(4, 1, 7, '2025-04-02', '19:30:00', 8, 'Aniversario', '2025-03-24 10:12:29'),
(5, 2, 15, '2025-04-03', '18:00:00', 12, 'Mesa privada si es posible', '2025-03-24 10:12:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL CHECK (`capacity` > 0),
  `location` enum('Interior','Exterior') NOT NULL,
  `status` enum('Disponible','Ocupada','Reservada') NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `table_number`, `capacity`, `location`, `status`) VALUES
(1, 1, 2, 'Interior', 'Disponible'),
(2, 2, 4, 'Interior', 'Disponible'),
(3, 3, 6, 'Interior', 'Disponible'),
(4, 4, 2, 'Interior', 'Disponible'),
(5, 5, 4, 'Exterior', 'Disponible'),
(6, 6, 6, 'Exterior', 'Disponible'),
(7, 7, 8, 'Interior', 'Disponible'),
(8, 8, 4, 'Interior', 'Disponible'),
(9, 9, 2, 'Exterior', 'Disponible'),
(10, 10, 6, 'Interior', 'Disponible'),
(11, 11, 4, 'Exterior', 'Disponible'),
(12, 12, 2, 'Interior', 'Disponible'),
(13, 13, 8, 'Interior', 'Disponible'),
(14, 14, 10, 'Exterior', 'Disponible'),
(15, 15, 12, 'Interior', 'Disponible'),
(16, 16, 4, 'Exterior', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `created_at`) VALUES
(1, 'Juan Pérez', 'juan@example.com', 'hashed_password', 'juan.png', '2025-03-24 10:12:10'),
(2, 'María Gómez', 'maria@example.com', 'hashed_password', 'maria.jpg', '2025-03-24 10:12:10'),
(3, 'Carlos López', 'carlos@example.com', 'hashed_password', 'carlos.png', '2025-03-24 10:12:10'),
(4, 'Juan Cristo', 'juan2@gmail.com', 'e7ea942765ed88bf14d477be6b93644e', 'juan.png', '2025-03-24 10:17:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_number` (`table_number`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
