<?php
require 'header.php';
?>
﻿<html>
<head>
<script src="jquery-3.0.0.min.js"></script>
<script type = "text/javascript" src = "script.js"></script>
<link rel='stylesheet' type='text/css' href='styles.css'>
</head>
<body>
<div style=" width:100%; height:1px; clear:both;">.</div>
<table><tr><td><div id = "blokfoto" ></div></td><td>
<form action = "newsview2.php" class = "formnews" method = "post" name = "news" enctype = "multipart/form-data">
<label for = "loadding"><img src="512x512bb.jpg" alt="" style = "width: 120px">
<h2>Вставити фото</h2>
</label>
<p><input type = "file" id = "loadding" name = "f[]" multiple="true"  style = "visibility: hidden; margin: 20px;"/></p>
<textarea name= "redaction_text"  rows = "25" cols = "90">
</textarea></br></br>
<input type = "submit" name = "newsbutton" id = "entr" value = "додати новину"/></form>
</td></td></table>
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
            span.innerHTML = ['<img class="thumb" title="', escape(theFile.name), '" src="', e.target.result, '" style = "width: 400px; margin: 20px;" id = "', escape(theFile.name), '" />'].join('');
            document.getElementById('blokfoto').innerHTML += span.innerHTML ;
			//document.getElementById('filename').setAttribute("value", escape(theFile.name));
        };
    })(f);
    reader.readAsDataURL(f);// Чтение изображения в качестве данных  URL файла.
}
document.getElementById('loadding').addEventListener('change', handleFileSelect, false);
          var inpf = document.getElementById('loadding');
          inpf.addEventListener('change', function () {
            var file = this.files[0];
            });
         </script>
	</body>
	<script src="jquery-3.0.0.min.js">
</script>