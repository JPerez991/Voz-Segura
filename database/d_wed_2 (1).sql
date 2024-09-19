-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2024 a las 05:38:36
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
-- Base de datos: `d_wed_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_psicologa` int(10) UNSIGNED NOT NULL,
  `estatus` enum('agendada','cancelada','completada') NOT NULL,
  `notas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `citas`
--
DELIMITER $$
CREATE TRIGGER `before_insert_cita` BEFORE INSERT ON `citas` FOR EACH ROW BEGIN
    DECLARE rol_psicologo VARCHAR(10);
    
    -- Obtenemos el rol de la persona asociada a id_psicologa
    SELECT `rol` INTO rol_psicologo 
    FROM `persona` 
    WHERE `documento` = NEW.id_psicologa;

    -- Si el rol no es 'psicologo', generamos un error
    IF rol_psicologo <> 'psicologo' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El perfil seleccionado no es un psicologo';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `id` int(11) NOT NULL,
  `conteo_usuarios` int(11) NOT NULL,
  `publicaciones_foro` int(11) NOT NULL,
  `h_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `citas_completadas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `id` int(10) UNSIGNED NOT NULL,
  `creado_por` int(10) UNSIGNED NOT NULL,
  `tema` varchar(90) NOT NULL,
  `h_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `h_actulizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_envio` int(10) UNSIGNED DEFAULT NULL,
  `id_reseccion` int(10) UNSIGNED DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `hora_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `es_anonimo` tinyint(1) DEFAULT 0,
  `es_reportado` tinyint(1) DEFAULT 0
) ;

--
-- Disparadores `mensajes`
--
DELIMITER $$
CREATE TRIGGER `before_insert_mensaje` BEFORE INSERT ON `mensajes` FOR EACH ROW BEGIN
    -- Verifica que el remitente y el receptor no sean el mismo
    IF NEW.id_envio = NEW.id_reseccion THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El remitente no puede ser el mismo que el receptor.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_update_mensaje` BEFORE UPDATE ON `mensajes` FOR EACH ROW BEGIN
    -- Verifica que el remitente y el receptor no sean el mismo al actualizar
    IF NEW.id_envio = NEW.id_reseccion THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El remitente no puede ser el mismo que el receptor.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `documento_pers` int(10) UNSIGNED NOT NULL,
  `nombre_completo` varchar(60) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `nombre_anonimo` varchar(20) NOT NULL,
  `h_creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `h_actulizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `documento` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(45) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `rol` enum('usuario','psicologo','admin') DEFAULT 'usuario',
  `es_anonimo` tinyint(1) NOT NULL DEFAULT 0,
  `foto_perfil` varchar(80) DEFAULT NULL,
  `h_creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `h_actulizado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_seguridad`
--

CREATE TABLE `reporte_seguridad` (
  `id` int(10) UNSIGNED NOT NULL,
  `reporte_mensaje_id` int(10) UNSIGNED DEFAULT NULL,
  `reportado_por` int(10) UNSIGNED DEFAULT NULL,
  `razon` varchar(80) DEFAULT NULL,
  `h_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_foto`
--

CREATE TABLE `respuesta_foto` (
  `id` int(10) UNSIGNED NOT NULL,
  `foro_id` int(10) UNSIGNED DEFAULT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `h_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `es_anonimo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_citas_usuario` (`id_usuario`),
  ADD KEY `fk_citas_psicologa` (`id_psicologa`);

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foros_perfiles` (`creado_por`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mensajes_envio` (`id_envio`),
  ADD KEY `fk_mensajes_reseccion` (`id_reseccion`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`documento_pers`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`documento`);

--
-- Indices de la tabla `reporte_seguridad`
--
ALTER TABLE `reporte_seguridad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reporte_mensaje` (`reporte_mensaje_id`),
  ADD KEY `fk_reporte_usuario` (`reportado_por`);

--
-- Indices de la tabla `respuesta_foto`
--
ALTER TABLE `respuesta_foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_respuesta_foro` (`foro_id`),
  ADD KEY `fk_respuesta_foto_usuario` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `documento_pers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `documento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporte_seguridad`
--
ALTER TABLE `reporte_seguridad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_foto`
--
ALTER TABLE `respuesta_foto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_citas_psicologa` FOREIGN KEY (`id_psicologa`) REFERENCES `perfiles` (`documento_pers`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_citas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `perfiles` (`documento_pers`) ON DELETE CASCADE;

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `fk_foros_perfiles` FOREIGN KEY (`creado_por`) REFERENCES `perfiles` (`documento_pers`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_envio` FOREIGN KEY (`id_envio`) REFERENCES `perfiles` (`documento_pers`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_mensajes_reseccion` FOREIGN KEY (`id_reseccion`) REFERENCES `perfiles` (`documento_pers`) ON DELETE SET NULL;

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `fk_perfiles_persona` FOREIGN KEY (`documento_pers`) REFERENCES `persona` (`documento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reporte_seguridad`
--
ALTER TABLE `reporte_seguridad`
  ADD CONSTRAINT `fk_reporte_mensaje` FOREIGN KEY (`reporte_mensaje_id`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reporte_usuario` FOREIGN KEY (`reportado_por`) REFERENCES `perfiles` (`documento_pers`) ON DELETE CASCADE;

--
-- Filtros para la tabla `respuesta_foto`
--
ALTER TABLE `respuesta_foto`
  ADD CONSTRAINT `fk_respuesta_foro` FOREIGN KEY (`foro_id`) REFERENCES `foros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_respuesta_foto_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `perfiles` (`documento_pers`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
