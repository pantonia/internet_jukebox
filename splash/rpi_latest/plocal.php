<?php

//$update = $_GET['update'];
//$text2_new = $_GET['text2'];
//$text3_new = $_GET['text3'];

//echo $text1_new.'-'.$text2_new.'-'.$text3_new;
//
//echo "UPDATE: ".$update;

$text1_text = file_get_contents('./forum/text1.txt', true);
$text2_text = file_get_contents('./forum/text2.txt', true);
$text3_text = file_get_contents('./forum/text3.txt', true);

?>

<h2>Message board</h2>

Leave an anonymous message on our virtual message board 
    <br/>
<div id="debugdiv"></div>
    <br/>

<form id="stupid_form" method="POST">
<textarea id="text1" name="text1" class="form-control" rows="10"><?php echo $text1_text?></textarea>
<textarea id="text2" name="text2" class="form-control" rows="10"><?php echo $text2_text?></textarea>
<textarea id="text3" name="text3" class="form-control" rows="10"><?php echo $text3_text?></textarea>
    <br/>
    <button type="submit" class="btn btn-primary">Save</button>
</form>



