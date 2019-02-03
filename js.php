<?php

$js = new pwafwJs();
echo $js->getAllJs();

class pwafwJs {
	public function getAllJs($path = "/js"){
		$jsDir = __DIR__.$path;
		$arrFiles = scandir($jsDir);
		$strOut  = "";
		foreach ($arrFiles as $currFile) {
			if ($currFile[0] == "."){
				continue;
			}
			if (is_dir($currFile)){
				$strOut = $this->getAllJs($jsDir."/".$currFile);
				continue;
			}
			$strOut .= file_get_contents($jsDir."/".$currFile)."\n";
		}
		return $strOut;
	}
}