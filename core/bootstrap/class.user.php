<?php
/*
p($CORE['USER']->Create([
	'LOGIN' => 'test5', 
	'PASSWORD' => 'test5', 
	'PASSWORD_RETYPE' => 'test5'
]));
*/

class user extends crud {

	// 
	protected $tableName = __CLASS__;
	private $cryptAlgo;

	public function __construct($config) {
		global $CORE;
		$this->cryptAlgo = $config;
		// Текущий пользователь
		$issetUser = $this->checkToken();
		if($issetUser) $CORE['CURRENT']['USER'] = $issetUser;
	}

	// 
	public function create($arFields = []) {
		// Фильтрация входных данных
		// Сравнение паролей
		if($arFields['PASSWORD'] != $arFields['PASSWORD_RETYPE']) {
			return "Пароли не совпадают";
		}
		unset($arFields['PASSWORD_RETYPE']);

		return $this->crudCreate($this->Encrypt($arFields), true);
	}

	public function Read($ID = false, $arFields = [], $pagination = [], $SORT = ['ID' => 'ASC'], $ROWS = '*') {
		// Фильтрация входных данных

		$arList = $this->crudRead($ID, $arFields);
		
		return $arList;
	}

	public function Update($ID, $arFields) {
		// TODO: Фильтрация входных данных
		if(!filter_var($arFields['EMAIL'], FILTER_VALIDATE_EMAIL)) return "Неверный формат E-mail";
		// Чтобы поменять логин, нужен пароль, так как он состоявляющая токена
		// Для пароля принимать два поля и сравнивать их на совпадение друг с другом
		return $this->crudUpdate($ID, $arFields);
	}

	public function Delete($ID) {
		return $this->crudDelete($ID);
	}

	// 
	public function Encrypt($arFields) {
		// if(!empty($arFields['LOGIN']) AND !empty($arFields['PASSWORD'])) {
		$arFields['PASSWORD'] = password_hash($arFields['PASSWORD'], $this->cryptAlgo);
		$arFields['TOKEN'] = password_hash($arFields['LOGIN'].$arFields['PASSWORD'], $this->cryptAlgo);
		return $arFields;
		// }
	}

	public function Auth($LOGIN, $PASSWORD) {
		// Счетчик попыток

		// Поиск такого пользователя
		$existUser = $this->Read('row', ['LOGIN' => $LOGIN]);
		// Проверка пароля
		password_verify($PASSWORD, $existUser['PASSWORD']);
		// Аутентификация
		cookie('token', $existUser['TOKEN']);
	}

	public function exit() {
		return cookie('token');
	}

	public function checkToken() {
		return empty($_COOKIE['token']) ? false : $this->Read('row', ['TOKEN' => $_COOKIE['token']]);
	}

}
