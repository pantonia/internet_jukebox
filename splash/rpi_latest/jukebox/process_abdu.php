<?php
if(isset($_POST["ip"]) && isset($_POST["mac"])){
//echo "barseeeeeem";
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
?>
