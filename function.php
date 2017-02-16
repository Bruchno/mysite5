<?php
require 'config.php';
require 'process.php';
require 'process2.php';
function dbconnect()
{
	$db = new PDO("mysql:host=localhost;dbname=usersinformation", "root", "2609");
	$db->query("SET NAMES 'utf-8'");
	return $db;
}
function viewfoto()
{
		$db = dbconnect();
		$stmt = $db->query("SELECT * FROM newuser");
		$rownum = $stmt->rowCount();
		if ($rownum >= 1)
		{
			$n = 0;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					if ($n >= 1)
						{
							echo '<div><img src = "'. $row['textpath'].'"/></br></div>';
							echo '<form method = "post" action = "redaction_news.php">
							<input type = "hidden" name = "delete" value = "yes"/>
							<input type = "hidden" name = "idImage" value ="'.$row['id'].'"/>
							<input type = "submit" name = "delete" value = "Видалити"/>
							</form>';
						}
						$n++;
				}
		}
}
function sanitizeString($var)
{
$var = stripslashes($var);
$var = htmlentities($var);
$var = strip_tags($var);
return $var;
}
function recording($id_user, $id_record)
{
	/*$dbn = dbconnect();
		$st = $dbn->prepare("SELECT * FROM users WHERE ID = :iduser");//
		$st->bindParam(':iduser', $id_user);
		$st->execute();
		while ($r = $st->fetch(PDO::FETCH_ASSOC))
		{
			$avatar = $r['AVATAR'];
			$login = $r['USER'];
		} $dbn = null;
		$db = dbconnect();//
		$stmt = $db->prepare("SELECT * FROM records WHERE RECORD_ID = :recordid");
		$stmt->bindParam(':recordid', $id_record);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$datarecording = $row['DATA'];
			$textrecording = $row['TEXT_RECORD'];
		}
		echo '<div class = "avatarka"><img src = "'.$avatar.'" style = "width: 180px"><br />
		<p>'.$login.'</p><span>'.$datarecording.'</span></div>';
		echo '<div style=" width:100%; height:1px; clear:both;"></div>';
		echo '<div class = "textindex" ><p>'.$textrecording.'</p></div>';
		$db = null;
		$arrayimage = array();*/
		$dbh = dbconnect();//
		$stm = $dbh->prepare("SELECT * FROM images WHERE id_record = :idrecord");
		$stm->bindParam(':idrecord', $id_record);
		$stm->execute();
		echo '<div class = "blokfoto">';
		while ($rowimg = $stm->fetch(PDO::FETCH_ASSOC))
		{
			echo '<img src ="'.$rowimg['imagepath'].'" style = "width: 47%;">';
		}
		echo '</div>';
		$dbh = null;		
}
function crop_str($string, $limit)
{
 $after = '';
 if (strlen($string) > $limit) {
 $substring_limited = substr($string, 0, $limit); //режем строку от 0 до limit 
 $str = substr($substring_limited, 0, strrpos($substring_limited, ' ')) . $after;
 return  $str;
 } else
 return  $string;
}
function destroySession()
{
	$un = $_SESSION['user'];
	$db = dbconnect();
	$query = "DROP TABLE ".$un;
	$db->query($query);
	$_SESSION = arrау();
	if (session_id() != "" || isset($_COOKIE[session_name()]))
	{
		setcookie (session_name().'', time()-2592000,'/');
		session_destroy();
	}
}
function createtable($username)
{
	$dbc = dbconnect();
	$query = "CREATE TABLE ".$username." (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, textpath VARCHAR(128))";
	$dbc->exec($query);
	$dbc = null;
}
function get_post($var)
{
return $_POST[$var];
}
?>