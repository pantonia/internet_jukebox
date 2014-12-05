// stupid_forum.php
<?php

$data = array();      // array to pass back data

$text1 = $_POST['simple_chat_text'];

file_put_contents('./simple_chat.txt', $text1, FILE_APPEND);

$data['success'] = true;
$data['message'] = 'Success!';

echo json_encode($data);

?>
