<?php 



class Core{
	public $glaObject;

	function __construct(){
		$this->loadGlaObject();
		spl_autoload_register(function($className){
			$arrClassName = explode("_", $className);
			unset($arrClassName[1]);
			require_once $this->getModelFile($arrClassName, true);
		});
	}

	public function loadGlaObject(){
		$this->glaObject = $this->getModel("core.glaobject");
	}

	public function start(){
		$this->unsetInstallError();
		if ($this->getInstallMode()){
			try {
				$this->runInstall();
				$this->unsetInstallMode();
			} catch (Exception $e) {
				$this->setInstallError(json_encode($e->getMassage()));
				$this->unsetInstallMode();
			}

		}
	}

	public function getInstallMode(){
		return file_exists(__DIR__."/install-mode.lock");
	}

	public function unsetInstallMode(){
		return @unlink(__DIR__."/install-mode.lock");
	}

	public function setInstallError(){
		return file_put_contents(__DIR__."/install-error.lock", " ");
	}

	public function unsetInstallError(){
		return @unlink(__DIR__."/install-error.lock");
	}

	public function buildAttributes($arrData){
		$str = " ";
		foreach ($arrData as $k => $v) {
			$str.=  $this->clean("attribute_name", $k)."=\"";
			if (is_array($v)){
				$str .= json_encode($v);
			} else {
				$str .= $v."\" ";
			}
		}
	}

	public function clean($clean_type, $str){
		switch ($clean_type) {
			case 'attribute_name':
					$str = strtolower(trim($str));
					$str = preg_replace('/[^a-z0-9]/', '-', $str);
					return $str;
				break;
			
			default:
				# code...
				break;
		}
	}


	public function getConfig(){
		return $this->getModel("core.config.data");
	}

	public function getModel($modelStr){
		$arrModel = explode(".", $modelStr);
		if (!is_file($this->getModelFile($arrModel))){
			$this->printError("El modelo/módulo ".$modelStr." no se pudo encontrar");
		}
		require_once $this->getModelFile($arrModel);
		$modelStr = $this->getModelStr($arrModel);
		$model = new $modelStr();
		$model->setCore($this);
		return $model;
	}

	public function getModelFile($arrModel){
		$strFileName = __DIR__."/modules";

		$k = 0;
		foreach ($arrModel as $currModelPart) {
			if ($k == 1){
				$strFileName .= "/model";
			}
			$strFileName .= "/".$currModelPart;
			$k++;
		}
		$strFileName .= ".php";

		return $strFileName;
	}

	public function getModelStr($arrModel){
		$strFileName = "";

		foreach ($arrModel as $k => $currModelPart) {
			if ($k == 1){
				$strFileName .= "_model";
			}
			$strFileName .= "_".$currModelPart;
		}
		$strFileName = trim($strFileName, "_");
		return $strFileName;
	}

	public function printError($msg){
		die("<div id='main-error' style='display:none'>".$msg."</div>");
	}

	public function end(){
		return;
	}
}

?> 
