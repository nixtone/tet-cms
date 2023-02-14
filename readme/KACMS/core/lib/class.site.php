<?
class Site {

	function ID($nID) {
		return DB::Query("SELECT * FROM `".DB_PREFIX."_site` WHERE `ID`='$nID'", "row");
	}

}