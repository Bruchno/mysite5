<?php
$name = $_POST['name'];
if (unlink ($name))
{
	echo "Yes";
} else {echo "No"; }		
?>