<?
class Section {

	var $table = DB_PREFIX."_section";

	function ID($sID) {
		return DB::Query("SELECT * FROM `".$this->table."` WHERE `ID`='$sID'", "row");
	}

	function Rows($arFilter = []) {
		// $WHERE = TOOL::WHERE($arFilter);
		return DB::Query("SELECT * FROM `".$this->table."`".$WHERE, "rows");
	}

	function Add($arPar) {
		return DB::Query("INSERT INTO `".$this->table."` VALUES(0, 1, '".$_POST['SORT']."', '".$_POST['NAME']."', '".$_POST['FOLDER']."', '".$_POST['DESIGN']."', '".$_POST['PARENT']."')");
	}

	function Delete($sID) {
		return DB::Query("DELETE FROM `".$this->table."` WHERE `ID`='$sID'");
	}

}