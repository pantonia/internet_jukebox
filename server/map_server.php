
<?php

$raspberry_file = "raspberry_pis.txt";
$raspberries = json_decode(file_get_contents($raspberry_file), true);

//print_r ($raspberries);


if ($_GET['q'])
{
    $new_raspberry = $_GET['q'];
    $new_ssid = $_GET['ssid'];
    $new_desc = $_GET['desc'];
    $new_activity = $_GET['activity'];

    $raspberries[$new_raspberry] = array("ssid" => $new_ssid,"description" => $new_desc, "activity"=>$new_activity);

//print_r ($raspberries);

file_put_contents($raspberry_file, json_encode($raspberries));

$curl_url = 'http://internet-jukebox.org/server/map_server.php?q='.$new_raspberry.'&ssid='.$new_ssid.        '&desc='.$new_desc.'&activity='.$new_activity;

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
print_r($resp);

if(!$resp){
        echo 'Error: '.curl_error($curl); 
}

//var_dump(curl_getinfo($curl));

curl_close($curl);

}


?>

