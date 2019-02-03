<?php

header("Content-type: text/css");
$Css = new pwafwCss();
echo $Css->getAllCss();

class pwafwCss {
	public function getAllCss($path = "/css"){
		$CssDir = __DIR__.$path;
		$arrFiles = scandir($CssDir);
		$strOut  = "";
		foreach ($arrFiles as $currFile) {
			if ($currFile[0] == "."){
				continue;
			}
			if (is_dir($currFile)){
				$strOut = $this->getAllCss($CssDir."/".$currFile);
				continue;
			}

			$strOut .= file_get_contents($CssDir."/".$currFile)."\n";
		}
		return $strOut;
	}
}