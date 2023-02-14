<?
class Block {

	var $table = DB_PREFIX."_block";

	function ID($nID) {
		return DB::Query("SELECT * FROM `".$this->table."` WHERE `ID`='$nID'", "row");
	}
	
	function Rows($arFilter = []) {
		// $WHERE = TOOL::WHERE($arFilter);
		return DB::Query("SELECT * FROM `".$this->table."`", "rows"); // .$WHERE
	}

	
	function Add($arBlock) { // , $code

		$bID = DB::Query("INSERT INTO `{$this->table}` VALUES(0, '{$arBlock['NAME']}')");
		DB::Query("CREATE TABLE `ka_block{$bID}` (`ID` int NOT NULL,`ACTIVE` int NOT NULL,`SORT` int NOT NULL,`SECTION_BLOCK` int NOT NULL,`CATEGORY` int NOT NULL,`URL_ALTERNATIVE` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");

		// Создать таблицу элементов

		// Создать таблицу категорий, наверно (если включить категории)

		$dirName = $_SERVER['DOCUMENT_ROOT'].'/core/dev/block/'.$bID;
		mkdir($dirName);
		file_put_contents($dirName.'/controller.php', $arBlock['CONTROLLER']);
		file_put_contents($dirName.'/template.php', $arBlock['TEMPLATE']);
		file_put_contents($dirName.'/template-full.php', $arBlock['TEMPLATE_FULL']);

		return $bID;

		/*
		CREATE TABLE `ka_block1` (
		  `ID` int NOT NULL,
		  `ACTIVE` int NOT NULL,
		  `SORT` int NOT NULL,
		  `SECTION_BLOCK` int NOT NULL,
		  `CATEGORY` int NOT NULL,
		  `URL_ALTERNATIVE` text NOT NULL,
		  `NAME` varchar(255) NOT NULL,
		  `TEXT` mediumtext NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
		ALTER TABLE `ka_block1` ADD PRIMARY KEY (`ID`);

		ALTER TABLE `ka_block1`
		  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
		COMMIT;
		*/

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

	function Delete($bID) {
		$DIR = $_SERVER['DOCUMENT_ROOT'].'/core/dev/block/'.$bID;
		$directory = escapeshellarg($DIR);
		exec("rmdir /s /q $DIR");
		return DB::Query("DELETE FROM `{$this->table}` WHERE `ID`='{$bID}'");
	}

}