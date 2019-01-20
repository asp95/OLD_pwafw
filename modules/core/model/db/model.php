<?php 

class core_model_db_model extends core_model_glaobject{
	protected $_currCursor = null;

	protected $_describe = null;

	protected $_items = [];

	protected $_itemIdx = 0;

	protected $_select = null;

	protected $_sql = null;

	public function _getSql(){
		if (!is_null($this->_sql)){
			return $this->_sql;
		}

		$this->_sql = new mysqli("127.0.0.1", "root", "", "pwafw");
		if ($this->_sql->connect_errno) {
			throw new Exception("Fallo al conectar a MySQL: " . $this->_sql->connect_error);
		}

		return $this->_sql;
	}

	function __destruct() {
		$this->_getSql()->close();
	}
	public function load($id, $field = ""){
		if ($this->getData()){
			return $this;
		}
		if (is_array($id)){
			$this->setData($id);
			return $this;
		}

		if (!$this->_describe){
			$this->_describe = $this->getDescribe();
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
		$this->_select = $sqlLoad;

		return $this;
	}

	public function getDescribe(){
		$describe = $this->getCore()->getModel("core.db.describe");
		return $describe->_setSelect("describe ".$this->getTableName());
	}

	public function getID(){
		$getter = $this->getGetter($this->getPrimaryIdx());
		return $this->$getter();
	}

	public function setID($value){
		$setter = $this->getSetter($this->getPrimaryIdx());
		return $this->$setter($value);
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
		$this->_select = $query;
		$this->_currCursor = $this->_getSql()->query($query);
		return $this;
	}
	public function _getSelect()
	{
		return $this->_select;
	}

	public function fetch() {
		if (is_null($this->_currCursor) && empty($this->_items[$this->_itemIdx])){
			$this->_itemIdx = 0;
			return false;
		}
		if (!($data = $this->_currCursor->fetch_assoc()) && empty($this->_items[$this->_itemIdx])){
			$this->_itemIdx = 0;
			return false;
		}

		if (!isset($this->_items[$this->_itemIdx])){
			$this->_items[$this->_itemIdx] = $this->getCore()->getModel($this)->load($data);
		}

		return $this->_items[$this->_itemIdx++];
	}

	public function save(){
		if (!$this->_describe){
			$this->_describe = $this->getDescribe();
		}

		$arrFields = [];
		while($currField = $this->_describe->fetch()){
			$arrFields[] = $currField->getData("Field");
		}
		if ($idIdx = array_search($this->getPrimaryIdx(), $arrFields) !== false){
			unset($arrFields[$idIdx-1]);
			$arrFields = array_values($arrFields);
		}

		if ($this->getID()){
			$sql = "UPDATE ".$this->getTableName()." set ";
			foreach ($arrFields as $currField) {
				$getter = $this->getGetter($currField);
				$sql .= $currField."='".$this->_getSql()->real_escape_string($this->$getter())."',";
			}
			$sql = trim($sql, ",");

			$sql .= " where ". $this->getPrimaryIdx()."=".(int)$this->getID().";";

			if (!$this->_getSql()->query($sql)){
				throw new Exception($this->_getSql()->error);
			}
		} else {
			$sql = "INSERT into ".$this->getTableName()." (".implode(",", $arrFields).") values ";

			$arrValues = [];
			foreach ($arrFields as $currField) {
				$getter = $this->getGetter($currField);
				$arrValues[] = "'".$this->_getSql()->real_escape_string($this->$getter())."'";
			}
			$sql .= "(".implode(",", $arrValues).")";
			if (!$this->_getSql()->query($sql)){
				throw new Exception($this->_getSql()->error);
			}
			$this->setID($this->_getSql()->insert_id);
		}
		return $this;

	}


}