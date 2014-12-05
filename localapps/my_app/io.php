<html>
<body>

<?php

include 'chat.php';

//write the message in the messages.txt file line by line.
$myfile=fopen("/Library/WebServer/Documents/messages.txt","a") or die("Unable to open the file");
fwrite($myfile,$message."\n");

//read the content of the file
$lines = file("messages.txt");

foreach($lines as $temp) {
    echo $temp;
    echo "<br>"; 
}

?>

</body>
</html>
