<?php 

class core_model_error_404 extends core_model_db_model{
	public function loadByRequest($get, $post){
		return $get;
	}

}