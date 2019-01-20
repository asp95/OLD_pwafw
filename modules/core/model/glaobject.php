<?php 


class core_model_glaobject /*extends ArrayObject*/{
	private $data;

	private $core;

	public function __construct($k = []){
		if ($k === false){
			return false;
		}
		$this->data = $k;
		//parent::__construct($this->data, self::ARRAY_AS_PROPS);
	}

	/*public function append($val){
		$this->data[] = $val;
		parent::append($val);
	}

	public function exchangeArray($val){
		$this->data = $val;
		parent::exchangeArray($val);
	}

	public function offsetGet($i){
		return $this->data[$i];
	}

	public function offsetSet($i, $v){
		$this->data[$this->getKeyname($i)] = $v;
		parent::offsetSet($this->getKeyname($i), $v);
	}

	public function offsetUnset($k){
		unset($this->data[$this->getKeyname($k)]);
		parent::unset($k);
	}

	public function serialize(){
		return json_encode($this->data);
	}

	public function uasort($fn){
		uasort($this->data, $fn);
		parent::uasort($fn);
	}

	public function uksort($fn){
		uksort($this->data, $fn);
		parent::uksort($fn);
	}

	public function unserialize($str){
		$this->data = json_decode($str);
		parent::unserialize(serialize(json_decode($str)));
	}*/

	public function __call($fnName, $args){
		if (strpos($fnName, "set") === 0){
			$this->data[$this->getKeyname($fnName)] = $args[0];
			return $this;
		} else if (strpos($fnName, "get") === 0) {
			if (isset($this->data[$this->getKeyname($fnName)])){
				return $this->data[$this->getKeyname($fnName)];
			} else {
				return null;
			}
		}
	}

	public function getCore(){
		return $this->core;
	}
	public function setCore($core){
		return $this->core = $core;
	}

	public function getKeyname($str){
		$arrUppercaseSeparator = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$keyname = "";

		$arrStr = str_split($str);
		$k = 0;
		foreach ($arrStr as $currStr) {
			if (in_array($k, [0, 1, 2])){
				$k++;
				continue;
			}
			if (in_array($currStr, $arrUppercaseSeparator)){
				$keyname .= "_";
				$keyname .= strtolower($currStr);
			} else {
				$keyname .= $currStr;
			}
			$k++;
		}
		$keyname = trim($keyname, "_");

		return $keyname;
	}

	public function getCaller($keyName, $type = "get"){
        $arrName = explode("_", $keyName);
        foreach ($arrName as $k => $currPart) {
            if (is_numeric($currPart[0])){
                $currPart = "_".$currPart;
            }
            $arrName[$k] = ucwords($currPart);
        }
        return $type.implode("", $arrName);
	}
	public function getGetter($keyName){
		return $this->getCaller($keyName);
	}
	public function getSetter($keyName){
		return $this->getCaller($keyName, "set");
	}

	public function getData($key = false){
		if ($key != false){
			return $this->data[$key];
		}
		if ($this->data == []){
			return null;
		} else {
			return $this->data;
		}
	}

	public function setData($arr){
		$this->data = $arr;
	}
}