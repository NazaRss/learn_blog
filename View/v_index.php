<!doctype html>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>	
	
		Список статей:<br><br>
		
		<?foreach($articles as $one) : ?>				
				<a href="article?id=<?=$one['id_news']; ?>"><?=$one['title']; ?></a>
				<?php // echo $one['dt_create']; ?>
				<a href="edit?id=<?=$one['id_news']; ?>"> Ред.</a>
				<hr>
        <?endforeach?> 	
	
	<br>
	
		<? if ($auth) : ?>
			<a href="login">Выйти из сайта</a>
		<? else : ?>
			<a href="login">Войти на сайт</a>
		<? endif; ?>

</body>
</html>	