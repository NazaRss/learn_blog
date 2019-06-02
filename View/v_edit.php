<!doctype html>
<html>
<head>
    <title>Добавление новости</title>

</head>
<body>
	<form method="post">
		Название файла<br>
		<input type="text" name="title" value="<?=$title?>"><br>
		Содержимое файла<br>
		<textarea name="content"><?=$content?></textarea><br>
		<input type="submit" value="Сохранить"><br>
		<input type="submit" name="delete" value="Удалить">
	</form><hr>

    <a href="/">| Вернуться на главную | </a>
	<a href="delete?id=<?=$id_news?>">Удалить статью</a><br>
	<a href="login">Выйти</a><br>
		<?=$msg?><br>	
	<? foreach ($errors as $error): ?>
		<p> <?=$error?> </p>
	<? endforeach;?>
		
	<a href="/">Назад</a><br>
</body>
</html>