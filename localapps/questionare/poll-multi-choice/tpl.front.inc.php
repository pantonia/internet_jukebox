<?php $poll =& $this->poll; ?>
<?php include( "css/style.inc.php" ); ?>

<div class='poll-front poll-multi-choice' style='display:none;'>

<form class='poll-form'>

<div class='poll-title'>
<?php echo $poll->attr( "title" ); ?>
</div>

<!-- [BEGIN] Looping through all the items -->
<div style='margin:20px 10px'>
<?php foreach( $poll->getAllItems() as $item ) { ?>
	<div class='ap-container poll-item'>
		<label style='cursor:pointer;'>
			<input type="<?php echo $poll->attr( "vote-input" ); ?>"
				name="answer"
				value="<?php echo $item->getName(); ?>" />
			<?php echo $item->getName(); ?>
		</label>
	</div>
<?php } ?>
</div>
<!-- [END] Looping through all the items -->

<?php if ( $poll->started() ): ?>
<!-- [BEGIN] Vote & View Buttons -->
<div style='text-align:center;margin:10px 10px;'>
	<button class="ap-vote poll-button">
		<?php echo $poll->attr( "msg-vote" ); ?>
	</button>
	&nbsp;&nbsp;
	<button class="ap-result poll-button">
		<?php echo $poll->attr( "msg-view-result" ); ?>
	</button>
</div>
<!-- [END] Vote & View Buttons -->
<?php else: ?>
<div class='poll-time-msg'>
	<?php echo $poll->attr( "msg-not-started" ); ?>
</div>
<?php endif; ?>

<?php if ( $poll->attr( "b-reset-block" ) ): ?>
<!-- [BEGIN] Reset Button -->
<div style='text-align:center;'>
<button class="ap-clear-block"><?php echo $poll->attr( "msg-reset-block" ); ?></button>
</div>
<!-- [END] Reset Button -->
<?php endif; ?>

<!-- [BEGIN] Mouse Over -->
<script>
(function($){
	$(document).ready(function() {
		$( '.poll-multi-choice .poll-item' ).mouseover( function() {
			$( this ).addClass( "poll-item-sel" );
		}).mouseout( function() {
			$( this ).removeClass( "poll-item-sel" );
		});
	});
}(jQuery));
</script>
<!-- [END] Mouse Over -->

<input type='hidden' name='msg-select-one' value='<?php echo $poll->attr( "msg-select-one" ); ?>' />
<input type='hidden' name='msg-already-voted' value='<?php echo $poll->attr( "msg-already-voted" ); ?>' />
<input type='hidden' name='tip-box-duration' value='<?php echo $poll->attr( "tip-box-duration" ); ?>' />
</form>

</div>
