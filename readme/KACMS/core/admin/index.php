<?
include($_SERVER['DOCUMENT_ROOT'].'/core/admin/function.php');

$tabs = $subtabs = [];

$CURRENT['SECTION']['LIST'] = $LIB['SECTION']->Rows();

// Адресация
// $FOLDER = array_map('strtolower', $FOLDER);
// echo ctype_upper($FOLDER[2]) ? 'yes' : 'no';
switch($FOLDER[2]) {
	case 'section': {
		$CURRENT['SECTION_BLOCK']['LIST'] = $LIB['SECTION_BLOCK']->Rows($_GET['id']);
		if(empty($_GET['section_block'])) {
			$CURRENT['SECTION_BLOCK'] = $CURRENT['SECTION_BLOCK']['LIST'][array_key_first($CURRENT['SECTION_BLOCK']['LIST'])];
			header("location: /admin/section?id=".$_GET['id'].'&section_block='.$CURRENT['SECTION_BLOCK']['ID']);
		}
		else {
			$CURRENT['SECTION_BLOCK'] = $CURRENT['SECTION_BLOCK']['LIST'][$_GET['section_block']];
		}
		$incPart = '/section/element/list.php';
	} break;
	case 'element': {
		if($_GET['action'] == 'edit') $CURRENT['ELEMENT'] = $LIB['ELEMENT']->ID($_GET['id'], $_GET['section_block']);
		$incPart = '/section/element/element.php';
	} break;
	case 'dev': {
		if(empty($FOLDER[3])) redirect('/admin/dev/block');
		$tabs = [
			'block' => ['HREF' => '/admin/dev/block', 'NAME' => 'Блоки'],
			'design' => ['HREF' => '/admin/dev/design', 'NAME' => 'Шаблоны'],
			'field' => ['HREF' => '/admin/dev/field', 'NAME' => 'Поля']
		];
		switch ($FOLDER[3]) {
			case 'block': {
				switch ($_GET['action']) {
					case 'edit': {
						$subtabs = [
							'cat_field' => ['HREF' => '', 'NAME' => 'Поля категорий'],
							'el_field' => ['HREF' => '', 'NAME' => 'Поля элементов'],
						];
					} break;
					case 'add': {

					} break;
				}
				$incPart = '/dev/block/'.(($_GET['action'] == ('edit' OR 'add')) ? 'block.php' : 'list.php' );
			} break;
			case 'design': $incPart = '/dev/design/'.(($_GET['action'] == ('edit' OR 'add')) ? 'design.php' : 'list.php' ); break;
			case 'field': {
				$subtabs = [
					'site' => ['HREF' => '/admin/dev/field/site', 'NAME' => 'Для сайта'],
					'design' => ['HREF' => '/admin/dev/field/section', 'NAME' => 'Для разделов'],
					'field' => ['HREF' => '/admin/dev/field/user', 'NAME' => 'Для пользователей']
				];
				/*$incPart = '.php';*/
			} break;
		}
		$tabs[$FOLDER[3]]['ACTIVE'] = 1;
	} break;
	case 'users': {

	} break;
	case 'settings': {

	} break;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>KACMS / Панель управления</title>
<link rel="icon" type="image/png" href="/core/admin/static/images/favicon.png">
<link rel="stylesheet" href="/core/admin/static/styles.css">
<script src="/core/admin/static/jquery-3.5.1.min.js"></script>
<script src="/core/admin/static/scripts.js"></script>
</head>
<body>

<div id="wrapper">
	<header>
		<a href="/" id="logo"><img src="/core/admin/static/images/logo1.png" alt=""></a>
		<div class="other">
			<a href="/admin/users">ПОЛЬЗОВАТЕЛИ</a>
			<a href="/admin/dev/block">РАЗРАБОТКА</a>
			<a href="/admin/settings">НАСТРОЙКИ</a>
		</div>
	</header>
	<div class="inner_wrap">
		<div class="section">
			<div class="manage">
				<div style="display: flex">
					<a href="<?=$CURRENT['URL']['PROTOCOL']?>://<?=$CURRENT['SITE']['DOMAIN']?>" class="goSite"></a>
					<a href="" class="tree open"></a>
				</div>
				<a href="" class="add_section">Добавить раздел</a>
			</div>
			<? sectionTree($CURRENT['SECTION']['LIST']); ?>
			<div class="contextmenu" style="display: none;">
				<a href="" data-link="add.php?sid=" class="item add">Добавить подраздел</a>
				<a href="" data-link="edit.php?sid=" class="item edit">Редактировать</a>
				<a href="" data-link="delete.php?sid=" class="item delete call">Удалить</a>
				<a href="" class="show">Посмотреть на сайте</a>
			</div>
		</div>
		<div class="content">
			<div class="tabs">
				<? foreach($tabs as $tab): ?>
					<a href="<?=$tab['HREF']?>"<?=$tab['ACTIVE']?' class="active"':''?>><?=$tab['NAME']?></a>
				<? endforeach; ?>
			</div>
			<div class="folder">
				<div class="subtabs">
					<? foreach($subtabs as $stab): ?>
						<a href="<?=$stab['HREF']?>"><?=$stab['NAME']?></a>
					<? endforeach; ?>
				</div>
				<div class="include_area"><? include($_SERVER['DOCUMENT_ROOT'].'/core/admin/include/'.$incPart); ?></div>
			</div>
		</div>
	</div>
</div>
<footer>&copy <a href="">KACMS</a> 2020</footer>
<div class="overlay" style="display: none">
	<div class="popup">
		<div class="message">Точно удалить?</div>
		<div class="confirm_area">
			<div class="confirm">Да</div>
			<div class="close">Отмена</div>
		</div>
	</div>
</div>
</body>
</html>