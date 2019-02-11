<?php 

class core_model_controller extends core_model_db_model{
	public function load($value, $field = ""){
		parent::load($value, $field);

		$componentCollection = $this->getCore()->getModel("core.controller.component");
		$componentCollection = $componentCollection->_setSelect(
			"SELECT * from ".
			$componentCollection->getTableName().
			" where ".
			$this->getPrimaryIdx().
			" = ".
			$this->getID().
			" order by 'order' asc "
		);

		$this->setComponentCollection($componentCollection);

		return $this;
	}
	public function getResponseData($postData){
		$arrComponents = [];
		while($currControllerComponent = $this->getComponentCollection()->fetch()){
			$arrComponents[] = $currControllerComponent->getCoreComponentId();
		}
		return $this->getCore()->getModel("core.component")->loadComponents($arrComponents, $postData);
	}
}