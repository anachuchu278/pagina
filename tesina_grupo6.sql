-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2024 a las 12:52:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tesina_grupo6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_pago`
--

CREATE TABLE `det_pago` (
  `id_Det_pago` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `monto` int(10) NOT NULL,
  `id_metodop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `det_pago`
--

INSERT INTO `det_pago` (`id_Det_pago`, `fecha_hora`, `monto`, `id_metodop`) VALUES
(1, '2024-10-29 15:36:48', 5000, 4),
(2, '2024-10-31 11:17:26', 5000, 1),
(3, '2024-10-31 11:21:32', 5000, 1),
(4, '2024-10-31 11:48:56', 5000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_Especialidad` int(11) NOT NULL,
  `tipo` varchar(75) NOT NULL,
  `descrip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_Especialidad`, `tipo`, `descrip`) VALUES
(1, 'Anatomía Patológica', ''),
(2, 'Anestesiología', ''),
(3, 'Cardiología', ''),
(4, 'Cirugía Cardiovascular', ''),
(5, 'Cirugía General', ''),
(6, 'Cirugía Pediátrica', ''),
(7, 'Cirugía Plástica y Reparadora', ''),
(8, 'Cirugía Torácica', ''),
(9, 'Cirugía Vascular Periférica', ''),
(10, 'Clínica Médica', ''),
(11, 'Dermatología', ''),
(12, 'Endocrinología', ''),
(13, 'Farmacología', ''),
(14, 'Gastroenterología', ''),
(15, 'Genética Médica', ''),
(16, 'Geriatría', ''),
(17, 'Ginecología y Obstetricia', ''),
(18, 'Hematología', ''),
(19, 'Infectología', ''),
(20, 'Medicina del Trabajo', ''),
(21, 'Medicina Familiar y Comun', ''),
(22, 'Fisiatria(Medicina Física y Rehabilitacion)', ''),
(23, 'Medicina Intensiva', ''),
(24, 'Medicina Interna', ''),
(25, 'Medicina Legal y Forense', ''),
(26, 'Medicina Nuclear', ''),
(27, 'Medicina Preventiva y Salud', ''),
(28, 'Nefrología', ''),
(29, 'Neumonología', ''),
(30, 'Neurocirugía', ''),
(31, 'Neurología', ''),
(32, 'Nutrición', ''),
(33, 'Oftalmología', ''),
(34, 'Oncología Médica', ''),
(35, 'Oncología Radioterápica', ''),
(36, 'Ortopedia y Traumatología', ''),
(37, 'Otorrinolaringología', ''),
(38, 'Pediatría', ''),
(39, 'Psiquiatría', ''),
(40, 'Radiología', ''),
(41, 'Reumatología', ''),
(42, 'Toxicología Médica', ''),
(43, 'Urología', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_Estado` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_Estado`, `estado`) VALUES
(1, 'En Espera'),
(2, 'Confirmado'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_medico`
--

CREATE TABLE `horario_medico` (
  `id_Horario` int(11) NOT NULL,
  `dia_sem` enum('Lunes','Martes','Miercoles','Jueves','Viernes') NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario_medico`
--

INSERT INTO `horario_medico` (`id_Horario`, `dia_sem`, `hora_inicio`, `hora_final`, `id_usuario`) VALUES
(2, 'Lunes', '08:30:00', '09:00:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `met_pago`
--

CREATE TABLE `met_pago` (
  `id_Metpago` int(11) NOT NULL,
  `metodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `met_pago`
--

INSERT INTO `met_pago` (`id_Metpago`, `metodo`) VALUES
(1, 'Debito'),
(2, 'Efectivo'),
(3, 'Credito'),
(4, 'Virtual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_social`
--

CREATE TABLE `obra_social` (
  `id_Obra` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `obra_social`
--

INSERT INTO `obra_social` (`id_Obra`, `nombre`) VALUES
(1, 'Omint'),
(2, 'OSDE'),
(3, 'Swiss Medical');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_Paciente` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `altura_cm` int(3) NOT NULL,
  `edad` int(3) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `historia_clinica` varchar(11) NOT NULL,
  `id_Obra` int(11) NOT NULL,
  `id_Sangre` int(11) NOT NULL,
  `RH_tipo_sangre` tinyint(1) NOT NULL,
  `ultima_mod` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_Paciente`, `id_Usuario`, `nombre`, `apellido`, `peso`, `altura_cm`, `edad`, `dni`, `historia_clinica`, `id_Obra`, `id_Sangre`, `RH_tipo_sangre`, `ultima_mod`) VALUES
(13, 4, 'Francesco', 'Capellino', 81.00, 118, 18, '45455454', '54645', 1, 1, 0, '2024-09-12 11:19:57'),
(19, 3, 'Cristian', 'Bustos', 70.00, 170, 44, '4545451', '707770', 1, 1, 0, '2024-09-12 11:54:59'),
(20, 1, 'Admin', '1', 100.00, 100, 1, '10000000', '1', 1, 1, 0, '2024-10-30 13:02:13'),
(21, 6, 'Cristian', 'Bustos', 70.00, 175, 18, '46888530', '55954', 1, 4, 1, '2024-10-31 11:48:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_Rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_Rol`, `nombre_rol`) VALUES
(1, 'Usuario'),
(2, 'Admin'),
(3, 'Recepcion'),
(4, 'Medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_sanguineo`
--

CREATE TABLE `tipo_sanguineo` (
  `id_Sangre` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_sanguineo`
--

INSERT INTO `tipo_sanguineo` (`id_Sangre`, `tipo`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'AB'),
(4, 'O');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_Turno` int(11) NOT NULL,
  `fecha_hora` int(11) NOT NULL,
  `codigo_turno` varchar(255) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_det_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_Turno`, `fecha_hora`, `codigo_turno`, `id_Usuario`, `id_paciente`, `id_estado`, `id_det_pago`) VALUES
(1, 2, '27066', 3, 1, 2, 1),
(2, 2, '668e6dd9', 3, 1, 1, 0),
(3, 2, '7e08feb1', 3, 1, 1, 0),
(4, 2, '6de70f56', 3, 3, 1, 0),
(5, 2, 'f3256473', 3, 21, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_especialidad` int(11) DEFAULT NULL,
  `imagen_ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `nombre`, `password`, `email`, `id_rol`, `id_especialidad`, `imagen_ruta`) VALUES
(1, 'admin', '$2a$12$pu8p/BCf0f3nPGtulm0tUO/fy0hMfm1wD9xZGy1oWHCGpoTYejTLG', 'admin@admin.com', 2, NULL, ''),
(2, 'cristian', '$2a$12$Uy9a5LpgSyNOcGdZbTO1dezV0M5WXHZVrV43upR68D0OX4ZAtJnkW', 'cristian@admin.org', 2, NULL, ''),
(3, 'MCristian', '$2a$12$Uy9a5LpgSyNOcGdZbTO1dezV0M5WXHZVrV43upR68D0OX4ZAtJnkW', 'cristianbustos@gmail.com', 4, 1, ''),
(4, 'Francesco', '$2y$10$T2NCpky7bvfF0pBRMyIxBeLbDyuX1KuMdgLRovBQ4e8bvl1EQYyY6', 'francescocapellino@gmail.com', 1, NULL, ''),
(5, 'mateo', '$2y$10$gEI/8qL0mAF/uuYHZgVfCur20Rq4n0qCMg5rvIgvW74eHTXxTZlI6', 'mateoobar51@gmail.com', 2, NULL, ''),
(6, 'CristianB', '$2y$10$32IRpUbkwgylLJtl0msj5uAFIMiD9UEuJeWpHD0LbcDejLScGYLl.', 'cristianbustos@alumnos.itr3.edu.ar', 1, NULL, '/img/imagen.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `det_pago`
--
ALTER TABLE `det_pago`
  ADD PRIMARY KEY (`id_Det_pago`),
  ADD KEY `id_metodop` (`id_metodop`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_Especialidad`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_Estado`);

--
-- Indices de la tabla `horario_medico`
--
ALTER TABLE `horario_medico`
  ADD PRIMARY KEY (`id_Horario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `met_pago`
--
ALTER TABLE `met_pago`
  ADD PRIMARY KEY (`id_Metpago`);

--
-- Indices de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  ADD PRIMARY KEY (`id_Obra`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_Paciente`),
  ADD KEY `id_usuario` (`id_Usuario`),
  ADD KEY `id_tipo_sangre` (`id_Sangre`),
  ADD KEY `id_obra` (`id_Obra`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indices de la tabla `tipo_sanguineo`
--
ALTER TABLE `tipo_sanguineo`
  ADD PRIMARY KEY (`id_Sangre`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_Turno`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_pago` (`id_det_pago`),
  ADD KEY `turno_ibfk_4` (`id_Usuario`),
  ADD KEY `fecha_hora` (`fecha_hora`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `det_pago`
--
ALTER TABLE `det_pago`
  MODIFY `id_Det_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_Especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_Estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horario_medico`
--
ALTER TABLE `horario_medico`
  MODIFY `id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `met_pago`
--
ALTER TABLE `met_pago`
  MODIFY `id_Metpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `obra_social`
--
ALTER TABLE `obra_social`
  MODIFY `id_Obra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_Paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_sanguineo`
--
ALTER TABLE `tipo_sanguineo`
  MODIFY `id_Sangre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_Turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `det_pago`
--
ALTER TABLE `det_pago`
  ADD CONSTRAINT `det_pago_ibfk_2` FOREIGN KEY (`id_metodop`) REFERENCES `met_pago` (`id_Metpago`);

--
-- Filtros para la tabla `horario_medico`
--
ALTER TABLE `horario_medico`
  ADD CONSTRAINT `horario_medico_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
