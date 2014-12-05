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



//traffic shaping rules according to config files
// the following two commands sets the default policy on wlan0 to shape everyone's download speed to 64kbyte/s

//exec("sudo tc qdisc add dev wlan0 root handle 1:0 htb default 10");
//echo("".$bw_limit."kbps");
//exec("sudo tc class add dev wlan0 parent 1:0 classid 1:10 htb rate 64Kbps ceil 64kbps prio 0");

//next, we set up another class to shape certain addresses to a higher speed, we also need to setup a filter so that any packets marked as such go through this rule
//exec("sudo tc class add dev wlan0 parent 1:1 classid 1:5 htb rate 256kbps ceil 256kbps prio 1");
//exec("sudo tc filter add dev wlan0 parent 1:0 prio 1 handle 5 fw flowid 1:5");

//exec("sudo iptables -t mangle -N shapeout");
//exec("sudo iptables -t mangle -N shapein");

//exec("sudo iptables -t mangle -I POSTROUTING -o wlan0 -j shapein");
//exec("sudo iptables -t mangle -I PREROUTING -i wlan0 -j shapeout");
//exec("sudo iptables -t mangle -I PREROUTING -i eth0 -j shapein");
//exec("sudo iptables -t mangle -I POSTROUTING -o eth0 -j shapeout");

//exec("sudo iptables -t mangle -A shapeout -s 10.0.0.0/24 -j MARK --set-mark 1");
//exec("sudo iptables -t mangle -A shapein -d 10.0.0.0/24 -j MARK --set-mark 1");
//exec("sudo iptables -t mangle -A shapeout -s 10.0.0.5 -j MARK --set-mark 5");
//exec("sudo iptables -t mangle -A shapein -d 10.0.0.5 -j MARK --set-mark 5");

//echo ("after shaping rules ..");

//now we need to setup iptable rules to mark specific packets we want to shape as such . (I added thoses rues to a shaper script that boots automatically


//echo "<h1>IP/MAC ADDRESS</h1>";
//capture their ip address
$ip  = $_SERVER["REMOTE_ADDR"];
////this is the path to the arp command used to get user MAC address from
////its IP address in linux
//
$arp="/usr/sbin/arp";
//
////execute the arp command to get the mac address of the user connecting
//
$mac= shell_exec("sudo $arp -an " . $ip);
preg_match('/..:..:..:..:..:../',$mac, $matches);
$mac =@$matches[0];
//echo " . $ip ";
//echo " . $mac";
//
////if mac couldn't be identified
if($mac == Null) {
//echo "Error: Can't retrieve user's MAC address.";
}


?>
<br/>
<br/>
<br/>
<div class=center>
    <h1>Welcome to the Internet Jukebox</h1>

    <img src="jukebox.png" width=200 align=right>

    The Internet Jukebox offers you (limited) access to the Internet, but most importantly
    you can browse and contribute to an offline repository of content created by all those 
    connected to this specific Jukebox, in this specific location, since January 12th, 2014.

    <br/>
    <br/>
    <h2>Internet access</h2>

    You can NOT access the following web sites:
    <br/>
    <br/>
<?php echo $hosts_black_html ?>
    <br/>
    <br/>
    Your quota is set to: <strong><?php echo $quota?></strong>

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


