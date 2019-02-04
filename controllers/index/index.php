<?php

class controllers_index_index extends core_model_controller{
	public function index($get, $post = []){
		return $this->loadComponents(["index_index"], $get, $post);
	}
}