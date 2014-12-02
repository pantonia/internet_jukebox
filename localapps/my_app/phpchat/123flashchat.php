<?php
require_once( 'configure/config.php' );



if($running_mode == 'host')
{
	$urlinfo = getHostParameters($host_address);
	$swfname = basename($urlinfo['path']);   
	parse_str($urlinfo['query']);
}


$width = "100%";
$height = "100%";
$user = '';

if(is_file("api/Api_user_session.php")&& $running_mode != 'free')
{
   require_once("api/Api_user_session.php");
   if(!empty($username)&&!empty($password))
   {
  	 $user = "&init_user=".rawurlencode($username)."&init_password=".$password;
   
   }

}

switch($running_mode)
{
	case 'free':
		chat_free();
		break;
	case 'host':
		show_chat();
		break;
	case 'local':
		show_chat();
		break;
	default:
	     echo '<script>window.location.href("index.php");</script>';
		 exit;break;
}




function chat_free()
{
	global $room_name,$width,$height;
	
	echo pageheader();
?>
<!-- FROM 123FLASHCHAT CODE BEGIN -->
	<script language="javascript">
		var clientWidth = document.body.clientWidth;
		//var clientWidth = "100%";
		var clientHeight = window.innerHeight;
		var htmlcode = '<script language="javascript" src="http://free.123flashchat.com/js.php?room=<?php echo rawurlencode($room_name); ?>';
			htmlcode += '&width='+clientWidth+'&height='+clientHeight+'"></scr';
			htmlcode += 'ipt>';
		document.write(htmlcode);
	</script>
<!-- FROM 123FLASHCHAT CODE END -->
<?php
	echo pagefooter();
}


function show_chat()
{
	global $swfname,$init_host,$init_port,$init_group,$width,$height,$host_address,$user,$running_mode;
	
	
	if($running_mode == 'host')
	{
		$client_location = checkSlash($host_address);
			
		$swfurl = $client_location.$swfname;
	
		if(!empty($init_host)){
			$swfurl .= (strpos($swfurl,"?"))?"&init_host=".$init_host:"?init_host=".$init_host;
		}
		if(!empty($init_port)){
			$swfurl .= (strpos($swfurl,"?"))?"&init_port=".$init_port:"?init_port=".$init_port;
		}
		if(!empty($init_group)){
			$swfurl .= (strpos($swfurl,"?"))?"&init_group=".$init_group:"?init_host=".$init_group;
		}
		
	}else if($running_mode == 'local'){
		global $init_host,$init_port,$local_chat_address,$user,$running_mode;
		//$php_self= str_replace('123flashchat.php','',$_SERVER['PHP_SELF']);
		$init_host = parse_url($local_chat_address, PHP_URL_HOST);
		$swfurl = $local_chat_address.'123flashchat.swf?init_host='.$init_host.'&init_port=51127';		
    }
	$swfurl .= $user;


		echo pageheader();
?>
	<!-- FROM 123FLASHCHAT CODE BEGIN -->
	<object width="100%" height="100%" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0">
		<param name="movie" value="<?php echo $swfurl;?>" />
		<param name="quality" value="high" />
		<param name="menu" value="false" />
		<param name="scale" value="noscale" />
		<param name="allowScriptAccess" value="always" />
		<embed src="<?php echo $swfurl;?>" width="100%" height="100%" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" menu="false" scale="noscale" allowScriptAccess="always">
		</embed>
	</object>
	<!-- FROM 123FLASHCHAT CODE END -->
	<script>
		var clientWidth = document.body.clientWidth;
		var clientHeight = window.innerHeight ;
		document.getElementsByTagName("body")[0].style.overflow = 'hidden';
		//document.getElementsByTagName("object")[0].style.width = clientWidth+'px';
		//document.getElementsByTagName("embed")[0].style.width = clientWidth+'px';
		document.getElementsByTagName("object")[0].style.height = clientHeight+'px';
		document.getElementsByTagName("embed")[0].style.height = clientHeight+'px';
	</script>

<?php	echo pagefooter();
	}

function getHostParameters($client_location)
{
	$content = @file_get_contents($client_location);
	if(!empty($content))
	{
		$pattern = '|var urlValue="(.*)"|U';
		preg_match($pattern, $content, $matches);
		if(!empty($matches[1]))
		{
			$url = $matches[1];
			$urlinfo = parse_url($url);
			return $urlinfo;
		}
		else
		{
			$pattern = '|PARAM NAME=movie VALUE="(.*)"|U';
			preg_match($pattern, $content, $matches);
			if(!empty($matches[1]))
			{
				$url = $matches[1];
				$urlinfo = parse_url($url);
				return $urlinfo;
			}
		}
		return false;
	}
}


function checkSlash($path)
{
		if(substr($path,-1,1) != "/" && !empty($path)){
			$path = $path."/";
		}
		return $path;
}

function pageheader()
{
      global $running_mode;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat Room - Powered by 123FlashChat</title>
</head>
<link rel="stylesheet" type="text/css" media="screen" href="http://www.123flashchat.com/stylesheet22.css" />
<body scroll="no" style="margin:0;padding:0;overflow:hidden;">

<?php 
}

function pagefooter()
{
?>
</body>
</html>
<?php
}
?>