<?php
$image_name = $_GET["image_name"];
$cmd = "/var/www/html/visual_landmark_detector ".$image_name;
$output = shell_exec($cmd);
#echo "command to execute:". $cmd;
$path_parts = pathinfo($image_name);
$result_image_file = $path_parts['dirname']."/".$path_parts['filename']."_results.".$path_parts['extension'];
#echo "result image filename is $result_image_file";
if (file_exists($result_image_file)){
	echo "<br><img src=\"".$result_image_file."\" alt=\"dummy2.jpg\"  style=\"max-height: 640px; max-width: 640px;\" />";
}
else{
	echo "<br>Image couldn't be processed correctly!!";
}
?>
