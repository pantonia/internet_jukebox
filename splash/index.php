<!DOCTYPE html>
<html>
<head>
<title>Internet Jukebox</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="jukebox.css" media="screen" title="home">
</head>
<body>
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
foreach ($host_white as $a_host => $data)
{ 
    $h_name = explode(".", $data);
    $img_name = $h_name[0]."_logo.png";
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
    $img_name = $h_name[0]."_logo.png";
    if (file_exists($img_name)) {
        $hosts_black_html .= "<a valign=top target=new_window href=\"http://www.$data\"><img width=100 src=$img_name></a>&nbsp;&nbsp;"; 
    }
    else {
    $hosts_black_html .= "<a target=new_window href=\"http://www.$data\">$h_name[0]</a>&nbsp;&nbsp;"; 
    }
}


echo "<h1>IP/MAC ADDRESS</h1>";
//capture their ip address
$ip  = $_SERVER["REMOTE_ADDR"];
////this is the path to the arp command used to get user MAC address from
////its IP address in linux
//
$arp="/usr/sbin/arp";
//
////execute the arp command to get the mac address of the user connecting
//
//$mac= shell_exec("sudo $arp -an " . $ip);
//preg_match('/..:..:..:..:..:../',$mac, $matches);
//$mac =@$matches[0];
echo " . $ip ";
//echo " . $mac";
//
////if mac couldn't be identified
//if($mac == Null) {
//echo "Error: Can't retrieve user's MAC address.";
//exit;
//}


/*
if(isset($_POST["ip"]) && isset($_POST["mac"])){
    echo "barseeeeeem";
    $ip = $_POST['ip'];
    $mac = $_POST['mac'];
    //echo $ip;
    //echo $mac;
    
   exec("sudo iptables -I internet 1 -t mangle -m mac --mac-source $mac -j RETURN");
    
   echo "User logged in.";
   exit;
   
   }else{
    echo "Access Denied";
    exit;
   }
 */


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
    You can access the following web sites (and many more): 
    <br/>
<?php echo $hosts_white_html ?>
    <br/>
    <br/>
    Your maximum throughput is set to: <strong><?php echo $bw_limit?></strong>

    <br/>
    <br/>
    Your quota is set to: <strong><?php echo $quota?></strong>

    <br/>
    <br/>

    <h2>Local content</h2>

    You can directly download the following content:

    <table class="table table-hover">
    <thead>
        <tr><th>Name</th><th>Description</th><th>Source</th></tr>
    </thead/>
    <tbody>
        <tr><td>test</tf><td>test</td><td>youtube</td></tr>
        <tr><td>test</tf><td>test</td><td>youtube</td></tr>
        <tr><td>test</tf><td>test</td><td>youtube</td></tr>
    </tbody>
    </table>

    <h4>Contribute a file:</h4>
    <input type="file" id="exampleInputFile">
    <br/>
    <br/>
    <button type="submit" class="btn btn-primary">Submit</button>

    <br/>
    <br/>
    <h2>Message board</h2>

    Leave an anonymous message on our virtual message board
    <br/>
    <br/>

    <textarea class="form-control" rows="10"></textarea>
    <textarea class="form-control" rows="10"></textarea>
    <br/>
    <textarea class="form-control" rows="10"></textarea>
    <textarea class="form-control" rows="10"></textarea>
    <br/>
    <button type="submit" class="btn btn-primary">Save</button>


</div>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


