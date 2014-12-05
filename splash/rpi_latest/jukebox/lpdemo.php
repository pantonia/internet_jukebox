<?php
include("lp_source.php");
?>
<html><head><title>Amazing Little Poll - simple php freeware voting poll</title></head>
	
<style type="text/css">
	
<!--
body {font-family: verdana, non-serif; font-size: 10pt; color: 0A2FA1;}
.banner {
	font-family: verdana, non-serif;
	font-size: medium;
	color: 0A2FA1;
	background: EDEDED;
	margin-bottom: 10px;
	padding: 2,4,2,4 }

.text {
	margin-bottom: 8px;
	margin-left: 20px;
	font-size: 12px;
}

.subhead {
	margin-left: 20px;
	font-size: 12px;
	font-weight: bold;
	margin-bottom: 5px;
	margin-top: 15px;
	color: 818181;
}

.pic {
	 margin-left: 50px;
 }
 
 a {
	 text-decoration: none;
	 font-size: 12px;
	 color: 0F48ED;
 }
 
 a:hover {
	 text-decoration: underline;
 }
 
 -->
</style>

<body>
	
<center>

<br>
<table width="600" border="0"><tr><td align=right>
<img class="pic" src="lp_logo.gif" >
</td></tr><tr><td align=right>	

</td></tr><tr><td>

<div class="subhead"><?php echo($mainstr); ?></div>

<div class="text"><?php echo($question); ?>
</div>

<div class="text"><?php if($votingstep==1) { echo($step1str); }
			if($votingstep==2) { echo($step2str); }
			if($votingstep==3) { echo($step3str); }
			?>
</div>

<div class="text">Number of votes: <?php echo($totalvotes); ?>
</div>

<div class="text"><a href="lprecookie.php">Reset cookie</a>
</div>

</td></tr>


</table></center>
</body></html>
