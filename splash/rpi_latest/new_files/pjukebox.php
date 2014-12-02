<html>
<head>
<link rel="stylesheet" href="input.css" media="screen" title="home">
</head>

<body>
<?php
$d1 = new DateTime('2014-11-25 16:55:00');
//$d1 = new DateTime('2014-11-24 19:20:00');
$d2 = new DateTime();

if ($d1 > $d2) 
    echo 'You can vote for the next movie of the month until <span class="time">November 25th, 16h45 CET</span>';
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

