
<?php 

echo "Refreshing ".date("H:i:s");

$raspberry_file = "raspberry_pis.txt";

//last time that file was modified
$file_modified = date ("His", filemtime($raspberry_file));

$now_time = date("His");

$now_time_default = date("ymdHis");

if ($now_time - $file_modified < 10)
    echo "REFRESHING <script>window.parent.location.reload();</script>";
else
    echo "nothing new - ".$now_time_default;

?>
