-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2024 a las 20:00:10
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
-- Base de datos: `proyectofdg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `precio_oferta` decimal(10,2) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `seccion` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL,
  `fecha` bigint(20) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `titulo`, `precio_oferta`, `precio`, `seccion`, `descripcion`, `ruta_imagen`, `fecha`, `id_user`) VALUES
(2, 'Kayak hinchable Intex Challenger k1 + 1 remo 274x76x33 cm| 1plaza| Kayak mar', 69.95, 120.00, 'hogar', 'El kayak hinchable Intex Challenger K1 está diseñado para uso individual con un límite de 100 kg, y mide 274 cm de largo, 76 cm de ancho y 33 cm de alto. Con un aspecto moderno en verde, negro y azul, este kayak utiliza un vinilo de 0,75 mm y la tecnología I-Beam para mayor estabilidad. Incluye un asiento inflable ajustable, una quilla extraíble, válvulas Boston para inflado rápido y viene con un remo de 218 cm y una bomba manual. Cumple con la Standard ISO 6185-1 para calidad y seguridad.', 'product30_kanoa.avif', 1706551561, 30),
(3, 'Grand Theft Auto V Premium Edition', 8.99, 20.00, 'gaming', 'Grand Theft Auto V: Premium Edition incluye la experiencia completa de la historia de Grand Theft Auto V, acceso gratuito al Grand Theft Auto Online en constante evolución y todas las actualizaciones y contenido de juego existentes, incluyendo The Doomsday Heist, Gunrunning, Smuggler&#039;s Run, Bikers y mucho más.', 'product30_JdvqcPlTYMxXrA1QQJm6TbDX.webp', 1706551561, 30),
(13, 'Lavadora Samsung Wifi 9Kg solo 299€', 299.00, 449.00, 'hogar', 'La lavadora Samsung Wifi 9Kg destaca por su cuidado de la ropa y ahorro de energía. Incorpora SmartThings AI Energy Mode, que reduce el uso energético en un 70%. Es controlable remotamente mediante Wi-Fi y la aplicación SmartThings, ofreciendo asimismo programas como Less Microfiber y Programa de vapor para minimizar el impacto ambiental y eliminar alérgenos. Además, incluye Lavado de tambor+ para limpieza sin químicos y una Cubeta StayClean que evita el desperdicio de detergente.', 'product32_1226640_1.avif', 1706554476, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `contraseña`, `ruta_imagen`) VALUES
(30, 'Angel', 'Porlan', 'angeelporlan4@gmail.com3', '$2y$10$y75eGTdPlrERs8FJVmO7p.CVkiKJLnDnJMxVfAQox5qzxuZmU.MKy', 'img30_eb78e90d-943a-4270-b049-4c9a2a8280f4_16-9-discover-aspect-ratio_default_0.jpg'),
(31, 'Angel', 'f', 'drivefactsmedia@gmail.com', '$2y$10$gCPj9qGZGbrbrN0MwK7S3uWKXd2id3Or2wGR.hzDCblaiVytMz07W', 'default.png'),
(32, 'Carlos', 'Millán', 'angeelporlan4@gmail.com1', '$2y$10$0mRUnQCkj9b70CAfv9cazeW5/LBLpqD.mzChSlUjow.6iB.gkWAoW', 'descarga.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
