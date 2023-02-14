<?
class Design {

	var $table = DB_PREFIX."_design";

	function ID($nID) {
		return DB::Query("SELECT * FROM `".$this->table."` WHERE `ID`='$nID'", "row");
	}
	
	function Rows($arFilter = []) {
		// $WHERE = TOOL::WHERE($arFilter);
		return DB::Query("SELECT * FROM `".$this->table."`", "rows"); // .$WHERE
	}

	
	function Add($bName, $code) {
		/*$newBlockID = DB::Query("INSERT INTO `".$this->table."` VALUES(0, '$bName')");
		DB::Query("CREATE TABLE IF NOT EXISTS `".$this->table.$newBlockID."` (`ID` int(11) NOT NULL,`ACTIVE` int(11) NOT NULL,`SORT` varchar(255) NOT NULL,`SECTION` int(11) NOT NULL,`SECTION_BLOCK` int(11) NOT NULL,`CATEGORY` int(11) NOT NULL,`URL_ALTERNATIVE` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		DB::Query("ALTER TABLE `".$this->table.$newBlockID."` ADD PRIMARY KEY (`ID`);");
		DB::Query("ALTER TABLE `".$this->table.$newBlockID."` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;");
		$dirName = $_SERVER['DOCUMENT_ROOT'].'/core/dev/block/'.$newBlockID;
		mkdir($dirName);
		file_put_contents($dirName.'/controller.php', $code['controller']);
		file_put_contents($dirName.'/template.php', $code['template']);
		file_put_contents($dirName.'/template-full.php', $code['template-full']);
		return $newBlockID;*/
	}
	
	function Edit() {

	}

	function Delete() {
		
	}

}