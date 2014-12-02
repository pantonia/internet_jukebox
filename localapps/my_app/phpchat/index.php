<?php
define("PHPCHAT","123flashchat");
include_once("theme/language/en/language.php");
include_once("includes/function_chat.php");
print_index();
check_install( $installing,$GET);
include_once('includes/foot.php');
?>