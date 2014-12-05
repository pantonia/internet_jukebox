<!DOCTYPE html>
<html>
<head>
<title>Internet Jukebox</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="jukebox.css" media="screen" title="home">
<script>
if (!window.jQuery) {
        document.write('<script src="/js/jquery.min.js"><\/script>');
}
</script>
<script src="jukebox.js"></script>
</head>
<body>
<?php

$text1_text = file_get_contents('./forum/text1.txt', true);
$text2_text = file_get_contents('./forum/text2.txt', true);
$text3_text = file_get_contents('./forum/text3.txt', true);

$simple_chat_text = file_get_contents('./chat/simple_chat.txt', true);


$filename = "jukebox.config";
$lines = file($filename, FILE_IGNORE_NEW_LINES);
//print "<pre>";
//print_r($lines);
//print "</pre>";
$hosts_white = explode(" ", $lines[0]);
$hosts_black = explode(" ", $lines[1]);
$bw = explode(" ", $lines[2]);
$qt = explode(" ", $lines[3]);
$bw_limit = $bw[1];
$quota = $qt[1];

$host_white = explode(",", $hosts_white[1]);
$hosts_white_html = "";
foreach ($host_white as $a_host => $data)
{ 
    $h_name = explode(".", $data);
    $img_name = "./logos/".$h_name[0]."_logo.png";
    if (file_exists($img_name)) {
        $hosts_white_html .= "<a target=new_window href=\"http://www.$data\"><img width=100 src=$img_name></a>&nbsp;&nbsp;"; 
    }
    else {
    $hosts_white_html .= "<a target=new_window href=\"http://www.$data\">$h_name[0]</a>&nbsp;&nbsp;"; 
    }
}

$host_black = explode(",", $hosts_black[1]);
$hosts_black_html = "";
foreach ($host_black as $a_host => $data)
{ 
    $h_name = explode(".", $data);
    $img_name = "./logos/".$h_name[0]."_logo.png";
    if (file_exists($img_name)) {
        $hosts_black_html .= "<a valign=top target=new_window href=\"http://www.$data\"><img width=100 src=$img_name></a>&nbsp;&nbsp;"; 
    }
    else {
    $hosts_black_html .= "<a target=new_window href=\"http://www.$data\">$h_name[0]</a>&nbsp;&nbsp;"; 
    }
}

?>
<br/>
<br/>
<br/>
<div class=center>
    <h1>Welcome to the Internet Jukebox</h1>

    <div id='main_div'>

    <div id='main_all'>
    <table width=500>
    <tr>
    <td>Internet access<br><img src="./images/internet.jpg" width=200> </td>
    <td>File sharing<br><img src="./images/files.jpg" width=200> </td>
    </tr>
    <tr>
    <td>Jukebox<br><img src="./images/jukebox.png" width=150> </td>
    <td>Local applications<br><img src="./images/local.png" width=200> </td>
    </tr>
    </table>
    </div>
    <div id='main_internet'>
    White list
<p/>
    <textarea id="text1" name="text1" class="form-control" rows="10">
<?php echo $white_list?></textarea>
<p/>
    Black list
<p/>
    <textarea id="text1" name="text1" class="form-control" rows="10">
<?php echo $black_list?></textarea>
<p/>
    
    Quota (MB) per MAC address is: <input id="quota_MB" size="2" value="<?php echo $quota?>"</input>
<p/>

    Quota (sec) per MAC address is: <input id="quota_MB" size="5"><?php echo $quota?></input>
<p/>

    Maximum throughput is: <input id="quota_MB" size="5"><?php echo $quota?></input>
<p/>
    
    </div>

    </div>


    <br/>
    <br/>
    <h2>Internet access</h2>

    You can NOT access the following web sites:
    <br/>
    <br/>
<?php echo $hosts_black_html ?>
    <br/>
    <br/>

    <br/>
    <br/>

    <h2>Local content</h2>

    You can directly download/upload content to the local folder:
    <br/>
    <br/>
    <iframe align=center width="770" height="400" src="./dirlist/index.php"></iframe> 

    <br/>
    <br/>

    <h2>Message board</h2>

    Leave an anonymous message on our virtual message board (inspired by <a href="http://stupidforum.com">stupid forum</a>)
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


</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


