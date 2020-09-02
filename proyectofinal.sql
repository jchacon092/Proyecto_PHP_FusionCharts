-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2018 a las 20:51:05
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_producto`
--

CREATE TABLE `lote_producto` (
  `Id_lote` int(11) NOT NULL,
  `Fecha_ingreso` date NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Id_produccion` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lote_producto`
--

INSERT INTO `lote_producto` (`Id_lote`, `Fecha_ingreso`, `Id_producto`, `Id_produccion`, `cantidad`) VALUES
(1, '2016-11-23', 1, 1, 400),
(2, '2016-11-01', 2, 2, 500),
(3, '2018-06-18', 1, 2, 40),
(4, '2018-04-18', 1, 1, 25),
(5, '2018-05-18', 2, 1, 88),
(6, '2018-06-18', 2, 2, 50),
(7, '2018-05-18', 2, 1, 88),
(8, '2018-06-18', 2, 2, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_prima`
--

CREATE TABLE `materia_prima` (
  `Id_materiaprima` int(11) NOT NULL,
  `Nombre_materiaprima` varchar(50) NOT NULL,
  `Cantidad_existente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia_prima`
--

INSERT INTO `materia_prima` (`Id_materiaprima`, `Nombre_materiaprima`, `Cantidad_existente`) VALUES
(1, 'PET', 200),
(2, 'PVC', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Id_usuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Id_usuario`, `Nombre`, `pass`) VALUES
(1, 'Joaquin', '12345'),
(2, 'Edgar', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `Id_produccion` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Cantidad_producida` int(11) NOT NULL,
  `Cantidad_usada` int(11) NOT NULL,
  `Id_materiaprima` int(11) NOT NULL,
  `Estado_produccion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produccion`
--

INSERT INTO `produccion` (`Id_produccion`, `Id_producto`, `Cantidad_producida`, `Cantidad_usada`, `Id_materiaprima`, `Estado_produccion`) VALUES
(1, 1, 500, 50, 1, 'Echo'),
(2, 2, 200, 70, 2, 'Echo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id_producto` int(11) NOT NULL,
  `Nombre_producto` varchar(50) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Id_tipoproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id_producto`, `Nombre_producto`, `Existencias`, `Id_tipoproducto`) VALUES
(1, 'Botella Coca cola', 1000, 5),
(2, 'Botella Pepsi', 900, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `Id_tipopago` int(11) NOT NULL,
  `Descripcion_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`Id_tipopago`, `Descripcion_tipo`) VALUES
(1, 'Efectivo'),
(2, 'Targeta de credito'),
(3, 'Targeta de debito'),
(4, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `Id_tipoproducto` int(11) NOT NULL,
  `Descripcion_tipoproducto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`Id_tipoproducto`, `Descripcion_tipoproducto`) VALUES
(5, 'Botella Litro'),
(6, 'Botella 500ml');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `Id_venta` int(11) NOT NULL,
  `Descripcion_venta` varchar(50) NOT NULL,
  `Cantidad_venta` int(11) NOT NULL,
  `Id_tipopago` int(11) NOT NULL,
  `Id_lote` int(11) NOT NULL,
  `Id_usuario` int(11) NOT NULL,
  `fecha_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`Id_venta`, `Descripcion_venta`, `Cantidad_venta`, `Id_tipopago`, `Id_lote`, `Id_usuario`, `fecha_venta`) VALUES
(1, 'Venta de botellas de Pepsi', 200, 1, 1, 1, '2016-11-01'),
(2, 'Botellas de coca cola', 50, 3, 2, 2, '2016-11-11'),
(3, 'Botellas de pepsi', 400, 2, 1, 2, '2016-10-20'),
(4, 'Botellas de coca cola', 47, 4, 1, 1, '2016-11-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lote_producto`
--
ALTER TABLE `lote_producto`
  ADD PRIMARY KEY (`Id_lote`),
  ADD KEY `Id_produccion` (`Id_produccion`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`Id_materiaprima`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Id_usuario`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`Id_produccion`),
  ADD KEY `Id_materiaprima` (`Id_materiaprima`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id_producto`),
  ADD KEY `Id_tipoproducto` (`Id_tipoproducto`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`Id_tipopago`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`Id_tipoproducto`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`Id_venta`),
  ADD KEY `Id_tipopago` (`Id_tipopago`),
  ADD KEY `Id_lote` (`Id_lote`),
  ADD KEY `Id_usuario` (`Id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lote_producto`
--
ALTER TABLE `lote_producto`
  MODIFY `Id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `Id_materiaprima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `Id_produccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `Id_tipopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `Id_tipoproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `Id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lote_producto`
--
ALTER TABLE `lote_producto`
  ADD CONSTRAINT `lote_producto_ibfk_1` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_producto_ibfk_2` FOREIGN KEY (`Id_produccion`) REFERENCES `produccion` (`Id_produccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`Id_materiaprima`) REFERENCES `materia_prima` (`Id_materiaprima`) ON UPDATE CASCADE,
  ADD CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`Id_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`Id_tipoproducto`) REFERENCES `tipo_producto` (`Id_tipoproducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`Id_usuario`) REFERENCES `persona` (`Id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`Id_lote`) REFERENCES `lote_producto` (`Id_lote`) ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`Id_tipopago`) REFERENCES `tipo_pago` (`Id_tipopago`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
