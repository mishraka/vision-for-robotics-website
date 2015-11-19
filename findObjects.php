<?php
// $output = shell_exec('ls -lart');
$image_name = $_GET["image_name"];
//echo "argument is $image_name <br>";
echo "<img src=\"".$image_name."\" alt=\"dummy2.jpg\"  style=\"max-height: 640px; max-width: 640px;\" />";
?>
