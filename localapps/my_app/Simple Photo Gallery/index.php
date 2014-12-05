<?php
include 'config.php';
include 'include/functions.php';

$string =array();
$dir = opendir($filePaththumb);
while ($file = readdir($dir)) {
	if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) {
	$string[] = $file;
	}
}

echo "<b><font size='$font_size'>".$gallery_name."</font></b><br>";
$loop = "0";
while (sizeof($string) != 0){
	$img = array_pop($string);
	echo "<a href='$filePath$img' target='$target_thumb'><img src='$filePaththumb$img' border='0' width='$thumb_width.px'/></a>";
	$loop = $loop + 1;
	if ($loop == $loop_end) {
		echo "<br>";
		$loop = "0";
	}
}
echo "<p><a target='_blank' href='http://www.friendsinwar.com'><font size='1'>Simple Photo Gallery v1.0</font></a></p>";
?>