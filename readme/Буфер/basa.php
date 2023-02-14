<?

function translation($string) {
	$arLetter = [
		'a' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
		'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'к' => 'k', 'л' => 'l', 'м' => 'm',
		'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
		'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh',
		'щ' => 'shch', 'ь' => '', 'ъ' => '', 'ы' => 'y', 'э' => 'eh', 'ю' => 'yu', 'я' => 'ya'
	];
	$sNewName = '';
	$string = strtr($string, $arWord);
	for ($i = 0, $c = mb_strlen($string, 'UTF-8'); $i < $c; $i++) {
		$sSymbol = mb_substr($string, $i, 1, 'UTF-8');
		if (preg_match("#[a-z0-9\._\-\_\(\)]#i", $sSymbol)) {
			$sNewName .= $sSymbol;
		}
	}
}

function url() {
	$url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$arUrl = parse_url($url);
	$arUrl['query'] = ['line' => $arUrl['query'], 'array' => $_GET];
	preg_match("/([a-zA-Z0-9]|\-)+\.(com|ru)/", $arUrl['host'], $mDomain);
	$arUrl['domain'] = $mDomain[0];
	$subdomain = array_shift(explode(".", $arUrl['host']));
	$arUrl['subdomain'] = ($subdomain == 'www' OR strstr($arUrl['domain'], $subdomain)) ? '' : $subdomain;
	return $arUrl;
}
$url = url();

/*
Редиректы
www
http
/

*/

// 
$a = ['SECTION_BLOCK' => 5, 'ACTIVE' => 1, 'STATUS' => 'Prison'];
$s = 'DESC';//['ACTIVE'=>'DESC'];

function sqlWhere($ar) {
	if(empty($ar)) return false; else $WHERE = " WHERE ";
	foreach ($ar as $key => $value) {
		$WHERE .= array_key_first($ar) == $key ? '' : ' AND ';
		$WHERE .= $AND.'`'.$key.'`=\''.$value.'\'';
	}
	return $WHERE;
}

// $sort - 'DESC'; или ['ACTIVE'=>'DESC'];
function sqlSort($sort) {
	if(is_array($sort)) {
		$row = array_key_first($sort);
		$sort = $sort[array_key_first($sort)];
	}
	else {
		$row = 'ID';
	}
	return empty($sort) ? false : " ORDER BY `$row` $sort" ;
}

$QUERY = "SELECT * FROM `data`".sqlWhere($a).sqlSort($s);
print_r($QUERY);
// 
