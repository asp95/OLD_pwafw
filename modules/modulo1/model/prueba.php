<?php 
/**
 * 
 */
class modulo1_model_prueba extends core_model_db_model{

	public function functionPrueba(){
		$strTest = "";
		$config = $this->getCore()->getModel("core.config.data");
		$config->_setSelect("SELECT * from ".$this->getTableName($config)." where path like '%prueba%'");

		foreach ($config as $currConfig) {
			//die(var_export($currConfig, true));
			$strTest .= $currConfig->getValue()." ";
		}

		return $strTest;
	}
}