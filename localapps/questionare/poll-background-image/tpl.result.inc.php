<?php $poll =& $this->poll; ?>
<?php include( "css/style.inc.php" ); ?>

<div class='poll-result poll-background-image' style='display:none;
	background-position:center center;
	background-image:url(<?php echo $poll->getFolderUrl(); ?>images/bg-result.jpg);'>

<form class='poll-form'>

<div class='poll-title'>
	<?php echo $poll->attr( "title" ); ?>
</div>

<!-- [BEGIN] Looping through all the items -->
<div style='margin:20px 0 0 0'>
<table class='poll-table' border="0" cellpadding="0" cellspacing="0" width='100%'>
<?php foreach( $poll->getAllItems() as $item ) { ?>
<tr>
	<td width='130' align='right'>
		<span <?php if ( $item->isVoted() ){ ?> style='color:red;' <?php } ?>>
		<?php echo $item->getName(); ?>
		</span>
	</td>
	<td align='left'>
		<div><div class='ap-bar poll-bar' ap-wratio='<?php echo $item->getWRatio(); ?>'></div></div>
	</td>
	<td width='40' align='right'><?php echo $item->getPercent(1); ?>%</td>
	<td width='30' align='right'><?php echo $item->getCount(); ?></td>
</tr>
<?php } ?>
</table>
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
//	echo "Error: Can't retrieve user's MAC address.";
//	exit;
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
<div style='text-align:right;margin:10px 0px;'>
	<span style='font-weight:bold;'>
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
<div style='text-align:left;margin:10px 10px;'>
	<a href='#' class="ap-front ap-ref-tipbox poll-link"><?php echo $poll->attr( "msg-return" ); ?></a>
</div>
<!-- [END] Back button -->
<?php endif; ?>

<input type='hidden' name='msg-thank-you' value='<?php echo $poll->attr( "msg-thank-you" ); ?>' />
</form>

</div>
