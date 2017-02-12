<?php
if(isset($_FILES['f'])) {
  $uploadfile = "i/".$_FILES['f']['name'];
  move_uploaded_file($_FILES['f']['tmp_name'], $uploadfile);
  echo '</br> Загружен файл: '.$uploadfile;
}

?>