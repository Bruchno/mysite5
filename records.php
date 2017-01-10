<?php
include 'header.php';
$num = 0;
if (isset($_POST['next']))
{
	$GLOBALS['num'] += 10;
}
$n = $GLOBALS['num'];
	$m = $n + 10;
	$db = dbconnect();
	$query = "SELECT * FROM records LIMIT 50";
	$stmt = $db->query($query);
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$idrecord = $row['RECORD_ID'];
		$datawrite = $row['DATA'];
		$text = crop_str($row['TEXT_RECORD'], 40);
		$id_user = $row['ID_USER'];
		$dbn = dbconnect();
		$st = $dbn->prepare("SELECT * FROM users WHERE ID = :iduser");
		$st->bindParam(':iduser', $id_user);
		$st->execute();
		foreach ($st as $r)
		{
			$avatar = $r['AVATAR'];
			$login = $r['USER'];
		} $dbn = null;
		echo '<div class = "avatarka" style = "float:left"><img src = "'.$avatar.'"><br />
		<p>'.$login.'</p></div>
		<div class = "reclama" ><p>'.$text.'</p><p>'.$datawrite.'</p></div>
		<form action = "newsview.php" method = "post">
		<input type = "hidden" name = "user_id" value = "'.$id_user.'"/>
		<input type = "hidden" name = "record_id" value = "'.$idrecord.'"/>
		<input type ="submit" name = "recordview" value = "Переглянути новину"/></form>';
		echo '<div style=" width:100%; height:1px; clear:both;">.</div>';
	} $db = null;
	echo '<br/><br /><form action = "newsview.php" method = "post">
	<input type = "submit" name = "next" class = "nextButton" value = "Далі">
	</form></body>';
?>