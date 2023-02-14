<?
$authAction = ['STATUS' => false, 'MSG' => ''];
if(isset($_POST['send_auth'])) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/core/lib/index.php');
    $authAction = $LIB['USER']->Auth($_POST['LOGIN'], $_POST['PASSWORD']);
    if($authAction['STATUS']) redirect();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TETCMS / Авторизация</title>
<link rel="stylesheet" type="text/css" href="/core/admin/static/ui.css">
<style>
.auth-form {
	margin: auto;
	max-width: 320px;
}
</style>
</head>
<body>

<div class="container auth-form">
    <form method="post">
        <h2>Авторазация</h2>
        <input type="text" name="LOGIN" class="field" placeholder="Логин">
        <div style="margin: 10px 0"></div>
        <input type="password" name="PASSWORD" class="field" placeholder="Пароль">
        <? if(!empty($authAction['MSG'])): ?><div class="msg"><?=$authAction['MSG']?></div><? endif; ?>
        <div class="btn_wrap"><input type="submit" name="send_auth" class="btn" value="Войти"></div>
    </form>
</div>

</body>
</html>