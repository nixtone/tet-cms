<? if(isset($CORE['CURRENT']['USER'])): ?>

	<p>Вы вошли как <strong><?=$CORE['CURRENT']['USER']['LOGIN']?></strong>, <a href="/?exit">Выход</a></p>

<? else: ?>

<form method="post">
	<table>
		<tr>
			<td><label for="auth_name">Логин</label></td>
			<td><input type="text" name="NAME" id="auth_name"></td>
		</tr>
		<tr>
			<td><label for="auth_password">Пароль</label></td>
			<td><input type="password" name="PASSWORD" id="auth_password"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="AUTH" value="Авторизация"></td>
		</tr>
	</table>
</form>

<form method="post">
	<table>
		<tr>
			<td><label for="reg_name">Логин</label></td>
			<td><input type="text" name="NAME" id="reg_name"></td>
		</tr>
		<tr>
			<td><label for="reg_email">E-mail</label></td>
			<td><input type="text" name="EMAIL" id="reg_email"></td>
		</tr>
		<tr>
			<td><label for="reg_password">Пароль</label></td>
			<td><input type="password" name="PASSWORD" id="reg_password"></td>
		</tr>
		<tr>
			<td><label for="reg_password2">Повторите пароль</label></td>
			<td><input type="password" name="PASSWORD_RETYPE" id="reg_password2"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="REG" value="Регистрация"></td>
		</tr>
	</table>
</form>

<? endif; ?>



<?

// p($CORE);

// p($CORE['USER']->Read(1));

// p($CORE['USER']->Update(1, ['EMAIL' => '@']));

if(isset($_POST['REG'])) {
	$status = $CORE['USER']->Create([
		'LOGIN' => $_POST['NAME'], 
		'PASSWORD' => $_POST['PASSWORD'],
		'PASSWORD_RETYPE' => $_POST['PASSWORD_RETYPE']
	]);
	if($status) {
		$CORE['USER']->Auth($_POST['NAME'], $_POST['PASSWORD']);
		header("location: /");
	}
}

if(isset($_POST['AUTH'])) {

	$CORE['USER']->Auth($_POST['NAME'], $_POST['PASSWORD']);
	header("location: /");
}

if(isset($_GET['exit'])) {
	$CORE['USER']->Exit();
	header("location: /");
}


// p($CORE['USER']->Delete(4));

// if(!empty($_POST)) {
// 	// p($_POST);
// 	// p($CORE['USER']->Read('row', ['NAME' => $_POST['NAME']]));
// 	p($CORE['USER']->Create([
// 		'LOGIN'=> $_POST['LOGIN'],
// 		'EMAIL' => $_POST['EMAIL'],
// 		'PASSWORD' => $_POST['PASSWORD'],
// 		// 'TOKEN' => ''
// 	]));
// }
?>