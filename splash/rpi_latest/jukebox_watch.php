
<?php


function mySort($a, $b) {
return intval($a['votes']) > intval($b['votes']);
}


$jukebox_file = "jukebox_movies.txt";
$jukebox_movies = json_decode(file_get_contents($jukebox_file), true);

$video_table = '';

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
    $title_ok = false;
    $video_table='<div style="overflow-y: scroll; overflow-x:hidden; height:600px;">';
    //$video_table='<div>';



    foreach ($jukebox_movies as $key => $value) {

        $count++;

        $videoId = $key;
        $title = $value['title'];
        $descr = $value['description'];
        $votes = intval($value['votes']);
        $border_color = '';

        if ($count == 1 && $votes == -2)
        {
            $video_table.= '<h3>Movie of the month</h3>';
        $video_table .= sprintf ('<table class="jukebox_table"><tr><td valign=top><div id="%s_img"><a href="./dirlist/%s.mp4"><img border="%s" src="./movies/%s.jpg" width="%s"></a></div></td><td valign=top><b>%s</b><br/>%s</td></tr></table>',
              $videoId,
              $videoId,
              $borderSize,
              $videoId,
              $max_thumb*100, 
              $title, $descr, $votes);
        }

        if ($votes == -1) 
        {
            if (!$title_ok)
            {
                $video_table.= '<h3>Previous available movies</h3>';
                $video_table.='<table class="jukebox_table">';
                $video_table.= '<form action="" method="POST">';
                $video_table.='<tr>';
                $title_ok = true;
            }

    
            $video_table .= sprintf ('<td valign=top><div id="%s_img"><a href="./dirlist/%s.mp4"><img border="%s" src="./movies/%s.jpg" width="%s"></a></div></td><td valign=top><b>%s</b><br/>%s</td>',
              $videoId,
              $videoId,
              $borderSize,
              $videoId,
              $max_thumb*100, 
              $title, $descr);

            if ($count % $max_cols == 0)
                $video_table.='</tr><tr>';

        }
    }
    if ($title_ok)
        $video_table.= '</tr></table></div><br/>';

?>

<!doctype html>
<html>
  <head>
    <title>Internet Jukebox - Voting</title>
<link rel="stylesheet" href="input.css" media="screen" title="home">
<script src="/js/jquery.min.js"></script>
<style>
html, body {
padding: 0;
margin: 0;
overflow: hidden;
}
#bla {
position: absolute;
left: 0;
top: 0;
right: -30px;
bottom: 0;  
padding-right: 15px;
overflow-y: scroll;
}
</style>
  </head>
  <body>

<script>

$(document).ready(function() {

    <?=$javascript_text?>

    });

</script>
<div id="bla">
<div id=debugjukebox></div>
    <?=$video_table?>
</div>
  </body>
</html>
