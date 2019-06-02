<!doctype html>
<html>
    <head>
        <title>Страница авторизации</title>
    </head>
    <body>
		<form method="post">
			Логин<br>
			<input type="text" name="login"><br>
        	Пароль<br>
        	<input type="text" name="password"><br><br>
			<input type="checkbox" name="remember">Запомнить меня
			<input type="submit" value="Войти">
		</form> 
		<?=$msg;?>
		<br>
		<a href="/">| Вернуться на главную. |</a>
   </body>
</html>