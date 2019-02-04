<?php 

class core_model_tools extends core_model_db_model{
	public function buildAttributes($arrAttributes){
		$arrStrAttrs = [];
		foreach ($arrAttributes as $k => $v) {
			if (is_array($v)){
				$v = json_encode($v);
			}
			$arrStrAttrs[] = $k."='".$v."'";
		}

		return implode(" ", $arrStrAttrs);
	}
}