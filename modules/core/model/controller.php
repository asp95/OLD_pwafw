<?php 

class core_model_controller extends core_model_db_model{
	public function loadComponents($arrComponentNames, $get = [], $post = []){
		$arrOutput = array(
			"componentsHtml" => [],
			"design" => array("_clear_" => ""),
			"data" => []
		);

		$componentCollection = $this->getCore()->getModel("core.controller");
		$componentCollection->_setSelect("SELECT * from ".$this->getTableName($componentCollection)." where component_name in ('".implode("','", $arrComponentNames)."')");
		
		while ($currComponent = $componentCollection->fetch()) {
			$arrOutput["componentsHtml"][ $currComponent->getComponentName() ] = $this->getComponentHTML($currComponent->getComponentName());
			$arrOutput["design"][ $currComponent->getComponentName() ] = $currComponent->getDesignPath();
			
			if (!is_null($currComponent->getClearPath())){
				if (empty($arrOutput["design"]["_clear_"])){
					$arrOutput["design"]["_clear_"] = $currComponent->getClearPath();
				} else {
					$arrOutput["design"]["_clear_"] .= ", ".$currComponent->getClearPath();
				}
			}


			if (!is_null($currComponent->getDataModel())){
				$arrOutput["data"][ $currComponent->getComponentName() ] = $this->getCore()->getModel( $currComponent->getDataModel() )->loadByRequest($get, $post);
			}

		}
		return $arrOutput;
	}


	public function getComponentHTML($componentName){
		$arrModel = explode("_", $componentName);
		if (!is_file($this->getComponentFile($arrModel))){
			throw new Exception("El componente ".$componentName." no se pudo encontrar", 3);
		}
		return file_get_contents($this->getComponentFile($arrModel));
	}

	public function getComponentFile($arrModel){
		$strFileName = __DIR__."/../../../components";
		foreach ($arrModel as $currModelPart) {
			$strFileName .= "/".$currModelPart;
		}
		$strFileName .= ".html";
		return $strFileName;
	}
}