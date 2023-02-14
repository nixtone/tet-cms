<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');

$CURRENT['ACTION'] = 'SECTION';
$CURRENT['STATUS'] = 200;
$CURRENT['SITE'] = $LIB['SITE']->ID(1);
// Анализ адреса
$url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$arUrl = parse_url($url);

$CURRENT['URL']['ADDR'] = $url;
$CURRENT['URL']['PROTOCOL'] = $arUrl['scheme'];
$CURRENT['URL']['DOMAIN'] = $arUrl['host'];
$CURRENT['URL']['PATH'] = $arUrl['path'];
$CURRENT['URL']['QUERY'] = $_GET;//$arUrl['query'];

$FOLDER = array_filter(explode("/", $CURRENT['URL']['PATH']));

if($FOLDER[1] == 'admin') {
	include($_SERVER['DOCUMENT_ROOT'].'/core/admin/index.php');
	die();
}


preg_match("#(.*?)/([c]?)(\d+)/(\d+)(/)?$#i", $CURRENT['URL']['PATH'], $arMatch);
p($arMatch);
/*
$arPath = pathinfo($arMatch[1]);
$arPath['SECTION_BLOCK'] = $arMatch[3];
if ($arMath[2]) {
	$CURRENT['ACTION'] = 'category';
	$arPath['CATEGORY'] = $arMatch[4];
} else {
	$CURRENT['ACTION'] = 'element';
	$arPath['ELEMENT'] = $arMatch[4];
}
*/


// Определение текущего раздела
$CURRENT['SECTION'] = $LIB['SECTION']->ID($CURRENT['SITE']['SECTION_INDEX']);
$arSBlock = $LIB['SECTION_BLOCK']->Rows($CURRENT['SECTION']['ID']);


/*
$arParse = parse_url($_GET['PATH']);
preg_match("#(.*?)/([c]?)(\d+)/(\d+)(/)?$#i", $arParse['path'], $arMatсh);
$arPath = pathinfo($arMath[1]);
$arPath['SECTION_BLOCK'] = $arMath[3];
if ($arMath[2]) {
	$CURRENT['ACTION'] = 'CATEGORY';
	$arPath['CATEGORY'] = $arMath[4];
} else {
	$CURRENT['ACTION'] = 'ELEMENT';
	$arPath['ELEMENT'] = $arMath[4];
}

switch ($CURRENT['STATUS']) {
	case 200: {
		header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
	} break;
	case 404: {
		header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
		header('location: /404.php');
	} break;
}
*/


// Формирование страницы
$design = new template('/core/dev/design/'.$CURRENT['SECTION']['DESIGN'].'/');
$design->template('header.php');
foreach(arGag($arSBlock) as $sBlock) {
	$CURRENT['SECTION_BLOCK'] = $sBlock;
	$CURRENT['BLOCK'] = $LIB['BLOCK']->ID($CURRENT['SECTION_BLOCK']['BLOCK']);
	$sBlockObj = new template('/core/dev/block/'.$sBlock['ID'].'/');
	$incController = $sBlockObj->template('controller.php');
}
$design->template('footer.php');
