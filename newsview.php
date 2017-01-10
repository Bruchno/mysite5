﻿<?php
include 'header.php';
if (isset($_POST['newsbutton']))
{
	$dbnew = dbconnect();
	$s = $dbnew->query("SELECT * FROM records");//Найдем номер записи
	$n = 0;
	while ($row = $s->fetch(PDO::FETCH_ASSOC))
	{
		if ($n < $row['RECORD_ID'])
		{
			$n = $row['RECORD_ID'];
		}
	}
	$RECORD_ID = $n + 1;// нашли или присвоили 1
	$dbnew = null;// Закрыли соединение
	$news = $_POST['redaction_text'];//get_post('redaction_text');
	//$news = sanitizeString($newsprev);
	//$news = iconv('utf8', 'cp1251', $news);//Сохранили в переменной текст записи
	date_default_timezone_set('UTC');
	$dey = date("y.m.d");// Здесь надо определить переменную для даты
	$un = $_SESSION['user'];
	$dbh = dbconnect();//Следующее соединение для нахождения номера пользователя
			$query = "SELECT * FROM users";
			$stm = $dbh->query($query);
			while ($r = $stm->fetch(PDO::FETCH_ASSOC))
			{
				if ($r['USER'] == $un)
				{
					$id_user = $r['ID'];
				}
			}
			$dbh = null;// Нашли, закрыли
			$pdo = dbconnect();//Вставляем запись в новости
			$st = $pdo->prepare("INSERT INTO records (DATA, ID_USER, RECORD_ID, TEXT_RECORD) 
			VALUES (:DATA, :ID_USER, :RECORD_ID, :TEXT_RECORD)");
			$st->bindParam(':DATA', $dey);
			$st->bindParam(':ID_USER', $id_user);
			$st->bindParam(':RECORD_ID', $RECORD_ID);
			$st->bindParam(':TEXT_RECORD', $news);
			$st->execute();
			$pdo = null;
	$db = dbconnect();
	$query = "SELECT * FROM ".$un;
	$stmt = $db->query($query);// Вынимаем записи из временной таблицы
	$numrows = $stmt->rowCount();
	if ($numrows != 0)// Если фотографий нет, то по быстрому
		{
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$img_record = $row['textpath'];
				$dbn = dbconnect();
			$stn = $dbn->prepare("INSERT INTO images (imagepath, id_record) 
			VALUES (:imagepath, :id_record)");
			$stn->bindParam(':imagepath', $img_record);
			$stn->bindParam(':id_record', $RECORD_ID);
			$stn->execute();
			$dbn = null;
		}
	} 
	$str = $un.", Ваш запис №:".$RECORD_ID." від ".$dey;
	$query = "DELETE FROM ".$un." WHERE ID>=1";
	$db->query($query);
$db = null;	
echo $str;
$db = dbconnect();
$st = $db->prepare("INSERT INTO count_information (record, count_view, count_like, count_notlike) 
VALUES (:record, :count_view, :count_like, :count_notlike)");
$n = 0;
$st->bindParam(':record', $RECORD_ID);
$st->bindParam(':count_view', $n);
$st->bindParam(':count_like', $n);
$st->bindParam(':count_notlike', $n);
$st->execute();
recording($id_user, $RECORD_ID);
countstatistic($RECORD_ID);
}
if (isset($_POST['recordview']))
{
	$id_user = $_POST['user_id'];
	$RECORD_ID = $_POST['record_id'];
	recording($id_user, $RECORD_ID);
	countstatistic($RECORD_ID);
}
function countstatistic($RECORD_ID)
{
	$id_record = $RECORD_ID;
	$db = dbconnect();
		$st = $db->prepare("SELECT * FROM count_information WHERE record = :idrecord");
		$st->bindParam(':idrecord', $id_record);
		$st->execute();
		while ($r = $st->fetch(PDO::FETCH_ASSOC))
		{
			$countview = $r['count_view'];
			$countlike = $r['count_like'];
			$countnotlike = $r['count_notlike'];
		}
		echo '<table class = "countview"> <tr><th>Переглядів</th>';
		echo '<th><input type = "button" onclick = "likeclik('; echo $id_record.')" value = "Подобається"/></th>';
		echo '<th><input type = "button" click = "notlikeclik('.$id_record.')" value = "Неподобається"/></th>';
		echo '</tr><tr><th>'.$countview.'</th>';
		echo '<th><div id = "countlike">'.$countlike.'</div></th>';
		echo '<th><div id = "notlikeclik">'.$countnotlike.'</div></th></tr></table>';
}
?>
<script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>