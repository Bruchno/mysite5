<html>
<title>Наші новини</title>
<head><script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
<link rel="stylesheet" href="styles.css" type = "text/css" />

</head>
<body>
<?php
header("Content-Type: text/html; charset=utf-8");
include 'function.php';
session_start();
$userstr = ' (Guest)';
$user = '';
echo '<header>Життя - це наявність новин</header><br /><br /><br />';
if (isset($_SESSION['user']))
{
	$user = $_SESSION['user'];
	$logeddin = true;
	$userstr = " ($user)";
	createtable($user);
} else $logeddin = false;
if ($logeddin)
{
	echo '<div style=" width:100%; height:1px; clear:both;">.</div>';
	date_default_timezone_set('UTC');
	$dey = date("d.m.y");
	$time=date("H:i");
	echo '<div class = "hello">Вітаємо на сайті! '.$user.'<br />'.$time.'   '.$dey.'</div>';
	echo '<div class = "menu"><br><ul class="menu">'.
	'<li><a href="index.php">Головна</a></li>'.
	'<li><a href="members.php">Дописувачі</a></li>'.
	'<li><a href="redaction_news.php">Створити новину</a></li>'.
	'<li><a href="records.php">Переглянути новини</a></li>'.
	'<li><a href="logout.php">Вийти</a></li></div>';
}
else 
{
	echo '<div style=" width:100%; height:1px; clear:both;">.</div>';
	date_default_timezone_set('UTC');
	$dey = date("d.m.y");
	$time=date("H:i");
	echo '<div class = "hello">Вітаємо на сайті! '.$user.'<br />'.$time.'   '.$dey.'</div>';
	echo '<div class = "menu"><br><ul class="menu">'.
	'<li><a href="index.php">Головна</a></li>'.
	'<li><a href="members.php">Дописувачі</a></li>'.
	'<li><a href="#modal_login" class = "open_modal" id = "login_pop">Створити новину</a></li>'.
	'<li><a href="records.php">Переглянути новини</a></li>'.
	'<li><a href="logout.php">Вийти</a></li></div>';
}
?>
<div id = "modal_login" class = "modal_div">
<span class = "modal_close">X</span><br/><br/>
<p>Для створення новини необхідно зареєструватися або підтвердити свою реєстрацію.</p>
<p>Ви зареєстровані?</p>
<a href = "registration.php" id = "registration" ><input type = "button" value = "Hi" /></a>
<a href = "identificate.php" id = "identificate" ><input type = "button" value = "Так" /></a>
</div>
<div id = "overlay"></div>
