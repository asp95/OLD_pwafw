<?php

header("Content-type: text/css");

$tools = $core->getModel("core.tools");
foreach ($core->getCssList() as $cssFile => $optionalData) {
	echo file_get_contents($cssFile);
	echo "\n";
}