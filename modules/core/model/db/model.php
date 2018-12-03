<?php 

class core_model_db_model extends core_model_glaobject{
	public function load($id, $field = ""){
		/*if ($this->getData()){
			return $this;
		}*/

		$sql = new mysqli("127.0.0.1", "root", "", "pwafw");
		if ($sql->connect_errno) {
		    throw new Exception("Fallo al conectar a MySQL: " . $mysqli->connect_error);
		}


		$sqlLoad = "SELECT * from ".$this->getTableName()." where ";
		if ($field){
			$sqlLoad .= $field;
		} else {
			$sqlLoad .= $this->getPrimaryIdx();
		}

		$sqlLoad .= " = '".$id."'";

		$curLoad = $sql->query($sqlLoad);
		$this->setData($curLoad->fetch_assoc());

		return $this;
	}

	public function getTableName(){
		$str = get_class($this);
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

	public function getPrimaryIdx(){
		return $this->getTableName()."_id";
	}
}