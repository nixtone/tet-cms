<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<style>
.section .contextmenu {
	position: absolute;
	background: #e5e5e5;
	padding: 3px 0;
}
.section .contextmenu a {
	display: block;
	padding: 5px 10px;
	text-decoration: none;
}
.section .contextmenu .show {
	border-top: 1px solid #ccc;
}
.section .contextmenu a:hover {
	background: #ccc;
	color: #454545;
}

.sb .move .icon {
	cursor: move;
	display: none;
}
.sb .move:hover .icon {
	display: block;
}

table {
	border-collapse: collapse;
	width: 100%;
}
th, td {
	padding: 6px;
}
</style>
<script src="/jquery-3.5.0.min.js"></script>
<script>
$(document).ready(function() {
	
	// Контекстное меню
	$(".section").contextmenu(false);

	$(document).click(function(event) {
		if(!$(".contextmenu").is(event.target) && $(".contextmenu").has(event.target).length === 0) $(".contextmenu").css('display', 'none');
	}).keydown(function(event) {
		if(event.keyCode == 27) $(".contextmenu").css('display', 'none');
	});

	$(".section .list .item a").mousedown(function(event) {
		if(event.button != 2) return false;
		var cPosX = cPosY = 0;
		if (!event) var event = window.event;
		if (event.pageX || event.pageY) {
			cPosX = event.pageX;
			cPosY = event.pageY;
		} else if (event.clientX || event.clientY) {
			cPosX = event.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
			cPosY = event.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		}
		$(".contextmenu").css({
			top: cPosY+'px',
			left: cPosX+'px',
			display: 'block'
		});

		var sid = $(this).data('sid'),
			shref = $(this).data('link');
		$(".section .contextmenu .item").each(function(index, el) {
			var href = $(this).data('link');
			$(this).attr('href', href+sid);
			$(".section .contextmenu .show").attr('href', shref);
		});
	});

	// Отсрочка на 30 секунд между кликами
	$("form").submit(function(event) {
		event.preventDefault();
		var now = new Date();
		console.log(now);
	});

	// 


});
</script>
</head>
<body>



<div class="section">

	<a href="" class="goSite">Перейти на сайт</a>
	<a href="" class="tree open close">Скрыть / раскрыть дерево разделов</a>
	<a href="" class="add">Добавить раздел</a>

	<ul class="list">
		<li class="item"><a href="fill.php?sid=1" data-sid="1" data-link="/404">Страница не найдена</a></li>
		<li class="item active"><a href="fill.php?sid=2" data-sid="2" data-link="/home">Главная</a></li>
		<li class="item">
			<a href="fill.php?sid=3" data-sid="3" data-link="/katalog">Каталог</a>
			<ul class="list">
				<li class="item"><a href="fill.php?sid=4" data-sid="4" data-link="/katalog/krossovki">Кроссовки</a></li>
				<li class="item"><a href="fill.php?sid=5" data-sid="5" data-link="/katalog/mashini">Машины</a></li>
			</ul>
		</li>
		<li class="item"><a href="fill.php?sid=6" data-sid="6" data-link="/forum">Форум</a></li>
		<li class="item"><a href="fill.php?sid=7" data-sid="7" data-link="/onas">О нас</a></li>
	</ul>
	<div class="contextmenu" style="display: none;">
		<a href="" data-link="add.php?sid=" class="item add">Добавить подраздел</a>
		<a href="" data-link="edit.php?sid=" class="item edit">Редактировать</a>
		<a href="" data-link="delete.php?sid=" class="item delete">Удалить</a>
		<a href="" class="show">Посмотреть на сайте</a>
	</div>
	
</div>

<form action="" method="post">
	<input type="text" name="" id="">
	<input type="submit" value="Send">
</form>

<div class="sb">
	<table border="1">
		<tr>
			<th>m</th>
			<th>ID</th>
			<th>Название</th>
			<th>Блок</th>
			<th>Элементов</th>
			<th>Действие</th>
		</tr>
		<tr>
			<td class="move"><div class="icon">m</div></td>
			<td>1</td>
			<td><a href="">Новости</a></td>
			<td><a href="">Текстовая страница</a></td>
			<td>1</td>
			<td>
				<a href="" class="edit">e</a>
				<a href="" class="delete">x</a>
			</td>
		</tr>
		<tr>
			<td class="move"><div class="icon">m</div></td>
			<td>2</td>
			<td><a href="">Карта сайта</a></td>
			<td><a href="">Карта сайта</a></td>
			<td>0</td>
			<td>
				<a href="" class="edit">e</a>
				<a href="" class="delete">x</a>
			</td>
		</tr>
		<tr>
			<td class="move"><div class="icon">m</div></td>
			<td>3</td>
			<td><a href="">Карта сайта</a></td>
			<td><a href="">Карта сайта</a></td>
			<td>0</td>
			<td>
				<a href="" class="edit">e</a>
				<a href="" class="delete">x</a>
			</td>
		</tr>
	</table>
</div>

</body>
</html>