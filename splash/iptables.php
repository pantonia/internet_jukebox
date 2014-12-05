//
<?php
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
