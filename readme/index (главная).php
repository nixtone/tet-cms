<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');
/**/
// TEST AREA





// TEST AREA END
die();

$LIB['CURRENT']['STATUS'] = 200;
$LIB['CURRENT']['ACTION'] = 'SECTION';


// Анализ адреса
if(!$URL = $LIB['URL']->Read('row', ['URL' =>$LIB['CURRENT']['URL']['REQUEST_URI']])) {
	if(empty($LIB['CURRENT']['URL']['SECTION'])) $LIB['CURRENT']['URL']['SECTION'] = ['index'];
	// 404 страница отдает код 200
	$LIB['CURRENT']['SECTION'] = $LIB['SECTION']->Read('row', ['FOLDER' => $LIB['CURRENT']['URL']['SECTION'][array_key_last($LIB['CURRENT']['URL']['SECTION'])]]);
	if($LIB['CURRENT']['SECTION']) {
		$LIB['CURRENT']['SECTION_BLOCK'] = $LIB['SECTION_BLOCK']->Read(false, ['SECTION' => $LIB['CURRENT']['SECTION']['ID']]);
		$SB = $LIB['CURRENT']['SECTION_BLOCK'];
	}
	else {
		$LIB['CURRENT']['STATUS'] = 404;
	}
}
else {
	$LIB['CURRENT']['SECTION'] = $LIB['SECTION']->Read($URL['SECTION']);
	$LIB['CURRENT']['SECTION_BLOCK'] = $LIB['SECTION_BLOCK']->Read($URL['SECTION_BLOCK']);

	$SB = [$LIB['CURRENT']['SECTION_BLOCK']['ID'] => $LIB['CURRENT']['SECTION_BLOCK']];

	$LIB['CURRENT']['BLOCK'] = $LIB['BLOCK']->Read($LIB['CURRENT']['SECTION_BLOCK']['BLOCK']);
	if($URL['CATEGORY']) {
		$LIB['CURRENT']['ACTION'] = 'CATEGORY';
		$LIB['CURRENT']['CATEGORY'] = $LIB['CATEGORY']->Read($URL['CATEGORY']);
	}
	if($URL['ELEMENT']) {
		$LIB['CURRENT']['ACTION'] = 'ELEMENT';
		$LIB['CURRENT']['ELEMENT'] = $LIB['ELEMENT']->Read($URL['ELEMENT'], ['BLOCK' => $LIB['CURRENT']['SECTION_BLOCK']['BLOCK']]);
	}
}

// Обработка кода ответа страницы
switch ($LIB['CURRENT']['STATUS']) {
	case 200: {
		header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
	} break;
	case 404: {
		header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
		// header('location: /404');
	} break;
}



// Формирование страницы
include($_SERVER['DOCUMENT_ROOT']."/core/dev/design/".$LIB['CURRENT']['SECTION']['DESIGN']."/header.php");
foreach($SB as $sBlock) {
	include($_SERVER['DOCUMENT_ROOT']."/core/dev/block/".$sBlock['BLOCK']."/controller.php");
	// p($sBlock);
}
include($_SERVER['DOCUMENT_ROOT']."/core/dev/design/".$LIB['CURRENT']['SECTION']['DESIGN']."/footer.php");

// Финиш, дебаг
p($LIB['CURRENT']);


die();

// p($LIB['DESIGN']->Create(['NAME' => 'Базовый']));
// p($LIB['DESIGN']->Delete(1));

// p($LIB['BLOCK']->Create(['NAME' => 'test2']));
// p($LIB['BLOCK']->Read('row', ['NAME' => 'Текстовая страница1']), 'vd');
// p($LIB['BLOCK']->Delete(2));

/*
p($LIB['SECTION']->Create([
	'NAME' => 'Страница не найдена',
	'FOLDER' => '404',
	'DESIGN' => 1,
	'SORT' => 10
]));
*/

/*
p($LIB['SECTION_BLOCK']->Create([
	'NAME' => 'Текстовая страница',
	'SECTION' => 1,
	'BLOCK' => 1,
	'SORT' => 10
]));
*/

// p($LIB['USER']->Create(['LOGIN' => 'test1@test.ru', 'PASSWORD' => 'test1']));
// p($LIB['USER']->Auth('test1@test.ru', 'test1'));


/*
p(ENV);
p($LIB);
p($LIB['CORE']->Current);
*/