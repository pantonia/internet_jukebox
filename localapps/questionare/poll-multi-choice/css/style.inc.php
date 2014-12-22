<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajax Poll Script v3.02 [ GPL ]
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : APSMX-302
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

//----------------------------------------------------------------
// <style>
//----------------------------------------------------------------
$style=<<<_EOM_
<style>

.poll-multi-choice,
.poll-multi-choice button {
	font-family: "Verdana", "Arial", "Helvetica", "serif";
}

.poll-multi-choice {
	letter-spacing:normal;
	line-height: normal;
	word-spacing: 0px;

	margin:0;
	padding:20px;

	color:white;
	text-align:left;

	-moz-box-shadow:    3px 3px 5px 2px #ccc;
	-webkit-box-shadow: 3px 3px 5px 2px #ccc;
	box-shadow:         3px 3px 5px 2px #ccc;

	border:0;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-khtml-border-radius: 10px;
	border-radius: 10px;

	/* for webkit browsers */
	background: -webkit-gradient(linear, left top, left bottom, from(#265AC5), to(#5DBBFC)); 
	/* for firefox 3.6+ */
	background: -moz-linear-gradient(top,  #265AC5,  #5DBBFC); 
	/* for IE */
	background: -ms-linear-gradient(top,  #265AC5, #5DBBFC);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#265AC5', endColorstr='#5DBBFC'); 
	/* for opera */
	background-image: -o-linear-gradient(-90deg, #265AC5, #5DBBFC);
	/* catch all */
	background-color:#265AC5;
}

.poll-multi-choice .poll-title {
	padding:0 10px;
	text-align:center;

	color:white;
	font-weight:bold;
	font-size:18px;
	line-height:20px;
}

.poll-multi-choice .poll-bar {
	display:none;
	width:0;
	height:6px;
	background-color:#ffc;

	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	-khtml-border-radius: 2px;
	border-radius: 2px;
}

.poll-multi-choice .poll-button {
	cursor:pointer;
	color:white;
	border:0;
	margin:0;
	padding:10px;
	width:130px;

	-moz-box-shadow: rgba(0, 0, 0, 0.277344) 0px 0px 13px 2px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.277344) 0px 0px 13px 2px;
	box-shadow: rgba(0, 0, 0, 0.277344) 0px 0px 13px 2px;

	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-khtml-border-radius: 10px;
	border-radius: 10px;

	/* for webkit browsers */
	background: -webkit-gradient(linear, left top, left bottom, from(#265AC5), to(#5DBBFC)); 
	/* for firefox 3.6+ */
	background: -moz-linear-gradient(top,  #265AC5,  #5DBBFC); 
	/* for IE */
	background: -ms-linear-gradient(top,  #265AC5, #5DBBFC);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#265AC5', endColorstr='#5DBBFC'); 
	/* for opera */
	background-image: -o-linear-gradient(-90deg, #265AC5, #5DBBFC);
	/* catch all */
	background-color:#265AC5;
}

.poll-multi-choice .poll-item {
	border:0;
	margin:0;
	padding:0;

	color:white;
	font-size:16px;
	line-height:20px;
}

.poll-multi-choice .poll-item input {
	margin-top: -1px;
	vertical-align: middle;
}

.poll-multi-choice .poll-item-sel {

	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-khtml-border-radius: 10px;
	border-radius: 10px;

	/* for webkit browsers */
	background: -webkit-gradient(linear, left top, left bottom, from(#265AC5), to(#5DBBFC)); 
	/* for firefox 3.6+ */
	background: -moz-linear-gradient(top,  #265AC5,  #5DBBFC); 
	/* for IE */
	background: -ms-linear-gradient(top,  #265AC5, #5DBBFC);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#265AC5', endColorstr='#5DBBFC'); 
	/* for opera */
	background-image: -o-linear-gradient(-90deg, #265AC5, #5DBBFC);
	/* catch all */
	background-color:#265AC5;
}

.poll-multi-choice .poll-time-msg {
	color:yellow;
	text-align:center;
	font-weight:bold;
	margin:10px;
	padding:3px 0;

	border:1px solid yellow;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
}
</style>
_EOM_;
$this->addStyle($style);
?>