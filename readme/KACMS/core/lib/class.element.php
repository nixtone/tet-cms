<?
class Element {

	var $table = DB_PREFIX."_block";

	function ID($eID, $sbID) {
		global $LIB;
		$SB = $LIB['SECTION_BLOCK']->ID($sbID);
		return DB::Query("SELECT * FROM `".$this->table.$SB['BLOCK']."` WHERE `ID`='{$eID}' limit 1", "row");
	}

	function Rows($nBlock, $arFilter = [], $sSort = 'ASC', $arRows = '*') {
		if(!empty($arFilter)) {
			$WHERE = ' WHERE';
			foreach ($arFilter as $filter => $value) {
				$AND = array_key_first($arFilter) == $filter ? ' ' : ' AND ';
				$WHERE .= "$AND`$filter`='$value'";
			}
		}
		$SORT = " ORDER BY `ID` $sSort";
		$arRows = ($arRows == '*') ? $arRows : implode(',', $arRows) ;
		return DB::Query("SELECT ".$arRows." FROM `".$this->table.$nBlock."` ".$WHERE.$SORT, "rows");
	}

	function Add() {

		// DB::Query("INSERT INTO `".$this->table."` VALUES(0,1,)");
	}

	function Edit($eID, $nBlock, $arRows) {
		// return DB::Query("UPDATE ".$this->table.$nBlock." SET arInline WHERE `ID`=".$eID);
	}

	function Delete() {

	}
	
}