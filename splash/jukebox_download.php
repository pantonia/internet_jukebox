
<?php

function mySort($a, $b) {
return intval($a['votes']) < intval($b['votes']);
}

$download_flag=1;

$d1 = new DateTime('2014-11-25 16:55:00');
//$d1 = new DateTime('2014-11-24 21:20:00');
$d2 = new DateTime();

if ($d1 > $d2) 
{
    echo 'You can vote for the next movie of the month until <span class="time">November 25th, 16h45 CET</span>';
    $download_flag=0;
}
else
{
    echo 'Voting period has expired! Please download the selected movie!';
    $download_flag=1;
}


$jukebox_file = "jukebox_movies.txt";
$jukebox_movies = json_decode(file_get_contents($jukebox_file), true);

$movie_selected = '';
//$download_flag = intval($_GET['download_flag']);
$javascript_text = '';
$video_table = '';
//echo '<b>download flag = '.$download_flag.'</b>';

if (isset($_POST['submit'])) {
 if(isset($_POST['radios']))
 {
     $movie_selected = $_POST['radios'];  //  Displaying Selected Value
     $download_action = $_POST['submit'];

     echo '<b>movie ID = '.$movie_selected.'</b>';
     echo '<b>Submit value = '.$download_action.'</b>';
    if ($download_action == 'Vote')
    {  
        $new_votes = intval($jukebox_movies[$movie_selected]["votes"])+1;
        $jukebox_movies[$movie_selected]["votes"]=$new_votes;
    }
    else
    {   

$url = 'http://www.youtube.com/watch?v='.$movie_selected;
$template = '/var/www/html/splash/' .  'dirlist/%(id)s.%(ext)s';
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
//echo json_encode(array('status' => $ret, 'errors' => $stderr,
//'url_orginal'=>$url, 'output' => $stdout,
//'command' => $string));

if (!$ret) {
    $video_table = '<h1>Movie downloaded! You can go to the <a href="./main.php?tab=library">library</a> to watch it!</h1>';
        $jukebox_movies[$movie_selected]["votes"]=-2;
    //echo 'Click <a href="./projection.php?movie_id='.$movie_selected.'">here</a> to project the video';
    //exec ('omxplayer -o hdmi '.$movie_selected.'.mp4');
}
else
    echo '<h1>Failed to download movie</h1>';

    }
}

file_put_contents($jukebox_file, json_encode($jukebox_movies));

}



uasort($jukebox_movies, 'mySort');

$svalue = '';
$rvalue = 10;
$cvalue = 2;
$tvalue = 3;
$dvalue = 6;

if ($_GET['q'] && $_GET['maxResults'] && $_GET['maxCols'] && $_GET['maxThumb'] && $_GET['maxDescr']) {
$svalue = $_GET['q'];
$rvalue = intval($_GET['maxResults']);
$cvalue = intval($_GET['maxCols']);
$tvalue = intval($_GET['maxThumb']);
$dvalue = intval($_GET['maxDescr']);
}

$javascript_text = '';

$htmlBody = <<<END
<form method="GET">
  <div>
    <input type="submit" value="Search"> 
    <input type="search" id="q" name="q" placeholder="Enter Search Term" value=$svalue>
    &nbsp;&nbsp;
    Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value=$rvalue>
    &nbsp;&nbsp;
    Size: <input type="number" id="maxCols" name="maxCols" min="1" max="3" step="1" value=$cvalue>
    &nbsp;&nbsp;
    Thumb: <input type="number" id="maxThumb" name="maxThumb" min="1" max="7" step="1" value=$tvalue>
    &nbsp;&nbsp;
    Descr: <input type="number" id="maxDescr" name="maxDescr" min="1" max="7" step="1" value=$dvalue>
    <br/>
    <hr/>
    <br/>
  </div>
</form>
END;

    $count=0;
    $max_cols = 1;
    $max_thumb = $tvalue;
    $max_descr = $dvalue;
    $video_table='<div style="overflow-y: scroll; overflow-x:hidden; height:550px;">';
    //$video_table='<div>';
    $video_table.='<table class="jukebox_table">';
    $video_table.= '<form action="" method="POST">';
    $video_table.='<tr>';



    foreach ($jukebox_movies as $key => $value) {

        $count++;

        $videoId = $key;
        $title = $value['title'];
        $descr = $value['description'];
        $votes = $value['votes'];
        $border_color = '';

        if (intval($votes)>0) {
        
        if ($count == 1 && $download_flag==1)
            $borderSize = "class=colorimg";
        else
            $borderSize = "";

        $video_table .= sprintf ('<td><input type="radio" name="radios" id="%s_radio" value="%s"></td><td valign=top><div %s id="%s_img"><img src="./movies/%s.jpg" width="%s"></div></td><td valign=top><b>%s</b><br/>%s</td><td valign=center><h3>%s</h3></td>',
              $videoId,
              $videoId,
              $borderSize,
              $videoId,
              $videoId,
              $max_thumb*100, 
              $title, $descr, $votes);

        if ($count % $max_cols == 0)
        $video_table.='</tr><tr>';

$javascript_text .= 'jQuery("#'.$videoId.'_img").click(function () { jQuery("#'.$videoId.'_radio").prop("checked",true);});';
        }
    }
    $video_table.= '</tr></table></div><br/>';
    if ($download_flag == 0)
    $video_table.= '<input class="submitButton" type="submit" name="submit" value="Vote"></form> ';
    else
    {
    $video_table.= '<input class="submitButton" type="submit" name="submit" value="Download"></form> ';
    }

?>

<script>

$(document).ready(function() {

    <?=$javascript_text?>

    });

</script>

<?=$video_table?>
