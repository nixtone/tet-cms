<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');

// Выход из админки
if(isset($LIB['CURRENT']['URL']['GET']['exit'])) {
    $LIB['USER']->Exit();
    redirect('/core/admin');
}
// Проверка полномочий
if(!isset($LIB['CURRENT']['USER']) OR $LIB['CURRENT']['USER']['PERMISSION'] > 2) die(include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/auth.php'));


// Контроллеры разделов админки
$LIB['CURRENT']['TEMPLATE'] = $_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/';
switch($LIB['CURRENT']['URL']['PARSE_URL']['path']) {

    // Главная страница админки
    case '/core/admin/': {
        $LIB['CURRENT']['TEMPLATE'] .= 'main.php';
    } break;


    // Новый раздел
    case '/core/admin/section/add': {
        $LIST['DESIGN'] = $LIB['DESIGN']->Read();
        $LIB['CURRENT']['TITLE'] = 'Новый раздел';
        $LIB['CURRENT']['TEMPLATE'] .= 'section/item.php';
    } break;
    // Редакция раздела
    case '/core/admin/section/edit': {
        $LIST['DESIGN'] = $LIB['DESIGN']->Read();
        $LIB['CURRENT']['PARENT'] = isset($LIB['CURRENT']['URL']['GET']['parent']) ?? 0 ; // Не оставляет ноль в hidden
        $LIB['CURRENT']['SECTION'] = $LIB['SECTION']->Read($LIB['CURRENT']['URL']['GET']['sid']);
        $LIB['CURRENT']['TITLE'] = 'Редакция раздела';
        $LIB['CURRENT']['TEMPLATE'] .= 'section/item.php';
    } break;
    // Удалить раздел
    case '/core/admin/section/delete': {
        // $LIB['SECTION']->Delete($LIB['CURRENT']['URL']['GET']['sid']);
        // redirect('/core/admin');
    } break;


    // Список блоков рездела
    case '/core/admin/section/block': { //  AND isset($LIB['CURRENT']['URL']['GET']['sb']))
        $LIST['CURRENT']['SECTION_BLOCK'] = $LIB['SECTION_BLOCK']->Read(false, ['SECTION' => $LIB['CURRENT']['URL']['GET']['sid']]);
        /*if(empty($LIST['CURRENT']['SECTION_BLOCK'])) {
            echo "Раздел пуст";
            break;
        }*/
        foreach($LIST['CURRENT']['SECTION_BLOCK'] as $SB) $SB_LIST[] = $SB['BLOCK'];
        $LIST['CURRENT']['BLOCK'] = $LIB['BLOCK']->Read($SB_LIST);
        $LIB['CURRENT']['TEMPLATE'] .= 'section/block/list.php';
    } break;
    // Новый блок раздела
    case '/core/admin/section/block/add': {
        $LIST['BLOCK'] = $LIB['BLOCK']->Read();
        $LIB['CURRENT']['TITLE'] = 'Новый блок раздела';
        $LIB['CURRENT']['TEMPLATE'] .= 'section/block/add.php';
    } break;
    // Редакция блока раздела
    case '/core/admin/section/block/edit': {
        $LIB['CURRENT']['TITLE'] = 'Редакция блока раздела';
        $LIST['CURRENT']['SECTION_BLOCK'] = $LIB['SECTION_BLOCK']->Read($LIB['CURRENT']['URL']['GET']['sb']);
        $LIST['CURRENT']['BLOCK'] = $LIB['BLOCK']->Read($LIST['CURRENT']['SECTION_BLOCK']['BLOCK']);
        $LIB['CURRENT']['TEMPLATE'] .= 'section/block/edit.php';
    } break;
    // Удаление блока раздела
    case '/core/admin/section/block/delete': {
        // $LIB['SECTION_BLOCK']->Delete($LIB['CURRENT']['URL']['GET']['sb']);
        // redirect('/core/admin/section/block?sid='.$LIB['CURRENT']['URL']['GET']['sid']);
    } break;


    // Содержимое блока раздела
    case '/core/admin/section/block/content': {
        // Редиректная ссылка на категории или элементы
        // ?sb=1
        $LIB['CURRENT']['SECTION_BLOCK'] = $LIB['SECTION_BLOCK']->Read($LIB['CURRENT']['URL']['GET']['sb']);
        // $LIB['CURRENT']['CATEGORY'] = $LIB['CATEGORY']->Read(false, ['BLOCK' => $LIB['CURRENT']['SECTION_BLOCK']['ID']]);
        // redirect((empty($LIB['CATEGORY']->Read(false, ['BLOCK' => $LIB['CURRENT']['SECTION_BLOCK']['BLOCK'], 'SECTION_BLOCK' => $LIB['CURRENT']['URL']['GET']['sb']]) ? '/core/admin/section/block/element' : '/core/admin/section/block/category'));

// 

        redirect((empty($LIB['CATEGORY']->Read(false, ['BLOCK' => $LIB['CURRENT']['SECTION_BLOCK']['BLOCK'], 'SECTION_BLOCK' => $LIB['CURRENT']['URL']['GET']['sb']])) ? '/core/admin/section/block/element?sb='.$LIB['CURRENT']['URL']['GET']['sb'] : '/core/admin/section/block/category'));
    } break;
    // Элементы блока раздела
    case '/core/admin/section/block/element': {
        $fields['BLOCK'] = 1;
        $fields['SECTION_BLOCK'] = $LIB['CURRENT']['URL']['GET']['sb'];
        if(isset($LIB['CURRENT']['URL']['GET']['category'])) $fields['CATEGORY'] = $LIB['CURRENT']['URL']['GET']['category'];
        $LIB['CURRENT']['ELEMENT'] = $LIB['ELEMENT']->Read(false, $fields);
        $LIB['CURRENT']['TITLE'] = 'Элементы блока';
        $LIB['CURRENT']['TEMPLATE'] .= 'section/element/list.php';
    } break;
    // Редакция элемента
    // Просмотр элемента
    // Удаление элемента
    
    // Категории блока раздела
    case '/core/admin/section/block/category': {
        
        $LIB['CURRENT']['TITLE'] = 'Категории блока';
        $LIB['CURRENT']['TEMPLATE'] .= 'section/category/list.php';
    } break;
    // Редакция категории
    // Просмотр категории
    // Удаление категории
    // Если адрес неверен, редирект на главную
    default: redirect('/core/admin'); break;
}

// Формирование страницы
include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/header.php');
include($LIB['CURRENT']['TEMPLATE']);
include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/footer.php');

// p($LIB['CURRENT']);











/*
include($_SERVER['DOCUMENT_ROOT'].'/core/admin/include/design/header.php');
// include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/section/item.php');
// include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/section/block/list.php');
// include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/section/block/item.php');
// include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/section/element/list.php');
// include($_SERVER['DOCUMENT_ROOT'].'/core/admin/templates/section/element/item.php');
include($_SERVER['DOCUMENT_ROOT'].'/core/admin/include/design/footer.php');
*/

/*
p($LIB['CURRENT']);

p($LIB['CURRENT']['URL']['SECTION'][3]);
p($LIB['CURRENT']['URL']['GET']['sid']);
*/

/*
# Раздел

Новый раздел        /core/admin/section/add (если подраздел "?parent=0")
Редакция раздела    /core/admin/section/edit?sid=1
Удалить раздел      /core/admin/section/delete?sid=1

Список блоков рездела /core/admin/section/block?sid=1
Новый блок раздела /core/admin/section/block/add?sid=1
Редакция блока раздела /core/admin/section/block/edit?sid=1&sb=1

/core/admin/section/block?sid=1 (список блоков раздела)
/core/admin/section/block/add?sid=1 (добавить блок в раздел)
/core/admin/section/block/edit?bid=1 (редактировать блок в разделе)

- - -

/core/admin/ Содержимое блока элемент
Содержимое блока категория

Добавить элемент
Редактировать элемент

Добавить категорию
Редактировать категорию

*/