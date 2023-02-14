<?
// p($test1, 'pr', __FILE__, __LINE__); 
function p($sData, $flag = 'pr', $FILE = '', $LINE = '') {
	global $CORE;
	if(!$CORE['CONFIG']['DEV_MODE']) return false;
	echo '<pre style="background:#fafafa;color:black;font-size:1em;margin:10px 0;white-space:pre-wrap">';
	foreach ($GLOBALS as $sKey => $sValue) if($sValue == $sData AND !empty($sValue)) $varName = $sKey;
	if($flag!='file') echo '<div style="display:flex;justify-content:space-between;padding:7px 12px;background:#e0e0e0;"><b>'.(empty($varName) ? 'Нет данных' : '$'.$varName ).'</b> '.(empty($FILE) ? '' : $FILE.'('.$LINE.')').'</div><div style="padding:7px 12px;">';
	switch ($flag) {
		case 'pr': print_r($sData); break;
		case 'vd': var_dump($sData); break;
		case 'file': {
			$dump = print_r($sData, true)."\n";
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/p $".$varName." - ".date('H;i;s d.m.Y').".txt", $dump);
		} break;
	}
	if($flag!='file') echo '</div></pre>';
}

function cookie($name, $content = '', $expires = '+1 year') {
	global $CORE;
	$cookieArgs = [
		'path' => '/', 
		'samesite' => 'Lax', 
		'domain' => $CORE['CURRENT']['URL']['DOMAIN']
	];
	$expires = empty($content) ? 0 : strtotime($expires);
	if(empty($content)) {
		$cookieArgs['expires'] = $expires; 
	}
	else {
		$cookieArgs['expires'] = $expires;
		if(isset($_SERVER['HTTPS'])) {
			$cookieArgs = array_merge($cookieArgs, ['secure' => true, 'httponly' => true]);
		}
	}
	return setcookie($name, $content, $cookieArgs);
}

function redirect($url) {
	// die("<script>window.location.href='{$url}'</script>");
	header("Location: ".$url);
}

function translit($sName) {
	$arLetter = [
	'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
	'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
	'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
	'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
	'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
	'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
	'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

	'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
	'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
	'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
	'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
	'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
	'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
	'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
	];
	$sNewName = '';
	$sName = str_replace(" ", "-", $sName);
	$sName = strtr($sName, $arLetter);
	for ($i = 0, $c = mb_strlen($sName, 'UTF-8'); $i < $c; $i++) {
		$sSymbol = mb_substr($sName, $i, 1, 'UTF-8');
		if (preg_match("#[a-z0-9\._\-\_\(\)]#i", $sSymbol)) $sNewName .= $sSymbol;
	}
	return $sNewName;
}

function sendCurl($url, $headers = [], $post = [], $curlOpt = []) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// curl_setopt_array($curl, $curlOpt);

	if(!empty($headers)) {
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($curl, CURLINFO_HEADER_OUT, false);
	}
	if(!empty($post)) {
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post); // http_build_query
	}
	// curl_setopt($curl, CURLOPT_PUT, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	$result['data'] = curl_exec($curl);
	$result['error'] = curl_error($curl);
	$result['code'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	return $result;
}

function SizeConvert($bytes, $decimals = 2) {
	$sz = 'BKMGTP';
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .' '. @$sz[$factor];
}

function hvar($text) {
	global $CORE;
	foreach($CORE['LIST']['HVAR'] as $varName => $value) {
		$text = str_replace("<!-- $".$varName."$ -->", $value, $text);
	}
	return $text;
}