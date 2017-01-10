<?php
include 'header.php';
$filename = null;
$useravatar = null;
if(isset($_FILES['avatar']))
{
	if(preg_match('/[.](jpg)||(gif)||(png)$/', $_FILES['avatar']['name']))
	{
		$filename = $_FILES['avatar']['name'];
		$source = $_FILES['avatar']['tmp_name'];
		$target = $path_to_image_directory.$filename;
		move_uploaded_file($source, $target);
		createThumbnail($filename);
		$useravatar = $path_to_thumbs_directory.$filename;
		echo '<div id = "ordermade"><img src="'.$path_to_thumbs_directory.$filename.'"/></div>';
	}
}
?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='styles.css'>
</head>
<body>
<form method="post" id = "addfoto" enctype="multipart/form-data" class = "formregistration">
<input type="file" name="avatar">
<input type="submit" id = "avatar" value="Додати фото" />
</form>
<form action = "viewregistration.php" class = "formregistration" name="registration" method = "post">
Введіть, будь-ласка, своє ім’я:</br>
<input type = "text" name="login" size="20" onchange="enablebutton()" onblur="checklogin(this.value)" /></br>
<span id="check_login"></span>
Введіть, будь-ласка, пароль:</br>
<input type = "text" name = "pass" size="12" onchange="enablebutton()" /></br></br>
<input type = "hidden" name = "filename" value = "<?php echo $useravatar; ?>">
<input type = "submit" id = "buttonregistration" name = "newuser" disabled="disabled" value = "Зареєструватись"/>
</form>
<script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>