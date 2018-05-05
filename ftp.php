<?php
// connect and login to FTP server
$ftp_server = "ftp3.dhl.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, 'tapadoo', 'me8reCrA');

$file = "index.php";

echo is_array(ftp_nlist($ftp_conn, ".")) ? 'Connected!' : 'not Connected! :(';
// upload file
// if (ftp_put($ftp_conn, "serverfile.php", $file, FTP_ASCII))
//   {
//   echo "Successfully uploaded $file.";
//   }
// else
//   {
//   echo "Error uploading $file.";
//   }

// close connection
ftp_close($ftp_conn);
?>