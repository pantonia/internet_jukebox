<!DOCTYPE html>
<html>
<head>
<title>HAVE A NICE CHATTING TIME</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<body>

<?php

$name=$_POST["name"];
echo "Welcome<br>";
echo $name;
echo "<br>HAVE A NICE CHATTING TIME<br>";

$message ="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if (empty($_POST["message"])) {
           $message = "";
        } else {
           $message =test_input($_POST["message"]);
        }
}

function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<br>
message: <textarea name="message" rows="5" cols="40"><?php echo $message."\n";?></textarea>
<br>
<input type="submit" name="submit" value="Submit"> 
</form>

</body>
</html>


