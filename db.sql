-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbsalud
-- ------------------------------------------------------
-- Server version	5.5.28-1

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CtCont`
--

LOCK TABLES `CtCont` WRITE;
/*!40000 ALTER TABLE `CtCont` DISABLE KEYS */;
INSERT INTO `CtCont` VALUES (1,2,1,'2010-03-01','2010-03-01','2015-03-31',2,'1070609877','Gerente','Monica Cortes','Cll 11 # 12-34',2,'1070818123','Gerente','Mateo Garcia','Cll 25 # 78-78',2,2,'O',0,5000000,10000000.00,9.99,0.00,15500000.00,15500000.00),(2,3,2,'2012-11-03','2012-11-30','2013-11-30',2,'909090','Gerente','Pablo Perez','Cll 11 # 12-34',3,'808080','Gerente','Marco Casas','Cll 25 # 78-78',3,3,'O',0,9000000,18000000.00,9.99,0.00,25000000.00,25000000.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbAcls`
--

LOCK TABLES `GbAcls` WRITE;
/*!40000 ALTER TABLE `GbAcls` DISABLE KEYS */;
INSERT INTO `GbAcls` VALUES (2,2,'asempr','index'),(3,3,'asempr','index'),(4,3,'asprot','index'),(5,3,'asprot','getpuesto'),(6,3,'asprot','newpuesto'),(7,3,'asprot','newprotocolo'),(8,3,'asprot','getques'),(9,3,'asprot','delques'),(10,3,'asprot','addques'),(11,3,'asprot','getproceso'),(12,3,'asprot','addproto'),(13,3,'asprot','delproto'),(14,2,'gbcarg','index'),(15,2,'gbcarg','show'),(16,2,'gbcarg','new'),(17,2,'gbcarg','create'),(18,2,'gbcarg','edit'),(19,2,'gbcarg','update'),(20,2,'gbcarg','delete'),(21,4,'asprot','index'),(22,4,'asprot','getpuesto'),(23,4,'asprot','newpuesto'),(24,4,'asprot','newprotocolo'),(25,4,'asprot','getques'),(26,4,'asprot','delques'),(27,4,'asprot','addques'),(28,4,'asprot','getproceso'),(29,4,'asprot','addproto'),(30,4,'asprot','delproto');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCarg`
--

LOCK TABLES `GbCarg` WRITE;
/*!40000 ALTER TABLE `GbCarg` DISABLE KEYS */;
INSERT INTO `GbCarg` VALUES (2,'Medico'),(1,'SYSTEM ADMIN');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCiud`
--

LOCK TABLES `GbCiud` WRITE;
/*!40000 ALTER TABLE `GbCiud` DISABLE KEYS */;
INSERT INTO `GbCiud` VALUES (1,1,'00000','SYSTEM'),(2,2,'00002','Girardot'),(3,2,'00001','Bogota');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCnae`
--

LOCK TABLES `GbCnae` WRITE;
/*!40000 ALTER TABLE `GbCnae` DISABLE KEYS */;
INSERT INTO `GbCnae` VALUES (1,'0000','NULL','NULL'),(2,'0001','Prestación de servicios','Prestación de servicios');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbCorp`
--

LOCK TABLES `GbCorp` WRITE;
/*!40000 ALTER TABLE `GbCorp` DISABLE KEYS */;
INSERT INTO `GbCorp` VALUES (1,'80800936789',3,'Vimelab SL','Quien Sabe','99999999',2,'Cll Falsa # 123',3,'09999990','09090909','mail@vimelab.com','vimelab.com','XD');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbDepa`
--

LOCK TABLES `GbDepa` WRITE;
/*!40000 ALTER TABLE `GbDepa` DISABLE KEYS */;
INSERT INTO `GbDepa` VALUES (1,1,'00','SYSTEM'),(2,2,'01','Cundinamarca');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbEmpr`
--

LOCK TABLES `GbEmpr` WRITE;
/*!40000 ALTER TABLE `GbEmpr` DISABLE KEYS */;
INSERT INTO `GbEmpr` VALUES (1,'0000',1,1,'','SYSTEM','NULL','NULL','NULL'),(2,'8080039356',3,2,'','Vimelab','Mateo Garcia','1070087911','vimelab.es'),(3,'8080058904',3,2,'D','Conasupo','Marco Casas','5859720','conasupo.com');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbIden`
--

LOCK TABLES `GbIden` WRITE;
/*!40000 ALTER TABLE `GbIden` DISABLE KEYS */;
INSERT INTO `GbIden` VALUES (1,'NULL','NULL'),(2,'CC','Cédula'),(3,'NIT','NIT');
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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbLogr`
--

LOCK TABLES `GbLogr` WRITE;
/*!40000 ALTER TABLE `GbLogr` DISABLE KEYS */;
INSERT INTO `GbLogr` VALUES (1,'2012-10-02 09:57:10',1,'Mdpaci','create ID: 1'),(2,'2012-11-09 16:48:56',1,'Gbusua','update ID: 3'),(3,'2012-11-13 13:46:06',1,'Gbpers','create ID: 2'),(4,'2012-11-13 13:46:17',1,'Gbcarg','create ID: 2'),(5,'2012-11-13 13:46:33',1,'Gbpers','update ID: 2'),(6,'2012-11-13 13:47:11',1,'Gbiden','create ID: 2'),(7,'2012-11-13 13:47:26',1,'Gbpers','update ID: 2'),(8,'2012-11-13 13:48:31',1,'Gbpers','update ID: 2'),(9,'2012-11-13 13:49:45',1,'Gbiden','create ID: 3'),(10,'2012-11-13 13:50:13',1,'Gbcnae','create ID: 2'),(11,'2012-11-13 13:51:05',1,'Gbempr','create ID: 2'),(12,'2012-11-13 13:52:23',1,'Gbsucu','create ID: 2'),(13,'2012-11-13 13:56:21',1,'Ctcont','create ID: 1'),(14,'2012-11-13 13:59:34',1,'Gbusua','update ID: 1'),(15,'2012-11-13 14:03:21',1,'Tcruta','create ID: 1'),(16,'2012-11-13 18:38:24',1,'Mdhist','create ID: 1'),(17,'2012-11-13 18:39:09',1,'Mdaudi','create ID: 1'),(18,'2012-11-14 07:46:28',1,'Gbusua','update ID: 4'),(19,'2012-11-14 14:24:30',1,'Mdpaci','create ID: 2'),(20,'2012-11-14 15:50:31',1,'Mdpaci','create ID: 3'),(21,'2012-11-14 15:52:30',1,'Mdpaci','create ID: 7'),(22,'2012-11-14 16:32:50',1,'Mdpaci','create ID: 8'),(23,'2012-11-14 16:34:46',1,'Mdpaci','create ID: 9'),(24,'2012-11-15 14:16:23',1,'Mdpaci','create ID: 10'),(25,'2012-11-15 14:38:13',1,'Mdpaci','create ID: 11'),(26,'2012-11-15 14:42:54',1,'Mdpaci','create ID: 12'),(27,'2012-11-15 14:45:34',1,'Mdpaci','create ID: 13'),(28,'2012-11-15 14:50:00',1,'Mdpaci','create ID: 14'),(29,'2012-11-15 14:52:31',1,'Mdpaci','create ID: 15'),(30,'2012-11-15 14:53:48',1,'Mdpaci','create ID: 16'),(31,'2012-11-15 14:55:24',1,'Mdpaci','create ID: 17'),(32,'2012-11-15 15:14:29',1,'Mdpaci','create ID: 18'),(33,'2012-11-15 15:17:31',1,'Mdhist','create ID: 2'),(34,'2012-11-15 16:35:02',1,'Mdhist','create ID: 3'),(35,'2012-11-20 15:24:30',1,'Mdhist','update ID: 1'),(36,'2012-11-20 15:29:13',1,'Mdhist','create ID: 4'),(37,'2012-11-20 15:29:25',1,'Mdhist','delete ID: '),(38,'2012-11-20 15:31:39',1,'Mdhist','update ID: 2'),(39,'2012-11-20 15:32:00',1,'Mdhist','update ID: 3'),(40,'2012-11-20 15:39:31',1,'Gbciud','update ID: 2'),(41,'2012-11-20 15:39:46',1,'Gbciud','update ID: 3'),(42,'2012-11-20 15:40:12',1,'Gbsucu','update ID: 2'),(43,'2012-11-20 15:49:42',1,'Gbempr','create ID: 3'),(44,'2012-11-20 15:49:59',1,'Gbempr','update ID: 3'),(45,'2012-11-20 15:50:54',1,'Gbsucu','create ID: 3'),(46,'2012-11-20 15:53:03',1,'Ctcont','create ID: 2'),(47,'2012-11-20 15:56:37',1,'Tcruta','create ID: 2'),(48,'2012-11-20 17:27:19',1,'Mdpaci','create ID: 19'),(49,'2012-11-21 15:25:41',1,'Mdhist','create ID: 20'),(50,'2012-11-21 15:25:53',1,'Mdhist','update ID: 20'),(51,'2012-11-21 15:32:43',1,'Mdhist','update ID: 20'),(52,'2012-11-21 17:17:59',1,'Mdpato','create ID: 1'),(53,'2012-11-21 17:18:10',1,'Mdpato','create ID: 2'),(54,'2012-11-21 17:18:22',1,'Mdpato','create ID: 3'),(55,'2012-11-21 17:18:34',1,'Mdpato','create ID: 4'),(56,'2012-11-21 17:18:50',1,'Mdpato','create ID: 5'),(57,'2012-11-21 17:19:05',1,'Mdpato','create ID: 6'),(58,'2012-11-21 17:32:08',1,'Mdpato','create ID: 7'),(59,'2012-11-22 17:55:06',1,'Mdaudi','create ID: 2'),(60,'2012-11-22 18:01:18',1,'Mdaudi','create ID: 3'),(61,'2012-11-22 18:02:03',1,'Mdaudi','create ID: 4'),(62,'2012-11-22 18:02:53',1,'Mdaudi','create ID: 5'),(63,'2012-11-22 18:06:15',1,'Mdaudi','create ID: 6'),(64,'2012-11-22 18:07:28',1,'Mdaudi','create ID: 7'),(65,'2012-11-22 18:08:35',1,'Mdaudi','create ID: 8'),(66,'2012-11-22 18:11:14',1,'Mdaudi','create ID: 9'),(67,'2012-11-22 18:16:36',1,'Mdaudi','create ID: 10'),(68,'2012-11-22 18:18:02',1,'Mdaudi','create ID: 11'),(69,'2012-11-22 18:22:20',1,'Mdaudi','create ID: 12'),(70,'2012-11-22 18:23:15',1,'Mdaudi','create ID: 13'),(71,'2012-11-22 18:24:29',1,'Mdaudi','create ID: 14'),(72,'2012-11-22 18:27:01',1,'Mdaudi','create ID: 15'),(73,'2012-11-22 18:27:55',1,'Mdaudi','create ID: 16'),(74,'2012-11-22 18:28:49',1,'Mdaudi','create ID: 17'),(75,'2012-11-22 18:31:06',1,'Mdaudi','create ID: 18'),(76,'2012-11-22 18:44:18',1,'Mdaudi','create ID: 19'),(77,'2012-11-22 18:46:30',1,'Mdaudi','create ID: 20'),(78,'2012-11-22 18:47:25',1,'Mdaudi','create ID: 21'),(79,'2012-11-22 18:49:29',1,'Mdaudi','create ID: 22'),(80,'2012-11-22 19:31:55',1,'Mdaudi','create ID: 23'),(81,'2012-11-23 09:45:08',1,'Mdaudi','create ID: 24'),(82,'2012-11-23 10:34:13',1,'Mdvisu','create ID: 1'),(83,'2012-11-23 10:35:06',1,'Mdvisu','create ID: 2'),(84,'2012-11-23 10:35:49',1,'Mdvisu','create ID: 3'),(85,'2012-11-23 10:38:12',1,'Mdvisu','create ID: 4'),(86,'2012-11-23 10:39:13',1,'Mdvisu','create ID: 5'),(87,'2012-11-23 10:41:08',1,'Mdaudi','create ID: 25'),(88,'2012-11-23 10:41:35',1,'Mdvisu','create ID: 6'),(89,'2012-11-23 10:43:15',1,'Mdvisu','create ID: 7'),(90,'2012-11-23 10:44:18',1,'Mdaudi','create ID: 26'),(91,'2012-11-23 10:44:57',1,'Mdvisu','create ID: 8'),(92,'2012-11-23 11:04:29',1,'Mdaudi','create ID: 27'),(93,'2012-11-23 11:05:42',1,'Mdaudi','create ID: 28'),(94,'2012-11-23 11:32:13',1,'Mdbiom','create ID: 1'),(95,'2012-11-23 11:33:15',1,'Mdbiom','create ID: 2'),(96,'2012-11-23 11:34:50',1,'Mdbiom','create ID: 3'),(97,'2012-11-23 11:35:59',1,'Mdbiom','create ID: 4'),(98,'2012-11-23 11:58:48',1,'Mdespi','create ID: 1'),(99,'2012-11-23 12:00:32',1,'Mdespi','create ID: 2'),(100,'2012-11-23 12:02:28',1,'Mdespi','create ID: 3'),(101,'2012-11-23 15:17:49',1,'Mdextr','create ID: 1'),(102,'2012-11-23 15:22:04',1,'Mdextr','create ID: 2'),(103,'2012-11-23 15:38:45',1,'Mdsist','create ID: 1'),(104,'2012-11-23 15:40:03',1,'Mdsist','create ID: 2'),(105,'2012-11-23 15:42:50',1,'Mdaudi','create ID: 29'),(106,'2012-11-23 15:43:43',1,'Mdvisu','create ID: 9'),(107,'2012-11-23 15:44:28',1,'Mdbiom','create ID: 5'),(108,'2012-11-23 15:45:04',1,'Mdespi','create ID: 4'),(109,'2012-11-23 15:46:34',1,'Mdextr','create ID: 3'),(110,'2012-11-23 15:47:14',1,'Mdsist','create ID: 3'),(111,'2012-11-23 16:40:17',1,'Gbcorp','create ID: 1'),(112,'2012-11-23 16:42:07',1,'Mdaudi','create ID: 30'),(113,'2012-11-23 16:42:22',1,'Mdvisu','create ID: 10'),(114,'2012-11-23 16:42:49',1,'Mdbiom','create ID: 6'),(115,'2012-11-23 16:43:06',1,'Mdespi','create ID: 5'),(116,'2012-11-23 16:43:36',1,'Mdextr','create ID: 4'),(117,'2012-11-23 16:43:58',1,'Mdsist','create ID: 4'),(118,'2012-11-23 16:45:23',1,'Mdsist','create ID: 5'),(119,'2012-11-23 16:46:14',1,'Mdaudi','create ID: 31'),(120,'2012-11-23 16:46:57',1,'Mdvisu','create ID: 11'),(121,'2012-11-23 16:47:19',1,'Mdbiom','create ID: 7'),(122,'2012-11-23 16:47:30',1,'Mdespi','create ID: 6'),(123,'2012-11-23 16:48:12',1,'Mdextr','create ID: 5'),(124,'2012-11-23 16:49:34',1,'Mdextr','create ID: 6'),(125,'2012-11-23 16:49:59',1,'Mdsist','create ID: 6');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbPais`
--

LOCK TABLES `GbPais` WRITE;
/*!40000 ALTER TABLE `GbPais` DISABLE KEYS */;
INSERT INTO `GbPais` VALUES (1,'000','SYSTEM'),(2,'001','Colombia');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbPers`
--

LOCK TABLES `GbPers` WRITE;
/*!40000 ALTER TABLE `GbPers` DISABLE KEYS */;
INSERT INTO `GbPers` VALUES (1,1,1,1,'0000','SYSTEM',NULL,'ADMIN',NULL,'1970-01-01','NULL','NULL','NULL',1,NULL,'1970-01-01',0,'A'),(2,1,2,2,'1070597089','Javier',NULL,'Herran',NULL,'1989-03-25','3108048435','Mz A Cs 16 Brr Juan P. II','contacto@ice-ing.co',2,'990099','2010-01-01',1,'A');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbPtra`
--

LOCK TABLES `GbPtra` WRITE;
/*!40000 ALTER TABLE `GbPtra` DISABLE KEYS */;
INSERT INTO `GbPtra` VALUES (1,'Test',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbSucu`
--

LOCK TABLES `GbSucu` WRITE;
/*!40000 ALTER TABLE `GbSucu` DISABLE KEYS */;
INSERT INTO `GbSucu` VALUES (1,1,1,'SYSTEM','NULL','NULL','NULL','NULL','NULL','NULL'),(2,2,2,'Principal','8355652','8350000','8356060','Mateo Garcia','Cll 71 # 11-05','main@vimelab.es'),(3,3,3,'Principal','7203030','7203030','7203030','Marco Casas','Cll 81 # 11-05','main@conasupo.com');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbUsua`
--

LOCK TABLES `GbUsua` WRITE;
/*!40000 ALTER TABLE `GbUsua` DISABLE KEYS */;
INSERT INTO `GbUsua` VALUES (1,2,'root','wg1HV7zlQXAkgYpMBDyviLg9jGo2eb5KuASDH0j9+pP3v9ex3lUTbf6J36lcJvxsThuE6F581+R8eiCBn1EFig=='),(2,1,'test','kLq6OoSx88MyFu0ArTsQ1NBZRYfdhvTQg0OMUV01kQ3RHgQFwgQDtM/nZGwoJYoj2iNiJfhg0csLk4qopB3oyA=='),(3,1,'pepe','iHHEIljVeJMc7TXtPnzk4MGBunjb8Z8lfNcc+yFIWZ+Mw3cNUYS5Ddx4Hxr3HkCLVPkHI+yoW6OT+YyVzzDqiw=='),(4,2,'foo','HMCETrcJQv6n9DFzQ7RzE7ai5QeOPz+tSLJKCCVhWjrZLNDbVIpXA7si9bXFy/RcxKfEOZsLsx9X6DdvvmYJLw==');
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbVars`
--

LOCK TABLES `GbVars` WRITE;
/*!40000 ALTER TABLE `GbVars` DISABLE KEYS */;
INSERT INTO `GbVars` VALUES (1,'M','msdic','ctcont=>Contratos|-|asprot=>Asistente De Protocolos|-|index=>Ingresar|-|new=>Nuevo|-|create=>Guardar|-|edit=>Editar|-|update=>Actualizar|-|delete=>Eliminar|-|delproto=>Eliminar Protocolo'),(2,'S','asprot','Asistente De Protocolos|-|*|-|asprot/index|:|asprot/getpuesto|:|asprot/newpuesto|:|asprot/newprotocolo|:|asprot/getques|:|asprot/delques|:|asprot/addques|:|asprot/getproceso|:|asprot/addproto|:|asprot/delproto'),(3,'S','assecu','Asistente De Seguridad|-|*|-|assecu/index|:|assecu/addcargo|:|assecu/addusua|:|assecu/getcargo|:|assecu/getpers|:|assecu/getusua|:|assecu/getact|:|assecu/addacl|:|assecu/delacl|:|assecu/getacl|:|gbpers/new|:|gbpers/create'),(4,'S','asubic','Asistente De Ubicaciones|-|*|-|asubic/index|:|asubic/getprovs|:|asubic/getpaises|:|asubic/addpais|:|asubic/addprov|:|asubic/getciuds|:|asubic/addciud|:|asubic/delciud'),(5,'S','ctcont','Contratos|-|!|-|ctcont/index=>Ingresar|:|ctcont/show=>Ver|:|ctcont/new=>Nuevo|:|ctcont/create=>Guardar|:|ctcont/edit=>Editar|:|ctcont/update=>Actualizar|:|ctcont/delete=>Borrar'),(6,'S','ctcoti','Presupuestos|-|!|-|ctcoti/index=>Ingresar|:|ctcoti/show=>Ver|:|ctcoti/new=>Nuevo|:|ctcoti/create=>Guardar|:|ctcoti/edit=>Editar|:|ctcoti/update=>Actualizar|:|ctcoti/delete=>Borrar'),(7,'S','ctfact','Facturas|-|!|-|ctfact/index=>Ingresar|:|ctfact/show=>Ver|:|ctfact/new=>Nuevo|:|ctfact/create=>Guardar|:|ctfact/edit=>Editar|:|ctfact/update=>Actualizar|:|ctfact/delete=>Borrar'),(8,'S','ctserv','Servicios|-|!|-|ctserv/index=>Ingresar|:|ctserv/show=>Ver|:|ctserv/new=>Nuevo|:|ctserv/create=>Guardar|:|ctserv/edit=>Editar|:|ctserv/update=>Actualizar|:|ctserv/delete=>Borrar'),(9,'S','cttari','Tarifas|-|!|-|cttari/index=>Ingresar|:|cttari/show=>Ver|:|cttari/new=>Nuevo|:|cttari/create=>Guardar|:|cttari/edit=>Editar|:|cttari/update=>Actualizar|:|cttari/delete=>Borrar'),(10,'S','gbacls','Control de Acceso|-|!|-|gbacls/index=>Ingresar|:|gbacls/show=>Ver|:|gbacls/new=>Nuevo|:|gbacls/create=>Guardar|:|gbacls/edit=>Editar|:|gbacls/update=>Actualizar|:|gbacls/delete=>Borrar'),(11,'S','gbcarg','Cargos|-|!|-|gbcarg/index=>Ingresar|:|gbcarg/show=>Ver|:|gbcarg/new=>Nuevo|:|gbcarg/create=>Guardar|:|gbcarg/edit=>Editar|:|gbcarg/update=>Actualizar|:|gbcarg/delete=>Borrar'),(12,'S','gbciud','Ciudades|-|!|-|gbciud/index=>Ingresar|:|gbciud/show=>Ver|:|gbciud/new=>Nuevo|:|gbciud/create=>Guardar|:|gbciud/edit=>Editar|:|gbciud/update=>Actualizar|:|gbciud/delete=>Borrar'),(13,'S','gbcnae','Actividad Económica|-|!|-|gbcnae/index=>Ingresar|:|gbcnae/show=>Ver|:|gbcnae/new=>Nuevo|:|gbcnae/create=>Guardar|:|gbcnae/edit=>Editar|:|gbcnae/update=>Actualizar|:|gbcnae/delete=>Borrar'),(14,'S','gbcorp','Corporaciones|-|!|-|gbcorp/index=>Ingresar|:|gbcorp/show=>Ver|:|gbcorp/new=>Nuevo|:|gbcorp/create=>Guardar|:|gbcorp/edit=>Editar|:|gbcorp/update=>Actualizar|:|gbcorp/delete=>Borrar'),(15,'S','gbdepa','Províncias|-|!|-|gbdepa/index=>Ingresar|:|gbdepa/show=>Ver|:|gbdepa/new=>Nuevo|:|gbdepa/create=>Guardar|:|gbdepa/edit=>Editar|:|gbdepa/update=>Actualizar|:|gbdepa/delete=>Borrar'),(16,'S','gbempr','Empresas|-|!|-|gbempr/index=>Ingresar|:|gbempr/show=>Ver|:|gbempr/new=>Nuevo|:|gbempr/create=>Guardar|:|gbempr/edit=>Editar|:|gbempr/update=>Actualizar|:|gbempr/delete=>Borrar'),(17,'S','gbiden','Identificaciones|-|!|-|gbiden/index=>Ingresar|:|gbiden/show=>Ver|:|gbiden/new=>Nuevo|:|gbiden/create=>Guardar|:|gbiden/edit=>Editar|:|gbiden/update=>Actualizar|:|gbiden/delete=>Borrar'),(18,'S','gblogr','Logs|-|!|-|gblogr/index=>Ingresar'),(19,'S','gbpais','Países|-|!|-|gbpais/index=>Ingresar|:|gbpais/show=>Ver|:|gbpais/new=>Nuevo|:|gbpais/create=>Guardar|:|gbpais/edit=>Editar|:|gbpais/update=>Actualizar|:|gbpais/delete=>Borrar'),(20,'S','gbpers','Personal|-|!|-|gbpers/index=>Ingresar|:|gbpers/show=>Ver|:|gbpers/new=>Nuevo|:|gbpers/create=>Guardar|:|gbpers/edit=>Editar|:|gbpers/update=>Actualizar|:|gbpers/delete=>Borrar'),(21,'S','gbptra','Puestos de Trabajo|-|!|-|gbptra/index=>Ingresar|:|gbptra/show=>Ver|:|gbptra/new=>Nuevo|:|gbptra/create=>Guardar|:|gbptra/edit=>Editar|:|gbptra/update=>Actualizar|:|gbptra/delete=>Borrar'),(22,'S','gbsucu','Sucursales|-|!|-|gbsucu/index=>Ingresar|:|gbsucu/show=>Ver|:|gbsucu/new=>Nuevo|:|gbsucu/create=>Guardar|:|gbsucu/edit=>Editar|:|gbsucu/update=>Actualizar|:|gbsucu/delete=>Borrar'),(23,'S','gbusua','Usuarios|-|!|-|gbusua/index=>Ingresar|:|gbusua/show=>Ver|:|gbusua/new=>Nuevo|:|gbusua/create=>Guardar|:|gbusua/edit=>Editar|:|gbusua/update=>Actualizar|:|gbusua/delete=>Borrar'),(24,'S','hsfami','Antecedentes Familiares|-|!|-|hsfami/index=>Ingresar|:|hsfami/show=>Ver|:|hsfami/new=>Nuevo|:|hsfami/create=>Guardar|:|hsfami/edit=>Editar|:|hsfami/update=>Actualizar|:|hsfami/delete=>Borrar'),(25,'S','hslabo','Antecedentes Laborales|-|!|-|hslabo/index=>Ingresar|:|hslabo/show=>Ver|:|hslabo/new=>Nuevo|:|hslabo/create=>Guardar|:|hslabo/edit=>Editar|:|hslabo/update=>Actualizar|:|hslabo/delete=>Borrar'),(26,'S','hspers','Antecedentes Personales|-|!|-|hspers/index=>Ingresar|:|hspers/show=>Ver|:|hspers/new=>Nuevo|:|hspers/create=>Guardar|:|hspers/edit=>Editar|:|hspers/update=>Actualizar|:|hspers/delete=>Borrar'),(27,'S','mdaudi','Audiometrías|-|!|-|mdaudi/index=>Ingresar|:|mdaudi/show=>Ver|:|mdaudi/new=>Nuevo|:|mdaudi/create=>Guardar|:|mdaudi/edit=>Editar|:|mdaudi/update=>Actualizar|:|mdaudi/delete=>Borrar'),(28,'S','mdbiom','Biometrías|-|!|-|mdbiom/index=>Ingresar|:|mdbiom/show=>Ver|:|mdbiom/new=>Nuevo|:|mdbiom/create=>Guardar|:|mdbiom/edit=>Editar|:|mdbiom/update=>Actualizar|:|mdbiom/delete=>Borrar'),(29,'S','mddiag','Diagnósticos|-|!|-|mddiag/index=>Ingresar|:|mddiag/show=>Ver|:|mddiag/new=>Nuevo|:|mddiag/create=>Guardar|:|mddiag/edit=>Editar|:|mddiag/update=>Actualizar|:|mddiag/delete=>Borrar'),(30,'S','mdespi','Espirometrías|-|!|-|mdespi/index=>Ingresar|:|mdespi/show=>Ver|:|mdespi/new=>Nuevo|:|mdespi/create=>Guardar|:|mdespi/edit=>Editar|:|mdespi/update=>Actualizar|:|mdespi/delete=>Borrar'),(31,'S','mdexam','Exámenes|-|!|-|mdexam/index=>Ingresar|:|mdexam/show=>Ver|:|mdexam/new=>Nuevo|:|mdexam/create=>Guardar|:|mdexam/edit=>Editar|:|mdexam/update=>Actualizar|:|mdexam/delete=>Borrar'),(32,'S','mdextr','Extremidades|-|!|-|mdextr/index=>Ingresar|:|mdextr/show=>Ver|:|mdextr/new=>Nuevo|:|mdextr/create=>Guardar|:|mdextr/edit=>Editar|:|mdextr/update=>Actualizar|:|mdextr/delete=>Borrar'),(33,'S','mdhist','Hístorias|-|!|-|mdhist/index=>Ingresar|:|mdhist/show=>Ver|:|mdhist/new=>Nuevo|:|mdhist/create=>Guardar|:|mdhist/edit=>Editar|:|mdhist/update=>Actualizar|:|mdhist/delete=>Borrar'),(34,'S','mdlabo','Ordenes de Laboratorio|-|!|-|mdlabo/index=>Ingresar|:|mdlabo/show=>Ver|:|mdlabo/new=>Nuevo|:|mdlabo/create=>Guardar|:|mdlabo/edit=>Editar|:|mdlabo/update=>Actualizar|:|mdlabo/delete=>Borrar'),(35,'S','mdpaci','Pacientes|-|!|-|mdpaci/index=>Ingresar|:|mdpaci/show=>Ver|:|mdpaci/new=>Nuevo|:|mdpaci/create=>Guardar|:|mdpaci/edit=>Editar|:|mdpaci/update=>Actualizar|:|mdpaci/delete=>Borrar'),(36,'S','mdpato','Patologías|-|!|-|mdpato/index=>Ingresar|:|mdpato/show=>Ver|:|mdpato/new=>Nuevo|:|mdpato/create=>Guardar|:|mdpato/edit=>Editar|:|mdpato/update=>Actualizar|:|mdpato/delete=>Borrar'),(37,'S','mdproc','Procedimientos|-|!|-|mdproc/index=>Ingresar|:|mdproc/show=>Ver|:|mdproc/new=>Nuevo|:|mdproc/create=>Guardar|:|mdproc/edit=>Editar|:|mdproc/update=>Actualizar|:|mdproc/delete=>Borrar'),(38,'S','mdprot','Protocolos|-|!|-|mdprot/index=>Ingresar|:|mdprot/show=>Ver|:|mdprot/new=>Nuevo|:|mdprot/create=>Guardar|:|mdprot/edit=>Editar|:|mdprot/update=>Actualizar|:|mdprot/delete=>Borrar'),(39,'S','mdques','Preguntas|-|!|-|mdques/index=>Ingresar|:|mdques/show=>Ver|:|mdques/new=>Nuevo|:|mdques/create=>Guardar|:|mdques/edit=>Editar|:|mdques/update=>Actualizar|:|mdques/delete=>Borrar'),(40,'S','mdresp','Respuestas|-|!|-|mdresp/index=>Ingresar|:|mdresp/show=>Ver|:|mdresp/new=>Nuevo|:|mdresp/create=>Guardar|:|mdresp/edit=>Editar|:|mdresp/update=>Actualizar|:|mdresp/delete=>Borrar'),(41,'S','mdsist','Revisión Sistemas|-|!|-|mdsist/index=>Ingresar|:|mdsist/show=>Ver|:|mdsist/new=>Nuevo|:|mdsist/create=>Guardar|:|mdsist/edit=>Editar|:|mdsist/update=>Actualizar|:|mdsist/delete=>Borrar'),(42,'S','mdvisu','Agudeza Visual|-|!|-|mdvisu/index=>Ingresar|:|mdvisu/show=>Ver|:|mdvisu/new=>Nuevo|:|mdvisu/create=>Guardar|:|mdvisu/edit=>Editar|:|mdvisu/update=>Actualizar|:|mdvisu/delete=>Borrar'),(43,'S','tcaspe','Aspectos Técnicos|-|!|-|tcaspe/index=>Ingresar|:|tcaspe/show=>Ver|:|tcaspe/new=>Nuevo|:|tcaspe/create=>Guardar|:|tcaspe/edit=>Editar|:|tcaspe/update=>Actualizar|:|tcaspe/delete=>Borrar'),(44,'S','tccapa','Capacitaciones|-|!|-|tccapa/index=>Ingresar|:|tccapa/show=>Ver|:|tccapa/new=>Nuevo|:|tccapa/create=>Guardar|:|tccapa/edit=>Editar|:|tccapa/update=>Actualizar|:|tccapa/delete=>Borrar'),(45,'S','tcchec','Lista de Chequeo|-|!|-|tcchec/index=>Ingresar|:|tcchec/show=>Ver|:|tcchec/new=>Nuevo|:|tcchec/create=>Guardar|:|tcchec/edit=>Editar|:|tcchec/update=>Actualizar|:|tcchec/delete=>Borrar'),(46,'S','tccurs','Cursos|-|!|-|tccurs/index=>Ingresar|:|tccurs/show=>Ver|:|tccurs/new=>Nuevo|:|tccurs/create=>Guardar|:|tccurs/edit=>Editar|:|tccurs/update=>Actualizar|:|tccurs/delete=>Borrar'),(47,'S','tcdeta','Detalles|-|!|-|tcdeta/index=>Ingresar|:|tcdeta/show=>Ver|:|tcdeta/new=>Nuevo|:|tcdeta/create=>Guardar|:|tcdeta/edit=>Editar|:|tcdeta/update=>Actualizar|:|tcdeta/delete=>Borrar'),(48,'S','tcrevi','Revisión Técnica|-|!|-|tcrevi/index=>Ingresar|:|tcrevi/show=>Ver|:|tcrevi/new=>Nuevo|:|tcrevi/create=>Guardar|:|tcrevi/edit=>Editar|:|tcrevi/update=>Actualizar|:|tcrevi/delete=>Borrar'),(49,'S','tcruta','Hoja de Ruta|-|!|-|tcruta/index=>Ingresar|:|tcruta/show=>Ver|:|tcruta/new=>Nuevo|:|tcruta/create=>Guardar|:|tcruta/edit=>Editar|:|tcruta/update=>Actualizar|:|tcruta/delete=>Borrar'),(50,'S','asempr','Asistente De Empresas|-|*|-|asempr/index');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdAudi`
--

LOCK TABLES `MdAudi` WRITE;
/*!40000 ALTER TABLE `MdAudi` DISABLE KEYS */;
INSERT INTO `MdAudi` VALUES (1,1,'S','30','5','10','35','35','10','20','20','5','5','15','35','25','0'),(2,37,'S','10','20','10','20','10','20','10','20','10','20','10','20','10','20'),(3,37,'S','25','30','20','30','20','30','20','30','20','30','20','30','20','30'),(4,37,'S','35','20','30','20','30','20','30','20','30','20','30','20','30','20'),(5,37,'S','30','20','20','20','30','30','20','30','30','20','20','20','30','30'),(6,37,'S','5','30','5','30','5','30','10','0','10','10','20','10','30','20'),(7,37,'S','50','30','5','20','10','20','10','20','20','10','20','0','20','10'),(8,37,'S','15','20','10','20','10','20','10','20','10','20','10','20','10','20'),(9,37,'S','0','10','0','10','10','10','10','10','10','10','10','10','10','10'),(10,37,'S','10','20','10','20','10','30','20','30','20','20','20','20','10','20'),(11,37,'S','15','30','10','30','10','30','10','30','10','30','10','30','10','30'),(12,37,'S','15','10','10','10','10','10','10','10','10','10','10','10','10','10'),(13,37,'S','30','20','40','30','20','40','30','5','5','40','70','10','10','20'),(14,37,'S','20','10','10','20','20','40','10','10','30','10','40','20','10','5'),(15,37,'S','10','10','10','30','10','30','20','30','20','10','20','40','20','10'),(16,37,'S','10','10','10','10','10','15','10','10','10','10','10','10','10','10'),(17,37,'S','10','20','10','20','10','20','10','20','10','20','10','20','10','20'),(18,37,'S','10','10','10','20','10','10','10','20','10','10','20','20','20','10'),(19,56,'S','15','10','10','10','10','10','10','10','10','10','10','10','10','10'),(20,57,'S','65','10','65','10','70','10','85','10','85','10','10','10','10','10'),(21,58,'S','85','10','10','10','10','10','','10','15','10','10','10','','10'),(22,59,'S','20','10','10','40','30','20','40','30','5','10','10','20','5','10'),(23,60,'S','15','20','10','20','10','20','10','20','10','20','10','20','10','20'),(24,61,'S','20','30','10','40','20','10','100','20','10','20','15','30','20','40'),(25,62,'S','5','20','5','20','5','20','5','20','10','40','10','40','10','40'),(26,64,'N','','','','','','','','','','','','','',''),(27,65,'N','','','','','','','','','','','','','',''),(28,66,'S','5','20','5','25','5','20','5','20','10','20','10','20','10','20'),(29,71,'S','5','10','10','15','15','30','20','20','40','45','25','10','30','10'),(30,72,'S','10','15','-5','-5','-5','0','-5','-5','-5','-5','-5','-5','-5','-5'),(31,74,'N','','','','','','','','','','','','','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdBiom`
--

LOCK TABLES `MdBiom` WRITE;
/*!40000 ALTER TABLE `MdBiom` DISABLE KEYS */;
INSERT INTO `MdBiom` VALUES (1,37,182.00,82.00,25.00,25.00,120.00,80.00),(2,37,182.00,82.00,25.00,25.00,120.00,80.00),(3,67,178.00,67.00,25.00,25.00,120.00,80.00),(4,68,168.00,60.00,25.00,40.00,120.00,84.00),(5,71,182.00,82.00,25.00,35.00,120.00,80.00),(6,72,182.00,82.00,25.00,25.00,120.00,80.00),(7,74,1.00,1.00,2.00,2.00,2.00,2.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdDiag`
--

LOCK TABLES `MdDiag` WRITE;
/*!40000 ALTER TABLE `MdDiag` DISABLE KEYS */;
INSERT INTO `MdDiag` VALUES (1,27,1),(2,28,3),(3,28,7),(4,30,1),(5,30,2),(6,30,3),(7,31,1),(8,31,2),(9,31,3),(10,31,7),(11,32,1),(12,32,2),(20,35,1),(21,35,2),(22,35,3),(30,39,1),(34,42,2),(35,42,3),(36,42,4),(37,42,5),(38,42,6),(41,44,4),(42,44,6),(43,45,1),(44,45,2),(46,45,7),(47,45,4),(49,45,6),(54,61,1),(58,61,4),(59,71,1),(60,71,4),(61,72,2),(62,72,4),(63,74,2),(64,74,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdEspi`
--

LOCK TABLES `MdEspi` WRITE;
/*!40000 ALTER TABLE `MdEspi` DISABLE KEYS */;
INSERT INTO `MdEspi` VALUES (1,37,'S',9.99,9.99,9.99),(2,37,'N',NULL,NULL,NULL),(3,69,'S',9.99,9.99,9.99),(4,71,'S',9.99,9.99,9.99),(5,72,'S',9.99,9.99,9.99),(6,74,'N',NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdExtr`
--

LOCK TABLES `MdExtr` WRITE;
/*!40000 ALTER TABLE `MdExtr` DISABLE KEYS */;
INSERT INTO `MdExtr` VALUES (1,37,'S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','lolo'),(2,70,'S','N','S','N','S','S','S','S','S','S','N','S','S','S','N','S','S','S','S','S','N','S','S','S','S','S','S','S','S','S','Cosas'),(3,71,'S','S','S','N','N','N','N','N','N','N','N','N','N','N','S','S','S','S','N','N','S','S','N','N','S','S','S','S','S','S','Comentario de extremidades!'),(4,72,'S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','Jojo'),(5,74,'S','S','S','S','S','S','S','S','S','S','S','S','S','S','N','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','ki'),(6,75,'S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','N','S','N','S','S','S','sss');
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
  `fecha` date NOT NULL,
  `menstru` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(1) unsigned NOT NULL,
  `comentario` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `MdPaci_id` (`MdPaci_id`),
  KEY `GbPers_id` (`GbPers_id`),
  KEY `TcRuta_id` (`TcRuta_id`),
  CONSTRAINT `MdHist_ibfk_1` FOREIGN KEY (`MdPaci_id`) REFERENCES `MdPaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdHist_ibfk_2` FOREIGN KEY (`GbPers_id`) REFERENCES `GbPers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MdHist_ibfk_3` FOREIGN KEY (`TcRuta_id`) REFERENCES `TcRuta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdHist`
--

LOCK TABLES `MdHist` WRITE;
/*!40000 ALTER TABLE `MdHist` DISABLE KEYS */;
INSERT INTO `MdHist` VALUES (1,1,1,2,'2012-11-09','N',0,NULL),(2,1,1,1,'2012-11-20',NULL,0,NULL),(3,1,1,1,'2012-01-06','S',0,NULL),(5,1,15,2,'2012-11-20','@',0,NULL),(6,1,2,2,'2012-11-20','S',0,NULL),(7,2,14,2,'2012-11-20','S',1,NULL),(8,2,14,2,'2012-11-20','S',1,NULL),(9,2,14,2,'2012-11-20','S',1,NULL),(10,2,14,2,'2012-11-20','S',1,NULL),(11,2,14,2,'2012-11-20','S',1,NULL),(12,2,14,2,'2012-11-20','S',1,NULL),(13,2,14,2,'2012-11-20','S',1,NULL),(14,2,8,2,'2012-11-20','@',1,NULL),(15,1,16,2,'2012-11-20','@',3,NULL),(16,2,17,2,'2012-11-20','N',0,NULL),(17,1,9,2,'2012-11-20','S',0,NULL),(18,2,19,2,'2012-11-20','@',2,NULL),(19,1,15,2,'2012-11-20','@',0,NULL),(20,1,1,1,'2012-11-08',NULL,0,NULL),(21,1,9,2,'2012-11-21','S',1,NULL),(22,1,15,2,'2012-11-21','@',0,NULL),(23,1,15,2,'2012-11-21','@',0,' lololo'),(24,1,15,2,'2012-11-21','@',0,NULL),(25,1,15,2,'2012-11-21','@',0,'Me aburre.'),(26,1,2,2,'2012-11-21','N',1,'Kokokoko'),(27,1,15,2,'2012-11-21','@',0,NULL),(28,1,15,2,'2012-11-21','@',1,NULL),(29,1,15,2,'2012-11-21','@',0,NULL),(30,1,15,2,'2012-11-21','@',0,NULL),(31,1,15,2,'2012-11-21','@',0,NULL),(32,1,2,2,'2012-11-21','N',0,NULL),(33,1,15,2,'2012-11-21','@',0,NULL),(34,1,15,2,'2012-11-21','@',0,NULL),(35,1,8,2,'2012-11-21','@',0,NULL),(36,1,15,2,'2012-11-21','@',0,NULL),(37,1,14,2,'2012-11-21','S',0,NULL),(38,1,14,2,'2012-11-21','N',1,NULL),(39,1,2,2,'2012-11-21','S',0,NULL),(40,1,17,2,'2012-11-21','S',0,NULL),(41,1,17,2,'2012-11-21','N',1,NULL),(42,1,2,2,'2012-11-21','S',1,NULL),(43,1,13,2,'2012-11-21','N',0,NULL),(44,1,15,2,'2012-11-21','@',0,NULL),(45,1,8,2,'2012-11-21','@',0,NULL),(46,1,17,2,'2012-11-21','S',1,' Test de comentario!'),(47,1,15,2,'2012-11-22','@',0,NULL),(48,1,13,2,'2012-11-22','S',0,NULL),(49,1,17,2,'2012-11-22','S',1,NULL),(50,1,17,2,'2012-11-22','S',0,NULL),(51,1,2,2,'2012-11-22','S',0,NULL),(52,1,17,2,'2012-11-22','S',0,NULL),(53,1,2,2,'2012-11-22','S',2,NULL),(54,1,14,2,'2012-11-22','S',0,NULL),(55,1,17,2,'2012-11-22','N',1,NULL),(56,1,17,2,'2012-11-22','N',0,NULL),(57,1,17,2,'2012-11-22','S',0,NULL),(58,1,17,2,'2012-11-22','S',0,NULL),(59,1,17,2,'2012-11-22','N',1,NULL),(60,1,11,2,'2012-11-22','S',1,NULL),(61,1,2,2,'2012-11-23','S',0,'Cosas de prueba!.'),(62,1,10,2,'2012-11-23','@',1,NULL),(63,1,15,2,'2012-11-23','@',4,NULL),(64,1,14,2,'2012-11-23','S',0,NULL),(65,1,15,2,'2012-11-23','@',0,NULL),(66,1,17,2,'2012-11-23','S',1,NULL),(67,1,17,2,'2012-11-23','N',1,NULL),(68,1,7,2,'2012-11-23','N',0,NULL),(69,1,17,2,'2012-11-23','S',0,NULL),(70,1,17,2,'2012-11-23','S',0,NULL),(71,1,17,2,'2012-11-23','N',1,'Test de comentario!.'),(72,1,17,2,'2012-11-23','N',1,'Hello comentario!.'),(73,1,15,2,'2012-11-23','@',0,NULL),(74,1,17,2,'2012-11-23','S',0,' xxx'),(75,1,15,2,'2012-11-23','@',0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdPaci`
--

LOCK TABLES `MdPaci` WRITE;
/*!40000 ALTER TABLE `MdPaci` DISABLE KEYS */;
INSERT INTO `MdPaci` VALUES (1,'10101',1,1,'jaja','ajaja','jajaj','ajaja','2012-10-12','M',1,'koko','ok','ok',1,'2012-10-20'),(2,'898989',2,2,'rocio',NULL,'casas',NULL,'1970-09-01','F',2,'crr 11 # 17-89','90909090','roci@hotmail.com',1,'2012-10-20'),(3,'9098',2,2,'Carlos',NULL,'Soto',NULL,'1970-11-02','M',2,'Cll 11 # 19-01','899898998','carlos@xmail.com',1,'2012-10-20'),(7,'1818181',2,2,'Lorena',NULL,'Mendez',NULL,'1989-08-01','F',2,'Cll 1 # 02-03','8456789','lore@mail.com',1,'2012-10-20'),(8,'90876',2,2,'Mateo',NULL,'Garcia',NULL,'1967-08-08','M',2,'Cll 11 # 19-01','90890899','mateo@mail.com',1,'2012-10-20'),(9,'1234567',2,2,'Laura',NULL,'Montoya',NULL,'1990-03-03','F',2,'Cll 11 # 19-01','284792','laura@mail.com',1,'2012-10-20'),(10,'7654',2,2,'Juan','Fernando','Mateus','Salas','1970-11-02','M',2,'crr 11 # 17-89','90909091','msalas@mail.com',1,'2012-10-20'),(11,'909081',2,2,'koko',NULL,'hekmatier',NULL,'1989-08-01','F',2,'Cll 1 # 02-03','000000000','koko@hcli.com',1,'2012-10-20'),(12,'1293801',2,2,'Garcia',NULL,'Paul',NULL,'1970-11-02','M',2,'Cll 11 # 19-01','19080','mga@mail.com',1,'2012-10-20'),(13,'1938120',2,2,'Cortes',NULL,'Honey',NULL,'1989-08-01','F',2,'Cll 11 # 19-01','891093902','honey@mail.com',1,'2012-10-20'),(14,'130923810',2,2,'Heilly',NULL,'Duz',NULL,'1970-11-02','F',2,'Cll 11 # 19-01','921830','hdz@mithril.com',1,'2012-10-20'),(15,'18312903',2,2,'Zack',NULL,'Aldrin',NULL,'1970-11-02','M',2,'Cll 11 # 19-01','1930','zacx@mitrill.com',1,'2012-10-20'),(16,'19083901',2,2,'Bob',NULL,'makihara',NULL,'1970-11-02','M',2,'Cll 11 # 19-01','21231','bob@tjt.com',1,'2012-10-20'),(17,'1983102830',2,2,'Karen',NULL,'Cortes',NULL,'1980-07-04','F',2,'Cll 11 # 19-01','123109','kcor@mail.com',1,'2012-10-20'),(18,'9087654',2,2,'Milena',NULL,'Moran',NULL,'1970-11-02','F',2,'Cll 1 # 02-03','2391','mmoran@mail.com',1,'2012-10-20'),(19,'678911',2,3,'Juan',NULL,'Sarmiento',NULL,'1990-03-03','M',3,'Cll 11 # 19-01','8907676','jsarmiento@mail.com',1,'2012-10-20');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdPato`
--

LOCK TABLES `MdPato` WRITE;
/*!40000 ALTER TABLE `MdPato` DISABLE KEYS */;
INSERT INTO `MdPato` VALUES (1,'1901','Sientese',NULL),(2,'1902','Duerma',NULL),(3,'1903','Coma',NULL),(4,'1500','Normal',NULL),(5,'1501','Psicotico',NULL),(6,'1502','Neurotico',NULL),(7,'1900','Recomendación',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdProc`
--

LOCK TABLES `MdProc` WRITE;
/*!40000 ALTER TABLE `MdProc` DISABLE KEYS */;
INSERT INTO `MdProc` VALUES (2,1,1),(3,1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdProt`
--

LOCK TABLES `MdProt` WRITE;
/*!40000 ALTER TABLE `MdProt` DISABLE KEYS */;
INSERT INTO `MdProt` VALUES (1,'001','Prueba'),(2,'7777','coc');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdQues`
--

LOCK TABLES `MdQues` WRITE;
/*!40000 ALTER TABLE `MdQues` DISABLE KEYS */;
INSERT INTO `MdQues` VALUES (1,1,'Le duele la espalda?'),(3,1,'Tiene hambre?'),(4,1,'uuuu'),(5,2,'gooo');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdSist`
--

LOCK TABLES `MdSist` WRITE;
/*!40000 ALTER TABLE `MdSist` DISABLE KEYS */;
INSERT INTO `MdSist` VALUES (1,37,'S','S','S','S','S','S','S','S','S','S','S','S'),(2,37,'S','S','S','S','S','S','S','S','S','S','S','S'),(3,1,'S','N','S','N','S','N','S','N','S','N','S','N'),(4,1,'S','N','N','N','N','S','S','S','S','S','S','S'),(5,73,'S','S','S','S','S','S','S','S','S','S','S','S'),(6,75,'S','S','S','S','S','S','S','S','S','S','S','S');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MdVisu`
--

LOCK TABLES `MdVisu` WRITE;
/*!40000 ALTER TABLE `MdVisu` DISABLE KEYS */;
INSERT INTO `MdVisu` VALUES (1,37,'S','S',1,1,0,1,0,0,0,0,'5','5','1','5','5','1'),(2,37,'S','S',1,1,0,0,1,0,0,0,'5','5','5','1','1','1'),(3,37,'S','S',1,0,0,0,1,0,0,0,'5','5','5','1','1','1'),(4,37,'S','S',1,0,0,0,1,0,0,0,'5','3','4','3','5','4'),(5,37,'S','S',1,0,0,0,1,0,0,0,'5','3','4','3','5','4'),(6,62,'S','S',1,0,0,0,1,0,0,0,'1','5','3','1','5','3'),(7,63,'S','S',1,0,0,0,0,0,0,0,'5','5','5','5','5','5'),(8,64,'S','S',1,0,0,0,1,0,0,0,'5','4','4','4','5','4'),(9,71,'S','S',1,0,0,1,1,0,0,0,'5','1','3','1','5','3'),(10,72,'S','S',0,0,0,0,1,0,0,0,'3','2','2','2','2','2'),(11,74,'S','S',1,0,0,0,0,0,0,0,'1','1','1','1','1','1');
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
  `fejecutada` date NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TcRuta`
--

LOCK TABLES `TcRuta` WRITE;
/*!40000 ALTER TABLE `TcRuta` DISABLE KEYS */;
INSERT INTO `TcRuta` VALUES (1,1,'2012-11-10','2012-11-12','Javier Herran','Cosas de médicos','No data','Girardot','Sofia martinez','No data','2012-11-12\r\n2012-11-13\r\n2012-11-14\r\n2012-11-15',1,1,1,1,1,1,'S','Toco hacerlos','Revisar significado',5,5,5,5,5,5,'A'),(2,2,'2012-11-14','2012-11-14','Todos','La misma','Todo','Principal','Mateo garcia','Ninguno','2012-11-14',1,1,1,1,1,1,'S','Ok','Ninguno',15,15,15,15,15,60,'A');
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

-- Dump completed on 2012-11-23 16:51:44
