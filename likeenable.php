<?php
$record = $_POST['record'];
$db = new PDO("mysql:host=localhost;dbname=usersinformation", "mama", "2609");
$stmt = $db->prepare("SELECT * FROM count_information WHERE record =?");
$stmt->execute(array($record));
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$n = $row['count_like'];
		}
		$n++;
		echo 'count ='.$n;
?>