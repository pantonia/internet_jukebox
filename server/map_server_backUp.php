
<?php

$raspberry_file = "raspberry_pis.txt";
$data_file = "../questionare/app.data/poll-multi-choice.def/votes.txt";

$data = json_decode(file_get_contents($data_file), true);

$raspberries = json_decode(file_get_contents($raspberry_file), true);

//print_r ($raspberries."<br/><br/>");


//if ($_GET['q'])
//{
    $new_raspberry = $_GET['q'];
    $new_ssid = $_GET['ssid'];
    $new_desc = $_GET['desc'];
    $new_lat = $_GET['lat'];
    $new_long = $_GET['long'];
//  $new_activity = $_GET['activity'];
    $new_activity = $data_file;

//check if already exists

    $raspberries[] = array("ssid" => $new_ssid,"latitude"=>$new_lat, "longitude"=>$new_long, "description" => $new_desc, "date"=>date("ymdhis"), "activity"=>$new_activity); 

print_r ($raspberries);


file_put_contents($raspberry_file, json_encode($raspberries));

$curl_url = 'http://internet-jukebox.org/server/map_server.php?q='.$new_raspberry.'&ssid='.$new_ssid.'&lat='.$new_lat.'$long='.$new_long.'&desc='.$new_desc.'&activity='.$new_activity;

//curl -T panos.jpg -u username:password ftp://ftp.internet-jukebox.org/www/server/images

echo 'curl = '.$curl_url;

//Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => $curl_url,
CURLOPT_USERAGENT => 'Test agent'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
//
//print_r($resp);

if(!$resp){
        echo 'Error: '.curl_error($curl); 
}

//var_dump(curl_getinfo($curl));

curl_close($curl);

//}


?>



<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Raspberry Map</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
    #map { position:absolute; top:100; bottom:20; width:50%; height:50%;}
</style>
</head>
<body>

<script>
$(document).ready(function(){
setInterval(function() {
$("#debugdiv").load("./refresh.php");
}, 3000);
});

</script>

<div id="debugdiv">DEBUG: </div>

<br/>

<div id='map'></div>

<script>
//L.mapbox.accessToken = 'pk.eyJ1IjoicGFuYXlvdGlzIiwiYSI6IjhVWVREOTAifQ.NWt_NiMoXds89Q7wF81msw';
L.mapbox.accessToken = 'pk.eyJ1IjoibHV5dWFueiIsImEiOiIwSkJGUkZJIn0.kO6TQZwaTwlqHLKzPOzGWg';

//var mapboxTiles = L.tileLayer('https://{s}.tiles.mapbox.com/v3/panayotis.kbh9i6fk/{z}/{x}/{y}.png', {
//            attribution: '<a href="http://www.mapbox.com/about/maps/" target="_blank">Terms &amp; Feedback</a>'
//            });

//var rpis = <?php echo json_encode($raspberries, JSON_PRETTY_PRINT) ?>

//var map = L.map('map')
//    .addLayer(mapboxTiles)
//        .setView([47.367, 8.55], 14);

//map.on('click', function(e) {
//        alert(e.latlng.lat+"-"+e.latlng.lng);
//});

//var date_now = Date.now();

$("#debugdiv").append("--"+date_now+"--");

for (var key in rpis) {
    if (rpis.hasOwnProperty(key)) {
        $('#debugdiv').append(rpis[key].ssid+"-"+rpis[key].latitude+"-"+rpis[key].longitude);

        var marker = L.marker([parseFloat(rpis[key].latitude), parseFloat(rpis[key].longitude)], {
            color: 'red'}).addTo(map);
        marker.bindPopup("<b>Hello "+rpis[key].ssid+"</b><br/><img width=100 src=./images/"+rpis[key].ssid+".jpg><br/><b>Description:</b><br/>"+rpis[key].description);
    }
}

//circle.bindPopup("I am a circle.");


</script>

<br/>
<br/>


</body>
</html>


