<!DOCTYPE html>
<html>
<body>

<?php

//Uploading the raspberry pi into the folder.
$target_dir = "image/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo "$target_file";
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
//    header("Refresh:0; url=../photos.php");
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    echo "Or your device has assigned the same name for your photos."
    echo "Please check your device."
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo "<br>";
        echo "If you would like to see the photo uploaded by you";
        echo "<br>";
        echo "Then go back to  the page and click the button 'view image uploaded' below.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//The file for storing the registered raspberry pi
$raspberry_file = "raspberry_pis.txt";

//Basic information of the raspberry pi
$new_id=$_POST["id"];
$new_ssid=$_POST["ssid"];
$new_lat=$_POST["latitude"];
$new_long=$_POST["longitude"];
$new_desc=$_POST["description"];
$new_photo=$_POST["fileToUpload"];

//Store the basic informatio of the raspberry pi in a array.
$raspberries[] = array("id"=>$new_id,"ssid"=>$new_ssid,"latitude"=>$new_lat, "longitude"=>$new_long, "description" => $new_desc, "new_photo"=>$new_photo); 

//Put this array using encode to the file storing the information of the raspberry pi.
file_put_contents($raspberry_file, json_encode($raspberries));

?>

</body>
</html>
