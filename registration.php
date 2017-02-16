<html> //загрузка аватарок с превью через javascript
<head>
<link rel='stylesheet' type='text/css' href='styles.css'>
<script type="text/javascript" src="assets_js_ajaxupload.3.5.js"></script>
</head>
<?php 
	include 'function.php';
	$filename = null;
?>
<body>
<header>Життя - це наявність новин</header><br /><br /><br /><br />
<button name="rus" onclick = "checenlang(this.name)">Русский</button>
<button name="ukr" onclick = "checenlang(this.name)">Українська</button>
<div class="ukr"><div class = "menu" ><br><ul class="menu">
<li><a href="index.php">Повернутись на головну<a></li></ul></div></div>
<div class="russ"><div class = "menu" ><ul class="menu">
<li><a href="index.php">Вернуться на главную</a></li><ul></div></div>
<form enctype="multipart/form-data" action = "viewregistration.php" class = "formnews" name="registration" method = "post" onchange="return validate(this)">
<table width = "90%">
<tr><label for = "avatar"> <span id="output"><h3>Вставити фото</h3></br>
                  <img src="512x512bb.jpeg" style = "width: 200px"> </span></label>
<input type="file" name="avatar" id = "avatar" style = "visibility: hidden; margin: 20px;" ></tr>
<tr><td colspan="2"><font color = "red" size = 1><i><p id ="inform"></p></i></font></td></tr>
<tr><td class= "russ">Логин</td><td class="ukr">Логін</td>
<td><input type = "text" name="login" size="20" onchange="enablebutton()" onblur="checklogin(this.value)" value= "<?php echo $login;?>" /></td></tr>
<th colspan="2" align="center"><span id="check_login"></span></th>
<tr><td>Пароль</td><td><input type = "text" name = "pass" maxlength="32" onchange="enablebutton()" value = "<?php echo $pass;?>"/></td></tr>
<table>
<input type = "hidden" id = "filename" name = "filename" value = ""/>
<input type = "submit" id = "buttonregistration" name = "newuser" disabled="disabled" value = "Зареєструватись"/>
</form>
<script src="jquery-3.0.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>
<script>
function handleFileSelect(evt) {
    var file = evt.target.files; // объект списка файлов ?
    var f = file[0];
    if (!f.type.match('image.*')) {
        alert("Только картинки please...."); //Только картинки!
    }
    var reader = new FileReader();// Закрыть для сбора информации о файле.
    reader.onload = (function(theFile) {
        return function(e) {
            var span = document.createElement('span'); // Делаем миниатюру.
            span.innerHTML = ['<img class="thumb" title="', escape(theFile.name), '" src="', e.target.result, '" style = "width: 200px; margin: 20px;" id = "', escape(theFile.name), '" />'].join('');
            document.getElementById('output').innerHTML = span.innerHTML ;
			document.getElementById('filename').setAttribute("value", escape(theFile.name));
        };
    })(f);
    reader.readAsDataURL(f);// Чтение изображения в качестве данных  URL файла.
}
document.getElementById('avatar').addEventListener('change', handleFileSelect, false);
          var inpf = document.getElementById('avatar');
          inpf.addEventListener('change', function () {
            var file = this.files[0];
            });
         </script>
	</body>
	<script src="jquery-3.0.0.min.js">
</script>