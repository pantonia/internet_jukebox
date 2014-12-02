//
<?php



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
echo " . $ip ";
echo " . $mac";
//
////if mac couldn't be identified
if($mac == Null) {
echo "Error: Can't retrieve user's MAC address.";
}

if (($mac != Null) && ($ip != Null))
{

//unlock the mac address and grant access to internet
exec("sudo iptables -I internet 1 -t mangle -m mac --mac-source $mac -j RETURN");
exec("sudo iptables -I https 1 -t mangle -m mac --mac-source $mac -j RETURN");
echo "mac address unlocked";
}else{
echo "Access Denied";
exit;
}
?>
