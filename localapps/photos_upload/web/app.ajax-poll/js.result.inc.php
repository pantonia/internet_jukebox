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

	this.name = "app.result";
	this.app = app;
	app.addChild( this );
	this.front = app.getChild( "app.front" );
	this.run();
}

CPage.prototype = {

	//-----------------------------------------------
	// hc_front
	//-----------------------------------------------
	hc_front : function( e ) {
		e.preventDefault();

		var _this = this;
		this.front.enabled = true;

		this.app.jobj.find('.poll-result').hide();
		this.app.jobj.find('.poll-result').remove();
		this.app.jobj.find('.poll-front').show();
	},

	//-----------------------------------------------
	// run
	//-----------------------------------------------
	run : function() {
		var _this = this;

		this.app.jobj.find('.poll-front').hide();
		this.app.jobj.find('.poll-result').show();

		//-- Animate Bars
		var w100 = this.app.jobj.find( ".ap-bar" ).eq(0).parent().width();
		this.app.jobj.find( ".ap-bar" ).each( function() {
			var wratio = $(this).attr( 'ap-wratio' );
			var wpx = Math.floor(w100*wratio);
			$(this).css( 'width', 0 );
			$(this).show();
			$(this).animate({
				width: wpx
			}, 1000 );
		});

		//-- Back button
		this.app.jobj.find( ".ap-front" ).click( function(e) {
			_this.app.hideTipBox();
			_this.hc_front( e );
		});
	},

	//-----------------------------------------------
	// thankYou
	//-----------------------------------------------
	thankYou : function() {
		var orig = this.app.jobj.find( ".ap-ref-tipbox" );
		var cfg = { "period":this.front.tip_box_duration, "background-color":"#008000" };
		var tbox = this.app.jobj.find( ".tip-box-thank-you" );
		if ( tbox.length ) {
			this.app.showTipBox( orig, cfg, tbox );
		} else {
			var txt = this.app.jobj.find( 'input[name="msg-thank-you"]').val();
			if ( typeof(txt) != 'undefined' ) {
				cfg["txt"] = txt;
				this.app.showTipBox( orig, cfg );
			}
		}

		return true;
	},

	//-----------------------------------------------
	// msgProc
	//-----------------------------------------------
	msgProc : function( msg ) {
		switch( msg.cmd ) {
		case "thank_you":
			var _this = this;
			var f = function(){ _this.thankYou(); };
			setTimeout( f, 1000 );
			return 1;
		}

		return 0;
	}
}

//----------------------------------------------------------------
// main
//----------------------------------------------------------------
var page = new CPage( window['<?php echo $this->appid; ?>'] ); 

}(jQuery));

</script>
<?php /* -- END OF FILE -- */ ?>