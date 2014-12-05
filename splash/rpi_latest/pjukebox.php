<html>
<head>
<link rel="stylesheet" href="input.css" media="screen" title="home">
</head>

<body>
<?php
$deadline_text = file_get_contents("./download_deadline.txt", true);
$d1 = new DateTime($deadline_text.trim());
$d2 = new DateTime();
$d2 = new DateTime();

if ($d1 > $d2) 
    echo 'You can vote for the next movie of the month until <span class="time">'.$deadline_text.'</span>';
else
    echo 'Voting deadline has expired!';
?>

    <br/>
    <iframe id='jukebox_iframe' align=center width="770" height="630" src="./jukebox_download_iframe.php?download_flag=<?php $download_flag?>"></iframe> 
<br/>
    <br/>
    <br/>

</body>
</html>

