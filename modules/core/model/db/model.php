<?php 

class core_model_db_model extends core_model_glaobject{
	protected $_currCursor;

	public function _getSql(){
		$sql = new mysqli("127.0.0.1", "root", "root", "pwafw");
		if ($sql->connect_errno) {
			throw new Exception("Fallo al conectar a MySQL: " . $mysqli->connect_error);
		}

		return $sql;
	}
	public function load($id, $field = ""){
		if ($this->getData()){
			return $this;
		}




		$sqlLoad = "SELECT * from ".$this->getTableName()." where ";
		if ($field){
			$sqlLoad .= $field;
		} else {
			$sqlLoad .= $this->getPrimaryIdx();
		}

		$sqlLoad .= " = '".$id."'";

		$curLoad = $this->_getSql()->query($sqlLoad);
		$this->setData($curLoad->fetch_assoc());

		return $this;
	}

	public function getTableName($model = false){
		if ($model){
			$str = get_class($model);
		} else {
			$str = get_class($this);
		}
		$arrStr = explode("_", $str);
		$finalStr = "";
		$k = 0;
		foreach ($arrStr as $currStr) {
			if ($k == 1){
				$k++;
				continue;
			}
			$finalStr .= $currStr."_";
			$k++;
		}
		$finalStr = trim($finalStr, "_");
		return $finalStr;
	}

	public function getPrimaryIdx($model = false){
		return $this->getTableName($model)."_id";
	}

	public function _setSelect($query){
		$this->_currCursor = $this->_getSql()->query($query);
		return $this;
	}

	public function getIterator() {
		$new = new core_model_glaobject();
		if (isset($this->_currCursor)){
			$new->setData($this->_currCursor->fetch_assoc());
			//return $this;	
		}

		return new ArrayIterator([$new]); // solo corre la cantidad de valores del array, o sea 1
	}


}