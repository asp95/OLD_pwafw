<?php 

class core_model_config_data extends core_model_db_model{

	public function getVar($varStr){
		$this->load($varStr, "path");
		return $this->getValue();
	}

	public function setVar($k, $v){
		$newVar = $this->getCore()->getModel("core.config.data");
		$newVar->setPath($k);
		$newVar->setValue($v);
		$newVar->save();
	}
}