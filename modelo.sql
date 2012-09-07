-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbsalud
-- ------------------------------------------------------
-- Server version	5.5.24-7

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CtCont`
--

DROP TABLE IF EXISTS `CtCont`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CtCont` (
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
  KEY `LegalGbCiud_id` (`LegalGbCiud_id`),
  CONSTRAINT `CtCont_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtCont_ibfk_3` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtCont_ibfk_5` FOREIGN KEY (`ContratanteGbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtCont_ibfk_6` FOREIGN KEY (`ContratistaGbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtCont_ibfk_7` FOREIGN KEY (`FirmaGbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtCont_ibfk_8` FOREIGN KEY (`LegalGbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CtCont`
--

LOCK TABLES `CtCont` WRITE;
/*!40000 ALTER TABLE `CtCont` DISABLE KEYS */;
/*!40000 ALTER TABLE `CtCont` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CtCoti`
--

DROP TABLE IF EXISTS `CtCoti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CtCoti` (
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
  KEY `GbEmpr_id` (`GbEmpr_id`),
  CONSTRAINT `CtCoti_ibfk_1` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CtCoti`
--

LOCK TABLES `CtCoti` WRITE;
/*!40000 ALTER TABLE `CtCoti` DISABLE KEYS */;
/*!40000 ALTER TABLE `CtCoti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CtFact`
--

DROP TABLE IF EXISTS `CtFact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CtFact` (
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
  KEY `CtCont` (`CtCont_id`),
  CONSTRAINT `CtFact_ibfk_1` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtFact_ibfk_2` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtFact_ibfk_3` FOREIGN KEY (`CtCont_id`) REFERENCES `CtCont` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CtFact`
--

LOCK TABLES `CtFact` WRITE;
/*!40000 ALTER TABLE `CtFact` DISABLE KEYS */;
/*!40000 ALTER TABLE `CtFact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CtServ`
--

DROP TABLE IF EXISTS `CtServ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CtServ` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `iva` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `tipo` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CtServ`
--

LOCK TABLES `CtServ` WRITE;
/*!40000 ALTER TABLE `CtServ` DISABLE KEYS */;
/*!40000 ALTER TABLE `CtServ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CtTari`
--

DROP TABLE IF EXISTS `CtTari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CtTari` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `CtServ_id` int(10) unsigned NOT NULL,
  `CtCont_id` bigint(99) unsigned NOT NULL,
  `valor` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CtServ_id` (`CtServ_id`),
  KEY `CtCont_id` (`CtCont_id`),
  CONSTRAINT `CtTari_ibfk_1` FOREIGN KEY (`CtServ_id`) REFERENCES `CtServ` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CtTari_ibfk_2` FOREIGN KEY (`CtCont_id`) REFERENCES `CtCont` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CtTari`
--

LOCK TABLES `CtTari` WRITE;
/*!40000 ALTER TABLE `CtTari` DISABLE KEYS */;
/*!40000 ALTER TABLE `CtTari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbAcls`
--

DROP TABLE IF EXISTS `GbAcls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbAcls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `GbUsua_id` bigint(99) unsigned NOT NULL,
  `modulo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `accion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbUsua_id` (`GbUsua_id`),
  CONSTRAINT `GbAcls_ibfk_1` FOREIGN KEY (`GbUsua_id`) REFERENCES `GbUsua` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbAcls`
--

LOCK TABLES `GbAcls` WRITE;
/*!40000 ALTER TABLE `GbAcls` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbAcls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbCarg`
--

DROP TABLE IF EXISTS `GbCarg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbCarg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCarg`
--

LOCK TABLES `GbCarg` WRITE;
/*!40000 ALTER TABLE `GbCarg` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbCarg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbCiud`
--

DROP TABLE IF EXISTS `GbCiud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbCiud` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `GbDepa_id` int(5) unsigned NOT NULL,
  `codigo` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `GbDepa_id` (`GbDepa_id`),
  CONSTRAINT `GbCiud_ibfk_1` FOREIGN KEY (`GbDepa_id`) REFERENCES `GbDepa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCiud`
--

LOCK TABLES `GbCiud` WRITE;
/*!40000 ALTER TABLE `GbCiud` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbCiud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbCnae`
--

DROP TABLE IF EXISTS `GbCnae`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbCnae` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `act_econ` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alternativo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCnae`
--

LOCK TABLES `GbCnae` WRITE;
/*!40000 ALTER TABLE `GbCnae` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbCnae` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbCorp`
--

DROP TABLE IF EXISTS `GbCorp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbCorp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `EmpresaGbIden_id` tinyint(2) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rplegal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `identrplegal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `RepresentanteGbIden_id` tinyint(2) unsigned NOT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GbCiud_id` int(5) unsigned NOT NULL,
  `telefono` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `EmpresaGbIden_id` (`EmpresaGbIden_id`),
  KEY `RepresentanteGbIden_id` (`RepresentanteGbIden_id`),
  KEY `GbCiud_id` (`GbCiud_id`),
  CONSTRAINT `GbCorp_ibfk_1` FOREIGN KEY (`EmpresaGbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbCorp_ibfk_2` FOREIGN KEY (`RepresentanteGbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbCorp_ibfk_3` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCorp`
--

LOCK TABLES `GbCorp` WRITE;
/*!40000 ALTER TABLE `GbCorp` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbCorp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbDepa`
--

DROP TABLE IF EXISTS `GbDepa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbDepa` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `GbPais_id` int(5) unsigned NOT NULL,
  `codigo` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `GbPais_id` (`GbPais_id`),
  CONSTRAINT `GbDepa_ibfk_1` FOREIGN KEY (`GbPais_id`) REFERENCES `GbPais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbDepa`
--

LOCK TABLES `GbDepa` WRITE;
/*!40000 ALTER TABLE `GbDepa` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbDepa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbEmpr`
--

DROP TABLE IF EXISTS `GbEmpr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbEmpr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `tipoide` tinyint(2) unsigned NOT NULL,
  `GbCnae_id` int(10) unsigned NOT NULL,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rplegal` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `identrplegal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `web` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  KEY `GbCnae_id` (`GbCnae_id`),
  KEY `tipoide` (`tipoide`),
  CONSTRAINT `GbEmpr_ibfk_1` FOREIGN KEY (`GbCnae_id`) REFERENCES `GbCnae` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbEmpr_ibfk_2` FOREIGN KEY (`tipoide`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbEmpr`
--

LOCK TABLES `GbEmpr` WRITE;
/*!40000 ALTER TABLE `GbEmpr` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbEmpr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbIden`
--

DROP TABLE IF EXISTS `GbIden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbIden` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbIden`
--

LOCK TABLES `GbIden` WRITE;
/*!40000 ALTER TABLE `GbIden` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbIden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbLogr`
--

DROP TABLE IF EXISTS `GbLogr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbLogr` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `GbUsua_id` bigint(99) unsigned NOT NULL,
  `modulo` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `accion` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbUsua_id` (`GbUsua_id`),
  CONSTRAINT `GbLogr_ibfk_1` FOREIGN KEY (`GbUsua_id`) REFERENCES `GbUsua` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbLogr`
--

LOCK TABLES `GbLogr` WRITE;
/*!40000 ALTER TABLE `GbLogr` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbLogr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbPais`
--

DROP TABLE IF EXISTS `GbPais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbPais` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbPais`
--

LOCK TABLES `GbPais` WRITE;
/*!40000 ALTER TABLE `GbPais` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbPais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbPers`
--

DROP TABLE IF EXISTS `GbPers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbPers` (
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
  `numcolegiado` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ingreso` date NOT NULL,
  `pdatos` tinyint(1) unsigned NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`identificacion`),
  KEY `GbSucu_id` (`GbSucu_id`),
  KEY `GbCiud_id` (`GbCiud_id`),
  KEY `GbIden_id` (`GbIden_id`),
  KEY `GbCarg_id` (`GbCarg_id`),
  CONSTRAINT `GbPers_ibfk_1` FOREIGN KEY (`GbSucu_id`) REFERENCES `GbSucu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbPers_ibfk_2` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbPers_ibfk_3` FOREIGN KEY (`GbIden_id`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbPers_ibfk_4` FOREIGN KEY (`GbCarg_id`) REFERENCES `GbCarg` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbPers`
--

LOCK TABLES `GbPers` WRITE;
/*!40000 ALTER TABLE `GbPers` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbPers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbPtra`
--

DROP TABLE IF EXISTS `GbPtra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbPtra` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GbEmpr_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbEmpr_id` (`GbEmpr_id`),
  CONSTRAINT `GbPtra_ibfk_1` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbPtra`
--

LOCK TABLES `GbPtra` WRITE;
/*!40000 ALTER TABLE `GbPtra` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbPtra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbSucu`
--

DROP TABLE IF EXISTS `GbSucu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbSucu` (
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
  KEY `GbEmpr_id` (`GbEmpr_id`),
  CONSTRAINT `GbSucu_ibfk_1` FOREIGN KEY (`GbEmpr_id`) REFERENCES `GbEmpr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GbSucu_ibfk_2` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbSucu`
--

LOCK TABLES `GbSucu` WRITE;
/*!40000 ALTER TABLE `GbSucu` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbSucu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbUsua`
--

DROP TABLE IF EXISTS `GbUsua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbUsua` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `GbPers_id` (`GbPers_id`),
  CONSTRAINT `GbUsua_ibfk_1` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbUsua`
--

LOCK TABLES `GbUsua` WRITE;
/*!40000 ALTER TABLE `GbUsua` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbUsua` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GbVars`
--

DROP TABLE IF EXISTS `GbVars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GbVars` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `valor` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbVars`
--

LOCK TABLES `GbVars` WRITE;
/*!40000 ALTER TABLE `GbVars` DISABLE KEYS */;
/*!40000 ALTER TABLE `GbVars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HsFami`
--

DROP TABLE IF EXISTS `HsFami`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HsFami` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `MdPato_id` bigint(99) unsigned NOT NULL,
  `familiar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  KEY `MdPato_id` (`MdPato_id`),
  CONSTRAINT `HsFami_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `HsFami_ibfk_2` FOREIGN KEY (`MdPato_id`) REFERENCES `MdPato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HsFami`
--

LOCK TABLES `HsFami` WRITE;
/*!40000 ALTER TABLE `HsFami` DISABLE KEYS */;
/*!40000 ALTER TABLE `HsFami` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HsLabo`
--

DROP TABLE IF EXISTS `HsLabo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HsLabo` (
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
  KEY `MdPaci_id` (`MdPaci_id`),
  CONSTRAINT `HsLabo_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HsLabo`
--

LOCK TABLES `HsLabo` WRITE;
/*!40000 ALTER TABLE `HsLabo` DISABLE KEYS */;
/*!40000 ALTER TABLE `HsLabo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HsPers`
--

DROP TABLE IF EXISTS `HsPers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HsPers` (
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
  `tetano` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tetanofecha` date DEFAULT NULL,
  `tetanodosis` text COLLATE utf8_unicode_ci,
  `observaciones` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  CONSTRAINT `HsPers_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HsPers`
--

LOCK TABLES `HsPers` WRITE;
/*!40000 ALTER TABLE `HsPers` DISABLE KEYS */;
/*!40000 ALTER TABLE `HsPers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdAudi`
--

DROP TABLE IF EXISTS `MdAudi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdAudi` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `realizado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `d500` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i500` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d1000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i1000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d2000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i2000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d3000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i3000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d4000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i4000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d6000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i6000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d8000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i8000` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdAudi_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdAudi`
--

LOCK TABLES `MdAudi` WRITE;
/*!40000 ALTER TABLE `MdAudi` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdAudi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdBiom`
--

DROP TABLE IF EXISTS `MdBiom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdBiom` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `talla` decimal(5,2) unsigned NOT NULL,
  `peso` decimal(5,2) unsigned NOT NULL,
  `pulso` decimal(5,2) unsigned NOT NULL,
  `fres` decimal(5,2) unsigned NOT NULL,
  `pasisto` decimal(5,2) unsigned NOT NULL,
  `padiasto` decimal(5,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdBiom_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdBiom`
--

LOCK TABLES `MdBiom` WRITE;
/*!40000 ALTER TABLE `MdBiom` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdBiom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdDiag`
--

DROP TABLE IF EXISTS `MdDiag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdDiag` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `MdPato_id` bigint(99) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  KEY `MdPato_id` (`MdPato_id`),
  CONSTRAINT `MdDiag_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdDiag_ibfk_2` FOREIGN KEY (`MdPato_id`) REFERENCES `MdPato` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdDiag`
--

LOCK TABLES `MdDiag` WRITE;
/*!40000 ALTER TABLE `MdDiag` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdDiag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdEspi`
--

DROP TABLE IF EXISTS `MdEspi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdEspi` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `realizado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cv` decimal(3,2) DEFAULT NULL,
  `vems` decimal(3,2) DEFAULT NULL,
  `tiff` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdEspi_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdEspi`
--

LOCK TABLES `MdEspi` WRITE;
/*!40000 ALTER TABLE `MdEspi` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdEspi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdExam`
--

DROP TABLE IF EXISTS `MdExam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdExam` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alternativo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdExam`
--

LOCK TABLES `MdExam` WRITE;
/*!40000 ALTER TABLE `MdExam` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdExam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdExtr`
--

DROP TABLE IF EXISTS `MdExtr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdExtr` (
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
  `pdmov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pimov` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pddef` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pidef` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `pdins` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `piins` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdExtr_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdExtr`
--

LOCK TABLES `MdExtr` WRITE;
/*!40000 ALTER TABLE `MdExtr` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdExtr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdHist`
--

DROP TABLE IF EXISTS `MdHist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdHist` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `TcRuta_id` bigint(99) unsigned NOT NULL,
  `MdPaci_id` bigint(99) unsigned NOT NULL,
  `GbPers_id` bigint(99) unsigned NOT NULL,
  `genero` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `menstru` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  KEY `GbPers_id` (`GbPers_id`),
  KEY `TcRuta_id` (`TcRuta_id`),
  CONSTRAINT `MdHist_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdHist_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdHist_ibfk_3` FOREIGN KEY (`TcRuta_id`) REFERENCES `TcRuta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdHist`
--

LOCK TABLES `MdHist` WRITE;
/*!40000 ALTER TABLE `MdHist` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdHist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdLabo`
--

DROP TABLE IF EXISTS `MdLabo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdLabo` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `CtServ_id` int(10) unsigned NOT NULL,
  `MdExam_id` int(10) unsigned NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'O',
  `resultado` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  KEY `CtServ_id` (`CtServ_id`),
  KEY `GbLabo_id` (`MdExam_id`),
  CONSTRAINT `MdLabo_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdLabo_ibfk_2` FOREIGN KEY (`CtServ_id`) REFERENCES `CtServ` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdLabo_ibfk_3` FOREIGN KEY (`MdExam_id`) REFERENCES `MdExam` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdLabo`
--

LOCK TABLES `MdLabo` WRITE;
/*!40000 ALTER TABLE `MdLabo` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdLabo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdPaci`
--

DROP TABLE IF EXISTS `MdPaci`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdPaci` (
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
  `telefono` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GbPtra_id` bigint(99) unsigned NOT NULL,
  `ingreso` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`identificacion`),
  KEY `GbCiud_id` (`GbCiud_id`),
  KEY `GbPtra_id` (`GbPtra_id`),
  KEY `GbSucu_id` (`GbSucu_id`),
  KEY `tipoide` (`tipoide`),
  CONSTRAINT `MdPaci_ibfk_1` FOREIGN KEY (`GbCiud_id`) REFERENCES `GbCiud` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdPaci_ibfk_2` FOREIGN KEY (`GbPtra_id`) REFERENCES `GbPtra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdPaci_ibfk_3` FOREIGN KEY (`GbSucu_id`) REFERENCES `GbSucu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdPaci_ibfk_4` FOREIGN KEY (`tipoide`) REFERENCES `GbIden` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdPaci`
--

LOCK TABLES `MdPaci` WRITE;
/*!40000 ALTER TABLE `MdPaci` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdPaci` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdPato`
--

DROP TABLE IF EXISTS `MdPato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdPato` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `alternativo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdPato`
--

LOCK TABLES `MdPato` WRITE;
/*!40000 ALTER TABLE `MdPato` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdPato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdProc`
--

DROP TABLE IF EXISTS `MdProc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdProc` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `GbPtra_id` bigint(99) unsigned NOT NULL,
  `MdProt_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `GbPtra_id` (`GbPtra_id`),
  KEY `MdProt_id` (`MdProt_id`),
  CONSTRAINT `MdProc_ibfk_1` FOREIGN KEY (`MdProt_id`) REFERENCES `MdProt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdProc_ibfk_2` FOREIGN KEY (`GbPtra_id`) REFERENCES `GbPtra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdProc`
--

LOCK TABLES `MdProc` WRITE;
/*!40000 ALTER TABLE `MdProc` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdProc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdProt`
--

DROP TABLE IF EXISTS `MdProt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdProt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdProt`
--

LOCK TABLES `MdProt` WRITE;
/*!40000 ALTER TABLE `MdProt` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdProt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdQues`
--

DROP TABLE IF EXISTS `MdQues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdQues` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdProt_id` int(11) unsigned NOT NULL,
  `pregunta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdProt_id` (`MdProt_id`),
  CONSTRAINT `MdQues_ibfk_1` FOREIGN KEY (`MdProt_id`) REFERENCES `MdProt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdQues`
--

LOCK TABLES `MdQues` WRITE;
/*!40000 ALTER TABLE `MdQues` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdQues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdResp`
--

DROP TABLE IF EXISTS `MdResp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdResp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `MdQues_id` bigint(20) unsigned NOT NULL,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `resultado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `MdQues_id` (`MdQues_id`),
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdResp_ibfk_1` FOREIGN KEY (`MdQues_id`) REFERENCES `MdQues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdResp_ibfk_2` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdResp`
--

LOCK TABLES `MdResp` WRITE;
/*!40000 ALTER TABLE `MdResp` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdResp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdSist`
--

DROP TABLE IF EXISTS `MdSist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdSist` (
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
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdSist_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdSist`
--

LOCK TABLES `MdSist` WRITE;
/*!40000 ALTER TABLE `MdSist` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdSist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MdVisu`
--

DROP TABLE IF EXISTS `MdVisu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MdVisu` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `MdHist_id` bigint(99) unsigned NOT NULL,
  `lentes` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `lentesprueba` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `miopia` tinyint(1) NOT NULL,
  `hipermetropia` tinyint(1) NOT NULL,
  `astigmatismo` tinyint(1) NOT NULL,
  `bif` tinyint(1) NOT NULL,
  `lent` tinyint(1) NOT NULL,
  `vcl` tinyint(1) NOT NULL,
  `vl` tinyint(1) NOT NULL,
  `vc` tinyint(1) NOT NULL,
  `vlod` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vloi` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vlao` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcod` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcoi` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `vcao` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `MdHist_id` (`MdHist_id`),
  CONSTRAINT `MdVisu_ibfk_1` FOREIGN KEY (`MdHist_id`) REFERENCES `MdHist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdVisu`
--

LOCK TABLES `MdVisu` WRITE;
/*!40000 ALTER TABLE `MdVisu` DISABLE KEYS */;
/*!40000 ALTER TABLE `MdVisu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcAspe`
--

DROP TABLE IF EXISTS `TcAspe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcAspe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `criterio` text COLLATE utf8_unicode_ci,
  `medida` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcAspe`
--

LOCK TABLES `TcAspe` WRITE;
/*!40000 ALTER TABLE `TcAspe` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcAspe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcCapa`
--

DROP TABLE IF EXISTS `TcCapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcCapa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `duracion` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcCapa`
--

LOCK TABLES `TcCapa` WRITE;
/*!40000 ALTER TABLE `TcCapa` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcCapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcChec`
--

DROP TABLE IF EXISTS `TcChec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcChec` (
  `id` bigint(99) unsigned NOT NULL AUTO_INCREMENT,
  `TcRevi_id` bigint(99) unsigned NOT NULL,
  `ntrabajadores` int(10) unsigned NOT NULL,
  `asesoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comite` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `caracteristicas` text COLLATE utf8_unicode_ci NOT NULL,
  `psensible` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `seguridad` text COLLATE utf8_unicode_ci NOT NULL,
  `mfisico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hfisico` text COLLATE utf8_unicode_ci NOT NULL,
  `mquimico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hquimico` text COLLATE utf8_unicode_ci NOT NULL,
  `mbiologico` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `hbiologico` text COLLATE utf8_unicode_ci NOT NULL,
  `rangocargas` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `cargas` text COLLATE utf8_unicode_ci NOT NULL,
  `carretilleros` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `repetitivos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `ett` tinyint(1) NOT NULL,
  `limpieza` tinyint(1) NOT NULL,
  `mantenimiento` tinyint(1) NOT NULL,
  `otros` tinyint(1) NOT NULL,
  `emergencia` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `simulacros` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `planos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `eplanos` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `textintor` char(3) COLLATE utf8_unicode_ci NOT NULL,
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
  KEY `TcRevi_id` (`TcRevi_id`),
  CONSTRAINT `TcChec_ibfk_1` FOREIGN KEY (`TcRevi_id`) REFERENCES `TcRevi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcChec`
--

LOCK TABLES `TcChec` WRITE;
/*!40000 ALTER TABLE `TcChec` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcChec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcCurs`
--

DROP TABLE IF EXISTS `TcCurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcCurs` (
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
  KEY `TcCapa_id` (`TcCapa_id`),
  CONSTRAINT `TcCurs_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `TcCurs_ibfk_2` FOREIGN KEY (`TcCapa_id`) REFERENCES `TcCapa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcCurs`
--

LOCK TABLES `TcCurs` WRITE;
/*!40000 ALTER TABLE `TcCurs` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcCurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcDeta`
--

DROP TABLE IF EXISTS `TcDeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcDeta` (
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
  KEY `TcAspe_id` (`TcAspe_id`),
  CONSTRAINT `TcDeta_ibfk_1` FOREIGN KEY (`TcRevi_id`) REFERENCES `TcRevi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `TcDeta_ibfk_2` FOREIGN KEY (`TcAspe_id`) REFERENCES `TcAspe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcDeta`
--

LOCK TABLES `TcDeta` WRITE;
/*!40000 ALTER TABLE `TcDeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcDeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcRevi`
--

DROP TABLE IF EXISTS `TcRevi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcRevi` (
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
  KEY `GbPers_id` (`GbPers_id`),
  CONSTRAINT `TcRevi_ibfk_1` FOREIGN KEY (`GbSucu_id`) REFERENCES `GbSucu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `TcRevi_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcRevi`
--

LOCK TABLES `TcRevi` WRITE;
/*!40000 ALTER TABLE `TcRevi` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcRevi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TcRuta`
--

DROP TABLE IF EXISTS `TcRuta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TcRuta` (
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
  `analitica` tinyint(1) NOT NULL,
  `biometria` tinyint(1) NOT NULL,
  `audiometria` tinyint(1) NOT NULL,
  `vision` tinyint(1) NOT NULL,
  `espirometria` tinyint(1) NOT NULL,
  `medica` tinyint(1) NOT NULL,
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
  KEY `CtCont_id` (`CtCont_id`),
  CONSTRAINT `TcRuta_ibfk_1` FOREIGN KEY (`CtCont_id`) REFERENCES `CtCont` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcRuta`
--

LOCK TABLES `TcRuta` WRITE;
/*!40000 ALTER TABLE `TcRuta` DISABLE KEYS */;
/*!40000 ALTER TABLE `TcRuta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-09-07 11:36:37
