<?php

class section extends crud {

	protected $tableName = __CLASS__;

	public function create($arFields = []) {
		return $this->crudCreate($arFields, true);
	}

	public function Read($ID = false, $arFields = []) {
		$arList = $this->crudRead($ID, $arFields);
		
		return $arList;
	}

	public function Update($ID, $arFields) {
		return $this->crudUpdate($arFields);
	}

	public function Delete($ID) {
		return $this->crudDelete($ID);
	}

}