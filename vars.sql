-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-07-2012 a las 08:43:06
-- Versión del servidor: 5.1.63
-- Versión de PHP: 5.3.6-13ubuntu3.8

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
-- Estructura de tabla para la tabla `GbVars`
--

DROP TABLE IF EXISTS `GbVars`;
CREATE TABLE IF NOT EXISTS `GbVars` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `valor` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `GbVars`
--

INSERT INTO `GbVars` (`id`, `tipo`, `nombre`, `valor`) VALUES
(1, 'M', 'msdic', 'ctcont=>Contratos|-|asprot=>Asistente De Protocolos|-|index=>Ingresar|-|new=>Nuevo|-|delproto=>Eliminar Protocolo'),
(2, 'S', 'asprot', 'Asistente De Protocolos|-|*|-|asprot/index|:|asprot/getpuesto|:|asprot/newpuesto|:|asprot/newprotocolo|:|asprot/getques|:|asprot/delques|:|asprot/addques|:|asprot/getproceso|:|asprot/addproto|:|asprot/delproto'),
(3, 'S', 'assecu', 'Asistente De Seguridad|-|*|-|assecu/index|:|assecu/addcargo|:|assecu/addusua|:|assecu/getcargo|:|assecu/getpers|:|assecu/getusua|:|assecu/getact|:|assecu/addacl|:|assecu/delacl|:|assecu/getacl|:|gbpers/new|:|gbpers/create'),
(4, 'S', 'asubic', 'Asistente De Ubicaciones|-|*|-|asubic/index|:|asubic/getprovs|:|asubic/getpaises|:|asubic/addpais|:|asubic/addprov|:|asubic/getciuds|:|asubic/addciud|:|asubic/delciud'),
(5, 'S', 'ctcont', 'Contratos|-|!|-|ctcont/index=>Ingresar|:|ctcont/show=>Ver|:|ctcont/new=>Nuevo|:|ctcont/create=>Guardar|:|ctcont/edit=>Editar|:|ctcont/update=>Actualizar|:|ctcont/delete=>Borrar'),
(6, 'S', 'ctcoti', 'Presupuestos|-|!|-|ctcoti/index=>Ingresar|:|ctcoti/show=>Ver|:|ctcoti/new=>Nuevo|:|ctcoti/create=>Guardar|:|ctcoti/edit=>Editar|:|ctcoti/update=>Actualizar|:|ctcoti/delete=>Borrar'),
(7, 'S', 'ctfact', 'Facturas|-|!|-|ctfact/index=>Ingresar|:|ctfact/show=>Ver|:|ctfact/new=>Nuevo|:|ctfact/create=>Guardar|:|ctfact/edit=>Editar|:|ctfact/update=>Actualizar|:|ctfact/delete=>Borrar'),
(8, 'S', 'ctserv', 'Servicios|-|!|-|ctserv/index=>Ingresar|:|ctserv/show=>Ver|:|ctserv/new=>Nuevo|:|ctserv/create=>Guardar|:|ctserv/edit=>Editar|:|ctserv/update=>Actualizar|:|ctserv/delete=>Borrar'),
(9, 'S', 'cttari', 'Tarifas|-|!|-|cttari/index=>Ingresar|:|cttari/show=>Ver|:|cttari/new=>Nuevo|:|cttari/create=>Guardar|:|cttari/edit=>Editar|:|cttari/update=>Actualizar|:|cttari/delete=>Borrar'),
(10, 'S', 'gbacls', 'Control de Acceso|-|!|-|gbacls/index=>Ingresar|:|gbacls/show=>Ver|:|gbacls/new=>Nuevo|:|gbacls/create=>Guardar|:|gbacls/edit=>Editar|:|gbacls/update=>Actualizar|:|gbacls/delete=>Borrar'),
(11, 'S', 'gbcarg', 'Cargos|-|!|-|gbcarg/index=>Ingresar|:|gbcarg/show=>Ver|:|gbcarg/new=>Nuevo|:|gbcarg/create=>Guardar|:|gbcarg/edit=>Editar|:|gbcarg/update=>Actualizar|:|gbcarg/delete=>Borrar'),
(12, 'S', 'gbciud', 'Ciudades|-|!|-|gbciud/index=>Ingresar|:|gbciud/show=>Ver|:|gbciud/new=>Nuevo|:|gbciud/create=>Guardar|:|gbciud/edit=>Editar|:|gbciud/update=>Actualizar|:|gbciud/delete=>Borrar'),
(13, 'S', 'gbcnae', 'Actividad Económica|-|!|-|gbcnae/index=>Ingresar|:|gbcnae/show=>Ver|:|gbcnae/new=>Nuevo|:|gbcnae/create=>Guardar|:|gbcnae/edit=>Editar|:|gbcnae/update=>Actualizar|:|gbcnae/delete=>Borrar'),
(14, 'S', 'gbcorp', 'Corporaciones|-|!|-|gbcorp/index=>Ingresar|:|gbcorp/show=>Ver|:|gbcorp/new=>Nuevo|:|gbcorp/create=>Guardar|:|gbcorp/edit=>Editar|:|gbcorp/update=>Actualizar|:|gbcorp/delete=>Borrar'),
(15, 'S', 'gbdepa', 'Províncias|-|!|-|gbdepa/index=>Ingresar|:|gbdepa/show=>Ver|:|gbdepa/new=>Nuevo|:|gbdepa/create=>Guardar|:|gbdepa/edit=>Editar|:|gbdepa/update=>Actualizar|:|gbdepa/delete=>Borrar'),
(16, 'S', 'gbempr', 'Empresas|-|!|-|gbempr/index=>Ingresar|:|gbempr/show=>Ver|:|gbempr/new=>Nuevo|:|gbempr/create=>Guardar|:|gbempr/edit=>Editar|:|gbempr/update=>Actualizar|:|gbempr/delete=>Borrar'),
(17, 'S', 'gbiden', 'Identificaciones|-|!|-|gbiden/index=>Ingresar|:|gbiden/show=>Ver|:|gbiden/new=>Nuevo|:|gbiden/create=>Guardar|:|gbiden/edit=>Editar|:|gbiden/update=>Actualizar|:|gbiden/delete=>Borrar'),
(18, 'S', 'gblogr', 'Logs|-|!|-|gblogr/index=>Ingresar'),
(19, 'S', 'gbpais', 'Países|-|!|-|gbpais/index=>Ingresar|:|gbpais/show=>Ver|:|gbpais/new=>Nuevo|:|gbpais/create=>Guardar|:|gbpais/edit=>Editar|:|gbpais/update=>Actualizar|:|gbpais/delete=>Borrar'),
(20, 'S', 'gbpers', 'Personal|-|!|-|gbpers/index=>Ingresar|:|gbpers/show=>Ver|:|gbpers/new=>Nuevo|:|gbpers/create=>Guardar|:|gbpers/edit=>Editar|:|gbpers/update=>Actualizar|:|gbpers/delete=>Borrar'),
(21, 'S', 'gbptra', 'Puestos de Trabajo|-|!|-|gbptra/index=>Ingresar|:|gbptra/show=>Ver|:|gbptra/new=>Nuevo|:|gbptra/create=>Guardar|:|gbptra/edit=>Editar|:|gbptra/update=>Actualizar|:|gbptra/delete=>Borrar'),
(22, 'S', 'gbsucu', 'Sucursales|-|!|-|gbsucu/index=>Ingresar|:|gbsucu/show=>Ver|:|gbsucu/new=>Nuevo|:|gbsucu/create=>Guardar|:|gbsucu/edit=>Editar|:|gbsucu/update=>Actualizar|:|gbsucu/delete=>Borrar'),
(23, 'S', 'gbusua', 'Usuarios|-|!|-|gbusua/index=>Ingresar|:|gbusua/show=>Ver|:|gbusua/new=>Nuevo|:|gbusua/create=>Guardar|:|gbusua/edit=>Editar|:|gbusua/update=>Actualizar|:|gbusua/delete=>Borrar'),
(24, 'S', 'hsfami', 'Antecedentes Familiares|-|!|-|hsfami/index=>Ingresar|:|hsfami/show=>Ver|:|hsfami/new=>Nuevo|:|hsfami/create=>Guardar|:|hsfami/edit=>Editar|:|hsfami/update=>Actualizar|:|hsfami/delete=>Borrar'),
(25, 'S', 'hslabo', 'Antecedentes Laborales|-|!|-|hslabo/index=>Ingresar|:|hslabo/show=>Ver|:|hslabo/new=>Nuevo|:|hslabo/create=>Guardar|:|hslabo/edit=>Editar|:|hslabo/update=>Actualizar|:|hslabo/delete=>Borrar'),
(26, 'S', 'hspers', 'Antecedentes Personales|-|!|-|hspers/index=>Ingresar|:|hspers/show=>Ver|:|hspers/new=>Nuevo|:|hspers/create=>Guardar|:|hspers/edit=>Editar|:|hspers/update=>Actualizar|:|hspers/delete=>Borrar'),
(27, 'S', 'mdaudi', 'Audiometrías|-|!|-|mdaudi/index=>Ingresar|:|mdaudi/show=>Ver|:|mdaudi/new=>Nuevo|:|mdaudi/create=>Guardar|:|mdaudi/edit=>Editar|:|mdaudi/update=>Actualizar|:|mdaudi/delete=>Borrar'),
(28, 'S', 'mdbiom', 'Biometrías|-|!|-|mdbiom/index=>Ingresar|:|mdbiom/show=>Ver|:|mdbiom/new=>Nuevo|:|mdbiom/create=>Guardar|:|mdbiom/edit=>Editar|:|mdbiom/update=>Actualizar|:|mdbiom/delete=>Borrar'),
(29, 'S', 'mddiag', 'Diagnósticos|-|!|-|mddiag/index=>Ingresar|:|mddiag/show=>Ver|:|mddiag/new=>Nuevo|:|mddiag/create=>Guardar|:|mddiag/edit=>Editar|:|mddiag/update=>Actualizar|:|mddiag/delete=>Borrar'),
(30, 'S', 'mdespi', 'Espirometrías|-|!|-|mdespi/index=>Ingresar|:|mdespi/show=>Ver|:|mdespi/new=>Nuevo|:|mdespi/create=>Guardar|:|mdespi/edit=>Editar|:|mdespi/update=>Actualizar|:|mdespi/delete=>Borrar'),
(31, 'S', 'mdexam', 'Exámenes|-|!|-|mdexam/index=>Ingresar|:|mdexam/show=>Ver|:|mdexam/new=>Nuevo|:|mdexam/create=>Guardar|:|mdexam/edit=>Editar|:|mdexam/update=>Actualizar|:|mdexam/delete=>Borrar'),
(32, 'S', 'mdextr', 'Extremidades|-|!|-|mdextr/index=>Ingresar|:|mdextr/show=>Ver|:|mdextr/new=>Nuevo|:|mdextr/create=>Guardar|:|mdextr/edit=>Editar|:|mdextr/update=>Actualizar|:|mdextr/delete=>Borrar'),
(33, 'S', 'mdhist', 'Hístorias|-|!|-|mdhist/index=>Ingresar|:|mdhist/show=>Ver|:|mdhist/new=>Nuevo|:|mdhist/create=>Guardar|:|mdhist/edit=>Editar|:|mdhist/update=>Actualizar|:|mdhist/delete=>Borrar'),
(34, 'S', 'mdlabo', 'Ordenes de Laboratorio|-|!|-|mdlabo/index=>Ingresar|:|mdlabo/show=>Ver|:|mdlabo/new=>Nuevo|:|mdlabo/create=>Guardar|:|mdlabo/edit=>Editar|:|mdlabo/update=>Actualizar|:|mdlabo/delete=>Borrar'),
(35, 'S', 'mdpaci', 'Pacientes|-|!|-|mdpaci/index=>Ingresar|:|mdpaci/show=>Ver|:|mdpaci/new=>Nuevo|:|mdpaci/create=>Guardar|:|mdpaci/edit=>Editar|:|mdpaci/update=>Actualizar|:|mdpaci/delete=>Borrar'),
(36, 'S', 'mdpato', 'Patologías|-|!|-|mdpato/index=>Ingresar|:|mdpato/show=>Ver|:|mdpato/new=>Nuevo|:|mdpato/create=>Guardar|:|mdpato/edit=>Editar|:|mdpato/update=>Actualizar|:|mdpato/delete=>Borrar'),
(37, 'S', 'mdproc', 'Procedimientos|-|!|-|mdproc/index=>Ingresar|:|mdproc/show=>Ver|:|mdproc/new=>Nuevo|:|mdproc/create=>Guardar|:|mdproc/edit=>Editar|:|mdproc/update=>Actualizar|:|mdproc/delete=>Borrar'),
(38, 'S', 'mdprot', 'Protocolos|-|!|-|mdprot/index=>Ingresar|:|mdprot/show=>Ver|:|mdprot/new=>Nuevo|:|mdprot/create=>Guardar|:|mdprot/edit=>Editar|:|mdprot/update=>Actualizar|:|mdprot/delete=>Borrar'),
(39, 'S', 'mdques', 'Preguntas|-|!|-|mdques/index=>Ingresar|:|mdques/show=>Ver|:|mdques/new=>Nuevo|:|mdques/create=>Guardar|:|mdques/edit=>Editar|:|mdques/update=>Actualizar|:|mdques/delete=>Borrar'),
(40, 'S', 'mdresp', 'Respuestas|-|!|-|mdresp/index=>Ingresar|:|mdresp/show=>Ver|:|mdresp/new=>Nuevo|:|mdresp/create=>Guardar|:|mdresp/edit=>Editar|:|mdresp/update=>Actualizar|:|mdresp/delete=>Borrar'),
(41, 'S', 'mdsist', 'Revisión Sistemas|-|!|-|mdsist/index=>Ingresar|:|mdsist/show=>Ver|:|mdsist/new=>Nuevo|:|mdsist/create=>Guardar|:|mdsist/edit=>Editar|:|mdsist/update=>Actualizar|:|mdsist/delete=>Borrar'),
(42, 'S', 'mdvisu', 'Agudeza Visual|-|!|-|mdvisu/index=>Ingresar|:|mdvisu/show=>Ver|:|mdvisu/new=>Nuevo|:|mdvisu/create=>Guardar|:|mdvisu/edit=>Editar|:|mdvisu/update=>Actualizar|:|mdvisu/delete=>Borrar'),
(43, 'S', 'tcaspe', 'Aspectos Técnicos|-|!|-|tcaspe/index=>Ingresar|:|tcaspe/show=>Ver|:|tcaspe/new=>Nuevo|:|tcaspe/create=>Guardar|:|tcaspe/edit=>Editar|:|tcaspe/update=>Actualizar|:|tcaspe/delete=>Borrar'),
(44, 'S', 'tccapa', 'Capacitaciones|-|!|-|tccapa/index=>Ingresar|:|tccapa/show=>Ver|:|tccapa/new=>Nuevo|:|tccapa/create=>Guardar|:|tccapa/edit=>Editar|:|tccapa/update=>Actualizar|:|tccapa/delete=>Borrar'),
(45, 'S', 'tcchec', 'Lista de Chequeo|-|!|-|tcchec/index=>Ingresar|:|tcchec/show=>Ver|:|tcchec/new=>Nuevo|:|tcchec/create=>Guardar|:|tcchec/edit=>Editar|:|tcchec/update=>Actualizar|:|tcchec/delete=>Borrar'),
(46, 'S', 'tccurs', 'Cursos|-|!|-|tccurs/index=>Ingresar|:|tccurs/show=>Ver|:|tccurs/new=>Nuevo|:|tccurs/create=>Guardar|:|tccurs/edit=>Editar|:|tccurs/update=>Actualizar|:|tccurs/delete=>Borrar'),
(47, 'S', 'tcdeta', 'Detalles|-|!|-|tcdeta/index=>Ingresar|:|tcdeta/show=>Ver|:|tcdeta/new=>Nuevo|:|tcdeta/create=>Guardar|:|tcdeta/edit=>Editar|:|tcdeta/update=>Actualizar|:|tcdeta/delete=>Borrar'),
(48, 'S', 'tcrevi', 'Revisión Técnica|-|!|-|tcrevi/index=>Ingresar|:|tcrevi/show=>Ver|:|tcrevi/new=>Nuevo|:|tcrevi/create=>Guardar|:|tcrevi/edit=>Editar|:|tcrevi/update=>Actualizar|:|tcrevi/delete=>Borrar'),
(49, 'S', 'tcruta', 'Hoja de Ruta|-|!|-|tcruta/index=>Ingresar|:|tcruta/show=>Ver|:|tcruta/new=>Nuevo|:|tcruta/create=>Guardar|:|tcruta/edit=>Editar|:|tcruta/update=>Actualizar|:|tcruta/delete=>Borrar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
