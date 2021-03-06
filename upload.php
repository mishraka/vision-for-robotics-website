<!DOCTYPE html>
<html>
<head>
<script>
function findObjects(image_name){
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("result").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "findObjects.php?image_name="+image_name, true);
        xmlhttp.send();
}
</script>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- place upload form here for more uploads.-->
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select new image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<br> <br>
<?php
$target_dir = "uploads/";
# Add time generated suffix to the uploaded filename
$path_parts = pathinfo($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        #echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large (>5Mb).";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        #echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
	echo "<img src=\" " . $target_file . " \" alt=\"dummy.jpg\" style=\"max-height: 640px; max-width: 640px;\" />"; 
	echo "<br><button onclick=\"findObjects('".$target_file."');\"> Find Me Objects </button>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<br>

<div id="result">
</div>

</body>
</html>
