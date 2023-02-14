<?
class template {

	var $dir = '';

	function __construct($sDir = '') {
		$this->dir = $_SERVER['DOCUMENT_ROOT'].$sDir;
	}

	function template($sFile = '') {
		global $CORE;
		if(empty($sFile)) $sFile = 'template.php';

		if(file_exists($this->dir.$sFile)) {
			include($this->dir.$sFile);
		}
		else {
			return "Файл не обнаружен";
		}

	}

}