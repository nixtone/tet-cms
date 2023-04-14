<?php

class crud {

	protected function crudCreate($arFields = [], $created_at = false) {
		// Поиск дублей

		// Текущая дата-время
		if($created_at) $arFields['CREATED_AT'] = date('Y-m-d H:i:s');
		// Создание
		return DB::Query("INSERT INTO `".DB::$prefix.$this->tableName."`".DB::setChain($arFields), "lastId", $arFields);
	}

	public function ReadOne($ID = false, $arFields = []) {
		$arList = $this->crudRead($ID, $arFields);
		return $arList[array_key_first($arList)];
	}

	protected function crudRead($ID = false, $arFields = [], $pagination = [], $SORT = ['ID' => 'ASC'], $ROWS = '*') {
		
		$LIMIT = '';
		$row_s = "rows";
		if(is_int($ID) OR $ID == "row") $row_s = "row";
		if($ID AND $ID != 'row') $arFields['ID'] = $ID;
		
		/*
		
		if($ID) $fields['ID'] = $ID;

		$LIMIT = '';
		
		
		$arList = DB::Query("SELECT ".(empty($ROWS) ? '*' : "`".implode("`,`", $ROWS)."`")." FROM ".DB::$prefix.$this->tableName.DB::whereChain($arFields).$SORT.$LIMIT, 'rows');
		*/

		if(!empty($pagination)) {
			global $CORE;
			$page = $_GET['PAGE'] ?? $pagination['PAGE'];
			// Элементов всего
			$CORE['PAGINATION']['ITEM_TOTAL'] = DB::Query("SELECT count(ID) FROM `".DB::$prefix.$this->tableName."`".DB::whereChain($arFields), 'row')['count(ID)']; 
			// Элементов на странице
			$CORE['PAGINATION']['ITEM_ONPAGE'] = $pagination['COUNT'];
 			// Кол-во страниц
			$CORE['PAGINATION']['PAGES'] = ceil($CORE['PAGINATION']['ITEM_TOTAL'] / $pagination['COUNT']);
			$CORE['PAGINATION']['START'] = $page ? ($page - 1) * $pagination['COUNT'] : 0;
			$LIMIT = " LIMIT {$CORE['PAGINATION']['START']}, {$pagination['COUNT']}";
		}

		
		if($SORT) $SORT = " ORDER BY `".array_key_first($SORT)."` ".$SORT[array_key_first($SORT)];
		$arList = DB::Query("SELECT ".(is_array($ROWS) ? "`".implode("`,`", $ROWS)."`" : '*')." FROM ".DB::$prefix.$this->tableName.DB::whereChain($arFields).$SORT.$LIMIT, $row_s);
		return $arList;
	}

	protected function crudUpdate($ID, $arFields) {
		return DB::Query("UPDATE `".DB::$prefix.$this->tableName."`".DB::setChain($arFields)." WHERE `ID`=:ID", 0, array_merge($arFields, ['ID' => $ID]));
	}

	protected function crudDelete($ID) {
		return DB::Query("DELETE FROM `".DB::$prefix.$this->tableName."` WHERE `ID`=:ID", 0, ['ID' => $ID]);
	}

}
