
<?php

$movie_selected = $_GET['movie_id'];

$url = 'http://www.youtube.com/watch?v='.$movie_selected;
$template = '/var/www/' .  'dirlist/%(id)s.%(ext)s';
$string = ('youtube-dl ' . escapeshellarg($url) . ' -f 18 -o ' .
escapeshellarg($template));
//escapeshellarg($template). ' --restrict-filenames');

$descriptorspec = array(
     0 => array("pipe", "r"),  // stdin
     1 => array("pipe", "w"),  // stdout
     2 => array("pipe", "w"),  // stderr
);
$process = proc_open($string, $descriptorspec, $pipes);
$stdout = stream_get_contents($pipes[1]);
fclose($pipes[1]);
$stderr = stream_get_contents($pipes[2]);
fclose($pipes[2]);
$ret = proc_close($process);
echo json_encode(array('status' => $ret, 'errors' => $stderr,
'url_orginal'=>$url, 'output' => $stdout,
'command' => $string));

if (!$ret) {
    echo '<h1>SUCCESS</h1>';
    //echo 'Click <a href="./projection.php?movie_id='.$movie_selected.'">here</a> to project the video';
    exec ('omxplayer -o hdmi '.$movie_selected.'.mp4');
}
else
    echo '<h1>FAILURE</h1>';


?>
