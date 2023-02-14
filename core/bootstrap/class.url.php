<?php

class url extends crud {

	protected $tableName = __CLASS__;

	public function __construct() {
		global $CORE;
		preg_match("/[a-z]+\.[a-z]+$/", $_SERVER['HTTP_HOST'], $host);
		$parse = parse_url($_SERVER['REQUEST_URI']);
		$CORE['CURRENT']['URL']['DOMAIN'] = $host[0];
		$CORE['CURRENT']['URL']['HTTP_HOST'] = $_SERVER['HTTP_HOST'];
		$CORE['CURRENT']['URL']['PROTOCOL'] = stripos($_SERVER['SERVER_PROTOCOL'], 'https') ? 'https' : 'http';
		$CORE['CURRENT']['URL']['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
		// Разделы
		$CORE['CURRENT']['URL']['PATH'] = $parse['path'];

		// $CORE['CURRENT']['URL']['SECTION']['LIST'] = array_filter(explode('/', $CORE['CURRENT']['URL']['SECTION']['PATH']));

		// get переменные
		if(isset($parse['query'])) {
			$CORE['CURRENT']['URL']['QUERY'] = $parse['query'];
			$CORE['CURRENT']['URL']['GET'] = $_GET;
		}

		if($CORE['CURRENT']['URL']['PATH'] != "/core/admin/") {
			$CORE['CURRENT']['URL']['DB'] = $this->Read('row',['URL' => $CORE['CURRENT']['URL']['PATH']]);
		}
		
	}

	public function create($arFields = []) {
		return $this->crudCreate($arFields);
	}

	public function Read($ID = false, $arFields = [], $pagination = [], $sort = ['ID' => 'ASC'], $rows = []) {
		$result = [];
		// Запрос данных
		$arList = $this->crudRead($ID, $arFields);
		return $arList;
		// Обработка ответных данных
		foreach($arList as $id => $item) {
			$result[$item['ID']] = $item;
		}

		return $result;
	}

	public function Update($ID, $arFields) {
		return $this->execute_update($arFields);
	}

	public function Delete($ID) {
		return $this->execute_delete($ID);
	}

}
