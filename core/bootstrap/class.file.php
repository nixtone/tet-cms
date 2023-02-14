<?php
/*

- мультизагрузка
- обработка изображений

https://snipp.ru/php/uploads-files

<form method="post" enctype="multipart/form-data">
	<input type="file" name="userfile">
	<input type="submit" value="Send" name="file_upload">
</form>

if(isset($_POST['file_upload'])) {
	p($CORE['FILE']->Upload($_FILES));
}

*/

class file {

	private $tableName = __CLASS__;
	public $path;

	public function __construct($config) {
		$this->path = $config['UPLOAD'];
	}

	function Upload($FILES) {
		$FILE = $FILES[array_key_first($FILES)];
		$EXTENSION = pathinfo($FILE['name'], PATHINFO_EXTENSION);
		
		$fileID = DB::Query("INSERT INTO `".DB::$prefix.$this->tableName."` VALUES(
			0, 
			'".$FILE['type']."', 
			'".$EXTENSION."',
			".$FILE['size'].", 
			NOW()
		)", 'lastId');
		
		$uploadStatus = move_uploaded_file(
			$FILE['tmp_name'], 
			$_SERVER['DOCUMENT_ROOT'].$this->path.$fileID.".".$EXTENSION
		);
		
		return $fileID;
	}

	public function Get($ID) {
		$arFile = DB::Query("SELECT * FROM `".DB::$prefix.$this->tableName."` WHERE `ID`=".$ID, 'row');
		$arFile['PATH'] = $this->path.$arFile['ID'].".".$arFile['EXTENSION'];
		return $arFile;
	}

	public function Delete($ID) {
		DB::Query("DELETE FROM `".DB::$prefix.$this->tableName."` WHERE `ID`=:ID", 0, ['ID' => $ID]);
		unlink(glob($_SERVER['DOCUMENT_ROOT'].$this->path.$ID.'*.*')[0]);
	}

}
