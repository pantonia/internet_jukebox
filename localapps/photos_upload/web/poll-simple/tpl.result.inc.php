<?php $poll =& $this->poll; ?>
<?php include( "css/style.inc.php" ); ?>

<div class='poll-result poll-simple' style='display:none;>

<form class='poll-form'>

<div class='poll-title'>
	<?php echo $poll->attr( "title" ); ?>
</div>

<!-- [BEGIN] Looping through all the items -->
<div style='margin:20px 0 10px 0'>
<table class='poll-table' border='0' cellpadding="0" cellspacing="0" width='100%'>
<?php foreach( $poll->getAllItems() as $item ) { ?>
<tr>
	<td width='120' align='right'>
		<span <?php if ( $item->isVoted() ){ ?> style='font-weight:bold;' <?php } ?>>
		<?php echo $item->getName(); ?>
		</span>
	</td>
	<td align='left'>
		<div><div class='ap-bar poll-bar' ap-wratio='<?php echo $item->getWRatio(); ?>'></div></div>
	</td>
	<td width='40' align='right' ><?php echo $item->getPercent(1); ?>%</td>
	<td width='30' align='right'><?php echo $item->getCount(); ?></td>
</tr>
<?php } ?>
</table>
</div>
<!-- [END] Looping through all the items -->

<!-- [BEGIN] Show total vote counts -->
<div style='text-align:right;margin:0;'>
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
<div style='text-align:center;margin:0;'>
	<button class="ap-front ap-ref-tipbox poll-button">
		<?php echo $poll->attr( "msg-return" ); ?>
	</button>
</div>
<!-- [END] Back button -->
<?php endif; ?>

<input type='hidden' name='msg-thank-you' value='<?php echo $poll->attr( "msg-thank-you" ); ?>' />
</form>

</div>
