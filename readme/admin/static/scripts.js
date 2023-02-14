$(document).ready(function() {
	
	$(".section_list a").each(function() {
		$(this).attr('href', '/core/admin/section/block?sid='+$(this).data('id'));
	});

	// Контекстное меню разделов
	$(".section_list a").mousedown(function(event) { // 
		
		// Отключение ЛКМ
		if(event.button != 2) return false;
		// Присвоение ID раздела
		var sid = $(this).data('id');
		$(".contextmenu .item").each(function(index, el) {	
			$(this).attr('href', $(this).data('href') + sid);
		});
		// Определение координат и вывод
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
		// Просмотр на сайте

	});
	// Закрытие
	$(document).on('click', function(event) {
		if(!$(".contextmenu").is(event.target) && $(".contextmenu").has(event.target).length === 0) $(".contextmenu").hide();
	}).keyup(function(event) {
		if (event.keyCode === 27) $(".contextmenu").hide(); // esc
	});

    
	// Транслитерация в латинский алфавит
	function translit(from) {
		
		// Допустимые символы в url: цифры [0-9], латиница в нижнем регистре [a-z], точка[.], слеш [/], дефис [-], нижнее подчеркивание [_].
		
		// англ в англ
		// остальные символы
		from = from.toLowerCase();
		var arLetter = {
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i', 
			'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 
			'ф': 'f', 'х': 'kh', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sch', 'ь': '', 'ъ': '', 'ы': 'y', 'э': 'eh', 
			'ю': 'yu', 'я': 'ya', ' ': '-'},
			to = '';
		for(var i = 0, flen = from.length; i < flen; i++) {
			if(arLetter[from[i]]) {
				to += arLetter[from[i]];
			}
		}
		return to;
	}
	$("input[name='NAME']").keyup(function(event) {
		$("input[name='FOLDER']").val(translit($(this).val()));
	});

});