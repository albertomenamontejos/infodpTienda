-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2018 a las 11:48:34
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_infodp_tienda`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `_user` VARCHAR(50), IN `_pass` VARCHAR(60))  select * from usuarios where user = _user and pass = _pass$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nomyape` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `condTributaria` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nomyape`, `direccion`, `telefono`, `email`, `cuit`, `condTributaria`) VALUES
(1, 'Cliente NN', 'S/D', 'S/N', 'clientenn@gmail.com', '1', 'CF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id` int(11) NOT NULL,
  `idRubro` int(11) NOT NULL,
  `idGenero` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `nroCompra` int(11) NOT NULL,
  `idComprobante` int(11) NOT NULL,
  `nroComprobante` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descGlobal` decimal(10,2) NOT NULL,
  `nom_imp` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `porc_imp` decimal(6,2) NOT NULL,
  `totalImpuesto` decimal(10,2) NOT NULL,
  `subTotalNeto` decimal(10,2) NOT NULL,
  `totalCompra` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobantes`
--

CREATE TABLE `comprobantes` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comprobantes`
--

INSERT INTO `comprobantes` (`id`, `descripcion`) VALUES
(1, 'FACTURA'),
(5, 'NOTA DE CRÉDITO'),
(2, 'RECIBO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompras`
--

CREATE TABLE `detallecompras` (
  `idCompra` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `codProd` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomProd` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `talle` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioCompra` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalledevoluciones`
--

CREATE TABLE `detalledevoluciones` (
  `idDevolucion` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `codProd` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nomProd` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `talle` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precioUnitVenta` decimal(10,2) NOT NULL,
  `cantVendida` int(11) NOT NULL,
  `cantDevuelta` int(11) NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleimpositivoventas`
--

CREATE TABLE `detalleimpositivoventas` (
  `idVenta` int(11) NOT NULL,
  `pais` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `moneda` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `idenTributaria` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nom_imp` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `porc_imp` decimal(6,2) NOT NULL,
  `condicionIVA` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `puntoVenta` int(11) NOT NULL,
  `emisor_receptor` varchar(6) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepagoscompras`
--

CREATE TABLE `detallepagoscompras` (
  `idCompra` int(11) NOT NULL,
  `idFormaPago` int(11) NOT NULL,
  `cuotas` int(11) NOT NULL,
  `pagoEfectivo` decimal(10,2) NOT NULL,
  `pagoDebito` decimal(10,2) NOT NULL,
  `pagoCredito` decimal(10,2) NOT NULL,
  `totalCompra` decimal(10,2) NOT NULL,
  `tarjDebito` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tarjCredito` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaCompra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepagosventas`
--

CREATE TABLE `detallepagosventas` (
  `idVenta` int(11) NOT NULL,
  `idFormaPago` int(11) NOT NULL,
  `cuotas` int(11) NOT NULL,
  `pagoEfectivo` decimal(10,2) NOT NULL,
  `pagoDebito` decimal(10,2) NOT NULL,
  `pagoCredito` decimal(10,2) NOT NULL,
  `nombreOFP` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pagoOFP` decimal(10,2) NOT NULL,
  `totalVenta` decimal(10,2) NOT NULL,
  `tarjDebito` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tarjCredito` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaVenta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `idVenta` int(11) DEFAULT NULL,
  `idExistencia` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `codProd` varchar(50) NOT NULL,
  `nomProd` varchar(100) NOT NULL,
  `talle` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioVentaNeto` decimal(10,2) NOT NULL,
  `precioVenta` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `nroNotaCredito` int(11) NOT NULL,
  `nroVenta` int(11) NOT NULL,
  `idComprobante` int(11) NOT NULL,
  `totalImpuesto` decimal(10,2) NOT NULL,
  `subTotalNeto` decimal(10,2) NOT NULL,
  `totalDevolucion` decimal(10,2) NOT NULL,
  `fechaDevolucion` date NOT NULL,
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencias`
--

CREATE TABLE `existencias` (
  `id` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `codProducto` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `talle` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujodecajas`
--

CREATE TABLE `flujodecajas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `entrada` decimal(10,2) NOT NULL,
  `salida` decimal(10,2) NOT NULL,
  `saldoActual` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formaspagos`
--

CREATE TABLE `formaspagos` (
  `id` int(11) NOT NULL,
  `formaPago` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formaspagos`
--

INSERT INTO `formaspagos` (`id`, `formaPago`) VALUES
(1, 'Efectivo'),
(2, 'Debito'),
(3, 'Credito'),
(4, 'Efectivo-Debito'),
(5, 'Efectivo-Credito'),
(6, 'Debito-Credito'),
(7, 'Efectivo-Debito-Credito'),
(8, 'Nota de Crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rubro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  `modo_impresion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio_comercial` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_impuesto` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `porcentaje_impuesto` decimal(6,2) NOT NULL,
  `idenTributaria` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `moneda` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `puntoVenta` int(11) NOT NULL,
  `ingresos_brutos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecIniAct` date NOT NULL,
  `condicionIVA` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `logo_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `logo_ruta` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `nombre_empresa`, `rubro`, `cuit`, `pais`, `modo_impresion`, `domicilio_comercial`, `telefono`, `email`, `nombre_impuesto`, `porcentaje_impuesto`, `idenTributaria`, `moneda`, `puntoVenta`, `ingresos_brutos`, `fecIniAct`, `condicionIVA`, `logo_nombre`, `logo_ruta`) VALUES
(1, 'InfoDP', 'Venta de Indumentaria', '10101010', 'AR', 'F', 'Salta Capital - Rivadavia 1010', '12121212', 'info@informaticadp.com.ar', 'IVA', '21.00', 'CUIT', '$', 1, 'NO', '2012-09-17', 'RI', 'Logo-impresion.png', 'assets/img/Logo-impresion.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precioCompra` decimal(8,2) NOT NULL,
  `precioVenta` decimal(8,2) NOT NULL,
  `idGenero` int(11) NOT NULL,
  `idRubro` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idEstilo` int(11) NOT NULL,
  `idMarca` int(11) NOT NULL,
  `controlTalles` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `controlColores` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `formato_codigo` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cuit` varchar(50) NOT NULL,
  `condTributaria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `direccion`, `telefono`, `email`, `cuit`, `condTributaria`) VALUES
(1, 'Proveedor NN', 'NN', '13156', 'nn@gmail.com', '1', 'CF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `descripcion`) VALUES
(3, 'ACCESORIOS'),
(2, 'CALZADOS'),
(1, 'INDUMENTARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `id` int(11) NOT NULL,
  `idRubro` int(11) NOT NULL,
  `idGenero` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`id`, `descripcion`) VALUES
(2, 'VISA CREDITO'),
(1, 'VISA DEBITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nomyape` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) DEFAULT '0',
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `privilegio` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `nomyape`, `pass`, `estado`, `direccion`, `telefono`, `email`, `privilegio`) VALUES
(1, 'admin', 'Usuario Administrador', '$1$CO4.ju/.$566BAh.JTz8ghvOB2xjnY.', 0, 'Argentina', '100200300', 'admin@admin.com', 'admin'),
(2, 'vendedor', 'Usuario Vendedor', '$1$CO4.ju/.$566BAh.JTz8ghvOB2xjnY.', 0, 'Argentina', '10101010', 'vendedor@mail.com', 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `nroVenta` int(11) NOT NULL,
  `idComprobante` int(11) NOT NULL,
  `descGlobal` decimal(10,2) NOT NULL,
  `totalImpuesto` decimal(10,2) NOT NULL,
  `subTotalNeto` decimal(10,2) NOT NULL,
  `totalVenta` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_colores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_colores` (
`id` int(11)
,`rubro` varchar(100)
,`genero` varchar(30)
,`categoria` varchar(100)
,`descripcion` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_compras` (
`id` int(11)
,`nroDeCompra` varchar(6)
,`fechaCompra` varchar(10)
,`proveedor` varchar(50)
,`totalCompra` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_controlstock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_controlstock` (
`id` int(11)
,`codigo` varchar(15)
,`nombre` varchar(100)
,`precioCompra` decimal(8,2)
,`precioVenta` decimal(8,2)
,`stock` decimal(32,0)
,`mar` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_existencias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_existencias` (
`id` int(11)
,`codigo` varchar(15)
,`nombre` varchar(100)
,`talle` varchar(50)
,`color` varchar(50)
,`stock` int(8)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_talles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_talles` (
`id` int(11)
,`rubro` varchar(100)
,`genero` varchar(30)
,`categoria` varchar(100)
,`descripcion` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_ventas` (
`id` int(11)
,`nroDeVenta` varchar(6)
,`fechaVenta` varchar(10)
,`cliente` varchar(50)
,`formaPago` varchar(50)
,`totalVenta` decimal(10,2)
,`estado` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_colores`
--
DROP TABLE IF EXISTS `vista_colores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_colores`  AS  select `colores`.`id` AS `id`,`rubros`.`descripcion` AS `rubro`,`generos`.`descripcion` AS `genero`,`categorias`.`descripcion` AS `categoria`,`colores`.`descripcion` AS `descripcion` from (((`colores` join `rubros` on((`colores`.`idRubro` = `rubros`.`id`))) join `generos` on((`colores`.`idGenero` = `generos`.`id`))) join `categorias` on((`colores`.`idCategoria` = `categorias`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_compras`
--
DROP TABLE IF EXISTS `vista_compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_compras`  AS  select `compras`.`id` AS `id`,lpad(`compras`.`nroCompra`,6,'0') AS `nroDeCompra`,date_format(`compras`.`fecha`,'%d/%m/%Y') AS `fechaCompra`,`proveedores`.`razon_social` AS `proveedor`,`compras`.`totalCompra` AS `totalCompra` from (`compras` join `proveedores` on((`compras`.`idProveedor` = `proveedores`.`id`))) order by `compras`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_controlstock`
--
DROP TABLE IF EXISTS `vista_controlstock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_controlstock`  AS  select `productos`.`id` AS `id`,`productos`.`codigo` AS `codigo`,`productos`.`nombre` AS `nombre`,`productos`.`precioCompra` AS `precioCompra`,`productos`.`precioVenta` AS `precioVenta`,sum(`existencias`.`stock`) AS `stock`,`marcas`.`descripcion` AS `mar` from ((`productos` join `existencias` on((`productos`.`id` = `existencias`.`idProducto`))) join `marcas` on((`productos`.`idMarca` = `marcas`.`id`))) group by `productos`.`id` order by `productos`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_existencias`
--
DROP TABLE IF EXISTS `vista_existencias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_existencias`  AS  select `existencias`.`id` AS `id`,`existencias`.`codProducto` AS `codigo`,`productos`.`nombre` AS `nombre`,`existencias`.`talle` AS `talle`,`existencias`.`color` AS `color`,`existencias`.`stock` AS `stock` from (`existencias` join `productos` on((`existencias`.`idProducto` = `productos`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_talles`
--
DROP TABLE IF EXISTS `vista_talles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_talles`  AS  select `talles`.`id` AS `id`,`rubros`.`descripcion` AS `rubro`,`generos`.`descripcion` AS `genero`,`categorias`.`descripcion` AS `categoria`,`talles`.`descripcion` AS `descripcion` from (((`talles` join `rubros` on((`talles`.`idRubro` = `rubros`.`id`))) join `generos` on((`talles`.`idGenero` = `generos`.`id`))) join `categorias` on((`talles`.`idCategoria` = `categorias`.`id`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_ventas`
--
DROP TABLE IF EXISTS `vista_ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_ventas`  AS  select `ventas`.`id` AS `id`,lpad(`ventas`.`nroVenta`,6,'0') AS `nroDeVenta`,date_format(`ventas`.`fecha`,'%d/%m/%Y') AS `fechaVenta`,`clientes`.`nomyape` AS `cliente`,`formaspagos`.`formaPago` AS `formaPago`,`ventas`.`totalVenta` AS `totalVenta`,`ventas`.`estado` AS `estado` from (((`ventas` join `detallepagosventas` on((`ventas`.`id` = `detallepagosventas`.`idVenta`))) join `formaspagos` on((`detallepagosventas`.`idFormaPago` = `formaspagos`.`id`))) join `clientes` on((`ventas`.`idCliente` = `clientes`.`id`))) order by `ventas`.`id` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idRubro` (`idRubro`,`idGenero`,`idCategoria`,`descripcion`),
  ADD KEY `descripcion` (`descripcion`) USING BTREE,
  ADD KEY `colores_ibfk_2` (`idGenero`),
  ADD KEY `colores_ibfk_3` (`idCategoria`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nroCompra` (`nroCompra`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idComprobante` (`idComprobante`);

--
-- Indices de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD KEY `idCompra` (`idCompra`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `detalledevoluciones`
--
ALTER TABLE `detalledevoluciones`
  ADD KEY `idDevolucion` (`idDevolucion`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `detalleimpositivoventas`
--
ALTER TABLE `detalleimpositivoventas`
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `detallepagoscompras`
--
ALTER TABLE `detallepagoscompras`
  ADD KEY `idVenta` (`idCompra`),
  ADD KEY `idFormasPagos` (`idFormaPago`),
  ADD KEY `idVenta_2` (`idCompra`),
  ADD KEY `idVenta_3` (`idCompra`),
  ADD KEY `idVenta_4` (`idCompra`),
  ADD KEY `idFormaPago` (`idFormaPago`);

--
-- Indices de la tabla `detallepagosventas`
--
ALTER TABLE `detallepagosventas`
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idFormaPago` (`idFormaPago`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idComprobante` (`idComprobante`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `existencias_ibfk_2` (`color`),
  ADD KEY `existencias_ibfk_3` (`talle`);

--
-- Indices de la tabla `flujodecajas`
--
ALTER TABLE `flujodecajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formaspagos`
--
ALTER TABLE `formaspagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD UNIQUE KEY `descripcion_2` (`descripcion`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD UNIQUE KEY `descripcion_2` (`descripcion`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `codigo_2` (`codigo`),
  ADD KEY `productos_ibfk_1` (`idCategoria`),
  ADD KEY `productos_ibfk_2` (`idEstilo`),
  ADD KEY `productos_ibfk_3` (`idGenero`),
  ADD KEY `productos_ibfk_4` (`idMarca`),
  ADD KEY `productos_ibfk_5` (`idRubro`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idRubro` (`idRubro`,`idGenero`,`idCategoria`,`descripcion`),
  ADD KEY `idGenero` (`idGenero`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `descripcion` (`descripcion`) USING BTREE;

--
-- Indices de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`user`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nroVenta` (`nroVenta`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idComprobante` (`idComprobante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comprobantes`
--
ALTER TABLE `comprobantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `flujodecajas`
--
ALTER TABLE `flujodecajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tarjetas`
--
ALTER TABLE `tarjetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colores`
--
ALTER TABLE `colores`
  ADD CONSTRAINT `colores_ibfk_1` FOREIGN KEY (`idRubro`) REFERENCES `rubros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `colores_ibfk_2` FOREIGN KEY (`idGenero`) REFERENCES `generos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `colores_ibfk_3` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`),
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`idComprobante`) REFERENCES `comprobantes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallecompras`
--
ALTER TABLE `detallecompras`
  ADD CONSTRAINT `detallecompras_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detallecompras_ibfk_3` FOREIGN KEY (`idCompra`) REFERENCES `compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalledevoluciones`
--
ALTER TABLE `detalledevoluciones`
  ADD CONSTRAINT `detalledevoluciones_ibfk_1` FOREIGN KEY (`idDevolucion`) REFERENCES `devoluciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalledevoluciones_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `existencias` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `detalleimpositivoventas`
--
ALTER TABLE `detalleimpositivoventas`
  ADD CONSTRAINT `detalleimpositivoventas_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallepagoscompras`
--
ALTER TABLE `detallepagoscompras`
  ADD CONSTRAINT `detallepagoscompras_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallepagoscompras_ibfk_2` FOREIGN KEY (`idFormaPago`) REFERENCES `formaspagos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallepagosventas`
--
ALTER TABLE `detallepagosventas`
  ADD CONSTRAINT `detallepagosventas_ibfk_6` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallepagosventas_ibfk_7` FOREIGN KEY (`idFormaPago`) REFERENCES `formaspagos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `detalleventas_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleventas_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `existencias_ibfk_2` FOREIGN KEY (`color`) REFERENCES `colores` (`descripcion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `existencias_ibfk_3` FOREIGN KEY (`talle`) REFERENCES `talles` (`descripcion`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idEstilo`) REFERENCES `estilos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`idGenero`) REFERENCES `generos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_5` FOREIGN KEY (`idRubro`) REFERENCES `rubros` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `talles`
--
ALTER TABLE `talles`
  ADD CONSTRAINT `talles_ibfk_1` FOREIGN KEY (`idRubro`) REFERENCES `rubros` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `talles_ibfk_2` FOREIGN KEY (`idGenero`) REFERENCES `generos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `talles_ibfk_3` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`idComprobante`) REFERENCES `comprobantes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
