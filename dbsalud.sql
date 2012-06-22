-- phpMyAdmin SQL Dump
-- version 3.4.9deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-01-2012 a las 13:08:17
-- Versión del servidor: 5.1.58
-- Versión de PHP: 5.3.8-1+b1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbsalud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CtCont`
--

CREATE TABLE IF NOT EXISTS `CtCont` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbEmpr_id` int(10) unsigned NOT NULL,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `ContratistaGbIden_id` tinyint(2) unsigned NOT NULL,
  `identcontratista` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cargocontratista` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecontratista` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccioncontratista` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ContratanteGbIden_id` tinyint(2) unsigned NOT NULL,
  `identcontratante` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cargocontratante` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecontratante` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `direccioncontratante` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `FirmaGbCiud_id` int(5) unsigned NOT NULL,
  `LegalGbCiud_id` int(5) unsigned NOT NULL,
  `revision` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `aviso` int(3) unsigned NOT NULL,
  `costovigencia` int(1) unsigned NOT NULL,
  `subtotal` decimal(10,2) unsigned NOT NULL,
  `iva` decimal(3,2) unsigned NOT NULL,
  `descuento` decimal(10,2) unsigned NOT NULL,
  `total` decimal(10,2) unsigned NOT NULL,
  `saldo` decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `GbPers_id` (`GbPers_id`),
  KEY `GbEmpr_id` (`GbEmpr_id`),
  KEY `GbIden_id` (`ContratistaGbIden_id`),
  KEY `ContratanteGbIden_id` (`ContratanteGbIden_id`),
  KEY `FirmaGbCiud_id` (`FirmaGbCiud_id`),
  KEY `LegalGbCiud_id` (`LegalGbCiud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CtCoti`
--

CREATE TABLE IF NOT EXISTS `CtCoti` (
  `id` bigint(99) NOT NULL AUTO_INCREMENT,
  `GbEmpr_id` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `modalidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `trabajadores` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `centros` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vencimiento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subtotal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iva` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descuento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbEmpr_id` (`GbEmpr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CtFact`
--

CREATE TABLE IF NOT EXISTS `CtFact` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `GbEmpr_id` int(10) unsigned NOT NULL,
  `CtCont_id` bigint(99) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `vencimiento` date DEFAULT NULL,
  `subtotal` decimal(10,2) unsigned NOT NULL,
  `iva` decimal(10,2) unsigned NOT NULL,
  `descuento` decimal(10,2) unsigned NOT NULL,
  `total` decimal(10,2) unsigned NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `GbPers_id` (`GbPers_id`),
  KEY `GbEmpr_id` (`GbEmpr_id`),
  KEY `CtCont` (`CtCont_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CtServ`
--

CREATE TABLE IF NOT EXISTS `CtServ` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iva` decimal(3,2) unsigned NOT NULL DEFAULT '0.00',
  `tipo` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CtTari`
--

CREATE TABLE IF NOT EXISTS `CtTari` (
  `id` bigint(99) unsigned NOT NULL,
  `CtServ_id` int(10) unsigned NOT NULL,
  `CtCont_id` bigint(99) unsigned NOT NULL,
  `valor` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CtServ_id` (`CtServ_id`),
  KEY `CtCont_id` (`CtCont_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbAcls`
--

CREATE TABLE IF NOT EXISTS `GbAcls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GbUsua_id` bigint(99) unsigned NOT NULL,
  `modulo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `accion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbUsua_id` (`GbUsua_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbCarg`
--

CREATE TABLE IF NOT EXISTS `GbCarg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbCarg`
--

INSERT INTO `GbCarg` (`id`, `nombre`) VALUES
(1, 'SYSTEM ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbCiud`
--

CREATE TABLE IF NOT EXISTS `GbCiud` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `GbDepa_id` int(5) unsigned NOT NULL,
  `codigo` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `GbDepa_id` (`GbDepa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbCiud`
--

INSERT INTO `GbCiud` (`id`, `GbDepa_id`, `codigo`, `nombre`) VALUES
(1, 1, '00000', 'SYSTEM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbCnae`
--

CREATE TABLE IF NOT EXISTS `GbCnae` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `act_econ` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alternativo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbCnae`
--

INSERT INTO `GbCnae` (`id`, `act_econ`, `alternativo`) VALUES
(1, 'NULO', 'NULO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbDepa`
--

CREATE TABLE IF NOT EXISTS `GbDepa` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `GbPais_id` int(5) unsigned NOT NULL,
  `codigo` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `GbPais_id` (`GbPais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `GbDepa`
--

INSERT INTO `GbDepa` (`id`, `GbPais_id`, `codigo`, `nombre`) VALUES
(1, 1, '00', 'SYSTEM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbEmpr`
--

CREATE TABLE IF NOT EXISTS `GbEmpr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `tipoide` tinyint(2) unsigned NOT NULL,
  `GbCnae_id` int(10) unsigned NOT NULL,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'C',
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rplegal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `identrplegal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  KEY `GbCnae_id` (`GbCnae_id`),
  KEY `tipoide` (`tipoide`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbEmpr`
--

INSERT INTO `GbEmpr` (`id`, `identificacion`, `tipoide`, `GbCnae_id`, `tipo`, `nombre`, `rplegal`, `identrplegal`, `web`) VALUES
(1, '000000000000000000000000N', 1, 1, 'N', 'SYSTEM', 'NULO', 'NULO', 'NULO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbIden`
--

CREATE TABLE IF NOT EXISTS `GbIden` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbIden`
--

INSERT INTO `GbIden` (`id`, `sigla`, `detalle`) VALUES
(1, 'NULL', 'NULO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbLogr`
--

CREATE TABLE IF NOT EXISTS `GbLogr` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `GbUsua_id` bigint(99) unsigned NOT NULL,
  `modulo` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `accion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbUsua_id` (`GbUsua_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbPais`
--

CREATE TABLE IF NOT EXISTS `GbPais` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `GbPais`
--

INSERT INTO `GbPais` (`id`, `codigo`, `nombre`) VALUES
(1, '000', 'SYSTEM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbPers`
--

CREATE TABLE IF NOT EXISTS `GbPers` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbSucu_id` int(10) unsigned NOT NULL,
  `GbCiud_id` int(5) unsigned NOT NULL,
  `GbIden_id` tinyint(2) unsigned NOT NULL,
  `identificacion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `prinom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `segnom` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priape` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `segape` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nacimiento` date NOT NULL,
  `telefono` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GbCarg_id` int(10) unsigned NOT NULL,
  `ingreso` date NOT NULL,
  `pdatos` tinyint(1) unsigned NOT NULL,
  `estado` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`identificacion`),
  KEY `GbSucu_id` (`GbSucu_id`),
  KEY `GbCiud_id` (`GbCiud_id`),
  KEY `GbIden_id` (`GbIden_id`),
  KEY `GbCarg_id` (`GbCarg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbPers`
--

INSERT INTO `GbPers` (`id`, `GbSucu_id`, `GbCiud_id`, `GbIden_id`, `identificacion`, `prinom`, `segnom`, `priape`, `segape`, `nacimiento`, `telefono`, `direccion`, `correo`, `GbCarg_id`, `ingreso`, `pdatos`, `estado`) VALUES
(1, 1, 1, 1, 'SYSADM', 'ADMIN', NULL, 'SYSTEM', NULL, '0000-00-00', 'NULO', 'NULO', 'NULO', 1, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbPtra`
--

CREATE TABLE IF NOT EXISTS `GbPtra` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GbEmpr_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbEmpr_id` (`GbEmpr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbSucu`
--

CREATE TABLE IF NOT EXISTS `GbSucu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GbEmpr_id` int(10) unsigned NOT NULL,
  `GbCiud_id` int(5) unsigned NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `tele2` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacto` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `GbCiud_id` (`GbCiud_id`),
  KEY `GbEmpr_id` (`GbEmpr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbSucu`
--

INSERT INTO `GbSucu` (`id`, `GbEmpr_id`, `GbCiud_id`, `nombre`, `telefono`, `tele2`, `fax`, `contacto`, `direccion`, `correo`) VALUES
(1, 1, 1, 'SYSTEM', 'NULO', NULL, NULL, NULL, 'NULO', 'NULO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GbUsua`
--

CREATE TABLE IF NOT EXISTS `GbUsua` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `GbPers_id` (`GbPers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `GbUsua`
--

INSERT INTO `GbUsua` (`id`, `GbPers_id`, `nombre`, `clave`) VALUES
(1, 1, 'root', 'wg1HV7zlQXAkgYpMBDyviLg9jGo2eb5KuASDH0j9+pP3v9ex3lUTbf6J36lcJvxsThuE6F581+R8eiCBn1EFig==');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HsFami`
--

CREATE TABLE IF NOT EXISTS `HsFami` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `MdPato_id` bigint(99) unsigned NOT NULL,
  `familiar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  KEY `MdPato_id` (`MdPato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HsLabo`
--

CREATE TABLE IF NOT EXISTS `HsLabo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `empresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fingreso` date DEFAULT NULL,
  `actividad` text COLLATE utf8_unicode_ci NOT NULL,
  `puesto` text COLLATE utf8_unicode_ci NOT NULL,
  `riesgo` text COLLATE utf8_unicode_ci NOT NULL,
  `duracion` int(5) unsigned NOT NULL,
  `edad` int(2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HsPers`
--

CREATE TABLE IF NOT EXISTS `HsPers` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `evento` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `operaciones` text COLLATE utf8_unicode_ci,
  `productos` text COLLATE utf8_unicode_ci,
  `riesgos` text COLLATE utf8_unicode_ci,
  `texposicion` text COLLATE utf8_unicode_ci,
  `proteccion` text COLLATE utf8_unicode_ci,
  `ventilacion` text COLLATE utf8_unicode_ci,
  `temperatura` text COLLATE utf8_unicode_ci,
  `horario` text COLLATE utf8_unicode_ci,
  `turno` text COLLATE utf8_unicode_ci,
  `rotacion` text COLLATE utf8_unicode_ci,
  `visitas` text COLLATE utf8_unicode_ci,
  `bajas` text COLLATE utf8_unicode_ci,
  `medicamentos` text COLLATE utf8_unicode_ci,
  `fumador` char(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `detfumador` text COLLATE utf8_unicode_ci,
  `bebedor` char(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `detbebedor` text COLLATE utf8_unicode_ci,
  `efpulmon` text COLLATE utf8_unicode_ci,
  `efcorazon` text COLLATE utf8_unicode_ci,
  `efasma` text COLLATE utf8_unicode_ci,
  `efbronquios` text COLLATE utf8_unicode_ci,
  `efcirculacion` text COLLATE utf8_unicode_ci,
  `efhigado` text COLLATE utf8_unicode_ci,
  `efgastritis` text COLLATE utf8_unicode_ci,
  `efulcera` text COLLATE utf8_unicode_ci,
  `efvesicula` text COLLATE utf8_unicode_ci,
  `efriñon` text COLLATE utf8_unicode_ci,
  `efurinario` text COLLATE utf8_unicode_ci,
  `efartrosis` text COLLATE utf8_unicode_ci,
  `eflumbago` text COLLATE utf8_unicode_ci,
  `efotros` text COLLATE utf8_unicode_ci,
  `alergias` text COLLATE utf8_unicode_ci,
  `prazucar` text COLLATE utf8_unicode_ci,
  `prcolesterol` text COLLATE utf8_unicode_ci,
  `prurico` text COLLATE utf8_unicode_ci,
  `prhepatitis` text COLLATE utf8_unicode_ci,
  `prtransaminasas` text COLLATE utf8_unicode_ci,
  `prhipertension` text COLLATE utf8_unicode_ci,
  `prhipotension` text COLLATE utf8_unicode_ci,
  `prsoplos` text COLLATE utf8_unicode_ci,
  `prarritmias` text COLLATE utf8_unicode_ci,
  `prhernias` text COLLATE utf8_unicode_ci,
  `prdepresion` text COLLATE utf8_unicode_ci,
  `cbintestinal` text COLLATE utf8_unicode_ci,
  `cborina` text COLLATE utf8_unicode_ci,
  `cbpiel` text COLLATE utf8_unicode_ci,
  `cbpeso` text COLLATE utf8_unicode_ci,
  `tetano` char(1) COLLATE utf8_unicode_ci DEFAULT 'S',
  `tetanofecha` date DEFAULT NULL,
  `tetanodosis` text COLLATE utf8_unicode_ci,
  `observaciones` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdAudi`
--

CREATE TABLE IF NOT EXISTS `MdAudi` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `realizado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `d500` decimal(3,2) unsigned NOT NULL,
  `i500` decimal(3,2) unsigned NOT NULL,
  `d1000` decimal(3,2) unsigned NOT NULL,
  `i1000` decimal(3,2) unsigned NOT NULL,
  `d2000` decimal(3,2) unsigned NOT NULL,
  `i2000` decimal(3,2) unsigned NOT NULL,
  `d3000` decimal(3,2) unsigned NOT NULL,
  `i3000` decimal(3,2) unsigned NOT NULL,
  `d4000` decimal(3,2) unsigned NOT NULL,
  `i4000` decimal(3,2) unsigned NOT NULL,
  `d6000` decimal(3,2) unsigned NOT NULL,
  `i6000` decimal(3,2) unsigned NOT NULL,
  `d8000` decimal(3,2) unsigned NOT NULL,
  `i8000` decimal(3,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdBiom`
--

CREATE TABLE IF NOT EXISTS `MdBiom` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `talla` decimal(3,2) unsigned NOT NULL,
  `peso` decimal(3,2) unsigned NOT NULL,
  `pulso` decimal(3,2) unsigned NOT NULL,
  `fres` decimal(3,2) unsigned NOT NULL,
  `pasisto` decimal(3,2) unsigned NOT NULL,
  `padiasto` decimal(3,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdDiag`
--

CREATE TABLE IF NOT EXISTS `MdDiag` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `MdPato_id` bigint(99) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  KEY `MdPato_id` (`MdPato_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdEspi`
--

CREATE TABLE IF NOT EXISTS `MdEspi` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `realizado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cv` decimal(3,2) NOT NULL,
  `vems` decimal(3,2) NOT NULL,
  `tiff` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdExam`
--

CREATE TABLE IF NOT EXISTS `MdExam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alternativo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `MdExam`
--

INSERT INTO `MdExam` (`id`, `codigo`, `nombre`, `alternativo`) VALUES
(1, 'EX001', 'GLUCOSA', 'GLUCOSA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdExtr`
--

CREATE TABLE IF NOT EXISTS `MdExtr` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `hdmov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `himov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hdpal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hipal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hdten` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hiten` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hdsur` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hisur` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cdmov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cimov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cdpal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cipal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mdmov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mimov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mdpal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mipal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mdten` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `miten` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mdhip` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mihip` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mdret` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `miret` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mdsme` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `misme` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pddef` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pidef` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pdins` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `piins` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdHist`
--

CREATE TABLE IF NOT EXISTS `MdHist` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `TcRuta_id` bigint(99) unsigned NOT NULL,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `menstru` tinyint(1) unsigned NOT NULL,
  `tipo` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  KEY `GbPers_id` (`GbPers_id`),
  KEY `TcRuta_id` (`TcRuta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdLabo`
--

CREATE TABLE IF NOT EXISTS `MdLabo` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `CtServ_id` int(10) unsigned NOT NULL,
  `MdExam_id` int(10) unsigned NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'O',
  `resultado` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  KEY `CtServ_id` (`CtServ_id`),
  KEY `GbLabo_id` (`MdExam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdPaci`
--

CREATE TABLE IF NOT EXISTS `MdPaci` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tipoide` tinyint(2) unsigned NOT NULL,
  `GbSucu_id` int(10) unsigned NOT NULL,
  `prinom` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `segnom` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priape` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `segape` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nacimiento` date NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'M',
  `GbCiud_id` int(5) unsigned NOT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GbPtra_id` bigint(99) unsigned NOT NULL,
  `ingreso` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`identificacion`),
  KEY `GbCiud_id` (`GbCiud_id`),
  KEY `GbPtra_id` (`GbPtra_id`),
  KEY `GbSucu_id` (`GbSucu_id`),
  KEY `tipoide` (`tipoide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdPato`
--

CREATE TABLE IF NOT EXISTS `MdPato` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alternativo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdProc`
--

CREATE TABLE IF NOT EXISTS `MdProc` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbPtra_id` bigint(99) unsigned NOT NULL,
  `MdProt_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbPtra_id` (`GbPtra_id`),
  KEY `MdProt_id` (`MdProt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdProt`
--

CREATE TABLE IF NOT EXISTS `MdProt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdQues`
--

CREATE TABLE IF NOT EXISTS `MdQues` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdProt_id` int(11) unsigned NOT NULL,
  `pregunta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdProt_id` (`MdProt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdResp`
--

CREATE TABLE IF NOT EXISTS `MdResp` (
  `id` bigint(20) unsigned NOT NULL,
  `MdQues_id` bigint(20) unsigned NOT NULL,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `resultado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `MdQues_id` (`MdQues_id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdSist`
--

CREATE TABLE IF NOT EXISTS `MdSist` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `otoscder` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `otosciz` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `boca` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `garganta` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pupilas` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `columna` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mucosas` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cardiaca` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `respiratoria` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `abdominal` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nervioso` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ppl` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MdVisu`
--

CREATE TABLE IF NOT EXISTS `MdVisu` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `lentes` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `lentesprueba` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `miopia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hipermetropia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `astigmatismo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `bif` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `lent` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcl` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vl` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vc` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vlod` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vloi` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vlao` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcod` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcoi` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcao` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcAspe`
--

CREATE TABLE IF NOT EXISTS `TcAspe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `criterio` text COLLATE utf8_unicode_ci,
  `medida` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcCapa`
--

CREATE TABLE IF NOT EXISTS `TcCapa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `duracion` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcChec`
--

CREATE TABLE IF NOT EXISTS `TcChec` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `TcRevi_id` bigint(99) unsigned NOT NULL,
  `ntrabajadores` int(10) unsigned NOT NULL,
  `asesoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comite` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `caracteristicas` text COLLATE utf8_unicode_ci NOT NULL,
  `psensible` text COLLATE utf8_unicode_ci NOT NULL,
  `seguridad` text COLLATE utf8_unicode_ci NOT NULL,
  `mfisico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hfisico` text COLLATE utf8_unicode_ci NOT NULL,
  `mquimico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hquimico` text COLLATE utf8_unicode_ci NOT NULL,
  `mbiologico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hbiologico` text COLLATE utf8_unicode_ci NOT NULL,
  `cargas` text COLLATE utf8_unicode_ci NOT NULL,
  `carretilleros` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `repetitivos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ett` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `limpieza` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mantenimiento` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `otros` text COLLATE utf8_unicode_ci,
  `emergencia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `simulacros` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `planos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `eplanos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `textintor` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pemergencia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `lemergencia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `alarmas` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `selectrico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `sextintor` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `sevacuacion` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `slavabos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `botiquin` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ascensor` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `bantideslizante` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `TcRevi_id` (`TcRevi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcCurs`
--

CREATE TABLE IF NOT EXISTS `TcCurs` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `TcCapa_id` int(10) unsigned NOT NULL,
  `empresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `instructor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  KEY `TcCapa_id` (`TcCapa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcDeta`
--

CREATE TABLE IF NOT EXISTS `TcDeta` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `TcRevi_id` bigint(99) unsigned NOT NULL,
  `TcAspe_id` int(10) unsigned NOT NULL,
  `evitable` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `estimacion` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `probabilidad` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `consecuencia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `TcRevi_id` (`TcRevi_id`),
  KEY `TcAspe_id` (`TcAspe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcRevi`
--

CREATE TABLE IF NOT EXISTS `TcRevi` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbSucu_id` int(10) unsigned NOT NULL,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `inicio` time NOT NULL,
  `fin` time NOT NULL,
  `entrevistados` text COLLATE utf8_unicode_ci NOT NULL,
  `resumen` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbSucu_id` (`GbSucu_id`),
  KEY `GbPers_id` (`GbPers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TcRuta`
--

CREATE TABLE IF NOT EXISTS `TcRuta` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `CtCont_id` bigint(99) unsigned NOT NULL,
  `fplaneada` date NOT NULL,
  `fejecutada` datetime NOT NULL,
  `personal` text COLLATE utf8_unicode_ci NOT NULL,
  `unidad` text COLLATE utf8_unicode_ci NOT NULL,
  `equipo` text COLLATE utf8_unicode_ci NOT NULL,
  `lugar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `encargado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datos` text COLLATE utf8_unicode_ci NOT NULL,
  `fparciales` text COLLATE utf8_unicode_ci NOT NULL,
  `analitica` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `biometria` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `audiometria` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `vision` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `espirometria` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `medica` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `electro` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `detelectro` text COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci,
  `ncompletos` int(10) unsigned NOT NULL DEFAULT '0',
  `nanaliticas` int(10) unsigned NOT NULL DEFAULT '0',
  `nsolas` int(10) unsigned NOT NULL DEFAULT '0',
  `necg` int(10) unsigned NOT NULL DEFAULT '0',
  `naudiometria` int(10) unsigned NOT NULL DEFAULT '0',
  `total` int(10) unsigned NOT NULL DEFAULT '0',
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P',
  PRIMARY KEY (`id`),
  KEY `CtCont_id` (`CtCont_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CtCont`
--
ALTER TABLE `CtCont`
  ADD CONSTRAINT `CtCont_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtCont_ibfk_3` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtCont_ibfk_5` FOREIGN KEY (`ContratanteGbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtCont_ibfk_6` FOREIGN KEY (`ContratistaGbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtCont_ibfk_7` FOREIGN KEY (`FirmaGbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtCont_ibfk_8` FOREIGN KEY (`LegalGbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CtCoti`
--
ALTER TABLE `CtCoti`
  ADD CONSTRAINT `CtCoti_ibfk_1` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CtFact`
--
ALTER TABLE `CtFact`
  ADD CONSTRAINT `CtFact_ibfk_3` FOREIGN KEY (`CtCont_id`) REFERENCES `CtCont` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtFact_ibfk_1` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtFact_ibfk_2` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CtTari`
--
ALTER TABLE `CtTari`
  ADD CONSTRAINT `CtTari_ibfk_1` FOREIGN KEY (`CtServ_id`) REFERENCES `CtServ` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `CtTari_ibfk_2` FOREIGN KEY (`CtCont_id`) REFERENCES `CtCont` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbAcls`
--
ALTER TABLE `GbAcls`
  ADD CONSTRAINT `GbAcls_ibfk_1` FOREIGN KEY (`GbUsua_id`) REFERENCES `GbUsua` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbCiud`
--
ALTER TABLE `GbCiud`
  ADD CONSTRAINT `GbCiud_ibfk_1` FOREIGN KEY (`GbDepa_id`) REFERENCES `GbDepa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbDepa`
--
ALTER TABLE `GbDepa`
  ADD CONSTRAINT `GbDepa_ibfk_1` FOREIGN KEY (`GbPais_id`) REFERENCES `GbPais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbEmpr`
--
ALTER TABLE `GbEmpr`
  ADD CONSTRAINT `GbEmpr_ibfk_1` FOREIGN KEY (`GbCnae_id`) REFERENCES `GbCnae` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `GbEmpr_ibfk_2` FOREIGN KEY (`tipoide`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbLogr`
--
ALTER TABLE `GbLogr`
  ADD CONSTRAINT `GbLogr_ibfk_1` FOREIGN KEY (`GbUsua_id`) REFERENCES `GbUsua` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbPers`
--
ALTER TABLE `GbPers`
  ADD CONSTRAINT `GbPers_ibfk_1` FOREIGN KEY (`GbSucu_id`) REFERENCES `GbSucu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `GbPers_ibfk_2` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `GbPers_ibfk_3` FOREIGN KEY (`GbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `GbPers_ibfk_4` FOREIGN KEY (`GbCarg_id`) REFERENCES `GbCarg` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbPtra`
--
ALTER TABLE `GbPtra`
  ADD CONSTRAINT `GbPtra_ibfk_1` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbSucu`
--
ALTER TABLE `GbSucu`
  ADD CONSTRAINT `GbSucu_ibfk_1` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `GbSucu_ibfk_2` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `GbUsua`
--
ALTER TABLE `GbUsua`
  ADD CONSTRAINT `GbUsua_ibfk_1` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `HsFami`
--
ALTER TABLE `HsFami`
  ADD CONSTRAINT `HsFami_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `HsFami_ibfk_2` FOREIGN KEY (`MdPato_id`) REFERENCES `MdPato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `HsLabo`
--
ALTER TABLE `HsLabo`
  ADD CONSTRAINT `HsLabo_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `HsPers`
--
ALTER TABLE `HsPers`
  ADD CONSTRAINT `HsPers_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdAudi`
--
ALTER TABLE `MdAudi`
  ADD CONSTRAINT `MdAudi_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdBiom`
--
ALTER TABLE `MdBiom`
  ADD CONSTRAINT `MdBiom_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdDiag`
--
ALTER TABLE `MdDiag`
  ADD CONSTRAINT `MdDiag_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdDiag_ibfk_2` FOREIGN KEY (`MdPato_id`) REFERENCES `MdPato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdEspi`
--
ALTER TABLE `MdEspi`
  ADD CONSTRAINT `MdEspi_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdExtr`
--
ALTER TABLE `MdExtr`
  ADD CONSTRAINT `MdExtr_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdHist`
--
ALTER TABLE `MdHist`
  ADD CONSTRAINT `MdHist_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdHist_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdHist_ibfk_3` FOREIGN KEY (`TcRuta_id`) REFERENCES `TcRuta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdLabo`
--
ALTER TABLE `MdLabo`
  ADD CONSTRAINT `MdLabo_ibfk_3` FOREIGN KEY (`MdExam_id`) REFERENCES `MdExam` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdLabo_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdLabo_ibfk_2` FOREIGN KEY (`CtServ_id`) REFERENCES `CtServ` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdPaci`
--
ALTER TABLE `MdPaci`
  ADD CONSTRAINT `MdPaci_ibfk_1` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdPaci_ibfk_2` FOREIGN KEY (`GbPtra_id`) REFERENCES `GbPtra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdPaci_ibfk_3` FOREIGN KEY (`GbSucu_id`) REFERENCES `GbSucu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdPaci_ibfk_4` FOREIGN KEY (`tipoide`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdProc`
--
ALTER TABLE `MdProc`
  ADD CONSTRAINT `MdProc_ibfk_1` FOREIGN KEY (`MdProt_id`) REFERENCES `MdProt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdProc_ibfk_2` FOREIGN KEY (`GbPtra_id`) REFERENCES `GbPtra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdQues`
--
ALTER TABLE `MdQues`
  ADD CONSTRAINT `MdQues_ibfk_1` FOREIGN KEY (`MdProt_id`) REFERENCES `MdProt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdResp`
--
ALTER TABLE `MdResp`
  ADD CONSTRAINT `MdResp_ibfk_1` FOREIGN KEY (`MdQues_id`) REFERENCES `MdQues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `MdResp_ibfk_2` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdSist`
--
ALTER TABLE `MdSist`
  ADD CONSTRAINT `MdSist_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `MdVisu`
--
ALTER TABLE `MdVisu`
  ADD CONSTRAINT `MdVisu_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TcChec`
--
ALTER TABLE `TcChec`
  ADD CONSTRAINT `TcChec_ibfk_1` FOREIGN KEY (`TcRevi_id`) REFERENCES `TcRevi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TcCurs`
--
ALTER TABLE `TcCurs`
  ADD CONSTRAINT `TcCurs_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TcCurs_ibfk_2` FOREIGN KEY (`TcCapa_id`) REFERENCES `TcCapa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TcDeta`
--
ALTER TABLE `TcDeta`
  ADD CONSTRAINT `TcDeta_ibfk_1` FOREIGN KEY (`TcRevi_id`) REFERENCES `TcRevi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TcDeta_ibfk_2` FOREIGN KEY (`TcAspe_id`) REFERENCES `TcAspe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TcRevi`
--
ALTER TABLE `TcRevi`
  ADD CONSTRAINT `TcRevi_ibfk_1` FOREIGN KEY (`GbSucu_id`) REFERENCES `GbSucu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TcRevi_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `TcRuta`
--
ALTER TABLE `TcRuta`
  ADD CONSTRAINT `TcRuta_ibfk_1` FOREIGN KEY (`CtCont_id`) REFERENCES `CtCont` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
