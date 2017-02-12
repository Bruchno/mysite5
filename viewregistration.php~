<?php
include 'header.php';
if (isset($_POST['newuser'])){
	$un = $_POST['login'];
	$up = $_POST['pass'];
	$useravatar = $_POST['filename'];
	$_SESSION['user'] = $un;
	$db = dbconnect();
	$stmt = $db->prepare("INSERT INTO users (USER, PASS, AVATAR) VALUES (:USER, :PASS, :AVATAR)");
	$stmt->bindParam(':USER', $un);
	$stmt->bindParam(':PASS', $up);
	$stmt->bindParam(':AVATAR', $useravatar);
	$stmt->execute();
	$db = null;
	createtable($un);
}
if (isset($_POST['user']))
{
	$un = $_POST['login'];
	$_SESSION['user']= $un;
	createtable($un);
}
?>
<div id = "entrnews" class = "modal_div">
	<p>Вітаємо! Продовжуйте роботу</p>
	<a href = "redaction_news.php"><input type = "button" value = "Ok" /></a>
	</div><div id = "overlay"></div></div>
<script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
<script>viewbutton();</script>
</body>