
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

$jukebox_file = "jukebox_movies.txt";
$jukebox_movies = json_decode(file_get_contents($jukebox_file), true);
//$jukebox_movies = array();
//
$jukebox_movies['id']['title'] = 'NEW TITLE';




$movie_selected = '';

if (isset($_POST['submit'])) {
 if(isset($_POST['radios']))
 {
     $movie_selected = $_POST['radios'];  //  Displaying Selected Value

 


$jukebox_movies[$movie_selected]["votes"]="1";

 }
}

$svalue = '';
$rvalue = 10;
$cvalue = 2;
$tvalue = 3;
$dvalue = 6;

$javascript_text='';

if ($_GET['q'] && $_GET['maxResults'] && $_GET['maxCols'] && $_GET['maxThumb'] && $_GET['maxDescr']) {
$svalue = $_GET['q'];
$rvalue = intval($_GET['maxResults']);
$cvalue = intval($_GET['maxCols']);
$tvalue = intval($_GET['maxThumb']);
$dvalue = intval($_GET['maxDescr']);
}

$htmlBody = <<<END
<form method="GET">
  <div>
    <input class=searchButton type="submit" value="Search"> 
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


// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($_GET['q'] && $_GET['maxResults'] && $_GET['maxCols'] && $_GET['maxThumb'] && $_GET['maxDescr']) {
//if ($_GET['q'] && $_GET['maxResults'] && $_GET['maxCols'] && $_GET['maxThumb']) {
//if ($_GET['q'] && $_GET['maxResults'] && $_GET['maxCols']) {
//if ($_GET['q'] && $_GET['maxResults']) {
  // Call set_include_path() as needed to point to your client library.
//set_include_path(get_include_path() . PATH_SEPARATOR . '../../google-api-php-client/src');
require_once './youtube/google-api-php-client/src/Google/Client.php';
require_once './youtube/google-api-php-client/src/Google/Service/YouTube.php';

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  //$DEVELOPER_KEY = 'AIzaSyD4Qf63qtXFJh--5bgVxpqYCrYB45MNsBk';
  //$DEVELOPER_KEY = 'AIzaSyAgAF08xVRq9mGTY4H7JZgkGn7oD01EpPY';
  $DEVELOPER_KEY = 'AIzaSyCesbW8Ufrx4H5HxLGbr1E5j_aVXo5YPeo';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  if ($cvalue == 1)
      $max_size = 'short';
  if ($cvalue == 2)
      $max_size = 'medium';
  if ($cvalue == 3)
      $max_size = 'long';

    $query_text = $_GET['q'];

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $query_text,
      'maxResults' => $_GET['maxResults'],
      'videoDuration' => $max_size,
      'type' => 'video',
    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    $count=0;
    $max_cols = 1;
    $max_thumb = $tvalue;
    $max_descr = $dvalue;
    $video_table='<div style="overflow-y: scroll; height:500px;">';
    $video_table.='<table width=700>';
    $video_table.= '<form action="" method="POST">';
    $video_table.='<tr>';
    foreach ($searchResponse['items'] as $searchResult) {
        $count++;

          $videos .= sprintf('%s|%s|%s|0|0<br/>',
            $searchResult['id']['videoId'],
             $searchResult['snippet']['title'],
              $searchResult['snippet']['description']);

        $videoId = $searchResult['id']['videoId'];
        if (!array_key_exists($videoId, $jukebox_movies)) {
              $jukebox_movies[$videoId] = array("title" => $searchResult['snippet']['title'],  "description" => $searchResult['snippet']['description'], "query"=>$query_text, "votes" => "0");
        }

        if ($videoId != $movie_selected && $jukebox_movies[$videoId]['votes'] == "0")
	    {

        $descr = $searchResult['snippet']['description'];
        $title = $searchResult['snippet']['title'];

//save_image('http://img.youtube.com/vi/'.$videoId.'/0.jpg', '/var/www/html/splash/movies/'.$videoId.'.jpg');

$remote_image='http://img.youtube.com/vi/'.$videoId.'/0.jpg';
$local_image='/var/www/html/splash/movies/'.$videoId.'.jpg';
save_image($remote_image, $local_image);
/*
if (copy($remote_image, $local_image.'_copy.jpg')) {
echo "Copy success!";
}else{
echo "Copy failed.";
}
 */
        $videoId = $searchResult['id']['videoId'];

        if ($max_descr > 1)
        {
        $maxd = $max_descr*10;
        $descr_short = (strlen($descr) > 5*$maxd+3) ? substr($descr,0,3*$maxd).'...' : $descr;
        $title_short= (strlen($title) > $maxd+3) ? substr($title,0,$maxd).'...' : $title;
        $dwidth=(700-$max_cols*$max_thumb*50)/$max_cols;


        //$video_table .= sprintf ('<td><input type="radio" name="radios" value="%s"></td><td valign=top><img src=http://img.youtube.com/vi/%s/0.jpg width=%s></td><td width=%s valign=top><b>%s</b><br/>%s</td>',
        $video_table .= sprintf ('<td><input type="radio" name="radios" id="%s_radio" value="%s"></td><td valign=top><div id="%s_img"><img src=./movies/%s.jpg width=%s></div></td><td width=%s valign=top><b>%s</b><br/>%s</td>',
              $videoId,
              $videoId,
              $videoId,
              $videoId,
              $max_thumb*100, $dwidth,
              $title_short, $descr_short);

        if ($count % $max_cols == 0)
        $video_table.='</tr><tr>';
        }
        else
        {
        $video_table .= sprintf ('<td><input type="radio" name="radios" id="%s_radio" value="%s"></td><td><div id="%s_img"><img src=./movies/%s.jpg width=%s></div></td>',
              $videoId,
              $videoId,
              $videoId,
              $videoId,
              $max_thumb*50);

        if ($count % $max_cols == 0)
        $video_table.='</tr><tr>';
	    }

$javascript_text .= 'jQuery("#'.$videoId.'_img").click(function () { jQuery("#'.$videoId.'_radio").prop("checked",true);});';

      }
    }

    $video_table.= '</tr></table></div><br/>';

    $video_table.= '<input class=submitButton type="submit" name="submit" value="Add to Jukebox"></form> ';

    file_put_contents($jukebox_file, json_encode($jukebox_movies));

    $htmlBody .= <<<END
END;
  } catch (Google_ServiceException $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>Internet Jukebox - YouTube Search</title>
<link rel="stylesheet" href="input.css" media="screen" title="home">
<script src="/js/jquery.min.js"></script>
  </head>
  <body>
<script>

$(document).ready(function() {
        <?=$javascript_text?>
                });
</script>

    <?=$htmlBody?>
    <?=$video_table?>
  </body>
</html>
