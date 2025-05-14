-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2025 a las 02:36:30
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
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(3, 'Musica'),
(4, 'Deportiva'),
(5, 'Jornadas comunitarias'),
(7, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `categoria_id` int(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `usuario_id`, `categoria_id`, `titulo`, `descripcion`, `fecha`) VALUES
(1, 1, 3, 'yawar cru', 'Gente hermosa de Bogota este 4 de Mayo estaremos visitando sus hermosa tierras, llevamos nuestro show de la gira #Elemental \r\nAllá los vemos a todos (entrada libre)\r\n\r\n\r\n', '2025-04-23'),
(2, 1, 4, 'Torneo Relámpago (micro)', 'Picadito Fútbol 5 Domingos 2-2025  Patrocinado por ANDINA\r\n\r\nConvoca a tu combo para jugarte un Picadito de Fútbol 5 los domingos, con tremenda premiación…  de 8’000.000 en efectivo!\r\n\r\nPa’que tengan en cuenta:\r\n\r\nArrancarías: Domingo 27 de Abril 2025.\r\n\r\nNivel: aficionado\r\nMín 5 y Máx 15 jugadores\r\n8 partidos en fase de grupos\r\nCanchas sintéticas\r\nHidratación (Agua)\r\n\r\nActividades y premios del patrocinador (Andina) durante el torneo\r\n\r\nNo incluye camisetas.\r\n\r\nHorarios: Domingos de 9am a 4pm\r\n\r\n(1 partido por semana)\r\n\r\nSede:\r\nAméricas: 5site Américas\r\nBogotá', '2025-04-23'),
(4, 1, 3, 'MamboRap', '????INVITADO INTERNACIONAL:\r\n\r\n⚡️Mamborap\r\n\r\n????INVITADOS NACIONALES:\r\n\r\n⚡El Red Code\r\n⚡Yawar Cruw\r\n⚡Free Stayla\r\n\r\n????SPECIAL GUEST:\r\n\r\n⚡The Catedral Rec\r\n⚡Wnd blanco\r\n\r\n????SHOW CASE\r\n\r\n⚡️A.K.A Huellas\r\n⚡Marvin up\r\n\r\n????BOGOTÁ:\r\nBORO ROOM\r\nCalle 55 # 13 -51 / CHAPINERO\r\n\r\n', '2025-04-23'),
(5, 1, 5, 'Vacunacion contra la rabia', '¡Ponte al día con las vacunas????y protégete contra diferentes enfermedades!  \r\n\r\nAquí los puntos habilitados en #BogotáMiCiudadMiCasa este 26 de abril????️. \r\n¡Te esperamos! ????????http://bit.ly/4aPMlDk ', '2025-04-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `fecha`) VALUES
(1, 'javier', 'ramirez', 'pepe@gmail.com', '$2y$04$Ob1svnD/U.lCNdBh.r./v.Khi5An33SnIB51y4u0n9xzTYOJ/nHz.', '2025-04-23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entradas_usuario` (`usuario_id`),
  ADD KEY `fk_entradas_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_entradas_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `fk_entradas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
