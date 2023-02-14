<?
class DB {

	static private $db;

	public function __construct() {
		if(defined('DB_NAME')) { // расширить проверку
			if(self::$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD)) {
				self::$db->exec("SET NAMES UTF8");
			}
		}
		else {
			if($_SERVER['REQUEST_URI'] != '/setup/') header('location: /setup/', 500);
		}
	}

	public static function Query($sQuery, $flag = 1) {
		$sqlQuery = self::$db->query($sQuery);
		switch ($flag) {
			case 'rows': {
				$sqlData = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
				foreach($sqlData as $item) $result[$item['ID']] = $item;
			} break;
			case 'row': {
				$result = $sqlQuery->fetch(PDO::FETCH_ASSOC);
			} break;
			default: $result = self::$db->lastInsertId(); break;
		}
		return $result;
	}

}