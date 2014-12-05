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
(function($){

//----------------------------------------------------------------
// CWaitIcon
//----------------------------------------------------------------
function CWaitIcon( url_img ) {
	var s = '';
	s += "<img ";
	s += "src='" + url_img + "'";
	s += ">";
	this.img = $( s );

	this.img.css({
		"position":"absolute",
		"left":"-10000px",
		"top":"-10000px"
	});

	this.img.hide();
	this.img.appendTo( $( 'body' ) );
}

CWaitIcon.prototype = {

	show : function( e ) {
		var _this = this;

		this.b_show = true;
		setTimeout(function(){
			if ( _this.b_show ) {
				var w = 32;
				var h = 32;
				_this.img
					.css({
						"left":(e.pageX - w/2) + "px",
						"top":(e.pageY - h/2) + "px"
					})
					.show();
			}
		},300);
	},

	hide : function() {
		this.b_show = false;
		this.img.hide();
	}
}

//----------------------------------------------------------------
// CApp
//----------------------------------------------------------------
var app_object_selector = '<?php echo $this->app_object_selector; ?>';
function CApp( jobj )
{
	this.children = [];

	this.jobj = jobj;
	this.tclass = this.getAttr( 'tclass', jobj );
	this.tid = this.getAttr( 'tid', jobj );
	this.url_app_entry = '<?php echo $this->url_app_entry; ?>';
	this.url_app_root = '<?php echo $this->url_app_root; ?>';
	this.url_app_img = '<?php echo $this->url_app_img; ?>';
	this.appid = this.makeRandomString( 64 );
	this.app_init_cmd = '<?php echo $this->app_init_cmd; ?>'; 
	this.wait_icon = new CWaitIcon( this.url_app_img + 'wait.gif' );
	this.tip_box = null;
	if ( this.app_init_cmd != '' )
	{
		this.send( { "cmd" : this.app_init_cmd } );
	}
}

CApp.prototype =
{
	showWaitIcon: function( e )
	{
		this.wait_icon.show( e );
	},

	showTipBox: function( obj, cfg, tbox ) {
		var _this = this;
		this.hideTipBox();

		period = ( "period" in cfg ) ? cfg["period"] : 2500;

		var tip_box;
		if ( typeof tbox === 'object' )
		{
			tip_box = tbox.clone();
		}
		else
		{
			txt = ( "txt" in cfg ) ? cfg["txt"] : "Saved！";
			bgcolor = ( "background-color" in cfg ) ? cfg["background-color"] : "#60a060";

			var s = '';
			s += "<span ";
			s += "style='";
			s += "text-align:center;";
			s += "padding:10px;";
			s += "margin:10px;";
			s += "font-size:22px;";
			s += "font-weight:bold;";
			s += "font-style:italic;";
			s += "font-family:times;";
			s += "color:#ffffff;";
			s += "background-color:" + bgcolor + ";";
			s += "border:3px solid #cfcfcf;";

			s += "-moz-border-radius: 15px;";
			s += "-webkit-border-radius: 15px;";
			s += "border-radius: 15px;";

			s += "-moz-box-shadow: 1px 1px 3px #000;";
			s += "-webkit-box-shadow: 1px 1px 3px #000;";
			s += "'>";
			s += txt;
			s += "</span>";
			tip_box = $( s );
		}

		tip_box.css({
			"position":"absolute",
			"left":"-10000px",
			"top":"-10000px"
		});

		tip_box.appendTo( $( 'body' ) );
		tip_box.show();

		wt = tip_box.outerWidth(false);
		ht = tip_box.outerHeight(true);

		var x = obj.offset().left;
		var y = obj.offset().top;
		var w = obj.width();
		var h = obj.height();

		var ytd = 10;
		var xt = x + w/2 - wt/2;
		var yt = y - ht;

		var xm = 0;
		var ym = 30;

		tip_box
			.css({
				"left":(xt - xm) + "px",
				"top":(yt - ym) + "px",
				"opacity":0
			})
			.animate({
				"left": "+=" + xm + "px",
				"top": "+=" + ym + "px",
				"opacity":"+=" + 1
			}, 300, function(){
				setTimeout(function(){
					tip_box.fadeOut( 500, function() {
						_this.hideTipBox();
					});
				},period);
			});

		this.tip_box = tip_box;
	},

	hideTipBox: function() {
		if ( this.tip_box != null ) {
			this.tip_box.hide();
			this.tip_box.remove();
			this.tip_box = null;
		}
	},

	//-----------------------------------------------
	// makeRandomString( n )
	//-----------------------------------------------
	makeRandomString : function ( n )
	{
		var s = "";
		var src = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		for( var i=0; i < n; i++ )
		{
			s += src.charAt( Math.floor( Math.random() * src.length ) );
		}
		return s;
	},

	//-----------------------------------------------
	// errBox
	//-----------------------------------------------
	errBox : function( data )
	{
		var errbox_sig = "<!--(ERRBOX)-->";
		if ( data.substring( 0, errbox_sig.length ) == errbox_sig )
		{// prevent double errbox
			return data;
		}
		else
		{
			var msg = '';
			msg += "<div style='padding:0px;border:1px solid red;";
			msg += "background-color:#fff0f0;'>";
			msg += "<div style='color:white;font-size:80%;font-weight:bold;";
			msg += "background-color:#ff0000;'>ERROR</div>";
			msg += "<div style='padding:10px;'>";
			msg += data;
			msg += "</div>";
			msg += "</div>";
			return msg;
		}
	},

	//-----------------------------------------------
	// getAttr
	//-----------------------------------------------
	getAttr : function( id_name, jobj )
	{
		if (
			( typeof( jobj.attr( id_name ) ) == 'undefined' ) || 
			( jobj.attr( id_name ) == '' ) // for Opera
		) return '';
		return jobj.attr( id_name );
	},

	//-----------------------------------------------
	// send
	//-----------------------------------------------
	send : function( json )
	{
		json['appid'] = this.appid;
		json['tclass'] = this.tclass;
		json['tid'] = this.tid;

		var _this = this;
		$.post( this.url_app_entry,
			json,
			function(data) {
				_this.process(data);
		});
	},

	//-----------------------------------------------
	// addChild
	//-----------------------------------------------
	addChild : function( child )
	{
		this.children[child.name] = child;
		return child;
	},

	//-----------------------------------------------
	// getChild
	//-----------------------------------------------
	getChild : function( name )
	{
		return this.children[name];
	},

	//-----------------------------------------------
	// sendMsg
	//-----------------------------------------------
	sendMsg : function( msg )
	{
		if ( typeof( msg.receiver ) !== 'undefined' )
		{
			if( Object.prototype.toString.call( msg.receiver ) === '[object Array]' )
			{
				for ( var i = 0; i < msg.receiver.length; i++ )
				{
					var ret = this.children[ msg.receiver[i] ].msgProc( msg );
					if ( ret != 0 ) return ret;
				}
			}
			else
			{
				return this.children[msg.receiver].msgProc( msg );
			}
		}
		else
		{
			for( name in this.children )
			{
				var ret = this.children[name].msgProc( msg );
				if ( ret != 0 ) return ret;
			}
		}
	},

	//-----------------------------------------------
	// process
	//-----------------------------------------------
	process : function( data )
	{
		this.wait_icon.hide();

		var b_evaled = false;
		try
		{
			this.res = eval('(' + data + ')');
			b_evaled = true;
		}
		catch(e)
		{
			var msg = "[ERROR]:" + "\r\n\r\n" + data.substring(0,1000);
			//alert( msg );
			this.jobj.html( this.errBox(data) );
		}

		try
		{
			if ( b_evaled )
			{
				if ( this.res.result == 'OK' )
				{
					window[this.appid] = this;
					switch( this.res.cmd )
					{
					case "alert":
						alert(this.res.html);
						break;
					case "load":
						this.jobj.append( this.res.html );
						break;
					}

					if ( typeof( this.res.msg ) !== 'undefined' )
					{
						this.sendMsg( this.res.msg );
					}
				}
				else
				{//-- code error
					alert( "^" + this.res.result );
					this.jobj.html( this.res.result );
				}
			}
		}
		catch(e)
		{
			var msg = "{ERROR}:" + e.message;
			alert( msg );
		}
	}
}

//----------------------------------------------------------------
// ready
//----------------------------------------------------------------
$(document).ready(function() {
	if (!( 'ajax-poll-script-9009' in window )) {
		window['ajax-poll-script-9009'] = true;
		$( app_object_selector ).each( function(){
			var app = new CApp( $(this) ); 
		});
	}
});

}(jQuery));
<?php /* -- END OF FILE -- */ ?>