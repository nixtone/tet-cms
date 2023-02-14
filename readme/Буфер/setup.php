<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');
    switch ((int)$_POST['CODE']) {
        case 3: {

            // Проверка входных данных
            /*
            $DB_HOST = $_POST['DB_HOST'];
            $DB_USER = $_POST['DB_USER'];
            $DB_PASSWORD = $_POST['DB_PASSWORD'];
            $DB_NAME = $_POST['DB_NAME'];
            $DB_PREFIX = $_POST['DB_PREFIX'];
            $CHMOD_DIR = $_POST['CHMOD_DIR'];
            $CHMOD_FILE = $_POST['CHMOD_FILE'];
            */
            foreach($_POST as $key => $item) {
                $inData[$key] = $item;
            }

            // Заполнение конфига
            $config =
                "<?\r\n".
                "define('DB_HOST', '".$inData['DB_HOST']."');\r\n".
                "define('DB_USER', '".$inData['DB_USER']."');\r\n".
                "define('DB_PASSWORD', '".$inData['DB_PASSWORD']."');\r\n".
                "define('DB_NAME', '".$inData['DB_NAME']."');\r\n".
                "define('DB_PREFIX', '".$inData['DB_PREFIX']."');\r\n";
            if(file_put_contents($_SERVER['DOCUMENT_ROOT'].'/core/config.php', $config)) {
                $result['response_config'] = true;
            }
            else {
                $result['response_config'] = false;
                $result['text'] .= "<br>Ошибка наполнения файла конфигурации '/core/config.php'";
            }

            // Загрузка дампа
            /*
            if ($sQuery = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/setup/dump.sql')) {
                $sQuery = str_replace("\r", '', $sQuery);
                $arQuery = explode("\n", $sQuery);
                $i = 0;
                while ($i < count($arQuery)) {
                    $sQuery = trim($arQuery[$i]);
                    if (mb_strlen($sQuery)) {
                        while (mb_substr($sQuery, mb_strlen($sQuery) - 1, 1) <> ';' && mb_substr($sQuery, 0, 1) <> '#' && mb_substr($sQuery, 0, 2) <> '--' && $i + 1 < count($arQuery)) {
                            $i++;
                            $sQuery .= "\n".$arQuery[$i];
                        }
                        $sQuery = trim($sQuery);
                        if (mb_substr($sQuery, 0, 1) <> '#' && mb_substr($sQuery, 0, 2) <> '--' && $sQuery != '') {
                            if(strstr($sQuery, 'DB_PREFIX')) $sQuery = str_replace('DB_PREFIX', $inData['DB_PREFIX'], $sQuery);
                            DB::Query($sQuery);
                        }
                    }
                    $i++;
                }
            }
            */
            /*
            $db = true; // Нужно собрать отчет о загрузке дампа в БД
            if($db) {
                $result['response_db'] = true;
                $result['text'] = $statusText; //
            }
            else {
                $result['response_db'] = false;
                $result['text'] = "Ошибка загрузки дампа в базу данных";
            }
            */
            $result['response_db'] = true;

            // Сбор статусов и ответ
            $result['response'] = $result['response_db'] AND $result['response_config'] ? true : false ;
            exit(json_encode($result));

        } break;
        case 4: {
            // Проверка входных данных

            // Назначение админа

            // Ответ
            $result['response'] = true;
            exit(json_encode($result));
        } break;
        case 5: {
            // Удаление папки установки
            $obRecursive = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($_SERVER['DOCUMENT_ROOT'].'/setup/'), RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($obRecursive as $obFile) {
                if (in_array($obFile->getFilename(), ['.', '..'])) {
                    continue;
                }
                is_dir($obFile) ? rmdir($obFile) : unlink($obFile);
            }
            $rmSetupDir = rmdir($_SERVER['DOCUMENT_ROOT'].'/setup/');
            // Ответ
            $result = json_encode(['response' => $rmSetupDir, 'text' => 5]);
            exit($result);
        } break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KACMS Установка</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, Verdana;
            font-size: 0.8em;
            line-height: 23px;
            color: #454545;
        }
        #wrapper {
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            box-sizing: border-box;
        }
        header {
            display: flex;
            padding-top: 30px;
            padding-bottom: 30px;

        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 15px 0;
        }
        th, td {
            padding: 7px 10px;
        }
        th {
            background-color: #5e6066;
            color: #fff;
            font-weight: normal;
            text-align: left;
            border-right: 1px solid #505257;
        }
        tr:nth-child(2n) {
            background: #edeeee;
        }
        td.false {
            color: #d37566;
            font-weight: bold;
        }
        td.true {
            color: #6aa159;
            font-weight: bold;
        }

        .panels .item {
            display: none;
        }
        .panels .item.active {
            display: block;
        }

        .report.false {
            border: 1px solid #d37566;
            background: #f4e0e0;
            padding: 6px 10px;
            color: #ad311c;
        }
        .report.true {
            border: 1px solid #b3cdab;
            background: #d4e4cf;
            padding: 6px 10px;
            color: #ad311c;
        }


        .tabs {
            display: flex;
            margin-bottom: 20px;
        }
        .tabs .item {
            border: 1px solid #ccc;
            color: #ccc;
            padding: 3px 10px;
            margin-right: 10px;
        }
        .tabs .item:last-child {
            margin: 0;
        }
        .tabs .item.active {
            border: 1px solid #454545;
            color: #fff;
            background-color: #454545;
        }

        h2 {
            margin: 0 0 15px;
            padding: 0 0 10px;
            border-bottom: 4px solid #676767;
        }

        .field {
            background: #f6f6f6;
            border: 1px solid #ddd;
            padding: 0 8px;
            line-height: 30px;
            width: 220px;
            color: #454545;
        }

        .btn_wrap {
            display: flex;
            justify-content: flex-start;
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .btn {
            border: 1px solid #454545;
            padding: 3px 15px;
            display: block;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
            line-height: 23px;
            background: transparent;
            box-sizing: border-box;
            margin-right: 10px;
            color: #454545;
        }
        .btn.disabled {
            cursor: default;
            border: 1px solid #ccc;
            color: #ccc;
        }

        @media (max-width: 830px) {
            #wrapper {
                padding-left: 15px;
                padding-right: 15px;
            }
            .tabs {
                flex-direction: column;
            }
            .tabs .item {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
    <script src="/core/admin/jquery-3.5.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".next").click(function(event) {
                if(!$(this).hasClass('disabled')) {
                    var next_tab = $(this).data('next');
                    $(".item.active").removeClass('active');
                    $(".item.c"+next_tab).addClass('active');
                }
            });
            $("form.step").submit(function(event) {
                event.preventDefault();
                $this = $(this);
                $.post('/setup/', $(this).serialize(), function(data) {
                    console.log(data);
                    if(data['response']) {
                        if(data['text'] == 5) window.location.href = "/admin/";
                        $(".report").removeClass('false').empty();
                        $this.find('input[type="submit"]').addClass('disabled').val('Успешно');
                        $this.find('.next').removeClass('disabled');
                    }
                    else {
                        $(".panels .item.c"+$this.find('input[name="CODE"]').val()+" .report").addClass('false').html(data['text']);
                    }
                });
            });
        });
    </script>
</head>
<body>
<div id="wrapper">
    <header>
        <img src="/core/admin/logo.png" alt="" class="logo" style="display: block; margin-right: 10px;">
        <div>Установка</div>
    </header>
    <div id="install">
        <div class="tabs">
            <div class="item c1 active">Шаг 1. Приветствие</div>
            <div class="item c2">Шаг 2. Настройки</div>
            <div class="item c3">Шаг 3. База данных</div>
            <div class="item c4">Шаг 4. Администратор</div>
            <div class="item c5">Шаг 5. Завершение</div>
        </div>
        <div class="panels">
            <div class="item c1 active">
                <h2>Начало установки</h2>
                <div>Программа установки проверит соответствие программного обеспечения на сервере системным требованиям CMS, произведет установку и первоначальное конфигурирование системы управления сайтом CMS.</div>
                <div class="btn_wrap">
                    <div class="next btn" data-next="2">Далее</div>
                </div>
            </div>
            <div class="item c2">
                <h2>Проверка настроек сервера</h2>
                <div>Ваша система должна соответствовать обязательным параметрам. Если какой-либо из этих параметров выделен красным цветом, то вам необходимо исправить его. В противном случае работоспособность сайта не гарантируется.</div>
                <table>
                    <tr>
                        <th>Параметр</th>
                        <th>Требуется</th>
                        <th>Текущее значение</th>
                    </tr>
                    <tr>
                        <td>Версия PHP</td>
                        <td>7.3 и выше</td>
                        <? if(phpversion() < '7.3'): ?><td class="false"><? echo phpversion(); $errStep2 = true; ?></td><? else: ?><td class="true"><?=phpversion()?></td><? endif; ?>
                    </tr>
                    <?
                    $arExtensions = get_loaded_extensions();
                    $needExt = ['gd', 'mysqli', 'iconv', 'zip', 'dom', 'SimpleXML', 'mbstring', 'curl'];
                    foreach ($needExt as $ext): ?>
                        <tr>
                            <td>Модуль <?=$ext?></td>
                            <td>Установлен</td>
                            <? if(in_array($ext, $arExtensions)): ?><td class="true">Установлен</td><? else: $errStep2 = true; ?><td class="false">Не установлен</td><? endif; ?>
                        </tr>
                    <? endforeach; ?>
                </table>
                <h3>Проверка прав доступа</h3>
                <table width="100%">
                    <tr>
                        <th>Директория / файл</th>
                        <th>Текущее значение</th>
                    </tr>
                    <?
                    $arFile = array('/index.php', '/core/', '/core/config.php');
                    foreach ($arFile as $file): ?>
                        <tr>
                            <td><?=$file?></td>
                            <?
                            if(substr($file, -1, 1) == '/') {
                                $sFile = $_SERVER['DOCUMENT_ROOT'].$file.'test.tmp';
                                if($rWritable = @file_put_contents($sFile, 1)) {
                                    ?><td class="true">Доступно для записи</td><?
                                    @unlink($sFile);
                                }
                                else {
                                    ?><td class="false">Не доступно для записи</td><?
                                    $errStep2 = true;
                                }
                            }
                            else {
                                if(is_writable($_SERVER['DOCUMENT_ROOT'].$file)) {
                                    ?><td class="true">Доступно для записи</td><?
                                }
                                else {
                                    ?><td class="false">Не доступно для записи</td><?
                                    $errStep2 = true;
                                }
                            }
                            ?>
                        </tr>
                    <? endforeach; ?>
                </table>
                <div class="btn_wrap">
                    <div class="next btn<?=$errStep2?' disabled':'';?>" data-next="3">Далее</div>
                </div>
            </div>
            <div class="item c3">
                <h2>Установка базы данных</h2>
                <div class="report"></div>
                <form class="step" method="post">
                    <table width="100%">
                        <tr>
                            <th colspan="3">Параметры доступа</th>
                        </tr>
                        <tr>
                            <td>Права доступа к директориям</td>
                            <td><input type="text" name="CHMOD_DIR" class="field" value="755"></td>
                            <td>например, 755</td>
                        </tr>
                        <tr>
                            <td>Права доступа к файлам</td>
                            <td><input type="text" name="CHMOD_FILE" class="field" value="644"></td>
                            <td>например, 644</td>
                        </tr>
                        <tr>
                            <th colspan="3">Параметры базы данных</th>
                        </tr>
                        <tr>
                            <td>MySQL cервер</td>
                            <td><input type="text" name="DB_HOST" class="field" value="localhost"></td>
                            <td>например, localhost</td>
                        </tr>
                        <tr>
                            <td>Имя пользователя</td>
                            <td><input type="text" name="DB_USER" class="field"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Пароль</td>
                            <td><input type="password" name="DB_PASSWORD" class="field"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>База данных</td>
                            <td><input type="text" name="DB_NAME" class="field"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Префикс таблиц</td>
                            <td><input type="text" name="DB_PREFIX" class="field" value="ka"></td>
                            <td>Пример названия таблицы `ka_site`</td>
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
                <div class="report"></div>
                <form class="step" method="post">
                    <table width="100%">
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
                        <tr>
                            <td>E-mail</td>
                            <td><input type="text" name="EMAIL" class="field"></td>
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
                <div class="report"></div>
                <div>Процесс установки почти завершен. Удаляем временные файлы и переходим в панель управления</div>
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
</body>
</html>