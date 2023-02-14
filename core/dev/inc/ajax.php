<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/bootstrap/index.php');
	switch($_POST['CODE']) {
		/*
		case '': {
			
			$result = true;
		} break;
		default: {
			$result = false;
		} break;
		*/
	}
	die(json_encode($result));
}

/*

let ajaxPath = '/core/dev/inc/ajax.php';

$("form").submit(function(event) {
    event.preventDefault();
	// До запроса
    $.ajax({
        url: ajaxPath,
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function() {
            // Во время запроса
        }
    })
    .always(function(data) {
        // Ответ
        console.log(data);

    });
});

*/