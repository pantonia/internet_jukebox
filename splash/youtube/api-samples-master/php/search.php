<?php

$htmlBody = <<<END
<form method="GET">
  <div>
    Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
  </div>
  <div>
    Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
  </div>
  <input type="submit" value="Search">
</form>
END;

// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($_GET['q'] && $_GET['maxResults']) {
  // Call set_include_path() as needed to point to your client library.
//set_include_path(get_include_path() . PATH_SEPARATOR . '../../google-api-php-client/src');
require_once '../../google-api-php-client/src/Google/Client.php';
require_once '../../google-api-php-client/src/Google/Service/YouTube.php';

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

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array(
      'q' => $_GET['q'],
      'maxResults' => $_GET['maxResults'],
    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    $count=0;
    $video_table='<table width=700>';
    $video_table.='<tr>';
    foreach ($searchResponse['items'] as $searchResult) {
        $count++;
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf('%s|%s|%s|0|0<br/>',
            $searchResult['id']['videoId'],
             $searchResult['snippet']['title'],
              $searchResult['snippet']['description']);

        $descr = $searchResult['snippet']['description'];
        $title = $searchResult['snippet']['title'];
        $descr_short = (strlen($descr) > 53) ? substr($descr,0,50).'...' : $descr;
        $title_short= (strlen($title) > 23) ? substr($title,0,20).'...' : $title;

          $video_table .= sprintf ('<td><input type="radio" name="radios" value="%s"></td><td><img src=http://img.youtube.com/vi/%s/0.jpg width=300></td><td valign=top width=200><b>%s</b><br/>%s</td>',
              $searchResult['id']['videoId'],
              $searchResult['id']['videoId'],
              $title, $descr_short);
        if ($count % 3 == 0)
        $video_table.='</tr><tr>';

          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['channelId']);
          break;
        case 'youtube#playlist':
          $playlists .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }
    $video_table.= '</tr></table>';

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
    <title>YouTube Search</title>
  </head>
  <body>
    <?=$htmlBody?>
    <?=$video_table?>
  </body>
</html>
