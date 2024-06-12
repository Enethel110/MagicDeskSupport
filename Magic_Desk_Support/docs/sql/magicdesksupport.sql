-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2024 a las 03:41:13
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
-- Base de datos: `magicdesksupport`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BackupSP` ()   BEGIN

    SET @dump_command = CONCAT('mysqldump -u root ticket > C:\\C9\\ticket.sql');

    CALL sys_exec(@dump_command);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filtrar_ticket` (IN `tick_titulo` VARCHAR(50), IN `cat_id` INT, IN `prio_id` INT)   BEGIN

 IF tick_titulo = '' THEN            

 SET tick_titulo = NULL;

 END IF; 

 

  IF cat_id = '' THEN            

 SET cat_id = NULL;

 END IF; 

 

  IF prio_id = '' THEN  

 SET prio_id = NULL;

 END IF; 

 

SELECT

tm_ticket.tick_id,

tm_ticket.usu_id,

tm_ticket.cat_id,

tm_ticket.tick_titulo,

tm_ticket.tick_descrip,

tm_ticket.tick_estado,

tm_ticket.fech_crea,

tm_ticket.fech_cierre,

tm_ticket.usu_asig,

tm_ticket.fech_asig,

tm_usuario.usu_nom,

tm_usuario.usu_ape,

tm_categoria.cat_nom,

tm_ticket.prio_id,

tm_prioridad.prio_nom

FROM 

tm_ticket

INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id

INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id

INNER join tm_prioridad on tm_ticket.prio_id = tm_prioridad.prio_id

WHERE

tm_ticket.est = 1

AND tm_ticket.tick_titulo like IFNULL(tick_titulo,tm_ticket.tick_titulo)

AND tm_ticket.cat_id =  IFNULL(cat_id,tm_ticket.cat_id)

AND tm_ticket.prio_id = IFNULL(prio_id,tm_ticket.prio_id)

ORDER BY tm_ticket.tick_id DESC;



END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filtrar_ticket2` (IN `tick_titulo` VARCHAR(50), IN `cat_id` INT, IN `prio_id` INT)   SELECT 


            tm_ticket.tick_id, 


            tm_ticket.usu_id,


            tm_ticket.cat_id,


            tm_ticket.tick_titulo, 


            tm_ticket.tick_descrip,


            tm_ticket.tick_estado, 


            tm_ticket.fech_crea, 


            tm_ticket.fech_cierre, 


            tm_ticket.usu_asig, 


            tm_ticket.fech_asig, 


            tm_usuario.usu_nom, 


            tm_usuario.usu_ape, 


            tm_categoria.cat_nom, 


            tm_ticket.prio_id, 


            tm_prioridad.prio_nom 


            FROM 


            tm_ticket 


            INNER join tm_categoria on tm_ticket.cat_id=tm_categoria.cat_id 


            INNER join tm_usuario on tm_ticket.usu_id=tm_usuario.usu_id 


            INNER join tm_prioridad on tm_ticket.prio_id=tm_prioridad.prio_id 


            WHERE 


            tm_ticket.est = 1 


            AND tm_ticket.tick_titulo like IFNULL(tick_titulo, tm_ticket.tick_titulo) 


            AND tm_ticket.cat_id like IFNULL(cat_id, tm_ticket.cat_id) 


            AND tm_ticket.prio_id like IFNULL(prio_id, tm_ticket.prio_id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_d_usuario_01` (IN `xusu_id` INT)   BEGIN


	UPDATE tm_usuario 


	SET 


		est='0',


		fech_elim = now() 


	where usu_id=xusu_id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_i_ticketdetalle_01` (IN `xtick_id` INT, IN `xusu_id` INT)   BEGIN

	INSERT INTO td_ticketdetalle 

    (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) 

    VALUES 

    (NULL,xtick_id,xusu_id,'Ticket Cerrado...',now(),'1');

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_l_reporte_01` ()   BEGIN

SELECT

	tick.tick_id as id,

	tick.tick_titulo as titulo,

	tick.tick_descrip as descripcion,

	tick.tick_estado as estado,

	tick.fech_crea as FechaCreacion,

	tick.fech_cierre as FechaCierre,

	tick.fech_asig as FechaAsignacion,

	CONCAT(usucrea.usu_nom,' ',usucrea.usu_ape) as NombreUsuario,

	IFNULL(CONCAT(usuasig.usu_nom,' ',usuasig.usu_ape),'SinAsignar') as NombreSoporte,

	cat.cat_nom as Categoria,

	prio.prio_nom as Prioridad,

	sub.cats_nom as SubCategoria

	FROM 

	tm_ticket tick

	INNER join tm_categoria cat on tick.cat_id = cat.cat_id

	INNER JOIN tm_subcategoria sub on tick.cats_id = sub.cats_id

	INNER join tm_usuario usucrea on tick.usu_id = usucrea.usu_id

	LEFT JOIN tm_usuario usuasig on tick.usu_asig = usuasig.usu_id

	INNER join tm_prioridad prio on tick.prio_id = prio.prio_id

	WHERE

	tick.est = 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_l_usuario_01` ()   BEGIN

	SELECT * FROM tm_usuario where est='1';

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_l_usuario_02` (IN `xusu_id` INT)   BEGIN

	SELECT * FROM tm_usuario where usu_id=xusu_id;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rtickets`
--

CREATE TABLE `rtickets` (
  `id_rank` int(11) NOT NULL,
  `tick_id` int(11) NOT NULL,
  `rankT` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_documento_detalle`
--

CREATE TABLE `td_documento_detalle` (
  `det_id` int(11) NOT NULL,
  `tickd_id` int(11) NOT NULL,
  `det_nom` varchar(200) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_ticketdetalle`
--

CREATE TABLE `td_ticketdetalle` (
  `tickd_id` int(11) NOT NULL,
  `tick_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `tickd_descrip` mediumtext NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int(11) NOT NULL,
  `rankT` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `td_ticketdetalle`
--

INSERT INTO `td_ticketdetalle` (`tickd_id`, `tick_id`, `usu_id`, `tickd_descrip`, `fech_crea`, `est`, `rankT`) VALUES
(196, 372, 3, 'Ticket Cerrado', '2024-01-17 14:39:15', 1, 1),
(197, 569, 18, 'Ticket Cerrado', '2024-02-07 10:37:24', 1, 1),
(198, 558, 18, 'Ticket Cerrado', '2024-02-07 10:38:54', 1, 1),
(199, 568, 18, 'Ticket Cerrado', '2024-02-07 10:51:09', 1, 1),
(200, 567, 18, 'Se ajusta la resolución de la pantalla adicionalmente se realiza mantenimiento preventivo al monitor', '2024-02-07 10:54:58', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nom` varchar(150) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `est`) VALUES
(1, 'Aloha', 1),
(2, 'Asignación', 1),
(3, 'BI', 1),
(4, 'Cambio', 1),
(5, 'CAPP', 1),
(6, 'Carpetas en red', 1),
(7, 'Contpaq', 1),
(8, 'Delitech', 1),
(9, 'DVR', 1),
(10, 'Facturacion', 1),
(11, 'Facturas', 1),
(12, 'GMAIL', 1),
(13, 'Infraestructura', 1),
(14, 'Instalación', 1),
(15, 'Mantenimiento', 1),
(16, 'MBP', 1),
(17, 'Plataformas', 1),
(18, 'Programas Otros', 1),
(19, 'Protheus', 1),
(20, 'Respaldo', 1),
(21, 'Revision', 1),
(22, 'Servidor GIRO', 1),
(23, 'Solicitud de equipo', 1),
(24, 'Soporte', 1),
(25, 'Spoonity', 1),
(26, 'WEB', 1),
(27, 'WEB Server', 1),
(28, 'Windows', 1),
(29, 'Zetus', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_notificacion`
--

CREATE TABLE `tm_notificacion` (
  `not_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `not_mensaje` varchar(400) NOT NULL,
  `tick_id` int(11) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_notificacion`
--

INSERT INTO `tm_notificacion` (`not_id`, `usu_id`, `not_mensaje`, `tick_id`, `est`) VALUES
(78, 3, 'Se le ha asignado el ticket #: ', 372, 1),
(79, 18, 'Se le ha asignado el ticket #: ', 558, 1),
(80, 18, 'Se le ha asignado el ticket #: ', 568, 1),
(81, 18, 'Se le ha asignado el ticket #: ', 567, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_prioridad`
--

CREATE TABLE `tm_prioridad` (
  `prio_id` int(11) NOT NULL,
  `prio_nom` varchar(50) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_prioridad`
--

INSERT INTO `tm_prioridad` (`prio_id`, `prio_nom`, `est`) VALUES
(1, 'Bajo', 1),
(2, 'Medio', 1),
(3, 'Alto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_subcategoria`
--

CREATE TABLE `tm_subcategoria` (
  `cats_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cats_nom` varchar(150) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_subcategoria`
--

INSERT INTO `tm_subcategoria` (`cats_id`, `cat_id`, `cats_nom`, `est`) VALUES
(1, 16, 'Archivo-Inventario', 1),
(2, 16, 'Articulos-Alta', 1),
(3, 21, 'Articulos-Alta', 1),
(4, 16, 'Articulos-Baja', 1),
(5, 21, 'Articulos-Baja', 1),
(6, 1, 'Artículos-Baja', 1),
(7, 16, 'Articulos-Modificación', 1),
(8, 21, 'Articulos-Modificación', 1),
(9, 1, 'Artículos-Nuevo', 1),
(10, 1, 'ATO -Asignar Pedido', 1),
(11, 1, 'ATO -Conexión B.D.', 1),
(12, 1, 'ATO -Consecutivo Tickets', 1),
(13, 1, 'ATO -Otros', 1),
(14, 16, 'BD-No inicia', 1),
(15, 5, 'BI-caido', 1),
(16, 19, 'Cambio de Hora-Factura', 1),
(17, 19, 'Cambio de Hora-NCC', 1),
(18, 29, 'Cambio-Hora', 1),
(19, 19, 'Cancelacion-Factura', 1),
(20, 19, 'Cancelacion-NCC', 1),
(21, 1, 'CFC-Acceso o Permiso', 1),
(22, 1, 'CFC-Actualizar', 1),
(23, 1, 'CFC-Contraseña', 1),
(24, 1, 'CFC-Erorr en CFC', 1),
(25, 1, 'CFC-Otros', 1),
(26, 15, 'Correctivo-Alarma', 1),
(27, 15, 'Correctivo-CCTV', 1),
(28, 12, 'correo-contraseña', 1),
(29, 12, 'correo-nuevo', 1),
(30, 12, 'correo-otros', 1),
(31, 12, 'correo-saturado', 1),
(32, 4, 'de-equipo', 1),
(33, 14, 'Dispositivos-Alarma', 1),
(34, 14, 'Dispositivos-CCTV', 1),
(35, 5, 'DRS-caido', 1),
(36, 5, 'DRS-otros', 1),
(37, 13, 'DVR-NAS', 1),
(38, 5, 'Envio-fallido', 1),
(39, 5, 'Equipo -caido', 1),
(40, 1, 'Equipos-Impresora', 1),
(41, 1, 'Equipos-Servidor', 1),
(42, 1, 'Equipos-Terminal', 1),
(43, 16, 'Estructuras-Incorrecta', 1),
(44, 21, 'Estructuras-Incorrecta', 1),
(45, 19, 'Factura-Ajuste', 1),
(46, 16, 'Factura-Soporte', 1),
(47, 21, 'Factura-Soporte', 1),
(48, 1, 'Fin de Día-Error', 1),
(49, 1, 'Fin de Día-Incompleto', 1),
(50, 1, 'Fin de Día-No se Realizo', 1),
(51, 16, 'Impresión-Configuración', 1),
(52, 21, 'Impresión-Configuración', 1),
(53, 13, 'Impresoras-Toner', 1),
(54, 1, 'Insight-Dudas', 1),
(55, 1, 'Insight-Nuevo', 1),
(56, 16, 'Inventario-Ajuste', 1),
(57, 16, 'Inventario-Claves', 1),
(58, 1, '-Migrar Sucursal', 1),
(59, 1, 'NCR-Pepeclub', 1),
(60, 1, 'NOLO-conexion', 1),
(61, 1, '-Nueva Sucursal', 1),
(62, 1, 'Otro-Duda', 1),
(63, 1, 'Otro-Información', 1),
(64, 1, 'Otro-Soporte', 1),
(65, 16, 'otros-Soporte', 1),
(66, 21, 'otros-Soporte', 1),
(67, 26, 'Pantalla-Roja', 1),
(68, 26, 'Pantalla-Trabada', 1),
(69, 10, 'Portal-credenciales', 1),
(70, 10, 'Portal-error', 1),
(71, 10, 'Portal-otros', 1),
(72, 1, 'Precios-Cambio', 1),
(73, 16, 'Precios-Cambio', 1),
(74, 21, 'Precios-Cambio', 1),
(75, 16, 'Precios-Dudas', 1),
(76, 21, 'Precios-Dudas', 1),
(77, 16, 'Precios-Incorrecto', 1),
(78, 1, 'Precios-Nuevo', 1),
(79, 15, 'Preventivo-Alarma', 1),
(80, 15, 'Preventivo-CCTV', 1),
(81, 1, 'Promoción-Baja', 1),
(82, 1, 'Promoción-cambio', 1),
(83, 16, 'Promociones-Alta', 1),
(84, 21, 'Promociones-Alta', 1),
(85, 16, 'Promociones-Baja', 1),
(86, 21, 'Promociones-Baja', 1),
(87, 16, 'Promociones-Modificación', 1),
(88, 21, 'Promociones-Modificación', 1),
(89, 1, 'Promoción-Nuevo', 1),
(90, 5, 'Redes-internet', 1),
(91, 16, 'Reporte-Tortilla', 1),
(92, 16, 'RIF-Alta', 1),
(93, 21, 'RIF-Alta', 1),
(94, 16, 'RIF-Baja', 1),
(95, 21, 'RIF-Baja', 1),
(96, 16, 'RIF-Modificación', 1),
(97, 21, 'RIF-Modificación', 1),
(98, 26, 'Sin-Despliegue', 1),
(99, 1, 'Store value-Pepesos', 1),
(100, 1, 'Tickets-Dudas', 1),
(101, 1, 'Tickets-Error', 1),
(102, 16, 'Tickets-Modificación', 1),
(103, 21, 'Tickets-Modificación', 1),
(104, 16, 'Tickets-Soporte', 1),
(105, 21, 'Tickets-Soporte', 1),
(106, 19, 'Timbres-XML', 1),
(107, 19, 'Transferencias- otros', 1),
(108, 1, 'Usuario-Baja', 1),
(109, 1, 'Usuario-Modificacion', 1),
(110, 1, 'Usuario-Nuevo', 1),
(111, 1, 'Usuario-Password', 1),
(112, 2, 'Usuarios-Alarma', 1),
(113, 13, 'VBox-dañada', 1),
(114, 1, 'Venta-Cancelación', 1),
(115, 1, 'Venta-Cortesía', 1),
(116, 1, 'Venta-Otro', 1),
(117, 13, 'Access Point', 1),
(118, 3, 'Actualizar', 1),
(119, 13, 'Adminpaq/Contpaq', 1),
(120, 14, 'Alarma', 1),
(121, 13, 'Antivirus', 1),
(122, 21, 'Audio', 1),
(123, 13, 'Calibrar Touch', 1),
(124, 9, 'Camaras', 1),
(125, 14, 'CCTV', 1),
(126, 13, 'Claves_Impresión', 1),
(127, 13, 'Claves_Telefónicas', 1),
(128, 6, 'Configuracion', 1),
(129, 13, 'Consumibles', 1),
(130, 8, 'Contraseña', 1),
(131, 16, 'Corte Z', 1),
(132, 13, 'CPU', 1),
(133, 1, 'Cursos y Capacitaciones', 1),
(134, 19, 'Descargas', 1),
(135, 19, 'Entradas', 1),
(136, 13, 'Equipo_Oficina', 1),
(137, 13, 'Equipo_Sucursal', 1),
(138, 13, 'Equipo_Telefónico', 1),
(139, 13, 'Extensiones', 1),
(140, 19, 'Impresiones', 1),
(141, 13, 'impresoras', 1),
(142, 13, 'Incidente General', 1),
(143, 8, 'Ingreso al portal', 1),
(144, 16, 'Ingresos', 1),
(145, 18, 'instalacion', 1),
(146, 13, 'Internet', 1),
(147, 19, 'Inv Cíclico', 1),
(148, 19, 'Inv Mensual', 1),
(149, 1, 'Kardex', 1),
(150, 13, 'licencia', 1),
(151, 13, 'Monitor', 1),
(152, 13, 'Móviles', 1),
(153, 13, 'Multifuncional', 1),
(154, 13, 'NAS', 1),
(155, 13, 'Navegadores', 1),
(156, 1, 'No inicia', 1),
(157, 13, 'Nobreak', 1),
(158, 8, 'Ordenes', 1),
(159, 19, 'Otro', 1),
(160, 24, 'Otros', 1),
(161, 28, 'Otros', 1),
(162, 11, 'pagos', 1),
(163, 13, 'Paqueteria', 1),
(164, 13, 'PBX', 1),
(165, 19, 'Pedidos', 1),
(166, 27, 'Pepeclub', 1),
(167, 27, 'Peperadio', 1),
(168, 3, 'Presupuesto', 1),
(169, 11, 'proveedor', 1),
(170, 13, 'RED', 1),
(171, 3, 'Reinicio', 1),
(172, 7, 'Reinicio', 1),
(173, 1, 'Reportes', 1),
(174, 13, 'Respaldo_Eléctrico', 1),
(175, 1, 'Revenwes', 1),
(176, 22, 'Revicion', 1),
(177, 13, 'Router', 1),
(178, 13, 'S.O.', 1),
(179, 23, 'Solicitud', 1),
(180, 19, 'Solicitud de Informe', 1),
(181, 8, 'Soporte', 1),
(182, 13, 'Switch', 1),
(183, 13, 'Tablets plataforma', 1),
(184, 13, 'Teamviewer', 1),
(185, 13, 'Teclado/Mouse', 1),
(186, 16, 'Trabado', 1),
(187, 19, 'Trabado', 1),
(188, 19, 'Usuario', 1),
(189, 21, 'Video', 1),
(190, 20, 'Videos', 1),
(191, 13, 'Vlan', 1),
(192, 13, 'VPN', 1),
(193, 17, 'Web', 1),
(194, 13, 'WLC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_ticket`
--

CREATE TABLE `tm_ticket` (
  `tick_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cats_id` int(11) NOT NULL,
  `tick_titulo` varchar(250) NOT NULL,
  `tick_descrip` mediumtext NOT NULL,
  `tick_estado` varchar(15) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `usu_asig` int(11) DEFAULT NULL,
  `fech_asig` datetime DEFAULT NULL,
  `tick_estre` int(11) DEFAULT NULL,
  `tick_coment` varchar(300) DEFAULT NULL,
  `fech_cierre` datetime DEFAULT NULL,
  `prio_id` int(11) DEFAULT NULL,
  `est` int(11) NOT NULL,
  `tick_rank` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_ticket`
--

INSERT INTO `tm_ticket` (`tick_id`, `usu_id`, `cat_id`, `cats_id`, `tick_titulo`, `tick_descrip`, `tick_estado`, `fech_crea`, `usu_asig`, `fech_asig`, `tick_estre`, `tick_coment`, `fech_cierre`, `prio_id`, `est`, `tick_rank`) VALUES
(541, 3, 14, 50, 'DRS CAIDO', 'NO CONTAMOS CON CONEXION AL SERVIDOR CENTRAL', 'Abierto', '2024-01-17 17:33:12', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(542, 1, 10, 20, 'Problema con la conexión a internet', '<p>No puedo conectarme a internet desde mi computadora</p><p><br></p>', 'Abierto', '2024-01-05 08:45:21', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(543, 2, 10, 30, 'Problema con la impresora láser', '<p>No puedo imprimir con mi impresora láser, la impresión sale borrosa</p><p><br></p>', 'Abierto', '2024-01-05 09:30:45', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(544, 1, 10, 40, 'Error al abrir aplicación de diseño gráfico', '<p>Cuando intento abrir la aplicación de diseño gráfico, obtengo un error</p><p><br></p>', 'Abierto', '2024-01-05 10:15:22', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(545, 2, 10, 50, 'Problema con la conexión Bluetooth', '<p>No puedo conectar mis dispositivos Bluetooth a la computadora</p><p><br></p>', 'Abierto', '2024-01-05 11:00:35', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(546, 1, 10, 60, 'Error al abrir documento', '<p>Cuando intento abrir un documento, obtengo un mensaje de error inesperado</p><p><br></p>', 'Abierto', '2024-01-05 11:45:19', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(547, 2, 10, 25, 'Problema con la batería', '<p>La batería de mi laptop se descarga rápidamente, incluso después de cargarla completamente</p><p><br></p>', 'Abierto', '2024-01-05 12:30:55', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(548, 1, 10, 35, 'Pérdida de datos', '<p>He perdido archivos importantes, ¿cómo puedo recuperarlos?</p><p><br></p>', 'Abierto', '2024-01-05 13:15:27', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(549, 2, 10, 45, 'Problema con el ratón', '<p>Mi ratón no responde correctamente, se mueve de manera errática</p><p><br></p>', 'Abierto', '2024-01-05 14:00:14', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(550, 1, 10, 55, 'No puedo instalar nuevo software', '<p>Cuando intento instalar un nuevo software, el proceso se interrumpe con un error</p><p><br></p>', 'Abierto', '2024-01-05 14:45:09', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(551, 2, 10, 16, 'Problema con la webcam', '<p>Mi webcam no funciona en las aplicaciones de videoconferencia</p><p><br></p>', 'Abierto', '2024-01-05 15:30:17', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(552, 1, 10, 26, 'Problema con la conexión Wi-Fi', '<p>No puedo conectarme a mi red Wi-Fi, a pesar de tener la contraseña correcta</p><p><br></p>', 'Abierto', '2024-01-05 16:15:32', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(553, 2, 10, 36, 'Problema con la pantalla táctil', '<p>La pantalla táctil de mi laptop no responde a los toques</p><p><br></p>', 'Abierto', '2024-01-05 17:00:40', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(554, 1, 10, 46, 'Error al reproducir video', '<p>Al intentar reproducir videos, obtengo un mensaje de error y no se reproduce</p><p><br></p>', 'Abierto', '2024-01-05 17:45:15', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(555, 2, 10, 56, 'Problema con la configuración de correo', '<p>No puedo configurar correctamente mi cliente de correo electrónico</p><p><br></p>', 'Abierto', '2024-01-05 18:30:59', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(556, 1, 10, 17, 'Pérdida de conexión a red', '<p>La conexión de red se pierde intermitentemente, ¿cómo puedo solucionarlo?</p><p><br></p>', 'Abierto', '2024-01-05 19:15:21', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(557, 2, 10, 27, 'Problema con la unidad de CD/DVD', '<p>No puedo leer ni grabar discos en mi unidad de CD/DVD</p><p><br></p>', 'Abierto', '2024-01-05 20:00:45', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(558, 1, 10, 37, 'No se inicia el sistema operativo', '<p>Mi computadora no arranca correctamente, se queda en la pantalla de inicio</p><p><br></p>', 'Cerrado', '2024-01-05 20:45:22', 18, '2024-02-07 10:38:33', NULL, NULL, '2024-02-07 10:38:54', 3, 1, 0),
(559, 2, 10, 47, 'Problema con la configuración de pantalla', '<p>La configuración de pantalla no se ajusta correctamente a mi monitor</p><p><br></p>', 'Abierto', '2024-01-05 21:30:35', NULL, NULL, NULL, NULL, NULL, 2, 1, 1),
(560, 1, 10, 57, 'Error al imprimir documentos', '<p>Cuando intento imprimir documentos, la impresora muestra un error</p><p><br></p>', 'Abierto', '2024-01-05 22:15:19', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(561, 2, 10, 18, 'Problema con la conexión USB', '<p>No puedo conectar dispositivos a través de puertos USB, parece un problema de conexión</p><p><br></p>', 'Abierto', '2024-01-05 23:00:55', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(562, 1, 10, 28, 'Problema con la barra de sonido', '<p>La barra de sonido de mi sistema de audio no produce sonido, ¿cómo puedo solucionarlo?</p><p><br></p>', 'Abierto', '2024-01-05 23:45:27', NULL, NULL, NULL, NULL, NULL, 1, 1, 0),
(563, 2, 10, 38, 'Problema con la conexión HDMI', '<p>No puedo conectar mi laptop a la TV a través del cable HDMI</p><p><br></p>', 'Abierto', '2024-01-06 00:30:14', NULL, NULL, NULL, NULL, NULL, 2, 1, 0),
(564, 1, 10, 48, 'Error al abrir archivo Excel', '<p>Al intentar abrir un archivo Excel, obtengo un mensaje de error inesperado</p><p><br></p>', 'Abierto', '2024-01-06 01:15:09', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(565, 2, 10, 58, 'Problema con la actualización de software', '<p>No puedo actualizar el software de mi computadora, siempre falla</p><p><br></p>', 'Abierto', '2024-01-06 02:00:40', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(566, 1, 10, 19, 'No puedo enviar mensajes por chat', '<p>Cuando intento enviar mensajes por chat, no se envían correctamente</p><p><br></p>', 'Abierto', '2024-01-06 02:45:17', NULL, NULL, NULL, NULL, NULL, 3, 1, 0),
(567, 2, 10, 29, 'Problema con la resolución de pantalla', '<p>La resolución de mi pantalla no se ajusta correctamente, todo se ve borroso</p><p><br></p>', 'Cerrado', '2024-01-06 03:30:27', 18, '2024-02-07 10:53:08', NULL, NULL, '2024-02-07 10:55:10', 1, 1, 0),
(568, 1, 10, 39, 'Error al conectar auriculares', '<p>No se escucha audio cuando conecto auriculares a mi computadora</p><p><br></p>', 'Cerrado', '2024-01-06 04:15:14', 18, '2024-02-07 10:48:59', NULL, NULL, '2024-02-07 10:51:09', 2, 1, 0),
(569, 2, 10, 49, 'Problema con la instalación de Windows', '<p>No puedo instalar Windows correctamente en mi computadora</p><p><br></p>', 'Cerrado', '2024-01-06 05:00:22', NULL, NULL, NULL, NULL, '2024-02-07 10:37:24', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuario`
--

CREATE TABLE `tm_usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nom` varchar(150) DEFAULT NULL,
  `usu_ape` varchar(150) DEFAULT NULL,
  `usu_correo` varchar(150) NOT NULL,
  `usu_pass` varchar(150) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `usu_telf` varchar(12) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Tabla Mantenedor de Usuarios';

--
-- Volcado de datos para la tabla `tm_usuario`
--

INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_ape`, `usu_correo`, `usu_pass`, `rol_id`, `usu_telf`, `fech_crea`, `fech_modi`, `fech_elim`, `est`) VALUES
(1, 'test', 'test', 'test@test.com', 'GQs0U8aPE28qxfkkjdS47fzSV3vi3jnZEmpk2u/uOJg=', 1, '+51981233834', '2020-12-14 19:46:22', NULL, NULL, 1),
(2, 'Usuario Miguel', 'Diaz', 'user@user.com', '3KLS4SbnBWTIgkUw4FqoF4THhtK48O3NnNbkePfFaaI=', 1, '+51981233834', '2020-12-14 19:46:22', NULL, NULL, 1),
(3, 'Soporte Miguel', 'Diaz', 'mickstudiosapps@gmail.com', 'BJSPczUz9IU338cuNlSfIqNvI0jc1mmoQmKM+WtpU3c=', 2, '+3334145281', '2020-12-14 19:46:22', NULL, '2021-01-21 22:04:50', 0),
(17, 'Ivan', 'Audiffred', 'ivan.hernandez@pollopepe.com.mx', 'vT1T/K67nkaJ0o6d0m3EtJHUoIpWVWX6QYY4tSfvbTk=', 2, '1234567890', '2024-01-12 11:16:46', NULL, NULL, 1),
(18, 'Emiliano', 'Gonzalez', 'emiliano.gonzalez@pollopepe.com.mx', 'iMzsPir+qcAfBfcoeGDC3qNexGlEEvsiB12EF/dsUtU=', 2, '1234567890', '2024-01-12 11:17:47', NULL, NULL, 1),
(19, 'pruebas', 'modular', 'pruebas@gmail.com', 'vxvNJxWXiOA0o6xCZSDuyAoek9i/v2w0q4YUAKZGcx4=', 1, '1020304050', '2024-05-17 12:40:25', NULL, NULL, 1),
(20, 'Carlos', 'Mendoza', 'carlosenethe@gmail.com', 'kZDcMxCL2aGy81reZveaVKh9SgBuUDh2lAVa0kgI27k=', 2, '33123456789', '2024-06-03 19:39:58', NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rtickets`
--
ALTER TABLE `rtickets`
  ADD PRIMARY KEY (`id_rank`);

--
-- Indices de la tabla `td_documento_detalle`
--
ALTER TABLE `td_documento_detalle`
  ADD PRIMARY KEY (`det_id`);

--
-- Indices de la tabla `td_ticketdetalle`
--
ALTER TABLE `td_ticketdetalle`
  ADD PRIMARY KEY (`tickd_id`);

--
-- Indices de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indices de la tabla `tm_notificacion`
--
ALTER TABLE `tm_notificacion`
  ADD PRIMARY KEY (`not_id`);

--
-- Indices de la tabla `tm_prioridad`
--
ALTER TABLE `tm_prioridad`
  ADD PRIMARY KEY (`prio_id`);

--
-- Indices de la tabla `tm_subcategoria`
--
ALTER TABLE `tm_subcategoria`
  ADD PRIMARY KEY (`cats_id`);

--
-- Indices de la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  ADD PRIMARY KEY (`tick_id`);

--
-- Indices de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rtickets`
--
ALTER TABLE `rtickets`
  MODIFY `id_rank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `td_documento_detalle`
--
ALTER TABLE `td_documento_detalle`
  MODIFY `det_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `td_ticketdetalle`
--
ALTER TABLE `td_ticketdetalle`
  MODIFY `tickd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tm_notificacion`
--
ALTER TABLE `tm_notificacion`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `tm_prioridad`
--
ALTER TABLE `tm_prioridad`
  MODIFY `prio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tm_subcategoria`
--
ALTER TABLE `tm_subcategoria`
  MODIFY `cats_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT de la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  MODIFY `tick_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
