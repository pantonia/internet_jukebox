<?php include("lp_source.php"); ?>

<?php
$videosDB= "videosDB.txt";
$vidrecords=file($videosDB);
$videos_url = "";

//here trying html link with id and get variables

//$urltest = <a href="#c4?link=1"> This is the first video </a>

//if(isset($_GET["link"]) && $_GET["link"] == "1"){
//echo "video 1 is clicked";
//}else{
//echo "video is not clicked";
//}

//foreach ($vidrecords as $rec)
//{
  //  $linenospace= explode(" ", $rec);
    //echo $linenospace[1]. "\n";
   // $pic_name= "./vid_logos/".$linenospace[1]."_logo.png";
    
   // $videos_html .= "<a target=new_window href=\"http://jukebox/"
//}


//echo("".$bw_limit."kbps");

//echo "<h1>IP/MAC ADDRESS</h1>";

//****************************************//
//Here we capture the ip address of the connected user to extract his mac address which help us to define users accessing our service

$ip  = $_SERVER["REMOTE_ADDR"];
////this is the path to the arp command used to get user MAC address from
////its IP address in linux
//
$arp="/usr/sbin/arp";
//
////execute the arp command to get the mac address of the user connecting
//

// ***** commented as this version is a local host for the voting system. uncomment it back when you work again on the Raspberry
//$mac= shell_exec("sudo $arp -an " . $ip);
//preg_match('/..:..:..:..:..:../',$mac, $matches);
//$mac =@$matches[0];
//echo " . $ip ";
//echo " . $mac";
//
////if mac couldn't be identified
//if($mac == Null) {
//echo "Error: Can't retrieve user's MAC address.";
//exit;/
//}


//if(isset($_POST["ip"]) && isset($_POST["mac"]))
//if(($mac != Null) && ($ip != Null))
//{
//echo "ip && mac .. correct";
//$ip = $_POST['ip'];
//$mac = $_POST['mac'];

 //echo $mac;
 
 
//unlock that mac address and grant access to internet (bypass redirecting rules)
//exec("sudo iptables -I internet 1 -t mangle -m mac --mac-source $mac -j RETURN");
//exec("sudo iptables -t nat -I PREROUTING -p tcp -m mac --mac-source $mac --dport 80 -j DNAT --to-destination 10.0.0.1:3128");
//uncomment the previous two lines to prevent a user to be directed again to the captive portal


//Testing insertions and queries to and from the DB (users.txt)
//$usersDB= "userDB.txt";
//user record is mac_address + Qouta + video_id + Donation + time_of_vote
//$quota=250;
//$video_id=3;
//$donation=30;
//$vote_time="12:14"

//$user_record= $mac . " " . $quota . "MB" . " " . $video_id . " " . $donation . "MB" . "\n";
//file_put_contents($usersDB, $user_record , FILE_APPEND | LOCK_EX);



//echo "User logged in.";
//exit;

//}else{
//echo "Access Denied";
//exit;
//}

//previous else part should be uncommented if you want to include mac addresses retrieval.. now i commented all to work on the voting system

?>
	
<table border="0">
<tr><td align=left></td></tr><tr>
<td align=left>	
<?php if($votingstep==1) { echo($step1str); }
if($votingstep==2) { echo($step2str); }
if($votingstep==3) { echo($step3str); }
?>
</td></tr>
</table>
	

