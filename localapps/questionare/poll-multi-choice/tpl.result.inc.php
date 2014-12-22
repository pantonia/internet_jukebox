<?php $poll =& $this->poll; ?>
<?php include( "css/style.inc.php" ); ?>

<div class='poll-result poll-multi-choice' style='display:none;'>

<form class='poll-form'>

<div class='poll-title'>
	<?php echo $poll->attr( "title" ); ?>
</div>

<!-- [BEGIN] Looping through all the items -->
<div style='margin:20px 10px'>
<?php foreach( $poll->getAllItems() as $item ) { ?>
<div class='poll-item' style='padding-bottom:10px;'>
	<div style='margin:3px 0;'>
		<?php echo $item->getName(); ?>:
		<span><?php echo $item->getPercent(); ?>%</span>
		<span><?php echo $item->getCount(); ?></span>
		<?php if ( $item->isVoted() ): ?>
			<span style='color:red;'>«««</span>
		<?php endif; ?>
	</div>
	<div class='ap-bar poll-bar' ap-wratio='<?php echo $item->getWRatio(); ?>'></div>
</div>
<?php } ?>
</div>
<!-- [END] Looping through all the items -->

<?php
//capture their ip address
$ip  = $_SERVER["REMOTE_ADDR"];
//this is the path to the arp command used to get user MAC address from
//its IP address in linux

$arp="/usr/sbin/arp";

//execute the arp command to get the mac address of the user connecting

$mac= shell_exec("sudo $arp -an " . $ip);
preg_match('/..:..:..:..:..:../',$mac, $matches);
$mac =@$matches[0];

//if mac couldn't be identified
//if($mac == Null) {
//echo "Error: Can't retrieve user's MAC address.";
//exit;
//}

//Get what this user vote

$answer = $poll->getVote();

$myFile = "/Library/WebServer/Documents/questionare/app.data/sendServer.txt";
$fh = fopen($myFile, "a");

$input=json_encode(array('user' => $mac, 'vote' => $answer));
fwrite($fh, $input);

fclose($fh);
?>

<!-- [BEGIN] Show total vote counts -->
<div style='text-align:center;margin:10px 10px;'>
	<span style='color:white;font-weight:bold;font-size:16px;'>
		<?php echo $poll->attr( "msg-total" ); ?>
		<?php echo $poll->getTotal(); ?>
	</span>
</div>
<!-- [END] Show total vote counts -->

<?php if ( $poll->ended() ): ?>
<div class='poll-time-msg'>
	<?php echo $poll->attr( "msg-ended" ); ?>
</div>
<?php else: ?>
<!-- [BEGIN] Back button -->
<div style='text-align:center;margin:10px 10px;'>
	<button class="ap-front ap-ref-tipbox poll-button">
		<?php echo $poll->attr( "msg-return" ); ?>
	</button>
</div>
<!-- [END] Back button -->
<?php endif; ?>

<input type='hidden' name='msg-thank-you' value='<?php echo $poll->attr( "msg-thank-you" ); ?>' />
</form>

</div>

