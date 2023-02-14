<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TETCMS / Главная</title>
<link rel="stylesheet" href="/core/admin/static/style.css">
</head>
<body>

<div class="container text">
	<header>
		<img src="/core/admin/static/images/logo.png" alt="">
	</header>
	<h2>Все готово к работе</h2>
    <p>Теперь можно приступать к разработке. Рекомендуем освоить <a href="">учебный курс</a> а также ознакомиться с <a href="">документацией</a>. Все основные изменения Вам предстоит делать в папке "/core/dev/". Если хотите, можете <a href="">поблагодарить</a> автора и поддержать дальнейшее развитие проекта. Приятного пользования</p>
	<div class="btn_wrap"></div>
	<?
	foreach($CORE['CURRENT']['SECTION_BLOCK'] as $SECTION_BLOCK) {
		$sb_tmp = new template("/core/dev/block/".$SECTION_BLOCK['BLOCK_ID']."/");
		$sb_tmp->template("controller.php");
	}
	?>
</div>

</body>
</html>