<title>Добавление новости</title>
	<form method="post">
		Название файла<br>
		<input type="text" name="title" value="<?=$title?>"><br><br>
		Содержимое файла<br>
		<textarea name="content"><?=$content; ?></textarea><br><br>
		<input type="submit" value="Сохранить"><br><br>
		<a href="/">Вернуться на главную</a><br><br>
		<?=$msg?>
	</form>
	
	<? foreach($errors as $error): ?>
		<p><?=$error?></p>
	<?endforeach;?>