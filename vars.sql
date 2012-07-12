-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbsalud
-- ------------------------------------------------------
-- Server version	5.5.24-4

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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbVars`
--

LOCK TABLES `GbVars` WRITE;
/*!40000 ALTER TABLE `GbVars` DISABLE KEYS */;
INSERT INTO `GbVars` VALUES (1,'M','msdic','ctcont=>Contratos|-|asprot=>Asistente De Protocolos|-|index=>Ingresar'),(2,'S','asprot','Asistente De Protocolos|-|*|-|asprot/index|:|asprot/getpuesto|:|asprot/newpuesto|:|asprot/newprotocolo|:|asprot/getques|:|asprot/delques|:|asprot/addques|:|asprot/getproceso|:|asprot/addproto|:|asprot/delproto'),(3,'S','assecu',''),(4,'S','asubic',''),(5,'S','ctcont','Contratos|-|!|-|ctcont/index=>Ingresar|:|ctcont/show=>Ver|:|ctcont/new=>Nuevo|:|ctcont/create=>Guardar|:|ctcont/edit=>Editar|:|ctcont/update=>Actualizar|:|ctcont/delete=>Borrar'),(6,'S','ctcoti',''),(7,'S','ctfact',''),(8,'S','ctserv',''),(9,'S','cttari',''),(10,'S','gbacls',''),(11,'S','gbcarg',''),(12,'S','gbciud',''),(13,'S','gbcnae',''),(14,'S','gbcorp',''),(15,'S','gbdepa',''),(16,'S','gbempr',''),(17,'S','gbiden',''),(18,'S','gblogr',''),(19,'S','gbpais',''),(20,'S','gbpers',''),(21,'S','gbptra',''),(22,'S','gbsucu',''),(23,'S','gbusua',''),(24,'S','hsfami',''),(25,'S','hslabo',''),(26,'S','hspers',''),(27,'S','mdaudi',''),(28,'S','mdbiom',''),(29,'S','mddiag',''),(30,'S','mdespi',''),(31,'S','mdexam',''),(32,'S','mdextr',''),(33,'S','mdhist',''),(34,'S','mdlabo',''),(35,'S','mdpaci',''),(36,'S','mdpato',''),(37,'S','mdproc',''),(38,'S','mdprot',''),(39,'S','mdques',''),(40,'S','mdresp',''),(41,'S','mdsist',''),(42,'S','mdvisu',''),(43,'S','tcaspe',''),(44,'S','tccapa',''),(45,'S','tcchec',''),(46,'S','tccurs',''),(47,'S','tcdeta',''),(48,'S','tcrevi',''),(49,'S','tcruta','');
/*!40000 ALTER TABLE `GbVars` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-07-12 14:04:41
