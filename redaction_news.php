<?php //Работающая версия загрузки файлов превью через ajax последняя версия на 14.02.17 
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
<div id = "information"></div>
<table><tr><td><div id = "blokfoto" ></div></td><td>
<form action = "" id = "mainForm" class = "formnews" method = "post" name = "news" enctype = "multipart/form-data">
<label for = "loadding"><img src="512x512bb.jpg" alt="" style = "width: 120px">
<h2>Вставити фото</h2>
</label>
<p><input type = "file" id = "loadding" name = "image" multiple="true"  style = "visibility: hidden; margin: 20px;"/></p>
</form><form action = "newsview.php" method = "post" name = "newsdata" class = "formnews">
<input type = "hidden" id = "imageArray" name = "imageArray" value =''/>
<textarea name= "redaction_text"  rows = "25" cols = "90">
</textarea></br></br>
<input type = "submit" name = "newsbutton" id = "entr" value = "додати новину"/></form>
</td></table>
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
$('#mainForm').on('change',function (e) {
    e.preventDefault();
    var maxFileSize = 100000000,
    data = new FormData;
    $.each(this.image.files, function (i, file){
        if(file.size <= maxFileSize){
            data.append('image[]', file);
        }
    });
    $.ajax({
        type: "POST",
    url: "ajax.php",
    data: data,
    contentType: false,
        processData: false,
        beforeSend: function() {
            $('#loader').show();
        }
    }).done(function (result) {
        $("#blokfoto").append('<img src = "'+result+'" style="height: 200px; padding:"/></br>'+'</br></div>');	
        var hiddenInput = document.getElementById('imageArray');
        var nameimage = hiddenInput.getAttribute('value');
        if (nameimage != '') {
        nameimage += ", " + result;
        } else {
        	nameimage = result;        
        }
        
        hiddenInput.setAttribute('value', nameimage);
        document.getElementById('information').innerHTML = nameimage; 
        $('#mainForm')[0].reset();
    });
});
         </script>
	</body>
	<script src="script.js"></script>
	<script src="jquery-3.0.0.min.js">
</script>