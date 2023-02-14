<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>KACMS / Авторизация</title>
<link rel="stylesheet" href="/core/admin/static/style.css">
<style>
#auth_page {
	height: inherit;
	display: flex;
}
form.auth {
	margin: auto;
}
</style>
</head>
<body>
<div id="auth_page">
	<form metho="post" class="auth">
		<input type="text" name="LOGIN" placeholder="Login">
		<input type="password" name="PASSWORD" placeholder="Password">
		<input type="submit" value="Войти">
	</form>
</div>
</body>
</html>