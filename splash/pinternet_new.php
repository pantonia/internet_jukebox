<?php

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
$count=0;
foreach ($host_white as $a_host => $data)
{ 
    $count = $count + 1;
    $h_name = explode(".", $data);
    $img_name = "./logos/".$h_name[0]."_logo.png";
    if (file_exists($img_name)) {
        $hosts_white_html .= "<a target=new_window href=\"http://www.$data\"><img width=100 src=$img_name></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
    if ($count % 2 == 0) $hosts_white_html .="<br/><br/>";
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


?>
<div id='main_internet'>

<form action="" method="POST">

<table>
<tr><td valign=top align=center>
<h3>Accessible sites</h3>
<br/>
<br/>
<?php echo $hosts_white_html ?>
&nbsp;
&nbsp;
<br/>
<br/>
</td>
<td valign=top align=left>
<h3>Limits</h3>
<br/>
<br/>
    Maximum &nbsp;&nbsp;data: <b><?php echo $quota?> MB</b> 
<br/>
<br/>
    Maximum speed: <b><?php echo $bw_limit?> Kbps</b>
<br/>
<br/>
    Download deadline: 
    <input type="text" name="deadline" value="<?php $deadline_text?>"></input>
<br/>
<br/>
</td></tr></table>

<button type="submit" class="btn btn-primary">Edit</button>
</form>
</div>

