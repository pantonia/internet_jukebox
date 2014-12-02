<?php include("lp_settings.php"); ?>

<html>

<head>

<title>Juke Box Admin Control</title>

<basefont size="2" face="Verdana">

</head>



<body bgcolor="#ADD8E6" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF">

<center>

<br>

<h1>Access as an Adminstrator to configure the voting options</h1>

<br>

<br>

<?php



function getIP() {

	if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");

	else if(getenv("HTTP_X_FORWARDED_FOR")) $ip = getenv("HTTP_X_FORWARDED_FOR");

	else if(getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR");

	else $ip = "UNKNOWN";

return $ip;

}



function write2log ($linetoadd) {

	$rightnow=date("F j, Y, g:i a");

	$fplog=fopen('lp_log.dat', "a");

	fputs($fplog, getIP()."|".$rightnow."|".$linetoadd."\n");

	fclose($fplog);

}



foreach( $_POST as $key => $value ) {
     
     $new_name = "p_".$key;
     $$new_name = $value;
     
}



if (!isset($p_adminstep)) {

	$adminstep=0;

	} else { $adminstep = $p_adminstep; }



if ($adminstep==0) {

	write2log("Enters admincenter");

	$adminstep0str='<form action="lp_admin.php" method="post" name="form0">Admin Password:<input type="hidden" name="adminstep" value="'.($adminstep+1).'"><input type="Password" name="pwd" size="20"><br><input type="Submit" value="OK"></form>';

}









if ($adminstep==1) {

	if ($p_pwd == $pwd) {

	$adminstep1str='<form action="lp_admin.php" method="post" name="form1">Number of Items:<input type="hidden" name="adminstep" value="'.($adminstep+1).'"><input type="Text" name="numofitems" size="5"><br>Voting Title/Question:&nbsp&nbsp&nbsp&nbsp&nbsp<input type="Text" name="question" size="25"><br><input type="Submit" value="OK"></form>';

	}

else {

	$adminstep1str='Wrong Password, try again...<br><br><a href="lp_admin.php">Back</a>';

	write2log("WRONG PASSWORD ENTERED IN ADMINCENTER");

	}



}



if($adminstep==2) :

	$adminstep2str='<form action="lp_admin.php" method="post" name="form2"><input type="hidden" name="question" value="'.$p_question.'"><input type="hidden" name="adminstep" value="'.($adminstep+1).'">';

	if (isset($p_numofitems)) {

		$hector=$p_numofitems+0;

		if($p_numofitems<=0) {

			$adminstep=0;

			$errtext="The number of items should be an integer, above zero";

			$hector=-1;

		}

	}



	$in=0;

	while($hector > 0) {

		$adminstep2str=$adminstep2str.'Item '.($in+1).'<br>Description:<input type="Text" size="25" name="item['.$in.']"><br>Small Pic: <input type="Text" size="25" name="smallpic['.$in.']"><br>Big Pic:<input type="Text" size="25" name="bigpic['.$in.']"><br><br>';

		$in++;

		$hector=$hector-1;

	}

	$adminstep2str=$adminstep2str.'<input type="hidden" name="numofitems" value='.$p_numofitems.'><input type="Submit" value="OK"></form>';

endif;

if($adminstep==3) {

	$fp=fopen($filename, "w");

	$hector=$p_numofitems+0;

	$in=0;

	$linetoadd=stripslashes($p_question."|");

	fputs($fp, $linetoadd);

	while($hector > 0) {

		$linetoadd=stripslashes($p_item[$in]).'|'.$p_smallpic[$in].'|'.$p_bigpic[$in]."|0|";

		fputs($fp, $linetoadd);

		$in++;

		$hector=$hector-1;

	}

	fclose($fp);

	write2log("New vote was created with question: ".stripslashes($p_question));

}



?>

<table border=0 width=400 bgcolor=#FFFFFF>

	<tr>

    	<td><font size=2 color=#000000>

        	<strong>Step <?php echo($adminstep); ?></strong>

        </td>

    </tr>

    <tr>

        <td bgcolor="#000000">

            <font size="2" color="#FFFFFF">

            <br>

            <blockquote>

            <?php if($adminstep==0) {

            	echo($adminstep0str);

            }

            if($adminstep==1) {



            	echo($adminstep1str);

            }

            if($adminstep==2) {

            	echo($adminstep2str);

            }

            if($adminstep==3) {

            	echo('File has been created... Content Voting can be used!<br><br><a href="jukebox.php">Check the content</a><br><br><br><font size="1"><a href="lp_admin.php?adminstep=1">Back to step 1</a> WARNING: all data will be destroyed!');

            }

        	?>

            </blockquote></td>

    </tr>

</table>

</center>









</body>

</html>
