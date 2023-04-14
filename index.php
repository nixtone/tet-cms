<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/bootstrap/index.php');


// ACTION (SECTION, CATEGORY, ELEMENT)
/*
$CORE['CURRENT']['ACTION'] = 'SECTION';
*/




// Код ответа страницы
/*
switch ($CURRENT['STATUS']) {
	case 200: {
		header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
	} break;
	case 404: {
		header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
		header('location: /404.php');
	} break;
}
$CORE['CURRENT']['STATUS'] = 200;
# Код ответа страницы 404
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
*/

// Текущий раздел, элемент
$CORE['CURRENT']['SECTION'] = $CORE['SECTION']->Read($CORE['CURRENT']['URL']['DB']['SECTION']);
$CORE['CURRENT']['SECTION_BLOCK'] = $CORE['SECTION_BLOCK']->Read(false, ['SECTION_ID' => $CORE['CURRENT']['SECTION']['ID']]);

if($CORE['CURRENT']['URL']['DB']['ELEMENT']) {
	$CORE['CURRENT']['ACTION'] = "ELEMENT";
}
else {
	$CORE['CURRENT']['ACTION'] = "SECTION";
}

// Формирование и вывод страницы
ob_start();
// require_once($_SERVER['DOCUMENT_ROOT']."/core/dev/design/1.php");
$design = new template("/core/dev/design/");
$design->template("1.php");

$page = ob_get_contents();
ob_end_clean();

echo $page; // htmlVar()





////////////////////////////////////////////////////////////////



// p($CORE['TEST']->Read([
// 	'LOGIN' => 'test5', 
// 	'PASSWORD' => 'test5', 
// 	'PASSWORD_RETYPE' => 'test5'
// ]));

// p($CORE['USER']->Read(false, [], ['PAGE' => 1, 'COUNT' => 2]));

// p($TEST, 'vd');


// p($CORE);

