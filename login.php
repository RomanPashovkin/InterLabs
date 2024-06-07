<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" href = "/style/login.css">
	<title>Авторизация</title>
</head>
<body>
	<div class = 'login'>
	<h2 class="form-title">Авторизация</h2>
		<form method = 'post' action = '/auth.php' class = 'login-form'>
			<input type="text" id="username" name="username" required placeholder = 'Логин'><br>
			<input type="password" id="password" name="password" required placeholder = 'Пароль'><br>
			<button class = 'form-submit' type="submit">Войти</button>
		</form>
	</div>
</body>
</html>