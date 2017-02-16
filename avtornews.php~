<?php
include 'header.php';
require_once 'function.php';
if (isset($_POST['avtor']))
{
	$iduser = $_POST['id_user'];
	$dbn = dbconnect();
	$st = $dbn->prepare("SELECT * FROM users WHERE ID=:iduser");
	$st->bindParam(':iduser', $iduser);
	$st->execute();
	while ($row = $st->fetch(PDO::FETCH_ASSOC))
	{
		$user = $row['USER'];
		$avatar = $row['AVATAR'];
		$id_user = $row['ID'];
		echo '<div class = "avatarka">';
		echo '<img src ="'.$avatar.'" style = "width: 100%"><br />';
		echo '<p>'.$user.'</p></div>';
	}
	$dbn = null;
	$db = dbconnect();
	$stmt = $db->prepare("SELECT * FROM records WHERE ID_USER =:iduser");
	$stmt->bindParam(':iduser', $iduser);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$idrecord = $row['RECORD_ID'];
		$datawrite = $row['DATA'];
		$text = crop_str($row['TEXT_RECORD'], 80);
		echo '<div class = "reclama"><p>'.$text.'</p><p>'.$datawrite.'</p>
		<form action = "newsview.php" method = "post">
		<input type = "hidden" name = "user_id" value = "'.$id_user.'">
		<input type = "hidden" name = "record_id" value = "'.$idrecord.'">
		<input type ="submit" name = "recordview" value = "Переглянути новину"></form></div>';
		echo '<div style=" width:100%; height:1px; clear:both;">.</div>';
	} $db = null;
}
?>