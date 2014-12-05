<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
  <?php 
    if (isset($_GET['album'])) {
	  echo $_GET['album'];
	} else {
	  echo 'Photo Gallery';
	}
  ?>
</title>

<!-- start gallery header --> 
<link rel="stylesheet" type="text/css" href="folio-gallery.css" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="colorbox/colorbox.css" />
<!--<link rel="stylesheet" type="text/css" href="fancybox/fancybox.css" />-->
<script type="text/javascript" src="colorbox/jquery.colorbox-min.js"></script>
<!--<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.1.min.js"></script>-->
<script type="text/javascript">
$(document).ready(function() {	
	
	// colorbox settings
	$(".albumpix").colorbox({rel:'albumpix'});
	
	// fancy box settings
	/*
	$("a.albumpix").fancybox({
		'autoScale	'		: true, 
		'hideOnOverlayClick': true,
		'hideOnContentClick': true
	});
	*/
});
</script>
<!-- end gallery header -->
</head>
<body>

<div align = "center" style = "font-size:15px; font-weight: bold">
	<br>
       <?php echo "Welcome to Photo Sharing and Free Chatting";?>
</div>

<div align="center" style="font-size:13px;font-weight:bold;">
	<br>
	<a href="http://localhost/my_app">&laquo; Back to HomePages.com</a>
</div>

<p>&nbsp;</p>

<div align="center" style="font-size:9px;font-weight:bold;font-style:italic">
	<p> If you would like to comment a photo, please click the photo and choose comment </p>
	<p> If you would like to download a photo, please click the photo and choose download </p>
	<p> If you would like to upload a photo, please choose one of your photos and upload </p>
</div>

<div class="gallery">  
  <?php include "folio-gallery.php"; ?>
</div>   

<form align = "center" action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">     
</form>

<div align = "center" style = "font-size:13px; font-weight: bold">
	<br>
	<?php echo "If you would like to leave a message, please write it on this board";?>
</div>

<form align="center" method="POST">
<textarea id="text1" name="text1" class="form-control" rows="10"><?php echo $text1_text?></textarea>
<textarea id="text2" name="text2" class="form-control" rows="10"><?php echo $text2_text?></textarea>
<textarea id="text3" name="text3" class="form-control" rows="10"><?php echo $text3_text?></textarea>
    <br/>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

</body>
</html>
