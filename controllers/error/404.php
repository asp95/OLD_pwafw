<?php

/**
 * 
 */
class controllers_error_404 extends core_model_controller{	
	public function index($get, $post = []){
		return $this->loadComponents(["error_404"], $get, $post);
	}
}