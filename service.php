<?php 
/*
service.php es la "puerta" al backend.

TODO : voy a rehacer todo el sistema de controllers. Me di cuenta que no es necesario hacer los controllers con código, y directamente se pueden hacer en DB.

Esto tmb me va a permitir armar un administrador visual para crear páginas en el framework :)

*/
require_once "core.php";
$core = new Core();
$core->start();

if (!isset($_POST["formData"])){
	$_POST["formData"] = [];
}
if (!isset($_POST["getData"])){
	$_POST["getData"] = [];
}

try {
	$path = preg_replace('#/+#','/',$_POST["path"]);
	$path = trim($path, "/");
	$arrPath = explode("/", $path);
	$arrPath = array_values($arrPath);
	if (count($arrPath) < 3){
		for ($i = 0 ; $i < 3 ; $i++){
			/*$currPath = $arrPath[$i];
			if ($currPath == $core->getMainDir()){
				$i--;
				continue;
			}*/
			if (!isset($arrPath[$i])){
				$arrPath[$i] = "index";
			}
		}
	}

	$i = 0;
	$currControllerCall = [];
	foreach ($arrPath as $currPath) {
		if ($currPath == $core->getMainDir()){
			continue;
		}

		if ($i < count($arrPath)-2){
			$currControllerCall[] = $currPath;
			// error_log(implode(".", $currControllerCall));
		} else {
			// error_log(implode(".", $currControllerCall));
			$currController = $core->getController(implode(".", $currControllerCall));
			echo json_encode($currController->$currPath(json_decode($_POST["getData"]), json_decode($_POST["formData"])));
		}
		$i++;
	}
} catch (Exception $e) {
	$currController = $core->getController("error.404");
	echo json_encode($currController->index(array("path" => $path)));
}
