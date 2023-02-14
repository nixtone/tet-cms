<?php

class bootstrap {

	public function __construct() {
		global $CORE;

		// Вспомогательные функции
		require_once($_SERVER['DOCUMENT_ROOT'].'/core/dev/inc/helpers.php');
		
		// Конфиг (БД, режим разработки, праваы)
		$configPath = $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
		if(file_exists($configPath)) {
			$CORE = [
				'CURRENT' => [],
				'CONFIG' => require_once($configPath),
			];
		}
		else {
			header("location: /setup");
		}

		// Вывод ошибок, в зависимости от "режима разработки"
		if($CORE['CONFIG']['DEV_MODE']) {
			error_reporting(E_ALL ^ E_NOTICE);
			ini_set('display_errors', 1);
		}
		
		// Поиск классов ядра
		$arClass = [];
		foreach(scandir($_SERVER['DOCUMENT_ROOT'].'/core/bootstrap/') as $dirItem)
			if(preg_match("/^class\.(.+)\.php/", $dirItem, $cName)) 
				$arClass[] = $cName[1];

		// Подключение классов ядра
		spl_autoload_register(function($cName) {
			require_once($_SERVER['DOCUMENT_ROOT'].'/core/bootstrap/class.'.$cName.'.php');
		});

		// Объекты класса
		foreach($arClass as $cName) {
			if($cName == "crud" OR $cName == "template") continue;
			$CORE[strtoupper($cName)] = new $cName($CORE['CONFIG'][strtoupper($cName)] ?? []);
		}
		
	}

}
new bootstrap;
