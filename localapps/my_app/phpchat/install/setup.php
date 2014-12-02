<?php
if(!defined("PHPCHAT"))
{
	echo '<script>window.location.href("../index.php");</script>';
	exit;
}

class setup
{
	static function prev_next($prev,$next)
	{
		$active_prev = md5($prev);
		$active_next = $next;

		if($prev =="setup" && $next == "none")
		{
			echo ' <div class="show_t"><hr size="1px" color="#CCCCCC" width="388px" align="left" /><a href="'.$_SERVER['PHP_SELF'].'?active='.$active_prev.'" ><img src="theme/img/prev.gif" border="0"/></a></div>
			</div>
			</div>
			<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
			</div>';
		}
		else
		{
			echo '<div class="next_prev" ><div class="show_txt"><a href="'.$_SERVER['PHP_SELF'].'?active='.$active_prev.'" ><img src="theme/img/prev.gif" width="80" height="30"  border="0"/></a><a href="javascript:void(0);" ><img src="theme/img/next.gif"  border="0" id="'.$active_next.'" /></a></div>
			</div>
	        <div id="checking"  align="center">Waiting!&nbsp;&nbsp;<img src="theme/img/checking.gif"  /></div>
			</div>
			<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
			</div>';
		}

	}

	static function install_cancel()
	{
		global 	$lang;
		echo '
	  		<div class="spaceline" ><!--spaceline--></div>
	  		<div id="install_cancel" class="notice"  align="center">'.$lang['install_cancel'].'</div>';
	}

	static public function print_div($get)
	{
		global 	$lang;
		if(is_file("configure/config.php"))
		include("configure/config.php");
		switch ($get)
		{
			case md5('free'):
				self::return_error();
				echo '
				<div class="show_txt">'.$lang['fill_room_name'].'</div>
				<div class="show_k1">'.$lang['param_room_name'].': <input name="tipword" tipname="param_room_name" type="text" id="param_room_name" value="Lobby" /></div>';		
				self::prev_next('others','free_conf');
				break;

			case md5('host'):
				if(!isset($host_address))
				{
					$host_address = '';
				}
				$host_address = str_replace("//","/",$host_address);
				$host_address = str_replace("http:/","http://",$host_address);

				self::return_error();
				echo '<div class="show_txt">'.$lang['fill_host_address'].'</div>
				  <div class="show_k1">'.$lang['param_host_address'].'
				  <input type="text" id="param_host_address"  value="'.$host_address.'" name="tipword" tipname="param_host_address"/></div>
				 ';

				self::prev_next('others','host_conf');
				break;
	  		
		 	case md5('host_inter'):
		 		self::return_error();
		 		self::db_mode_select();
		 		self::db_select();
		 		self::db_mode_config();
		 		echo '<div class="spaceline" ><!--spaceline--></div></div>';
		 		self::prev_next('host','host_conf_inter');
		 		break;

		 	case md5('local'):
		 		self::return_error();
		 		self::local_download();
		 		if(!isset($local_server_address))
		 		{
		 			$local_server_address ='';

		 		}
		 		$local_server_address = str_replace("//","/",$local_server_address);
		 	 

				echo '<div class="show_txt">'.$lang['fill_local_address'].'</div>
<div class="show_k1">'.$lang['param_local_address'].' <input type="text" name="tipword" tipname="param_local_address" id="param_local_server_address"  value="'.$local_server_address.'"/></div>';
			 	
			 	self::prev_next('others','local_conf');
			 	break;
			 	
		 	case md5('local_inter'):
		 		$add_mode = 'add_database_mode';
		 		self::db_mode_select($add_mode);
		 		self::db_select();
		 		self::db_mode_config();
		 		echo '<div class="spaceline" ><!--spaceline--></div></div>';
		 		
		 		self::prev_next('local','local_conf_inter');
		 		self::install_cancel();
		 		break;

			 case md5('host_login_chat'):
		 		$php_self= str_replace('index','login_chat',$_SERVER['PHP_SELF']);
		 		$login_chat_url = 'http://'.$_SERVER['HTTP_HOST'].$php_self.'?username=%username%&password=%password%';
		 		echo '<div class="show_open">'.$lang['login_chat'].'
						<p><b>1. Open chat admin panel page:</b><br/>
						'.$host_address.'admin_123flashchat.html<br/>
						<a href="'.$host_address.'admin_123flashchat.html" target="_blank"><img src="theme/img/go_blue.gif" width="51" height="21" border="0" /></a></p>
						<b>2. Log into admin panel with default password: admin/admin</b>
						<p><b>3. Find: System Settings -&gt; Integration panel</b></p><img src="theme/img/help/logchat1.jpg" width="468" height="261" />
						<p><b>4. Select: DataBase -> URL -> Edit</b></p><img src="theme/img/help/logchat2.jpg" width="468" height="257" /><br/><br/>
						<b>5. Fill the following URL into \'URL\' blank:</b><br/> 
						<font color="#FF0000">'. $login_chat_url.'</font>
						<p><b>6. Click \'ok\', save it.</b></p> 
						 Done 
						<hr size="1px" color="#cccccc" />
						</div>
						<div align="center"><a href="javascript:void(0)"><img src="theme/img/done.gif" id="install_done" border="0"  /></a></div>
						</div>
						<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
						</div>';
		 		break;

		 	case md5('local_move_file'):
				include_once(dirname(dirname(__FILE__)).'/configure/config.php');
				if(isset($local_chat_address) && strpos($local_chat_address,'35555') ){
				
				}else{
					echo '<div class="show_txt">'.$lang['move_file'].'
						<br/>
						  <input id="auto_movefile_no" name="radio" type="radio" checked  />
						 '.$lang['move_file_s1'] .'
					  </div>
					  <div class="notice" id="movefile_self">'.$lang['move_file_s1_tip'].'</div>
					<div class="show_txt">
					  
					  <input id="auto_movefile_yes" name="radio" type="radio" />
					'.$lang['move_file_s2'] .' </div>
					 <div class="notice" id="movefile_auto">  
					<p><a href="javascript:void(0);" title="copy file" class="deleteuser" onclick="copy_file();"> <img src="theme/img/copy.jpg" border="0"/></a></p>
					 </div><div class="show_txt"><hr size="1px" color="#CCCCCC" width="360" align="left" /></div>';
				}
		 		echo '<div class="show_txt">'.$lang['restart_chat'].'
					<br/><input id="auto_restart_yes" name="radio1" type="radio" checked />
					'.$lang['restart_chat_s1'].'<br/>
					  <div  id="restart_auto" class="move_file"><br/>
						 <a id="restart_chat" href="javascript:void(0)"> <img src="theme/img/restart.jpg" border="0"/></a>
					  </div>
					  <br/><input id="auto_restart_no" name="radio1" type="radio" />
						'.$lang['restart_chat_s2'].' <br/></div>
					  <div  id="restart_self" class="notice">
						'.$lang['restart_chat_s2_tip'].'
						</div>
							
				
					<div align="center"><a href="javascript:void(0)"><img id="install_done" src="theme/img/done.gif" border="0" /></a></div>
					</div>
					<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
					</div>';

		 		break;




		 	 
		 	case md5('others'):
		 		echo '
		<div class="others"> <a href="'.$_SERVER['PHP_SELF'].'?active='.md5('local').'" ><img src="theme/img/icon01.gif" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('local').'" >'.$lang['select_mode_local'].'</a></span>
		<div style="clear:both;"></div>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('host').'" ><img src="theme/img/icon03.gif" width="54" height="54" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('host').'" >'.$lang['select_mode_host'].'</a></span>
		<div style="clear:both;"></div>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('free').'" ><img src="theme/img/icon02.gif" width="54" height="54" border="0" /></a><span>
		<a href="'.$_SERVER['PHP_SELF'].'?active='.md5('free').'" >'.$lang['select_mode_free'].'</a></span>
		</div>';
		 		self::prev_next('setup',"none");
		 		break;

			default:  self::module_3rd_part_select();
		 	break;
		}
	}

	static function return_error()
	{
		echo '<div class ="return_error"></div>';
	}



	static function db_mode_select($add_mode='')
	{
		global $lang;
		echo '
  <div class="show_txt">'.$lang['enable_integration'].'
    <p>
      <input  name="tipword" tipname="integration_yes"  id="radio_mode_yes" type="radio" />Yes<br/>
      <input  name="tipword" tipname="integration_no" id="radio_mode_no" type="radio"  checked />No</p>
  </div>
  <div class="show_txt" id="db_mode_select">'.$lang['select_integration_mode'].'
  <p>Mode: 
    <select id="select_mode" name="tipword" tipname="integration_select_db">
      <option value="mode_url" selected="selected">URL integration mode</option>';
		if($add_mode == 'add_database_mode')
		echo '<option value="mode_database">Database integration mode</option>';
		echo '</select></p>';
	}


	static function db_select()
	{
		global  $lang;
		echo $lang['select_db'].'
		<p>Database: <select id="select_db"  name="tipword" tipname="integration_select_db">
			  <option value="mysql" selected="selected">MySQL</option>
			  <option value="mssql">MSSQL</option>
			   <option value="oracle">Oracle</option>
			</select></p>
		</div>';
	}





	static function db_mode_config()
	{
		global 	$lang;
		echo '
		<div class="show_k" id="db_mode_config">
	<span>Database host:</span><input class="input_color" id="param_db_host" type="text" name="tipword" tipname="param_db_host"><br/>
	<span>Database port:</span><input class="input_color" id="param_db_port" type="text"name="tipword" tipname="param_db_port"><br/>
	<span>Database name:</span><input class="input_color" id="param_db_name" type="text" name="tipword" tipname="param_db_name"><br/>
	<span>Database username:</span><input class="input_color" id="param_db_username" type="text" name="tipword" tipname="param_db_username"><br/>
	<span>Database password:</span><input class="input_color" id="param_db_password" type="password" name="tipword" tipname="param_db_password"><br/>
	<span>Database user table:</span><input class="input_color" id="param_db_user_table" type="text" name="tipword" tipname="param_uesrname_field"><br/>
	<span>Username field:</span><input class="input_color" id="param_uesrname_field" type="text" name="tipword" tipname="param_uesrname_field"><br/>
	<span>Password field:</span><input class="input_color" id="param_pw_field" type="text" name="tipword" tipname="param_pw_field"><br/>
	<span>EnableMD5:</span><select  id="enablemd5" name="tipword" tipname="enablemd5">
				<option selected="selected" value="Off">Off</option>
				<option value="On">On</option>
			  </select> ';	
	}


	static function module_3rd_part_select()
	{
		global 	$lang;
		include("3rd_module_list.php");
		echo '<div align="center">';
		
		foreach($list_3rd as $val)
		{

			echo '<div class="module_logo"><a href="http://www.123flashchat.com/'.$val['url'].'" target="_blank"><img src="install/icon/'.$val['name'].'.jpg" width="150" height="38" border="0" /></a><br />
	  <a target="_blank" href="http://www.123flashchat.com/'.$val['url'].'">&raquo; Overview</a>&nbsp; &nbsp; &nbsp; ';
			if(strtolower($val['name']) == 'wordpress' || strtolower($val['name']) == 'buddypress'){
				echo '<a target="_blank" href="http://www.123flashchat.com/download/wordpress/123flashchat.zip">&raquo; Download</a></div>';
			}else{
				echo '<a target="_blank" href="http://www.123flashchat.com/download/'.strtolower($val['name']).'_mod_for_123flashchat.zip">&raquo; Download</a></div>';
			}
		}

		echo '  <div class="space2"><!-- space end--></div>
		<br /><a href="'.$_SERVER['PHP_SELF'].'?active='.md5("others").'" ><img src="theme/img/others2.gif" border="0" width="143" height="44" /></a></div>
		   <div class="space2"><!-- space end--></div>
		</div>
		</div>
		<div class="instruction_b"><img src="theme/img/kd_left.gif" /><span><!-- space end--></span><img src="theme/img/kd_right.gif" /></div>
		</div>';
	}



	static function local_download()
	{
		if(strripos($_SERVER['WINDIR'], 'win'))
		{
			$sys = 'win';
			$postfix = '.exe';
		}
		else {
		 	$sys = 'linux';
		 	$postfix = '.tar.gz';
	 	}
		echo '<table width="98%" align="center" style="border:solid 1px #ccc;">
		  <tbody><tr bgcolor="#dddddd"><td width="28%" height="25" align="left" valign="middle">File Name</td>
		  <td width="21%" align="center" valign="middle">Include JRE</td>
		  <td width="18%" align="center" valign="middle">Download</td>
		  </tr> <tr bgcolor="#ffffff"><td height="25" align="left" valign="middle"><img src="theme/img/icon_'.$sys.'.gif"/>
		  <a href="http://www.123flashchat.com/download/123flashchat'.$postfix.'" target="_blank" title="Free download chat server software version">123flashchat'.$postfix.'</a></td>
		  <td align="center" valign="middle">
		 <img src="theme/img/checkmark.gif" alt="Free download chat server software version"/></td>
		<td align="center" valign="middle"><a href="http://www.123flashchat.com/download/123flashchat'.$postfix.'" target="_blank"><img border="0" src="theme/img/btn.gif" alt="Free download chat server software version"/></a></td>
		  </tr>   <tr bgcolor="#ffffff"><td height="25" align="left" valign="middle"><img src="theme/img/icon_'.$sys.'.gif"/><a href="http://www.123flashchat.com/download/123flashchat_s'.$postfix.'" target="_blank" title="Free download chat server software version">123flashchat_s'.$postfix.'</a></td>
		  <td align="center" valign="middle"><img src="theme/img/no1.gif"/></td>
		<td align="center" valign="middle"> <a href="http://www.123flashchat.com/download/123flashchat_s'.$postfix.'" target="_blank" title="Free download chat server software version"><img border="0" src="theme/img/btn.gif" alt="Free download chat server software version"/></a></td>
		  </tr> 
		  </tbody></table>';
	}
} //class end
?>