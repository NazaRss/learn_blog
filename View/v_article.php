<!Doctype html>
<html>
	<head>
		<title><?=$post['title']?></title>
	</head>
	<body>
 
		<h1> <?=$post['title']?></h1>
		<div> <?=$post['content']?></div><br>
		<em>Дата:</em> <?=$post['dt_create']?><br>

		<?if($auth):?>
			<br><a href="edit?id=<?=$id_news?>">Редактировать</a><br>
			<a href="delete?id=<?=$id_news?>">Удалить</a><br>				
		<?endif?>

    <br><a href="/">Назад</a>
</body>
</html>	