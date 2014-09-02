// stupid_forum.php
<?php

$data = array();      // array to pass back data

file_put_contents('./panos.txt', 'test');

$text1 = $_POST['text1'];
$text2 = $_POST['text2'];
$text3 = $_POST['text3'];

file_put_contents('./text1.txt', $text1);
file_put_contents('./text2.txt', $text2);
file_put_contents('./text3.txt', $text3);

$data['success'] = true;
$data['message'] = 'Success!';

echo json_encode($data);

?>
