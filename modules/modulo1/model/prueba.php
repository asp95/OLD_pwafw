<?php 
/**
 * 
 */
class modulo1_model_prueba extends core_model_db_model{

	public function functionPrueba(){
		$strTest = "";
		$config = $this->getCore()->getModel("core.config.data");
		$config->_setSelect("SELECT * from ".$this->getTableName($config)." where path like '%prueba%'");

		while ($currConfig = $config->fetch()) {
			$strTest .= $currConfig->getValue()." ";
			$currConfig->setValue("EXITO!");
			$currConfig->save();
		}

		$testInsert = $this->getCore()->getModel("core.config.data");
		$testInsert->setPath("system.blabla.prueba");
		$testInsert->setvalue("123456");
		$testInsert->save();
		echo "<br>".$testInsert->getID();


		return $strTest;
	}
}