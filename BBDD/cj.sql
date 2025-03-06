-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-05-2023 a las 22:19:56
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cj`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adultos`
--

CREATE TABLE `adultos` (
  `DNI_adulto` varchar(9) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cons_cj` tinyint(1) NOT NULL,
  `trat_img` tinyint(1) NOT NULL,
  `seguro` varchar(60) NOT NULL,
  `hijos` tinyint(1) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `seccion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adultos`
--

INSERT INTO `adultos` (`DNI_adulto`, `nombre`, `apellidos`, `fecha_nac`, `telefono`, `email`, `cons_cj`, `trat_img`, `seguro`, `hijos`, `usuario`, `seccion`) VALUES
('51495937H', 'Marco', 'Batista Calado', '2003-02-04', '646722873', 'marco@gmail.com', 1, 1, 'privado', 2, 'batiiis.12', 'padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `cod_form` varchar(10) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `plazas` int(11) NOT NULL,
  `plazas_ocupadas` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `coste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`cod_form`, `nombre`, `plazas`, `plazas_ocupadas`, `fecha_hora`, `coste`) VALUES
('ADRADA_23', 'Campamento La Adrada 2023', 110, 0, '2023-07-01 08:00:00', 300),
('C_CONF_23', 'Cena de Confirmaciones 2023', 150, 0, '2023-05-10 20:42:51', 20),
('MUS_1', 'Musical', 500, 0, '2023-05-06 19:30:00', 1),
('MUS_2', 'Musical', 500, 0, '2023-05-07 18:00:00', 1),
('MUS_3', 'Musical', 500, 0, '2023-05-12 19:30:00', 1),
('MUS_4', 'Musical', 500, 0, '2023-05-13 19:30:00', 1),
('MUS_5', 'Musical', 500, 0, '2023-05-14 18:00:00', 1),
('PAR_23', 'Campamento Parzán 2023', 200, 0, '2023-07-15 08:00:00', 275);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menores`
--

CREATE TABLE `menores` (
  `DNI_menor` varchar(9) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telef_menor` varchar(9) NOT NULL,
  `email` varchar(60) NOT NULL,
  `seguro` varchar(60) NOT NULL,
  `colegio` varchar(60) NOT NULL,
  `adulto` varchar(9) NOT NULL,
  `seccion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menores`
--

INSERT INTO `menores` (`DNI_menor`, `nombre`, `apellidos`, `fecha_nac`, `telef_menor`, `email`, `seguro`, `colegio`, `adulto`, `seccion`) VALUES
('51470807G', 'Jacinto', 'Calado', '2009-02-04', '667396687', 'jacinto@gmail.com', 'privado', 'Salesianos Estrecho', '51495937H', 'Chiquicentro'),
('51511759Q', 'Ruben', 'Agyakwa', '2009-02-04', '667396687', 'ruben@gmail.com', 'privado', 'Salesianos Estrecho', '51495937H', 'Jovenes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `numero` int(11) NOT NULL,
  `cod_form` varchar(10) NOT NULL,
  `DNI_adulto` varchar(9) NOT NULL,
  `DNI_menor` varchar(9) DEFAULT NULL,
  `pagado` tinyint(1) NOT NULL,
  `observaciones` varchar(60) NOT NULL,
  `t_imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `password`, `tipo`) VALUES
('batiiis.12', '$2y$10$BfuNveaByjOPko.l78LP9OJiqFK4yLhCsWV3choLthynEnOhkK/Su', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adultos`
--
ALTER TABLE `adultos`
  ADD PRIMARY KEY (`DNI_adulto`),
  ADD KEY `Usuario` (`usuario`),
  ADD KEY `usuario_2` (`usuario`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`cod_form`);

--
-- Indices de la tabla `menores`
--
ALTER TABLE `menores`
  ADD PRIMARY KEY (`DNI_menor`),
  ADD KEY `Adulto` (`adulto`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `cod_form` (`cod_form`),
  ADD KEY `DNI_adulto` (`DNI_adulto`),
  ADD KEY `DNI_menor` (`DNI_menor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adultos`
--
ALTER TABLE `adultos`
  ADD CONSTRAINT `Foreing_key` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);

--
-- Filtros para la tabla `menores`
--
ALTER TABLE `menores`
  ADD CONSTRAINT `menores_ibfk_1` FOREIGN KEY (`adulto`) REFERENCES `adultos` (`DNI_adulto`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cod_form`) REFERENCES `formularios` (`cod_form`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`DNI_adulto`) REFERENCES `adultos` (`DNI_adulto`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`DNI_menor`) REFERENCES `menores` (`DNI_menor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
