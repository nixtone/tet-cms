<?php

class DB {

	static private $DB;
	static public $prefix;

	public function __construct($config) {
		self::$prefix = $config['PREFIX'];
		self::$DB = new PDO("mysql:host=".$config['HOST'].";dbname=".$config['NAME'], $config['USER'], $config['PASSWORD']);
		self::$DB->exec("SET NAMES UTF8");
	}

	public static function Query($sQuery = '', $flag = 0, $arParams = []) {
		global $CORE;
		$CORE['CURRENT']['DB_QUERY'][] = $sQuery;
		$query = self::$DB->prepare($sQuery);
		$query->execute($arParams);
		switch ($flag) {
			case 'rows': $result = $query->fetchAll(PDO::FETCH_ASSOC); break;
			case 'row': $result = $query->fetch(PDO::FETCH_ASSOC); break;
			case 'lastId': $result = self::$DB->lastInsertId(); break;
			default: $result = $query; break;
		}
		return $result;
	}

	// Из массива строка для WHERE, вида "(`NAME`=:NAME OR `NAME`=) AND `CREATED`=:CREATED"
	public static function whereChain($arFields) {
		$WHERE = !empty($arFields) ? ' WHERE ' : '';
		foreach ($arFields as $field => $fVal) {
			$AND = array_key_first($arFields) != $field ? ' AND ' : '' ;
			if($field == 'WHERE') {
				$WHERE .= (count($arFields) > 1 ? $AND : '').$arFields['WHERE'];	
				continue;
			}
			if(is_array($fVal)) {
				foreach ($fVal as $index => $fValItem) {
					$OR = array_key_first($fVal) == $index ? $AND.'(' : ' OR ';
					$WHERE .= $OR.'`'.$field.'`=\''.$fValItem.'\''.(array_key_last($fVal) == $index ? ')' : '');
				}
			}
			else {
				$WHERE .= $AND.'`'.$field.'`=\''.$fVal.'\'';
			}
		}
		return $WHERE;
	}

	// Из массива строка для SET, вида "`NAME`=:NAME,`CREATED`=:CREATED"
	public static function setChain($arFields) {
		foreach($arFields as $name => $value) $arChain[] = "`$name`=:$name";
		return " SET ".implode(",", $arChain);
	}

}
