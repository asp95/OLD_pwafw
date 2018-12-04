<?php 
/**
 * 
 */
class modulo1_model_prueba extends core_model_db_model{

	public function functionPrueba(){
		$strTest = "";
		$config = $this->getCore()->getModel("core.config.data")
			->setSelect("SELECT * from ".$this->getTableName($config)." where path like '%prueba%'");

		foreach ($config as $currConfig) {
			$strTest .= $currConfig->getValue()."|";
		}

		return $strTest;
	}
}