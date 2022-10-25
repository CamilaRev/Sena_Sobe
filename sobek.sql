-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2022 a las 01:00:01
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sobek`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `c_id` int(11) NOT NULL,
  `c_idproductofk` int(11) NOT NULL,
  `c_nombre` varchar(500) NOT NULL,
  `c_marca` varchar(500) NOT NULL,
  `c_precio` int(11) NOT NULL,
  `c_cantidad` int(11) NOT NULL,
  `c_total` int(11) NOT NULL,
  `c_idusuariofk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `p_id` int(11) NOT NULL,
  `p_codigo` text NOT NULL,
  `p_nombre` varchar(500) NOT NULL,
  `p_categoria` enum('Maquillaje','Productos faciales','Otro','') NOT NULL,
  `p_marca` enum('Avon','Esika','Yambal','') NOT NULL,
  `p_precio` int(11) NOT NULL,
  `p_stock` int(11) NOT NULL,
  `p_foto` mediumblob NOT NULL,
  `p_fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`p_id`, `p_codigo`, `p_nombre`, `p_categoria`, `p_marca`, `p_precio`, `p_stock`, `p_foto`, `p_fecha_vencimiento`) VALUES
(1, '0987654', 'Crema para peinar', 'Productos faciales', 'Esika', 23400, 29, 0x2f6b6f74696469616e612f70726f647563746f732f50524f3230323231303138434f443233333033322e6a7067, '2022-10-04'),
(2, '476890', 'Delineador', 'Maquillaje', 'Esika', 13457, 63, 0x2f6b6f74696469616e612f70726f647563746f732f50524f3230323231303138434f443233353233332e6a7067, '2022-10-06'),
(3, '7654987', 'Labial', 'Maquillaje', 'Esika', 14500, 59, 0x2f6b6f74696469616e612f70726f647563746f732f50524f3230323231303138434f443233353335322e6a7067, '2022-10-06'),
(4, '54332212', 'Removedor de uñas', 'Maquillaje', 'Avon', 56700, 15, 0x2f6b6f74696469616e612f70726f647563746f732f50524f3230323231303138434f443233353830312e6a7067, '2022-09-28'),
(5, '76543', 'Delineador', 'Maquillaje', 'Yambal', 6474, 67, 0x2f6b6f74696469616e612f70726f647563746f732f50524f3230323231303232434f443137353930322e6a7067, '2022-10-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `u_id` int(11) NOT NULL,
  `u_nombres` varchar(500) NOT NULL,
  `u_apellidos` varchar(500) NOT NULL,
  `u_identificacion` bigint(20) NOT NULL,
  `u_email` varchar(500) NOT NULL,
  `u_ciudad` varchar(200) NOT NULL,
  `u_direccion` text NOT NULL,
  `u_celular` bigint(20) NOT NULL,
  `u_fecha_nacimiento` date NOT NULL,
  `u_tipo` int(11) NOT NULL,
  `u_contrasena` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`u_id`, `u_nombres`, `u_apellidos`, `u_identificacion`, `u_email`, `u_ciudad`, `u_direccion`, `u_celular`, `u_fecha_nacimiento`, `u_tipo`, `u_contrasena`) VALUES
(1, 'MANUE LUIS', 'LOPEZ LOPEZ', 10035656879, 'luis@hotmail.com', 'Bogota', 'Calle Principal', 1003565687, '2022-06-08', 1, '12345'),
(2, 'SANDRA MARIA', 'VARGAS PEREZ', 10034441111, 'sandra@gmail.com', 'Bogota', 'Avenida', 314678888, '2022-06-07', 1, '12345'),
(3, 'FRANCISCO JOSE', 'LOPEZ SOSA', 10035556666, 'francisco@gmail.com', 'Bogota', 'Calle 12', 3245657687, '2022-06-01', 1, '12345'),
(6, 'Diana', 'Mora', 105522, 'dianmor@gmail.com', 'Bogota', 'Cr12#12-07', 3245678876, '2022-09-28', 2, '1234'),
(7, 'Edi', 'Puerto', 10552205, 'edipuert@gmail.com', 'Duitama', 'cll12#17-26', 8957649587, '2022-09-30', 2, '12348'),
(8, 'Luis', 'Pita', 2, 'gjebal@gmail.com', 'Duitama', 'Cr23-#12-04', 56323281, '2021-08-21', 2, '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `v_id` int(11) NOT NULL,
  `v_factura` varchar(500) NOT NULL,
  `v_nombre` varchar(500) NOT NULL,
  `v_marca` varchar(500) NOT NULL,
  `v_precio` int(11) NOT NULL,
  `v_cantidad` int(11) NOT NULL,
  `v_total` int(11) NOT NULL,
  `v_fkidusuario` int(11) NOT NULL,
  `v_identificacion` bigint(20) NOT NULL,
  `v_nombresapellidos` varchar(500) NOT NULL,
  `v_ciudad` varchar(300) NOT NULL,
  `v_direccion` varchar(500) NOT NULL,
  `v_celular` bigint(20) NOT NULL,
  `v_fecha` date NOT NULL,
  `v_hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`v_id`, `v_factura`, `v_nombre`, `v_marca`, `v_precio`, `v_cantidad`, `v_total`, `v_fkidusuario`, `v_identificacion`, `v_nombresapellidos`, `v_ciudad`, `v_direccion`, `v_celular`, `v_fecha`, `v_hora`) VALUES
(1, 'KOT20221019C000853', 'Delineador', 'Esika', 13457, 15, 201855, 6, 105522, 'Diana Mora', 'Bogota', 'Cr12#12-07', 3245678876, '2022-10-19', '00:08:53'),
(2, 'KOT20221019C000853', 'Labial', 'Esika', 14500, 8, 116000, 6, 105522, 'Diana Mora', 'Bogota', 'Cr12#12-07', 3245678876, '2022-10-19', '00:08:53'),
(3, 'KOT20221019C000853', 'Removedor de uñas', 'Avon', 56700, 11, 623700, 6, 105522, 'Diana Mora', 'Bogota', 'Cr12#12-07', 3245678876, '2022-10-19', '00:08:53'),
(4, 'KOT20221019C001123', 'Crema para peinar', 'Esika', 23400, 16, 374400, 7, 10552205, 'Edi Puerto', 'Duitama', 'cll12#17-26', 8957649587, '2022-10-19', '00:11:23'),
(5, 'KOT20221019C001123', 'Labial', 'Esika', 14500, 8, 116000, 7, 10552205, 'Edi Puerto', 'Duitama', 'cll12#17-26', 8957649587, '2022-10-19', '00:11:23'),
(6, 'KOT20221019C001123', 'Removedor de uñas', 'Avon', 56700, 5, 283500, 7, 10552205, 'Edi Puerto', 'Duitama', 'cll12#17-26', 8957649587, '2022-10-19', '00:11:23'),
(7, 'KOT20221021C215821', 'Removedor de uñas', 'Avon', 56700, 6, 340200, 7, 10552205, 'Edi Puerto', 'Duitama', 'cll12#17-26', 8957649587, '2022-10-21', '21:58:21'),
(8, 'KOT20221021C215821', 'Labial', 'Esika', 14500, 4, 58000, 7, 10552205, 'Edi Puerto', 'Duitama', 'cll12#17-26', 8957649587, '2022-10-21', '21:58:21'),
(9, 'KOT20221021C215821', 'Removedor de uñas', 'Avon', 56700, 2, 113400, 7, 10552205, 'Edi Puerto', 'Duitama', 'cll12#17-26', 8957649587, '2022-10-21', '21:58:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `idproductofk` (`c_idproductofk`),
  ADD KEY `idusuariofk` (`c_idusuariofk`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`p_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`u_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `fkidusuario` (`v_fkidusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `idproductofk` FOREIGN KEY (`c_idproductofk`) REFERENCES `producto` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idusuariofk` FOREIGN KEY (`c_idusuariofk`) REFERENCES `usuario` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
