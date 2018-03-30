<?php
    // ref https://stackoverflow.com/questions/27402572/how-to-echo-image-that-is-outside-of-the-public-folder
    $mime_type = mime_content_type("../images/{$_GET['file']}");
    header('Content-Type: '.$mime_type);
    readfile("../images/{$_GET['file']}");
    // <img src="file.php?file=photo.jpg" />
?>    