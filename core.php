<?php 
class Core {
	public $mainObject;

	function __construct(){
		$this->loadMainobject();
		spl_autoload_register(function($className){
			/*if ($className == "controllers_error_404"){
				die(json_encode(debug_backtrace()));
			}*/
			$arrClassName = explode("_", $className);
			unset($arrClassName[1]);
			require_once $this->getModelFile($arrClassName, true);
		});
	}

	public function loadMainobject(){
		$this->mainObject = $this->getModel("core.mainobject");
	}

	public function start(){
		return true;
	}

	public function getJsonConfig($path){
		$arrJsonConfig = json_decode(file_get_contents(__DIR__."/modules/config.json"), true);
		return $arrJsonConfig[$path];
	}
	public function getConfig(){
		/*
			Todos los models tienen una identificación en string. 
			"core.config.data" ( $this->getCore()->getModel("core.config.data") )
			 = nueva instancia de model core_model_config_data (/modules/core/model/config/data.php)

		*/
		return $this->getModel("core.config.data");
	}

	public function getModel($modelStr){
		if (is_object($modelStr)){
			$modelStr = get_class($modelStr);
			$arrModel = explode("_", $modelStr);
			unset($arrModel[1]);
			$arrModel = array_values($arrModel);
		} else {
			$arrModel = explode(".", $modelStr);
		}
		if (!is_file($this->getModelFile($arrModel))){
			throw new Exception("El modelo/modulo ".$modelStr." no se pudo encontrar", 1);
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

	public function getController($path){
		$arrModel = explode(".", $path);
		if (!is_file($this->getControllerFile($arrModel))){
			throw new Exception("El controller ".$path." no se pudo encontrar", 2);
		}
		require_once $this->getControllerFile($arrModel);
		$modelStr = $this->getControllerStr($arrModel);
		$model = new $modelStr();
		$model->setCore($this);
		return $model;
	}

	public function getControllerFile($arrModel){
		$strFileName = __DIR__."/controllers";
		foreach ($arrModel as $currModelPart) {
			$strFileName .= "/".$currModelPart;
		}
		$strFileName .= ".php";

		return $strFileName;
	}

	public function getControllerStr($arrModel){
		$strFileName = "controllers";

		foreach ($arrModel as $k => $currModelPart) {
			$strFileName .= "_".$currModelPart;
		}
		$strFileName = trim($strFileName, "_");
		return $strFileName;
	}

	public function getMainDir(){ //TODO
		return "pwafw";
	}

	public function printError($m){
		echo $m;
		return;
	}

	public function end(){
		return;
	}
}

?> 
