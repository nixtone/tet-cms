<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Админка</title>
<link rel="stylesheet" href="/core/admin/static/style.css">
</head>
<body>

<div class="container text">

	<header>
		<img src="/core/admin/static/images/logo.png" alt="">
	</header>

	
	<form method="post">
		<table>
			<tr>
				<th colspan="2">Аутентификация</th>
			</tr>
			<tr>
				<td><label for="auth_name">Логин</label></td>
				<td><input type="text" name="NAME" id="auth_name" class="field"></td>
			</tr>
			<tr>
				<td><label for="auth_password">Пароль</label></td>
				<td><input type="password" name="PASSWORD" id="auth_password" class="field"></td>
			</tr>
		</table>
		<div class="btn_wrap">
		    <input type="submit" name="AUTH" value="Войти" class="btn">
		</div>
	</form>
	

</div>

<script src="/core/admin/static/jquery.js"></script>
</body>
</html>