<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
?>

<!DOCTYPE>
<html>
<head>
	<title><?=$title?></title>
	<meta content="text/html"; charset="utf-8" http-equiv="content-type">	
	<link rel="stylesheet" type="text/css" media="screen" href="view/style.css" /> 	
</head>
<body>
	<div id="header">
		<h1><?=$title?></h1>
	</div>
	
	<div id="menu">
		<a href="index.php">Читать текст</a> |
		<a href="index.php?c=page&act=edit">Редактировать текст</a>
		<a id="entrance" href="index.php?c=user&act=<?= isset($_SESSION['user']) ? "logout" : "login" ?>"><?= isset($_SESSION['user']) ? "Выйти" : "Войти в личный кабинет" ?></a>
	</div>
	
	<div id="content">
		<?=$content?>
	</div>
	
	<div id="footer">
		Все права защищены. Адрес. Телефон.
	</div>
</body>
</html>