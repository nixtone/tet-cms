<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');
switch($_POST['CODE']) {
    // Новый раздел
    case 'SECTION_ADD': {
        $redirect = '/core/admin/section/block?sid='.$LIB['SECTION']->Create($_POST);
    } break;
    // Редакция раздела
    case 'SECTION_EDIT': {
        
    } break;

    // Новый блок раздела
    case 'SECTION_BLOCK_ADD': {
        $LIB['SECTION_BLOCK']->Create($_POST);
        $redirect = '/core/admin/section/block?sid='.$_POST['SECTION'];
    } break;
    // Редакция блока раздела
    case 'SECTION_BLOCK_EDIT': {
        $LIB['SECTION_BLOCK']->Update($_POST['SB'], $_POST);
        $redirect = '/core/admin/section/block?sid='.$_POST['SID'];
    } break;

    // 
    case '': {

    } break;
    // 
    case '': {

    } break;
}
redirect($redirect);
