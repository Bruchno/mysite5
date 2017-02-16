<?php
include 'header.php';
	$un = $_POST['login'];
	$up = $_POST['pass'];
	$avatar = $_POST['filename'];
		$filename = $_FILES['avatar']['name'];
		$source = $_FILES['avatar']['tmp_name'];
		$target = $path_to_image_directory.$filename;
		move_uploaded_file($source, $target);
		$useravatar = 'i/'.$filename;
	$_SESSION['user'] = $un;
	$db = dbconnect();
	$stmt = $db->prepare("INSERT INTO users (USER, PASS, AVATAR) VALUES (:USER, :PASS, :AVATAR)");
	$stmt->bindParam(':USER', $un);
	$stmt->bindParam(':PASS', $up);
	$stmt->bindParam(':AVATAR', $useravatar);
	$stmt->execute();
	$db = null;
	createtable($un);
	echo '<div class = "textindex">'.
	'<p><span class="ukr">Вітаємо! Продовжуйте роботу, </span><span class = "russ">Поздравляем! Продолжайте работу</span></p>';
	echo '<p ><span class = "russ">Проверка прошла успешно: </span><span class="ukr">Перевірка пройшла успішно: </span>'.
	'<img src = "'.$useravatar.'" style = "width: 200px"/></br>'.$un.' '.$up.' </p>';
	echo '<a href = "redaction_news.php"><button>Створити новину</button></a>'.
	'<a href = "index.php"><button>На головну</button></a></div>';	
?>