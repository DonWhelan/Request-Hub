<form action="s3.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php
//readfile("images/2966.jpg");
//$a = readfile("../images/2966.jpg");
// $file = "../images/2966.jpg";
// header('Content-Type:image/jpeg');
// header('Content-Length: '.filesize($file));
// $a = file_get_contents($file);

// echo "<img src='$a'></img>"



?>


<img src="image.php?file=2966.jpg" />

