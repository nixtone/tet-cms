<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	switch($_POST['CODE']) {

        // Установка базы данных
		case 3: {
            
			// Создание конфига
            $config = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/setup/config');

            // if(!isset($_POST['CHMOD_DIR'])) $_POST['CHMOD_DIR'] = '0755';
            // if(!isset($_POST['CHMOD_FILE'])) $_POST['CHMOD_FILE'] = '0644';
            if(!isset($_POST['DEV_MODE'])) $_POST['DEV_MODE'] = 0;

            foreach($_POST as $key => $postValue) {
                $config = str_replace("<!-- $".$key."$ -->", $postValue, $config);
            }
            /*
            $config = str_replace('localhost', $_POST['DB_HOST'], $config);
            $config = str_replace('dbname', $_POST['DB_NAME'], $config);
            $config = str_replace('dbuser', $_POST['DB_USER'], $config);
            $config = str_replace('dbpassword', $_POST['DB_PASSWORD'], $config);
            $config = str_replace('dbprefix', $_POST['DB_PREFIX'], $config);
            $config = str_replace('chdir', $_POST['CHMOD_DIR'], $config);
            $config = str_replace('chfile', $_POST['CHMOD_FILE'], $config);
            $config = str_replace('devmode', (isset($_POST['DEV_MODE']) ? 1 : 0), $config);
            */

            $status['config'] = @file_put_contents($_SERVER['DOCUMENT_ROOT'].'/core/config1.php', $config);

            // Загрузка дампа
            $status['dump'] = false;
            
			$result = $status;
		} break;

        // Назначение админа
		case 4: {
			/*
            require_once($_SERVER['DOCUMENT_ROOT'].'/core/bootstrap/index.php');
            // Проверить совпадение паролей
            $LIB['USER']->Create(['LOGIN' => $_POST['LOGIN'], 'PASSWORD' => $_POST['PASSWORD']]);
            $LIB['USER']->Auth($_POST['LOGIN'], $_POST['PASSWORD']);
            */
			$result = true;
		} break;

        // Удаление папки установки
        case 5: {
            /*
            unlink($_SERVER['DOCUMENT_ROOT'].'/setup/index.php');
            unlink($_SERVER['DOCUMENT_ROOT'].'/setup/dump.sql');
            rmdir($_SERVER['DOCUMENT_ROOT'].'/setup/');
            */
			$result = true;
		} break;
	}
	die(json_encode($result));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TETCMS / Установка</title>
<link rel="stylesheet" href="/core/admin/static/styles.css">
<style>
.tab_area {
	max-width: 800px;
}
.tab-area .page .item {
	display: none;
}
.tab-area .item.active {
	display: block;
}
.tab-area .label {
	display: flex;
	margin-bottom: 10px;
}
.tab-area .label .item {
	border: 1px solid #ccc;
	color: #ccc;
	margin-right: 10px;
    margin-bottom: 10px;
	padding: 3px 10px;
}
.tab-area .label .item.active {
	background: #454545;
	color: #fff;
	border: 1px solid #454545;
}
.tab-area .page {
	margin-bottom: 20px;
}

@media all and (max-width: 768px) {
    .tab-area .label {
        flex-direction: column;
    }
}
</style>
</head>
<body>

<div class="container text">

	<header>
		<!-- <img src="/core/admin/static/images/logo.png" alt=""> -->
	</header>

	<div class="tab-area">
	    <div class="label">
	        <div class="item c1 active">Шаг 1. Приветствие</div>
	        <div class="item c2">Шаг 2. Настройки</div>
	        <div class="item c3">Шаг 3. База данных</div>
	        <div class="item c4">Шаг 4. Администратор</div>
	        <div class="item c5">Шаг 5. Завершение</div>
	    </div>
	    <div class="page">
	        <div class="item c1 active">
	        	<h2>Начало установки</h2>
                <p>Программа установки проверит соответствие программного обеспечения на сервере системным требованиям CMS, произведет установку и первоначальное конфигурирование системы управления сайтом.</p>
	        	<div class="btn_wrap">
	                <div class="next btn" data-next="2">Далее</div>
	            </div>
	    	</div>
	        <div class="item c2">
	        	<h2>Проверка настроек сервера</h2>
			    <p>Ваша система должна соответствовать обязательным параметрам. Если какой-либо из этих параметров выделен красным цветом, то вам необходимо исправить его. В противном случае работоспособность сайта не гарантируется.</p>
                <table>
                    <tr>
                        <th>Параметр</th>
                        <th>Статус</th>
                    </tr>
                    <tr>
                        <td>Версия PHP ( >= 8.0)</td>
                        <td><div class="<?=phpversion() < '8.0' ? 'false':'true'?>"><?=phpversion()?></div></td>
                    </tr>
                    <?
                    $arExt = get_loaded_extensions();
                    $needExt =  ['pdo_mysql', 'mbstring']; //['gd', 'mysqli', 'iconv', 'zip', 'dom', 'SimpleXML', 'mbstring', 'curl'];
                    foreach($needExt as $ext): ?>
                    <tr>
                        <td>Модуль <?=$ext?></td>
                        <td><?=in_array($ext, $arExt) ? 'Установлен' : 'Не установлен' ?></td>
                    </tr>
                    <? endforeach; ?>
                </table>
                <h3>Проверка прав доступа</h3>
                <table>
                    <tr>
                        <th>Директория / файл</th>
                        <th>Статус</th>
                    </tr>
                    <?
                    $arFile = array('/index.php', '/core/', '/core/config.php');
                    foreach ($arFile as $file): ?>
                    <tr>
                        <td><?=$file?></td>
                        <td>
                            <?
                            if(substr($file, -1, 1) == '/'):
                                $sFile = $_SERVER['DOCUMENT_ROOT'].$file.'test.tmp';
                                if($rWritable = @file_put_contents($sFile, 1)) {
                                    echo 'Доступен';
                                    @unlink($sFile);
                                }
                                else {
                                    echo 'Не доступен';
                                }
                            else:
                                echo is_writable($_SERVER['DOCUMENT_ROOT'].$file) ? 'Доступен' : 'Не доступен' ;
                            endif;
                            echo ' для записи';
                            ?>
                        </td>
                    </tr>
                    <? endforeach; ?>
                </table>
	        	<div class="btn_wrap">
	                <div class="next btn" data-next="3">Далее</div>
	            </div>
	    	</div>
	        <div class="item c3">
	        	<h2>Установка базы данных</h2>
                <p>После этого шага, будет сформирован файл <strong>"/core/config.php"</strong>, внутри которого будут храниться введенные здесь данные</p>
	        	<form class="step" method="post">
	        		<table>
                        <tr>
                            <th colspan="2">Права доступа</th>
                        </tr>
                        <tr>
                            <td>Папки</td>
                            <td><input type="text" name="CHMOD_DIR" class="field" value="0755"></td>
                        </tr>
                        <tr>
                            <td>Файлы</td>
                            <td><input type="text" name="CHMOD_FILE" class="field" value="0644"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Параметры базы данных</th>
                        </tr>
                        <tr>
                            <td>Адрес cервера</td>
                            <td><input type="text" name="DB_HOST" class="field" value="localhost"></td>
                        </tr>
                        <tr>
                            <td>Пользователь</td>
                            <td><input type="text" name="DB_USER" class="field"></td></td>
                        </tr>
                        <tr>
                            <td>Пароль</td>
                            <td><input type="password" name="DB_PASSWORD" class="field"></td>
                        </tr>
                        <tr>
                            <td>База данных</td>
                            <td><input type="text" name="DB_NAME" class="field"></td></td>
                        </tr>
                        <tr>
                            <td>Префикс таблиц</td>
                            <td><input type="text" name="DB_PREFIX" class="field" value="tet_"></td>
                        </tr>
                        <tr>
                            <th>Режим разработки</th>
                            <th><input type="checkbox" name="DEV_MODE" value="1" checked></th>
                        </tr>
                    </table>
                    <div class="btn_wrap">
	                    <input type="hidden" name="CODE" value="3">
		                <input type="submit" value="Установить" class="btn">
		                <div class="next btn disabled" data-next="4">Далее</div>
	                </div>
	            </form>
	    	</div>
	        <div class="item c4">
	        	<h2>Создание учетной записи администратора</h2>
				<form class="step" method="post">
					<table>
                        <tr>
                            <th colspan="2">Параметры</th>
                        </tr>
                        <tr>
                            <td>Логин</td>
                            <td><input type="text" name="LOGIN" class="field"></td>
                        </tr>
                        <tr>
                            <td>Пароль</td>
                            <td><input type="password" name="PASSWORD" class="field"></td>
                        </tr>
                        <tr>
                            <td>Повтор пароля</td>
                            <td><input type="password" name="PASSWORD_RETYPE" class="field"></td>
                        </tr>
                    </table>
					<div class="btn_wrap">
		                <input type="hidden" name="CODE" value="4">
		                <input type="submit" value="Назначить" class="btn">
		                <div class="next btn disabled" data-next="5">Далее</div>
	                </div>
	            </form>
	    	</div>
	        <div class="item c5">
	        	<h2>Завершение установки</h2>
                <p>Процесс установки почти завершен. Удаляем временные файлы и переходим в панель управления</p>
	        	<form class="step" method="post">
	                <div class="btn_wrap">
	                    <input type="hidden" name="CODE" value="5">
	                    <input type="submit" value="Готово" class="btn">
	                </div>
	            </form>
	    	</div>
	    </div>
	</div>
</div>


<script src="/core/admin/static/jquery.js"></script>
<script>
$(document).ready(function() {
    
    $(".next").click(function(event) {
    	if(!$(this).hasClass('disabled')) {
			$(".item.active").removeClass('active');
			$(".item.c"+$(this).data('next')).addClass('active');
		}
	});
    $("form.step").submit(function(event) {
		event.preventDefault();
        let $this = $(this);
        $.post('/setup/', $(this).serialize(), function(answer) {
            
            let errorStatus = false;
            $.each(answer, function(key, value) {
                if(!value) {
                    errorStatus = true;
                    $this.find('.btn_wrap').addClass('false');
                    switch(key) {
                        case 'config': $this.find('.btn_wrap').append('<div>Не удалось создать файл конфигурации</div>'); break;
                        case 'dump': $this.find('.btn_wrap').append('<div>Ошибка загрузки дампа базы</div>'); break;
                    }
                }
            });
            if(!errorStatus) {
                // if(result == 5) window.location.href = "/core/admin";
                $this.find('input[type="submit"]').addClass('disabled').val('Успешно');
				$this.find('.next').removeClass('disabled');
            }
            
        }, 'json');
	});
    
});
</script>

</body>
</html>