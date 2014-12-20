
<!DOCTYPE html>
<html>
<body>

<?php

// A simple PHP/FTP upload to a remote site


//The image file going to be uploaded.
$data_file = "image/Rpi1.jpg";

//The ftp server parameters.
$ftp_server = "ftp.internet-jukebox.org";
$ftp_user_name="internetpk";
$ftp_user_pass="6v2MGfNBdb65";

$file_path = 'www/server/photos';

// set up basic connection
$conn_id = ftp_connect($ftp_server)  or die ("Cannot connect to host");

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


// check connection
if ((!$conn_id) || (!$login_result)) {
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name";
    exit;
} else {
    echo "Connected to $ftp_server successfully";
}


// upload a file
if (ftp_put($conn_id, $file_path, $data_file, FTP_ASCII)) {
 echo "successfully uploaded $data_file\n";
} else {
 echo "There was a problem while uploading $file\n";
}

// close the connection
ftp_close($conn_id);
?>


</body>
</html>
