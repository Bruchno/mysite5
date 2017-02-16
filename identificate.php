<?php
include 'header.php';
?>
<form action = "viewregistration1.php" name="registration" class = "formregistration " method = "post">
Введіть, будь-ласка, своє ім’я:</br>
<input type = "text" name="login" size="20" onBlur="mylogin()" /></br>
Введіть, будь-ласка, пароль:</br>
<input type = "text" name = "pass" size="12" onBlur="mylogin()"  /></br></br>
<span id="my_login"></span>
<input type = "submit" id = "enter" name = "user" disabled="disabled" value = "Ввійти"/>
</form><div id ="responseajax"></div>
<script src="jquery-3.0.0.min.js">
</script><script src="script.js"></script>
</body></html>