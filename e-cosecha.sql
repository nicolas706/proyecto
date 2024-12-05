-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2024 a las 15:17:54
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
-- Base de datos: `e-cosecha`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_cosechero`
--

CREATE TABLE `caja_cosechero` (
  `id` int(11) NOT NULL,
  `cosecha_id` int(11) DEFAULT NULL,
  `tarja_id` int(11) DEFAULT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `tipo_caja_id` int(11) DEFAULT NULL,
  `codigo_completo` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campo`
--

CREATE TABLE `campo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campo`
--

INSERT INTO `campo` (`id`, `nombre`, `lugar`, `detalle`, `created_at`, `updated_at`) VALUES
(1, 'Campo Norte', 'Valle Central', NULL, '2024-10-15 12:28:36', '2024-10-15 12:28:36'),
(2, 'Campo Sur', 'Colchagua', NULL, '2024-10-15 12:28:36', '2024-10-15 12:28:36'),
(3, 'Sector A', 'Curicó', NULL, '2024-10-15 12:28:36', '2024-10-15 12:28:36'),
(4, 'Sector B', 'Rancagua', NULL, '2024-10-15 12:28:36', '2024-10-15 12:28:36'),
(5, 'Campo Este', 'Región del Maule', NULL, '2024-10-15 12:28:36', '2024-10-15 12:28:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

CREATE TABLE `carro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carro`
--

INSERT INTO `carro` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Carro 01', 'Carro utilizado para el transporte de cajas en el huerto', '2024-10-15 12:17:25', '2024-10-15 12:17:25'),
(2, 'Carro 02', 'Carro ligero para mover pequeñas cargas rápidamente', '2024-10-15 12:17:25', '2024-10-15 12:17:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_de_costos`
--

CREATE TABLE `centro_de_costos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `detalle` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_de_barras`
--

CREATE TABLE `codigo_de_barras` (
  `id` int(11) NOT NULL,
  `cosecha_id` int(11) DEFAULT NULL,
  `numero` varchar(100) DEFAULT NULL,
  `cantidad_impresos` int(11) DEFAULT NULL,
  `cantidad_entregados` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `codigo_de_barras`
--

INSERT INTO `codigo_de_barras` (`id`, `cosecha_id`, `numero`, `cantidad_impresos`, `cantidad_entregados`, `created_at`, `updated_at`) VALUES
(25, 1, '3733302188001', 2, 2, '2024-11-25 20:55:43', '2024-11-25 20:55:43'),
(27, 1, '3375649232002', 6, 6, '2024-11-26 18:32:41', '2024-11-26 18:32:41'),
(46, 1, '1719334070003', 5, 5, '2024-11-27 19:35:07', '2024-11-27 19:35:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cosecha`
--

CREATE TABLE `cosecha` (
  `id` int(11) NOT NULL,
  `anio` year(4) NOT NULL,
  `activa` tinyint(1) NOT NULL,
  `detalle` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cosecha`
--

INSERT INTO `cosecha` (`id`, `anio`, `activa`, `detalle`, `created_at`, `updated_at`) VALUES
(1, '2024', 1, 'Cosecha de otoño con excelentes resultados', '2024-10-15 12:15:06', '2024-10-15 12:15:06'),
(2, '2023', 0, 'Cosecha del año pasado con rendimiento moderado', '2024-10-15 12:15:06', '2024-10-15 12:15:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `falta`
--

CREATE TABLE `falta` (
  `id` int(11) NOT NULL,
  `cosecha_id` int(11) DEFAULT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `tipo_de_falta_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huerto`
--

CREATE TABLE `huerto` (
  `id` int(11) NOT NULL,
  `campo_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `año` year(4) NOT NULL,
  `detalle` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `huerto`
--

INSERT INTO `huerto` (`id`, `campo_id`, `nombre`, `año`, `detalle`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cuartel 01', '2020', NULL, '2024-10-15 12:30:56', '2024-10-15 12:30:56'),
(2, 1, 'Cuartel 02', '2020', NULL, '2024-10-15 12:30:56', '2024-10-15 12:30:56'),
(3, 1, 'Cuartel 03', '2021', NULL, '2024-10-15 12:30:56', '2024-10-15 12:30:56'),
(4, 1, 'Cuartel 04', '2021', NULL, '2024-10-15 12:30:56', '2024-10-15 12:30:56'),
(5, 1, 'Cuartel 05', '2022', NULL, '2024-10-15 12:30:56', '2024-10-15 12:30:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeciones`
--

CREATE TABLE `objeciones` (
  `id` int(11) NOT NULL,
  `tarja_id` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_paterno` varchar(100) DEFAULT NULL,
  `apellido_materno` varchar(100) DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `banco` varchar(100) DEFAULT NULL,
  `cuenta_corriente` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `comuna` varchar(100) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `detalle` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `rut`, `nombre`, `apellido_paterno`, `apellido_materno`, `sexo`, `fecha_de_nacimiento`, `banco`, `cuenta_corriente`, `telefono`, `comuna`, `estado_civil`, `detalle`, `created_at`, `updated_at`) VALUES
(1, '', 'Juan', 'Pérez', 'López', '', '1988-05-15', NULL, NULL, '123456789', NULL, NULL, NULL, '2024-10-15 12:40:43', '2024-10-15 12:40:43'),
(2, '', 'María', 'Gómez', 'Rojas', '', '1995-11-22', NULL, NULL, '987654321', NULL, NULL, NULL, '2024-10-15 12:40:43', '2024-10-15 12:40:43'),
(3, '6552856', 'Carlos', 'Martínez', 'Sánchez', 'M', '1981-03-30', NULL, NULL, '456789123', NULL, NULL, NULL, '2024-10-15 12:40:43', '2024-11-15 16:26:47'),
(6, '6552856', 'nicolas', 'ALONSO', 'PAREDES', 'M', '2024-11-21', NULL, NULL, '5252636', NULL, NULL, NULL, '2024-11-15 16:24:23', '2024-11-15 16:26:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_de_usuario`
--

CREATE TABLE `rol_de_usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarja`
--

CREATE TABLE `tarja` (
  `id` int(11) NOT NULL,
  `cosecha_id` int(11) DEFAULT NULL,
  `carro_id` int(11) NOT NULL,
  `variedad_huerto_id` int(11) NOT NULL,
  `trabajador_id` int(11) DEFAULT NULL,
  `tipo_caja_id` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `total_fisico` int(11) NOT NULL,
  `codigos_registrados` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `detalle` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarja`
--

INSERT INTO `tarja` (`id`, `cosecha_id`, `carro_id`, `variedad_huerto_id`, `trabajador_id`, `tipo_caja_id`, `codigo`, `total_fisico`, `codigos_registrados`, `fecha`, `detalle`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 'TARJA001', 100, 115, '2024-10-10', NULL, '2024-10-15 13:07:41', '2024-10-15 13:07:41'),
(2, 1, 2, 2, 2, 2, 'TARJA002', 200, 240, '2024-10-11', NULL, '2024-10-15 13:07:41', '2024-10-15 13:19:25'),
(3, 1, 1, 1, 2, 1, 'TARJA003', 150, 155, '2024-10-12', NULL, '2024-10-15 13:07:41', '2024-10-15 13:07:41'),
(4, 1, 2, 2, 1, 2, 'TARJA004', 80, 85, '2024-10-13', NULL, '2024-10-15 13:07:41', '2024-10-15 13:19:25'),
(5, 1, 1, 1, 1, 1, 'TARJA005', 120, 125, '2024-10-14', NULL, '2024-10-15 13:07:41', '2024-10-15 13:07:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_caja`
--

CREATE TABLE `tipo_caja` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `capacidad_kg` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_caja`
--

INSERT INTO `tipo_caja` (`id`, `nombre`, `capacidad_kg`, `created_at`, `updated_at`) VALUES
(1, 'Caja Pequeña', 3.00, '2024-10-15 12:58:19', '2024-10-15 12:58:19'),
(2, 'Caja Mediana', 5.00, '2024-10-15 12:58:19', '2024-10-15 12:58:19'),
(3, 'Caja Grande', 8.00, '2024-10-15 12:58:19', '2024-10-15 12:58:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_falta`
--

CREATE TABLE `tipo_de_falta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `gravedad` enum('leve','moderada','grave') DEFAULT NULL,
  `detalles` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_trabajo`
--

CREATE TABLE `tipo_trabajo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_trabajo`
--

INSERT INTO `tipo_trabajo` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Tractorista', NULL, '2024-10-15 12:44:32', '2024-10-15 12:44:32'),
(2, 'Digitador', NULL, '2024-10-15 12:44:32', '2024-10-15 12:44:32'),
(3, 'Control de calidad', NULL, '2024-10-15 12:44:32', '2024-10-15 12:44:32'),
(4, 'Jefe de cuadrilla', NULL, '2024-10-15 12:44:32', '2024-10-15 12:44:32'),
(5, 'Cosechero', NULL, '2024-11-28 14:15:03', '2024-11-28 14:15:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL,
  `cosecha_id` int(11) DEFAULT NULL,
  `tipo_trabajo_id` int(11) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `codigo` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id`, `cosecha_id`, `tipo_trabajo_id`, `persona_id`, `codigo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'T001', '2024-10-15 12:50:15', '2024-10-15 12:55:03'),
(2, 1, 2, 2, 'T002', '2024-10-15 12:50:15', '2024-10-15 12:55:03'),
(3, 1, 3, 3, 'T003', '2024-10-15 12:50:15', '2024-10-15 12:55:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('usuario','administrador') DEFAULT 'usuario',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `username`, `password`, `rol`, `created_at`) VALUES
(1, 'Nicolas', 'nicolas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'administrador', '2024-11-20 19:40:50'),
(2, 'Santiago', 'santiago@gmail.com', '202cb962ac59075b964b07152d234b70', 'usuario', '2024-11-20 19:54:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variedad`
--

CREATE TABLE `variedad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `variedad`
--

INSERT INTO `variedad` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Cereza Bing', '2024-10-15 12:19:35', '2024-10-15 12:19:35'),
(2, 'Cereza Rainier', '2024-10-15 12:19:35', '2024-10-15 12:19:35'),
(3, 'Cereza Lapins', '2024-10-15 12:19:35', '2024-10-15 12:19:35'),
(4, 'Cereza Sweetheart', '2024-10-15 12:19:35', '2024-10-15 12:19:35'),
(5, 'Cereza Lambert', '2024-10-15 12:19:35', '2024-10-15 12:19:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variedad_huerto`
--

CREATE TABLE `variedad_huerto` (
  `id` int(11) NOT NULL,
  `huerto_id` int(11) DEFAULT NULL,
  `variedad_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `variedad_huerto`
--

INSERT INTO `variedad_huerto` (`id`, `huerto_id`, `variedad_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-15 12:34:39', '2024-10-15 12:34:39'),
(2, 1, 2, '2024-10-15 12:34:39', '2024-10-15 12:34:39'),
(3, 2, 3, '2024-10-15 12:34:39', '2024-10-15 12:34:39'),
(4, 3, 4, '2024-10-15 12:34:39', '2024-10-15 12:34:39'),
(5, 4, 5, '2024-10-15 12:34:39', '2024-10-15 12:34:39'),
(6, 5, 1, '2024-10-15 12:34:39', '2024-10-15 12:34:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_cosechero`
--
ALTER TABLE `caja_cosechero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosecha_id` (`cosecha_id`),
  ADD KEY `tipo_caja_id` (`tipo_caja_id`),
  ADD KEY `tarja_id` (`tarja_id`),
  ADD KEY `trabajador_id` (`trabajador_id`);

--
-- Indices de la tabla `campo`
--
ALTER TABLE `campo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centro_de_costos`
--
ALTER TABLE `centro_de_costos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codigo_de_barras`
--
ALTER TABLE `codigo_de_barras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosecha_id` (`cosecha_id`);

--
-- Indices de la tabla `cosecha`
--
ALTER TABLE `cosecha`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `falta`
--
ALTER TABLE `falta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosecha_id` (`cosecha_id`),
  ADD KEY `tipo_de_falta_id` (`tipo_de_falta_id`),
  ADD KEY `trabajador_id` (`trabajador_id`);

--
-- Indices de la tabla `huerto`
--
ALTER TABLE `huerto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campo_id` (`campo_id`);

--
-- Indices de la tabla `objeciones`
--
ALTER TABLE `objeciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarja_id` (`tarja_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_de_usuario`
--
ALTER TABLE `rol_de_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarja`
--
ALTER TABLE `tarja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosecha_id` (`cosecha_id`),
  ADD KEY `trabajador_id` (`trabajador_id`),
  ADD KEY `carro_id` (`carro_id`),
  ADD KEY `variedad_huerto_id` (`variedad_huerto_id`),
  ADD KEY `tipo_caja_id` (`tipo_caja_id`);

--
-- Indices de la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_de_falta`
--
ALTER TABLE `tipo_de_falta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_trabajo`
--
ALTER TABLE `tipo_trabajo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `tipo_trabajo_id` (`tipo_trabajo_id`),
  ADD KEY `cosecha_id` (`cosecha_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`username`);

--
-- Indices de la tabla `variedad`
--
ALTER TABLE `variedad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `variedad_huerto`
--
ALTER TABLE `variedad_huerto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `huerto_id` (`huerto_id`),
  ADD KEY `variedad_id` (`variedad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_cosechero`
--
ALTER TABLE `caja_cosechero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campo`
--
ALTER TABLE `campo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carro`
--
ALTER TABLE `carro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `centro_de_costos`
--
ALTER TABLE `centro_de_costos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigo_de_barras`
--
ALTER TABLE `codigo_de_barras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `cosecha`
--
ALTER TABLE `cosecha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `falta`
--
ALTER TABLE `falta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `huerto`
--
ALTER TABLE `huerto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `objeciones`
--
ALTER TABLE `objeciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol_de_usuario`
--
ALTER TABLE `rol_de_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarja`
--
ALTER TABLE `tarja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_de_falta`
--
ALTER TABLE `tipo_de_falta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_trabajo`
--
ALTER TABLE `tipo_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `variedad`
--
ALTER TABLE `variedad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `variedad_huerto`
--
ALTER TABLE `variedad_huerto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja_cosechero`
--
ALTER TABLE `caja_cosechero`
  ADD CONSTRAINT `caja_cosechero_ibfk_1` FOREIGN KEY (`cosecha_id`) REFERENCES `cosecha` (`id`),
  ADD CONSTRAINT `caja_cosechero_ibfk_3` FOREIGN KEY (`tipo_caja_id`) REFERENCES `tipo_caja` (`id`),
  ADD CONSTRAINT `caja_cosechero_ibfk_4` FOREIGN KEY (`tarja_id`) REFERENCES `tarja` (`id`),
  ADD CONSTRAINT `caja_cosechero_ibfk_5` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`);

--
-- Filtros para la tabla `codigo_de_barras`
--
ALTER TABLE `codigo_de_barras`
  ADD CONSTRAINT `codigo_de_barras_ibfk_1` FOREIGN KEY (`cosecha_id`) REFERENCES `cosecha` (`id`);

--
-- Filtros para la tabla `falta`
--
ALTER TABLE `falta`
  ADD CONSTRAINT `falta_ibfk_1` FOREIGN KEY (`cosecha_id`) REFERENCES `cosecha` (`id`),
  ADD CONSTRAINT `falta_ibfk_3` FOREIGN KEY (`tipo_de_falta_id`) REFERENCES `tipo_de_falta` (`id`),
  ADD CONSTRAINT `falta_ibfk_4` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`);

--
-- Filtros para la tabla `huerto`
--
ALTER TABLE `huerto`
  ADD CONSTRAINT `huerto_ibfk_1` FOREIGN KEY (`campo_id`) REFERENCES `campo` (`id`);

--
-- Filtros para la tabla `objeciones`
--
ALTER TABLE `objeciones`
  ADD CONSTRAINT `objeciones_ibfk_2` FOREIGN KEY (`tarja_id`) REFERENCES `tarja` (`id`);

--
-- Filtros para la tabla `tarja`
--
ALTER TABLE `tarja`
  ADD CONSTRAINT `tarja_ibfk_1` FOREIGN KEY (`cosecha_id`) REFERENCES `cosecha` (`id`),
  ADD CONSTRAINT `tarja_ibfk_2` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajador` (`id`),
  ADD CONSTRAINT `tarja_ibfk_3` FOREIGN KEY (`carro_id`) REFERENCES `carro` (`id`),
  ADD CONSTRAINT `tarja_ibfk_4` FOREIGN KEY (`variedad_huerto_id`) REFERENCES `variedad_huerto` (`id`),
  ADD CONSTRAINT `tarja_ibfk_5` FOREIGN KEY (`tipo_caja_id`) REFERENCES `tipo_caja` (`id`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `trabajador_ibfk_3` FOREIGN KEY (`tipo_trabajo_id`) REFERENCES `tipo_trabajo` (`id`),
  ADD CONSTRAINT `trabajador_ibfk_5` FOREIGN KEY (`cosecha_id`) REFERENCES `cosecha` (`id`);

--
-- Filtros para la tabla `variedad_huerto`
--
ALTER TABLE `variedad_huerto`
  ADD CONSTRAINT `variedad_huerto_ibfk_2` FOREIGN KEY (`huerto_id`) REFERENCES `huerto` (`id`),
  ADD CONSTRAINT `variedad_huerto_ibfk_3` FOREIGN KEY (`variedad_id`) REFERENCES `variedad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
