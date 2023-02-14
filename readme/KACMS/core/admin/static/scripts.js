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
	/*$("form").submit(function(event) {
		event.preventDefault();
		var now = new Date();
		console.log(now);
	});*/

	// Транслитерация в латинский алфавит
	function translit(from) {
		// англ в англ
		// остальные символы
		from = from.toLowerCase();
		var arLetter = {'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh', 'з': 'z', 'и': 'i', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'kh', 'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'shch', 'ь': '', 'ъ': '', 'ы': 'y', 'э': 'eh', 'ю': 'yu', 'я': 'ya'},
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

	// Диалоговое окно
	$(".call").click(function(event) {
        event.preventDefault();
        $(".overlay").fadeIn(100);
    });
    $(".overlay .popup .close").click(function(event) {
        $(".overlay").fadeOut(100);
    });

    // Массовая отметка
    $("th input[type='checkbox']").click(function(event) {
    	$(this).closest('table').find("tr td:first-child input[type='checkbox']").prop('checked', ($(this).is(':checked')?true:false));
    });
    

});