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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GbVars`
--

LOCK TABLES `GbVars` WRITE;
/*!40000 ALTER TABLE `GbVars` DISABLE KEYS */;
INSERT INTO `GbVars` VALUES (1,'S','asprot','Asistente De Protocolos|-|*|-|asprot/index|:|asprot/getpuesto|:|asprot/newpuesto|:|asprot/newprotocolo|:|asprot/getques|:|asprot/delques|:|asprot/addques|:|asprot/getproceso|:|asprot/addproto|:|asprot/delproto'),(2,'S','assecu',''),(3,'S','asubic',''),(4,'S','ctcont','Contratos|-|!|-|ctcont/index=>Ingresar|:|ctcont/show=>Ver|:|ctcont/new=>Nuevo|:|ctcont/create=>Guardar|:|ctcont/edit=>Editar|:|ctcont/update=>Actualizar|:|ctcont/delete=>Borrar'),(5,'S','ctcoti',''),(6,'S','ctfact',''),(7,'S','ctserv',''),(8,'S','cttari',''),(9,'S','gbacls',''),(10,'S','gbcarg',''),(11,'S','gbciud',''),(12,'S','gbcnae',''),(13,'S','gbcorp',''),(14,'S','gbdepa',''),(15,'S','gbempr',''),(16,'S','gbiden',''),(17,'S','gblogr',''),(18,'S','gbpais',''),(19,'S','gbpers',''),(20,'S','gbptra',''),(21,'S','gbsucu',''),(22,'S','gbusua',''),(23,'S','hsfami',''),(24,'S','hslabo',''),(25,'S','hspers',''),(26,'S','mdaudi',''),(27,'S','mdbiom',''),(28,'S','mddiag',''),(29,'S','mdespi',''),(30,'S','mdexam',''),(31,'S','mdextr',''),(32,'S','mdhist',''),(33,'S','mdlabo',''),(34,'S','mdpaci',''),(35,'S','mdpato',''),(36,'S','mdproc',''),(37,'S','mdprot',''),(38,'S','mdques',''),(39,'S','mdresp',''),(40,'S','mdsist',''),(41,'S','mdvisu',''),(42,'S','tcaspe',''),(43,'S','tccapa',''),(44,'S','tcchec',''),(45,'S','tccurs',''),(46,'S','tcdeta',''),(47,'S','tcrevi',''),(48,'S','tcruta','');
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

-- Dump completed on 2012-07-11 22:36:57
