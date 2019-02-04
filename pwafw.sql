-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.15 - MySQL Community Server - GPL
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para pwafw
CREATE DATABASE IF NOT EXISTS `pwafw` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pwafw`;

-- Volcando estructura para tabla pwafw.core_config_data
CREATE TABLE IF NOT EXISTS `core_config_data` (
  `core_config_data_is` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(50) DEFAULT NULL,
  `value` text,
  `test` json DEFAULT NULL,
  PRIMARY KEY (`core_config_data_is`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pwafw.core_config_data: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `core_config_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_config_data` ENABLE KEYS */;

-- Volcando estructura para tabla pwafw.core_controller
CREATE TABLE IF NOT EXISTS `core_controller` (
  `core_controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `component_name` varchar(255) DEFAULT NULL,
  `design_path` varchar(255) DEFAULT NULL,
  `data_model` varchar(255) DEFAULT NULL,
  `clear_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`core_controller_id`),
  UNIQUE KEY `component_name` (`component_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla pwafw.core_controller: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `core_controller` DISABLE KEYS */;
INSERT INTO `core_controller` (`core_controller_id`, `component_name`, `design_path`, `data_model`, `clear_path`) VALUES
	(1, 'error_404', '#main-content', 'core.error.404', '#main-content');
/*!40000 ALTER TABLE `core_controller` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
