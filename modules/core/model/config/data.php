<?php 

class core_model_config_data extends core_model_db_model {
/*
	el nombre de la clase tiene que respetar la estructura de archivos desde /modules/, siendo la última parte el nombre del propio archivo.

	todos los models deben extender de core_model_db_model (/modules/core/model/db/model.php)
*/
	public function getVar($varStr){
		/*
			Todos los models pueden tener opcionalmente una tabla. 
			En este caso el nombre de la tabla es "core_config_data" (igual al identificador, con "_")

			La tabla debe tener un campo ID llamado "core_config_data_id" (nombre de tabla + "_id")
		*/
		$this->load($varStr, "path");
		/*
			load($value, $field = "")
			carga el modelo con los datos del registro de la tabla "core_config_data" con el ID = $value

			si se define un $field, se cargará con los datos del primer registro encontrado con el "$field" = $value
		*/
		return $this->getValue();
		/*
			->getValue()
			->setValue("test")
				getter | setter del campo "value" del registro cargado

			quedan armados getter y setter de cada campo del registro

			ej:
				campo = "initial_scale"
				getter = getInitialScale()
				setter = setInitialScale(0.5)

			AVISO: Los setters/getters se pueden usar para almacenar cualquier variable. No está restringido a los campos en DB
		*/
	}

	public function setVar($k, $v){
		$newVar = $this->getCore()->getModel("core.config.data");
		$newVar->setPath($k);
		$newVar->setValue($v);
		$newVar->save();
		/*
			save()
				Inserta o actualiza los valores modeificados de un model cargado
				Ignora todas las variables de setters/getters que no coincidan con los campos existentes en DB

				En caso de insertar un registro nuevo (si se llena el objeto sin cargarlo previamente (load()) en $model->getID() termina cargado el auto_increment ID)
		*/
	}
}