-- MySQL dump 10.13  Distrib 8.0.15, for Linux (x86_64)
--
-- Host: localhost    Database: pwafw
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `pwafw`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pwafw` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `pwafw`;

--
-- Table structure for table `core_config_data`
--

DROP TABLE IF EXISTS `core_config_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `core_config_data` (
  `core_config_data_is` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(50) DEFAULT NULL,
  `value` text,
  `test` json DEFAULT NULL,
  PRIMARY KEY (`core_config_data_is`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_config_data`
--

LOCK TABLES `core_config_data` WRITE;
/*!40000 ALTER TABLE `core_config_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_config_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_controller`
--

DROP TABLE IF EXISTS `core_controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `core_controller` (
  `core_controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `component_name` varchar(255) DEFAULT NULL COMMENT 'el nombre del componente. respeta la nomenclatura de los models',
  `design_path` varchar(255) DEFAULT NULL COMMENT 'esta info se manda a front. Donde se ubica este componente (CSS path)',
  `clear_path` varchar(255) DEFAULT NULL COMMENT 'Cuando se use este componente, que sección de la página se debe limpiar (borrar el contenido) antes. Puede estar vacío.',
  `data_model` varchar(255) DEFAULT NULL COMMENT 'Model que se va a usar para enviar la info dataModel al front (que después se usa para llenar el component + procesar en JS)',
  PRIMARY KEY (`core_controller_id`),
  UNIQUE KEY `component_name` (`component_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='core_model_controller se encarga de armar la estuctura de datos necesaria para enviar al front (los components, el design, el dataModel)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_controller`
--

LOCK TABLES `core_controller` WRITE;
/*!40000 ALTER TABLE `core_controller` DISABLE KEYS */;
INSERT INTO `core_controller` VALUES (1,'error_404','#main-content','#main-content','core.error.404');
/*!40000 ALTER TABLE `core_controller` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-10  2:21:31
