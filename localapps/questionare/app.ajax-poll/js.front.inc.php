<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajax Poll Script v3.02 [ GPL ]
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : APSMX-302
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<
?>
<script>
(function($){

//----------------------------------------------------------------
// CPage
//----------------------------------------------------------------
function CPage( app ) {
	this.name = "app.front";
	this.app = app;
	app.addChild( this );
	this.enabled = true;
	this.run();
}

CPage.prototype = {

	//-----------------------------------------------
	// hc_result
	//-----------------------------------------------
	hc_result : function( e ) {
		e.preventDefault();
		if ( this.enabled ) {
			this.enabled = false;
			this.app.showWaitIcon( e );
			this.app.send( { "cmd": "result" } );
		}
	},

	//-----------------------------------------------
	// hc_vote
	//-----------------------------------------------
	hc_vote : function( e, obj ) {
		e.preventDefault();

		this.vote_button_obj = obj;

		var answer = [];
		this.app.jobj.find( 'input[name="answer"]:checked').each( function(){
			answer.push( '"' + $(this).val().replace( '"', '\"') + '"' );
		});

		if ( answer.length > 0 ) {//-- send a vote
			answer = '[' + answer.join( "," ) + ']';
			this.app.showWaitIcon( e );
			this.app.send( { "cmd": "vote", "answer":answer } );
		} else {//-- show 'select one' message
			var orig = this.vote_button_obj;
			var cfg = { "period":this.tip_box_duration };
			var tbox = this.app.jobj.find( ".tip-box-select-one" );
			if ( tbox.length ) {
				this.app.showTipBox( orig, cfg, tbox );
			} else {
				var txt = this.app.jobj.find( 'input[name="msg-select-one"]').val();
				if ( typeof(txt) != 'undefined' ) {
					cfg["txt"] = txt;
					this.app.showTipBox( orig, cfg );
				}
			}
		}
	},

	//-----------------------------------------------
	// hc_clear_block
	//-----------------------------------------------
	hc_clear_block : function( e ) {
		e.preventDefault();
		this.app.send( { "cmd": "clear_block" } );
	},

	//-----------------------------------------------
	// run
	//-----------------------------------------------
	run : function() {
		var jqo = this.app.jobj.find( 'input[name="tip-box-duration"]').eq(0);
		this.tip_box_duration = ( jqo.length ? jqo.val() : 300 );

		this.app.jobj.find('.poll-front').show();

		var _this = this;

		//-- Set cursor to pointer
		this.app.jobj.find( ".ap-container" ).each( function() {
			$(this).css( "cursor", "pointer" );
		});

		//-- View button
		this.app.jobj.find( ".ap-result" ).click( function(e) {
			_this.app.hideTipBox();
			_this.hc_result( e );
		});

		//-- Vote button
		this.app.jobj.find( ".ap-vote" ).click( function(e) {
			_this.app.hideTipBox();
			_this.hc_vote( e, $(this) );
		});

		//-- Clear button
		this.app.jobj.find( ".ap-clear-block" ).click( function(e) {
			_this.app.hideTipBox();
			_this.hc_clear_block( e );
		});
	},

	//-----------------------------------------------
	// msgProc
	//-----------------------------------------------
	msgProc : function( msg ) {
		switch( msg.cmd ) {
		case "already_voted":
			var orig = this.vote_button_obj;
			var cfg = { "period":this.tip_box_duration, "background-color":"red" };
			var tbox = this.app.jobj.find( ".tip-box-already-voted" );
			if ( tbox.length ) {
				this.app.showTipBox( orig, cfg, tbox );
			} else {
				var txt = this.app.jobj.find( 'input[name="msg-already-voted"]').val();
				if ( typeof(txt) != 'undefined' ) {
					cfg["txt"] = txt;
					this.app.showTipBox( orig, cfg );
				}
			}

			return true;
		}

		return false;
	}
}

//----------------------------------------------------------------
// start-up
//----------------------------------------------------------------
var page = new CPage( window['<?php echo $this->appid; ?>'] ); 

}(jQuery));

</script>
<?php /* -- END OF FILE -- */ ?>
