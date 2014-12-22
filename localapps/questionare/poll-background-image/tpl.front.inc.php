<?php $poll =& $this->poll; ?>
<?php include( "css/style.inc.php" ); ?>

<div class='poll-front poll-background-image' style='display:none;
	background-position:center center;
	background-image:url(<?php echo $poll->getFolderUrl(); ?>images/bg-front.jpg);'>

<form class='poll-form'>

<div class='poll-title'>
	<?php echo $poll->attr( "title" ); ?>
</div>

<!-- [BEGIN] Looping through all the items -->
<div style='margin:20px 0 0 0'>
<table class='poll-table' border="0" cellpadding="0" cellspacing="0" style='width:auto;'>
<?php foreach( $poll->getAllItems() as $item ) { ?>
<tr>
	<td class='ap-container' align='left'>
		<div class='poll-item'>
			<label style='cursor:pointer;'>
				<input type="<?php echo $poll->attr( "vote-input" ); ?>"
					name="answer"
					value="<?php echo $item->getName(); ?>"　/>
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
<div style='text-align:center;margin:10px 0;'>
	<div id='blinking-vote-button'
		class="ap-vote poll-button"
	><?php echo $poll->attr( "msg-vote" ); ?></div>
</div>

<div style='text-align:left;margin:10px 10px;'>
	<a href='#' class="ap-result poll-link"><?php echo $poll->attr( "msg-view-result" ); ?></a>
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

<!-- [BEGIN] Blink Vote Button -->
<script>
(function($){
	function run() {
		var obj = $('#blinking-vote-button');
		obj.fadeTo( 500, 1.0, function() {
			obj.fadeTo( 500, 0.0, function() {
				window.setTimeout(run, 1);
			});
		});
	}
	$(document).ready(function() {
		run();
	});
})(jQuery);
</script>
<!-- [END] Blink Vote Button -->

<input type='hidden' name='msg-select-one' value='<?php echo $poll->attr( "msg-select-one" ); ?>' />
<input type='hidden' name='msg-already-voted' value='<?php echo $poll->attr( "msg-already-voted" ); ?>' />
<input type='hidden' name='tip-box-duration' value='<?php echo $poll->attr( "tip-box-duration" ); ?>' />
</form>

</div>

<!-- [BEGIN] preload background on the result page -->
<script>
	setTimeout(function(){
		if (document.images) {
			img1 = new Image();
			img1.src = "<?php echo $poll->getFolderUrl(); ?>images/bg-result.jpg";
		}
	},300);
</script>
<!-- [END] preload background on the result page -->

