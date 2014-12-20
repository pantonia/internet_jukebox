<!DOCTYPE html>
<html>
<body>

<form align = "center" action="register_rpi.php" method="post">
ID: <input type="text" name="id"><br>
SSID: <input type="text" name="ssid"><br>
Description: <input type="text" name="description"><br>
Latitude: <input type="text" name="latitude"><br>
Longtitude: <input type="text" name="longtitude"><br>
<input type="submit" value="Add this Raspberry Pi">
</form>


<form align = "center" action="register_rpi" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">     
</form>

<div align = "center" style = "font-size:13px; font-weight: bold">
	<br>
	<?php echo "Note: Please insert ID as Rpi_1, Rpi_2,.......as administrator";?>
</div>



</body>
</html>
