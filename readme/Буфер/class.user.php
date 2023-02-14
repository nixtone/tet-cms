<?php

class user extends crud {

	protected $tableName = __CLASS__;
	private $cryptAlgo = PASSWORD_ARGON2I;

	public function Create($fields = []) {
		$this->Encrypt($fields);
		return $this->crudCreate($fields);
	}

	public function Read($ID = false, $arFields = []) {
		$arList = $this->crudRead($ID, $arFields);
		
		return $arList;
	}

	public function Update($ID, $fields) {

		// Если нужно сменить пароль но нет логина
		// if($fields['PASSWORD'] AND !isset($fields['LOGIN'])) $fields['LOGIN'] = $this->Read($ID)['LOGIN'];
		// Чтобы поменять логин, нужен пароль, так как он состоявляющая токена
		// if(isset($fields['LOGIN'] AND !isset($fields['PASSWORD']))) return false;
		// Для пароля принимать два поля и сравнивать их на совпадение друг с другом
		// $this->Encrypt($fields);
		return $this->crudUpdate($ID, $fields);
	}

	public function Delete($ID) {
		return $this->crudDelete($ID);
	}

	public function Encrypt(&$fields) {
		if(!empty($fields['LOGIN']) AND !empty($fields['PASSWORD'])) {
			$fields['PASSWORD'] = password_hash($fields['PASSWORD'], $this->cryptAlgo);
			$fields['TOKEN'] = password_hash($fields['LOGIN'].$fields['PASSWORD'], $this->cryptAlgo);
		}
	}

	public function Auth($login, $password) {
		// $authTry = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/core/temp/auth_try.txt'));
		$checkUser = $this->Read('row', ['LOGIN' => $login]);
		if(empty($checkUser)) return ['STATUS' => false, 'MSG' => 'Пользователь не найден'];
		if(!password_verify($password, $checkUser['PASSWORD'])) {
			// Увеличить счетчик попыток
			// Записать время попытки date('Y-m-d H:i:s')
			// strtotime("now")-strtotime('2021-04-07 23:02:00'); // Разница времени в секундах
			return ['STATUS' => false, 'MSG' => 'Неверный пароль'];
		}
		// Сбрасывать счетчик попыток
		$this->Update($checkUser['ID'], ['LAST_AUTH' => date('Y-m-d H:i:s')]);
		cookie('token', $checkUser['TOKEN']);
		return ['STATUS' => true];
	}

	public function checkToken($token) {
		return empty($token) ? false : $this->Read(false, ['TOKEN' => $token, 'AR' => 'ROW']);
	}

	public function Exit() {
		return cookie('token');
	}

}
