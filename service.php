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

$path = clearPath($core, $_POST["path"]);

$currController = $core->getModel("core.controller")->load($path, "path");
if (empty($currController->getID())){ // 404
	$e404Controller = $core->getModel("core.controller")->load("[404]", "path");
	if (empty($e404Controller->getID())) die("ERROR: 404 no configurado");

	echo json_encode($e404Controller->getResponseData($_POST));
	$core->end();
}
echo json_encode($currController->getResponseData($_POST));
$core->end();


function clearPath($core, $path){
	$path = mb_strtolower($path);
	$path = preg_replace('#/+#','/',$_POST["path"]);
	$path = trim($path, "/");
	$arrPath = explode("/", $path);
	foreach ($arrPath as $k => $currPathPart) {
		if ($currPathPart == $core->getMainDir()){
			unset($arrPath[$k]);
		}
	}
	$arrPath = array_values($arrPath);
	$path = implode("/", $arrPath);
	if ($path == "") $path = "/";

	return $path;
}