<?php
if(!defined("PHPCHAT"))
{
  echo '<script>window.location.href("../index.php");</script>';
  exit;
}

$installing =false;
$get_type = array(
md5('setup'),md5('free'),md5('host'),md5('host_inter'),md5('local')
,md5('local_inter'),md5('local_move_file'),md5('host_login_chat')
,md5('3rd_module'),md5('others')
);

if(!isset($_GET['active']))
{
	$_GET['active'] = '';
	$GET = '';
}	
	
if(isset($_GET)&& in_array($_GET['active'],$get_type))
{
	$installing = true;
	$GET = $_GET['active'];
 }

function print_index()
{
	index_hearder();
	index_logo();
	index_instruction($_GET['active']);

}


function index_hearder()
{
    global $lang;
    echo '
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>'.$lang['title'].'</title>
	<link href="theme/css/impromptu.css" rel="stylesheet" type="text/css" />
	<link href="theme/css/main.css" rel="stylesheet" type="text/css" />
	<meta name="description" content="123 Flash Chat PHP Chat is a free php application. It has these special features: easy-installed, easy-used, safe and supporting most dominant databases, such as MySQL, MSSQL and oracle. The PHP Chat integration modules include database integration and auth url integration."/>

<meta name="Keywords" content="php chat, free php chat, Flash Chat, php Web Chat Room, Chat Script, Chat Hosting"/>';
	echo'</head><body><div align="center"><div id="box">';
}

function index_logo()
{
	echo '<div id=\'logo\' class="logo"><a href="http://www.123flashchat.com"><img src="theme/img/logo.gif"  border="0"  width="243" height="98" /></a></div>';
}



function index_instruction($get_hash)
{
	global $lang;
//md5('setup'),md5('free'),md5('host'),md5('host_inter'),md5('local'),md5('local_inter'),md5('local_move_file')
	
	switch($get_hash){
	case md5('setup'):
	       $instruction_content = $lang['instruction_content_setup'];
		   $instruction_title = $lang['instruction_title_setup'];
		   break;	
	case md5('free'):
	       $instruction_content = $lang['instruction_param_conf_free'];
		   $instruction_title = $lang['instruction_param_conf'];
		   reinstall_module();
		   break;	
	case md5('host'):
	       $instruction_content = $lang['instruction_param_conf_host'];
		   $instruction_title = $lang['instruction_param_conf'];
		   reinstall_module();
		   break;		   
	case md5('local'):
	       $instruction_content = $lang['instruction_param_conf_local'];
		   $instruction_title = $lang['instruction_param_conf'];
		   reinstall_module();
		   break;
	case md5('host_inter'):
	case md5('local_inter'):
	       $instruction_content = $lang['instruction_param_host_inter'];
		   $instruction_title = $lang['instruction_param_conf'];
		   break;
    case md5('local_move_file'):
	       $instruction_content = $lang['instruction_local_move_file'];
		   $instruction_title = $lang['instruction_param_conf'];
		   break;
    case md5('others'):
	       $instruction_content = $lang['instruction_others_c'];
		   $instruction_title = $lang['instruction_others_t'];
		   break;
   default:
	       $instruction_content = $lang['instruction_content'];
		   $instruction_title = $lang['instruction_title'];
		   break;
	}
	

	if(!(empty($get_hash)))
	{
		echo'
		<div class="instruction">
		<div class="instruction_t"><img src="theme/img/k_left.gif" /><span>'.$instruction_title.'</span><img src="theme/img/k_right.gif" /></div>
		<div class="instruction_c">
		  <div class="instruction_n">'. input2html($instruction_content).'</div>
		</div>
		<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
		<div class="space"><!-- space end--></div>
		<div class="kt"><img src="theme/img/kt_left.gif" /><span><!-- space end--></span><img src="theme/img/kt_right.gif" /></div>
		<div class="instruction_c2">';
	}
}


function reinstall_module(){
	if(is_file("install/installed.lock")){
		unlink('install/installed.lock');
	}	
}

function check_install($installing,$GET)
{

	if(!is_file("install/installed.lock")&&is_file("install/setup.php")&&$installing ==false){
	//install initialize

		echo'<div class="instruction">
		<div class="instruction_t"><img src="theme/img/k_left.gif" /><span>PHP chat instruction</span><img src="theme/img/k_right.gif" /></div>
		<div class="instruction_c">
		  <div class="instruction_n"><a href="http://www.123flashchat.com" target="_blank">123 Flash Chat</a> PHP chat 3rd party module can make your website have its own flash chat room. It also can integrate your website with databases through simple configuration. It is a totally free third party plug-in component.<br />
			<br />
			<span>Module Support:<br/>
			  <a href="http://www.123flashchat.com/support.html"  target="_blank">http://www.123flashchat.com/support.html</a></span> <a href="'.$_SERVER['PHP_SELF'].'?active='.md5('setup').'" ><img src="theme/img/install.gif" width="218" height="61" border="0" />
			  </a></div>
			  </div>
		<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
		</div>';
				
		
		
		
	}else if(!is_file("install/installed.lock")&&is_file("install/setup.php")&&$installing ==true){
	 //install start  
	   require('install/setup.php');
	   $setup = new setup;
	   $setup-> print_div($GET);
	
	}else{
	//install complete 
	   print_install_completer();
	}


}


function input2html($str)
{
   $str = nl2br($str);
  return $str;

}


function textarea()
{

	$php_self= str_replace('index','123flashchat',$_SERVER['PHP_SELF']);
	$chat_url = 'http://'.$_SERVER['HTTP_HOST'].$php_self;
	$textarea = strstr(file_get_contents($chat_url),'<!-- FROM');
	$textarea_arr = explode('<!-- FROM 123FLASHCHAT CODE END -->',$textarea);
	$textarea = $textarea_arr[0].'<!-- FROM 123FLASHCHAT CODE END -->';
	$textarea = htmlspecialchars($textarea);
	return  $textarea;

}

function check_chat_url()
{

   $httpHost =  str_replace(".","",$_SERVER['HTTP_HOST']);
     $php_self= str_replace('index','123flashchat',$_SERVER['PHP_SELF']);
	 
  if(!is_numeric($httpHost)&&$httpHost != "localhost"){
  

     return 'http://'.$_SERVER['HTTP_HOST'].$php_self;

   }else{
   
        return 'http://'.$_SERVER['HTTP_HOST'].$php_self;
   }

}



function print_install_completer()
{
			global $lang;
   
   $chat_url =   check_chat_url();


   
    $print_attention = '';

   
   if(is_file('configure/config.php')){
       include('configure/config.php');
	}
   
    if($running_mode == 'host' || $running_mode == 'local' )
    {
	   $support_url = 'http://customer.123flashchat.com/helpdesk/';
	}else{
	    $support_url = 'http://www.123flashchat.com/community/index.php';
	}

     $instruction_content = $lang['instruction_content'];
     $instruction_title = $lang['instruction_title'];

	echo '

			<div class="instruction">
		<div class="instruction_t"><img src="theme/img/k_left.gif" /><span>'.$instruction_title.'</span><img src="theme/img/k_right.gif" /></div>
		<div class="instruction_c">
		  <div class="instruction_n">'. input2html($instruction_content).'</div>
		</div>
		<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
		<div class="space"><!-- space end--></div>
		<div class="kt"><img src="theme/img/kt_left.gif" /><span><!-- space end--></span><img src="theme/img/kt_right.gif" /></div>
		<div class="instruction_c2">
	
	<div class="show_txt"><b style="color:#FF0000;font-size:15px; font-family:Tahoma;">'.$print_attention.'</b></div>
	<div class="cg">
	<div class="cg_d">
	  <li><a href="javascript:void(0);" id="show_code1" name="cg_index" >Index</a></li>
	  <li><a href="javascript:void(0);" id="show_code2" name="cg_url" >Copy URL</a></li>
	  <li><a href="javascript:void(0);" id="show_code3" name="cg_code" >Copy Code</a></li></div>
	  <div class="cg_k">
	  
	  <div id="cg_index" ><b>Index</b>
	  <hr size="1" color="#cccccc" />
	  Chat room URL:<br/><br/>
	 <a href="123flashchat.php" target="_blank" >'.$chat_url.'</a>
	 </div>
	  <div id="cg_url"><b>Direct chat room link</b>
	  <hr size="1" color="#cccccc" />
	  It can be added to any webpage with a chat room link. <br/><br/>
	  <label>
	  <input type="text" name="textfield" onclick="this.select();" id="codes_direct_value" size="55" value="'.$chat_url.'" style="font-size:12px;font-family:Tahoma;color:#333333;width:480px;"/>
	  </label><br/><br/>
	  
	 <a href="javascript:void(0)" onclick="copy(\'codes_direct_value\');return false;"><img src="theme/img/copycode.gif" width="51" height="21" border="0" /></a>  </div>
	  <div id="cg_code"><b>JavaScript chat room code:</b>
	  <hr size="1" color="#cccccc" />
	  It can be added to any webpage with some simple code.<br/>
	  <br/>
	 <textarea  onclick="this.select();" name="code_javascript_value" id="code_javascript_value" cols="50" rows="6" style="font-size:12px;font-family:Tahoma;color:#333333;width:480px;">';
	  echo textarea();
	  echo '</textarea><br/><br/>
	 <a href="javascript:void(0)" onclick="copy(\'code_javascript_value\');return false;"> <img src="theme/img/copycode.gif" border="0" border="0"/></a></div>
	 
	<p>&nbsp;</p>
	</div>
	</div>
	</div>
	<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
	</div>';
	echo '<div class="space"><!-- space end--></div>
	<div class="instruction_t"><img src="theme/img/k_left.gif"><span>'.$lang['reinstall_other_mode'].'</span><img src="theme/img/k_right.gif"></div>
	<div class="instruction_c2" >
		<div class="others"> ';
	if($running_mode == 'host'){
		echo '<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('local').'" ><img src="theme/img/icon01.gif" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('local').'" >'.$lang['select_mode_local'].'</a></span>
		<div style="clear:both;"></div>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('free').'" ><img src="theme/img/icon02.gif" width="54" height="54" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('free').'" >'.$lang['select_mode_free'].'</a></span>';
	}elseif($running_mode == 'local'){
		echo '<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('host').'" ><img src="theme/img/icon03.gif" width="54" height="54" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('host').'" >'.$lang['select_mode_host'].'</a></span>
		<div style="clear:both;"></div>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('free').'" ><img src="theme/img/icon02.gif" width="54" height="54" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('free').'" >'.$lang['select_mode_free'].'</a></span>';
	}else{
		echo '<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('local').'" ><img src="theme/img/icon01.gif" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('local').'" >'.$lang['select_mode_local'].'</a></span>
		<div style="clear:both;"></div>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('host').'" ><img src="theme/img/icon03.gif" width="54" height="54" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('host').'" >'.$lang['select_mode_host'].'</a></span>';
	}
	echo '</div>
	</div>
	<div class="instruction_b"><img src="theme/img/kd_left.gif"><span><!-- space end--></span><img src="theme/img/kd_right.gif"></div>
	<div style="clear:both;"></div>';
	echo '
	<p>&nbsp;</p>
	<div class="link" align="center"><a href="http://www.123flashchat.com" target="_blank" >Home</a>&nbsp;<b>|</b>&nbsp;<a href="http://www.123flashchat.com/buy.html" target="_blank">Buy</a>&nbsp;<b>|</b>&nbsp;
	<a href="http://www.123flashchat.com/help/index.html" target="_blank">Help</a>&nbsp;<b>|</b>&nbsp;<a href="'.$support_url.'" target="_blank">Support</a></div>';
}
?>