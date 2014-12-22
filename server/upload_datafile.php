=<!DOCTYPE html>
<html>
<body>

<?php

// A simple PHP/FTP upload to a remote site

//Here is the data file votes_Rpi1.txt
//Notes, modify the data file name from the folder questionare
//It locates in /quesionare/app.ajax-poll/include/CPoll.inc.php
//There is a method getDataFilePath()
//Change the votes.txt to votes_Rpi1.txt there

$data_file = "../localapps/questionare/app.data/poll-multi-choice.def/votes_Rpi1.txt";

//Here is the parameters of the ftp server
$ftp_server = "ftp.internet-jukebox.org";
$ftp_user_name="internetpk";
$ftp_user_pass="6v2MGfNBdb65";

$file_path = 'votes_Rpi1.txt';

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
    echo "Connected to $ftp_server.";
}

ftp_chdir($conn_id, 'www/server/votes/');

// get contents of the current directory
$contents = ftp_nlist($conn_id, ".");
//
// // output $contents
var_dump($contents);


// upload a file
if (ftp_put($conn_id, $file_path, $data_file, FTP_BINARY)) {
 echo "<br/>successfully uploaded $data_file\n";
} else {
 echo "There was a problem while uploading $file\n";
}

// close the connection
ftp_close($conn_id);
?>


</body>
</html>
