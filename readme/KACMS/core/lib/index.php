<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/function.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/core/config.php');

$arClass = ['db', 'site', 'section', 'section_block', 'block', 'design', 'template', 'element'];
foreach($arClass as $cName) {
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/class.'.$cName.'.php');
	$LIB[strtoupper($cName)] = new $cName();
}
