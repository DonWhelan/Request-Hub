<?php
    $mime_type = mime_content_type("../images/{$_GET['file']}");
    header('Content-Type: '.$mime_type);
    readfile("../images/{$_GET['file']}");
?>    