<?php
require 'header.php';
if (isset($_FILES['f']))
{
	if (sizeof($_FILES['f']) != 0) 
	{
		
		if(preg_match('/[.](jpg)||(gif)||(png)$/', $_FILES['f']['name']))
			{
		$filename = $_FILES['f']['name'];
		$source = $_FILES['f']['tmp_name'];
		$target = $path_to_image_directory.$filename;
		move_uploaded_file($source, $target);
		createThumbnail2($filename);
		$nf = $path_to_thumbs_directory.$filename;
		$db = dbconnect();
		$un = $_SESSION['user'];
		$query = "INSERT INTO ".$un." (textpath) VALUES (:textpath)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':textpath', $nf);
		$stmt->execute();
		}
	}
}
if (isset ($_POST['delete']))
{
	$un = $_SESSION['user'];
	$db = dbconnect();
	$idimg = $_POST['idImage'];
	$query = "DELETE FROM ".$un." WHERE ID =".$idimg;
	$db->exec($query);
	$db = null;
}
function viewfoto1()
{
	$un = $_SESSION['user'];
	$db = dbconnect();
		$query = "SELECT * FROM ".$un;
		if($stmt = $db->query($query))
		{
			$rownum = $stmt->rowCount();
			if ($rownum >= 1)
			{
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
						echo '<div><img src = "'. $row['textpath'].'"/></br></div>';
						echo '<form method = "post" action = "redaction_news.php">
							<input type = "hidden" name = "delete" value = "yes"/>
							<input type = "hidden" name = "idImage" value ="'.$row['id'].'"/>
							<input type = "submit" name = "delete" value = "Видалити"/>
							</form>';
				}
			}
		}
}

?>
<html>
<head>
<script src="jquery-3.0.0.min.js"></script>
<script type = "text/javascript" src = "script.js"></script>
<link rel='stylesheet' type='text/css' href='styles.css'>
</head>
<body>
<div id = "galery">
<form action = "redaction_news.php" class = "formnews" method = "post" enctype = "multipart/form-data">
<p><input type = "file" name = "f" /></p>
<input type ="submit" name = "loadding"  value="Додати фото" />
</form></div>
<div id = "blokfoto" ><?php viewfoto1(); ?></div>
<form action = "newsview.php" class = "formnews" method = "post" name = "news">
<textarea name= "redaction_text"  rows = "15" cols = "50">
</textarea>
<input type = "submit" name = "newsbutton" id = "entr" value = "додати новину"/>
<div id = "entrnews" class = "modal_div">
<span class = "modal_close">X</span>
<p>Введіть, будь-ласка, текст.</p>
<p>Вкажіть хоча б тематику повідомлення!</p>
<a href = "redaction_news.php"><input type = "button" value = "Ok" /></a>
</div>
<div id = "overlay"></div>

</script>
</form>
</body>
</html>