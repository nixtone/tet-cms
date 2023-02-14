<?
class user extends crud {

	protected $tableName = __CLASS__;

	private $cryptAlgo = PASSWORD_ARGON2I; // PASSWORD_DEFAULT, PASSWORD_BCRYPT, PASSWORD_ARGON2ID

	public function Create($arFields = []) {
		$this->Encrypt($arFields);
		$arFields['EMAIL'] = $arFields['EMAIL'] ?? '';
		$arFields['USER_GROUP'] = 1;
		$arFields['ACTIVE'] = 1;
		return ['ID' => $this->execute_create($arFields)];
	}

	public function Read($ID = false, $arFields = [], $pagination = [], $sort = ['ID' => 'ASC'], $rows = []) {
		$result = [];
		// $ar_status = $arFields['AR'];
		// unset($arFields['AR']);
		// Запрос данных
		$arList = $this->execute_read($ID, $arFields, $pagination, $sort, $rows);
		// Обработка ответных данных
		foreach($arList as $id => $item) {
			$result[$item['ID']] = $item;
		}
		// if($ar_status == 'ROW') $result = $result[array_key_first($result)];
		
		
		return $result;
	}
	
	/*
	public function row() {
		return $this->result[array_key_first($this->result)];
	}
	*/

	public function Update($ID, $arFields) {
		return $this->execute_update($ID, $arFields);
	}

	public function Delete($ID) {
		return $this->execute_delete($ID);
	}

	// Шифровка пароля и генерация токена авторизации
	private function Encrypt(&$fields) {
		if($fields['LOGIN'] AND $fields['PASSWORD']) {
			$fields['PASSWORD'] = password_hash($fields['PASSWORD'], $this->cryptAlgo);
			$fields['TOKEN'] = password_hash($fields['LOGIN'].$fields['PASSWORD'], $this->cryptAlgo);
		}
	}

	public function Auth($login, $password) {
		$fields = ['LOGIN' => $login, 'PASSWORD' => $password];
		$checkUser = $this->Read(false, ['LOGIN' => $login, 'AR' => 'ROW']);
		if(empty($checkUser)) return ['STATUS' => false, 'MSG' => 'Пользователь не найден'];
		if(!password_verify($password, $checkUser['PASSWORD'])) return ['STATUS' => false, 'MSG' => 'Неверный пароль'];
		return cookie('token', $checkUser['TOKEN']);
	}

	public function checkToken($token) {
		return empty($token) ? false : $this->Read(false, ['TOKEN' => $token, 'AR' => 'ROW']);
	}

	public function exit() {
		return cookie('token');
	}

}
