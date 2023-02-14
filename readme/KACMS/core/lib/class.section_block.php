<?
class section_block {

	var $table = DB_PREFIX."_section_block";

	function ID($sbID) {
		return DB::Query("SELECT * FROM `".$this->table."` WHERE `ID`='$sbID'", "row");
	}

	function Rows($sID) {
		return DB::Query("SELECT * FROM `".$this->table."` WHERE `SECTION`='$sID'", "rows");
	}

}