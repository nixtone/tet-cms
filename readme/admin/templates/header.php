<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TETCMS / Панель управления</title>
<link rel="stylesheet" type="text/css" href="/core/admin/static/base.css">
<link rel="stylesheet" type="text/css" href="/core/admin/static/ui.css">
</head>
<body>
<div id="wrapper">
	<header>

        <div class="user">
            <?=$LIB['CURRENT']['USER']['LOGIN']?>
            <a href="?exit">Exit</a>
        </div>

        <div>
            <a href="">Пользователи</a>
            <a href="">Разработка</a>
            <a href="">Настройки</a>
        </div>

    </header>
    <div class="inner">
        <div class="sidebar">
            <a href="/core/admin/section/add">Добавить раздел</a>
            <div class="section_list">
                <? sectionTree($LIB['SECTION']->Read()) ?>
            </div>
<?/**/?>  
            <div class="contextmenu" style="display: none;">
				<a href="" data-href="/core/admin/section/add?parent=" class="item add">Добавить подраздел</a>
				<a href="" data-href="/core/admin/section/edit?sid=" class="item edit">Редактировать</a>
				<a href="" data-href="/core/admin/section/delete?sid=" class="item delete">Удалить</a>
				<a href="" data-href="" class="show">Посмотреть на сайте</a>
			</div>
          
        </div>
        <div class="content">
        