CREATE DATABASE IF NOT EXISTS `pwafw`;
USE `pwafw`;

CREATE TABLE IF NOT EXISTS `core_config_data` (
  `core_config_data_is` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(50) DEFAULT NULL,
  `value` text,
  `test` json DEFAULT NULL,
  PRIMARY KEY (`core_config_data_is`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*
core_model_controller se encarga de armar la estuctura de datos necesaria para enviar al front (los components, el design, el dataModel)
*/
CREATE TABLE IF NOT EXISTS `core_controller` (
  `core_controller_id` int(11) NOT NULL AUTO_INCREMENT,
  `component_name` varchar(255) DEFAULT NULL,
  `design_path` varchar(255) DEFAULT NULL,
  `data_model` varchar(255) DEFAULT NULL,
  `clear_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`core_controller_id`),
  UNIQUE KEY `component_name` (`component_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `core_controller` (`core_controller_id`, `component_name`, `design_path`, `data_model`, `clear_path`) VALUES
	(1, 'error_404', '#main-content', 'core.error.404', '#main-content');