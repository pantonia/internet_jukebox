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

.poll-background-image,
.poll-background-image a,
.poll-background-image button {
	font-family: "Verdana", "Arial", "Helvetica", "serif";
}

.poll-background-image {
	letter-spacing:normal;
	line-height: normal;
	word-spacing: 0px;

	/*width:310px;*/
	padding:20px 20px;
	font-size:16px;
	color:white;

	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-khtml-border-radius: 10px;
	border-radius: 10px;
}

.poll-background-image .poll-form {
	margin:0;
}

.poll-background-image .poll-title {
	padding:0 10px;
	text-align:center;

	color:#ffe;
	font-weight:bold;
	font-size:18px;
	line-height:20px;
}

.poll-background-image .poll-table {
	margin:0 auto;

	border-collapse:separate;
	border-spacing: 5px 5px;
	border:0;
}

.poll-background-image .poll-table td {
	padding:0;
	font-size:16px;
	line-height:18px;
	color:white;
	*border:1px solid transparent;
}

.poll-background-image .poll-item {
}

.poll-background-image .poll-item input {
	margin: 0 3px 3px 0;
	vertical-align: middle;
}

.poll-background-image .poll-bar {
	display:none;
	width:0;
	height:6px;
	background-color:#ffe;

	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	-khtml-border-radius: 2px;
	border-radius: 2px;
}

.poll-background-image .poll-button {
	margin:0;
	font-size:20px;
	font-weight:bold;
	cursor:pointer;
}

.poll-background-image .poll-link:link,
.poll-background-image .poll-link:visited {
	cursor:pointer;
	color:white;
	font-size:12px;
	text-decoration:underline;
}

.poll-background-image .poll-link:hover,
.poll-background-image .poll-link:active {
	color:yellow;
}

.poll-background-image .poll-time-msg {
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
