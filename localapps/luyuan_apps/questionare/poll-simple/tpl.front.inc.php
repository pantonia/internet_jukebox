<?php $poll =& $this->poll; ?>
<?php include( "css/style.inc.php" ); ?>

<div class='poll-front poll-simple' style='display:none;'>

<form class='poll-form'>

<div class='poll-title'>
	<?php echo $poll->attr( "title" ); ?>
</div>

<!-- [BEGIN] Looping through all the items -->
<div style='margin:20px 0 30px 0'>
<table class='poll-table' border="0" cellpadding="0" cellspacing="0" width='100%'>
<?php foreach( $poll->getAllItems() as $item ) { ?>
<tr>
	<td class='ap-container' align='left'>
		<div class='poll-item'>
			<label style='cursor:pointer;'>
				<input type="<?php echo $poll->attr( "vote-input" ); ?>"
					name="answer"
					value="<?php echo $item->getName(); ?>" />
				<?php echo $item->getName(); ?>
			</label>
		</div>
	</td>
</tr>
<?php } ?>
</table>
</div>
<!-- [END] Looping through all the items -->

<?php if ( $poll->started() ): ?>
<!-- [BEGIN] Vote & View Buttons -->
<div style='text-align:center;margin:10px 10px;'>
	<button class="ap-vote poll-button">
	<?php echo $poll->attr( "msg-vote" ); ?></button>
	&nbsp;
	<button class="ap-result poll-button">
	<?php echo $poll->attr( "msg-view-result" ); ?></button>
</div>
<!-- [END] Vote & View Buttons -->
<?php else: ?>
<div class='poll-time-msg'>
	<?php echo $poll->attr( "msg-not-started" ); ?>
</div>
<?php endif; ?>

<?php if ( $poll->attr( "b-reset-block" ) ): ?>
<!-- [BEGIN] Reset Button -->
<div style='text-align:center;margin-top:10px;'>
<button class="ap-clear-block"><?php echo $poll->attr( "msg-reset-block" ); ?></button>
</div>
<!-- [END] Reset Button -->
<?php endif; ?>

<input type='hidden' name='msg-select-one' value='<?php echo $poll->attr( "msg-select-one" ); ?>' />
<input type='hidden' name='msg-already-voted' value='<?php echo $poll->attr( "msg-already-voted" ); ?>' />
<input type='hidden' name='tip-box-duration' value='<?php echo $poll->attr( "tip-box-duration" ); ?>' />
</form>

</div>
