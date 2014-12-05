
<?php

function save_image($inPath,$outPath)
{ //Download images from remote server
$in=    fopen($inPath, "rb");
$out=   fopen($outPath, "wb");
while ($chunk = fread($in,8192))
{
fwrite($out, $chunk, 8192);
}
fclose($in);
fclose($out);
}

save_image('http://img.youtube.com/vi/coq9klG41R8/0.jpg', '/var/www/html/splash/movies/YES.jpg');

$url = 'http://www.youtube.com/watch?v=coq9klG41R8';
$template = '/var/www/html/splash/' .  'dirlist/%(id)s.%(title)s.%(ext)s';
$string = ('youtube-dl ' . escapeshellarg($url) . ' -f 18 -o ' .
escapeshellarg($template). ' --restrict-filenames');

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

?>
