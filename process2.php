<?php
function createThumbnail2($filename)
{
	require 'config.php';
	//Определяем формат файла
	if(preg_match('/[.](jpg)$/',$filename) || preg_match('/[.](jpeg)$/',$filename))
	{
		$im = imagecreatefromjpeg($path_to_image_directory.$filename);
	} else if(preg_match('/[.](gif)$/',$filename))
	{
		$im = imagecreatefromgif($path_to_image_directory.$filename);
	} else if (preg_match('/[.](png)', $filename))
	{
		$im = imagecreatefrompng($path_to_image_directory.$filename);
	}
	$ox = imagesx($im);
	$oy = imagesy($im);
	$nx = $width_add_foto;
	$ny = floor($oy*($width_add_foto/$ox));
	$nm = imagecreatetruecolor($nx, $ny);
	imagecopyresized($nm, $im, 0,0,0,0, $nx, $ny, $ox, $oy);
	if(!file_exists($path_to_thumbs_directory))
	{
		if(!mkdir($path_to_thumbs_directory))
		{
			die ("Возникли проблемы");
		}
	}
	imagejpeg($nm, $path_to_thumbs_directory.$filename);
}
?>