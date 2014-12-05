<?php
if(empty($_POST)) exit;

include ("../theme/language/en/language.php");

$error = array();
$config_content = '';
$next_step = '';
$error_num = 0;

switch ($_POST['active'])
{
	case 'free_mode_conf':  $next_step = 'free_ok';
	check_room_name($_POST['param_post']);
	check_configphp_permission();
	check_config_return();
	break;

	//case 'host_mode_conf': 	$next_step = 'host_integration_conf';
	case 'host_mode_conf': 	$next_step = 'install_done';
	check_host_address($_POST['param_post']);
	check_configphp_permission();
	check_config_return();
	break;

	case 'host_conf_inter_db':  $next_step = 'host_login_chat';
	check_configphp_permission();
	check_db_param();
	check_config_return();
	break;

	//case 'local_mode_conf': $next_step = 'local_integration_conf';
	case 'local_mode_conf': $next_step = 'install_done';
	check_local_address($_POST['param_post']);
	check_configphp_permission();
	check_config_return();

	break;

	case 'local_conf_inter_db':  $next_step = 'local_move_file';
	check_db_param();
	check_config_return();
	break;

	case 'no_integration':
	case 'install_done':
		create_installed_lock();
		echo "index.php";
		exit;
		break;

}




function check_config_return(){
	global $next_step,$config_content;
	$print_error = print_error();


	if( $print_error=='ok')
	{
		//not any errors
		$error[0]['error'] = false;

		switch($next_step)
		{
			case 'host_integration_conf':  $error['tag']['next'] = "index.php?active=".md5('host_inter');
			break;
			case 'local_integration_conf':  $error['tag']['next'] = "index.php?active=".md5('local_inter');
			break;
			case 'local_move_file':  $error['tag']['next'] = "index.php?active=".md5('local_move_file');
			break;
			case 'host_login_chat':  $error['tag']['next'] = "index.php?active=".md5('host_login_chat');
			break;
			default:
				create_installed_lock();
				$error['tag']['next'] = "index.php";
				break;
		}
			

		$open = fopen("../configure/config.php","w");
		fwrite($open,$config_content);
		fclose($open);

		echo successful_return($error);
	}
	else
	{
		//back error data
		echo  $print_error;
	}

}

function  check_db_param()
{
	global $error,$lang,$error_num,$config_content;

	if(empty($_POST['param_db_port'])){
		$_POST['param_db_port'] = md5('none');
	}

	if(empty($_POST['param_db_password'])){
		$_POST['param_db_password'] = md5('none');
	}

	if(in_array('',$_POST))
	{
		$error[$error_num]['error'] = $lang['error_full_db_param'];
		$error_num ++;
	}
	else
	{
		if($_POST['param_db_password'] == md5('none'))
		{
			$_POST['param_db_password'] = '';
		}
		switch ($_POST['select_db'])
		{
			case 'mysql': $include = check_php_module ('mysql_connect','mysql');
			break;
			case 'mssql':$include = check_php_module ('mssql_pconnect','mssql');
			break;
			case 'oracle':$include = check_php_module ('ocinlogon','oracle');
			break;
		}
			
		if($include)
		{
			@include($include);
			$sql = 'SELECT '. $_POST['param_uesrname_field'] .', '.$_POST['param_pw_field'].' FROM '.$_POST['param_db_user_table'];

			$test_db = new dbal_mysql;
			$db_port = false;
			$param_db_port = '';

			if( $_POST['param_db_port'] != md5('none') )
			{
				$db_port = $_POST['param_db_port'];
				$param_db_port = $_POST['param_db_port'];
			}

			$db_connect = $test_db -> sql_connect(
			$_POST['param_db_host'],
			$_POST['param_db_username'],
			$_POST['param_db_password'],
			$_POST['param_db_name'],
			$db_port
			);

			if($db_connect[0] !='error')
			{
	 			if($sql_query_test = $test_db -> sql_query($sql))
	 			{
	 				if($fetch_row = $test_db -> sql_fetchrow($sql_query_test))
	 				{
	 					$perv_content = file_get_contents('../configure/config.php');
	 					$config_content = str_replace('?>','',$perv_content);
	 					$config_content .= "
							\$select_db = '". $_POST['select_db']."';
							\$param_db_host = '". $_POST['param_db_host']."';
							\$param_db_port = '".$param_db_port."';
							\$param_db_name = '". $_POST['param_db_name']."';
							\$param_db_user = '". $_POST['param_db_username']."';
							\$param_db_password = '". $_POST['param_db_password']."';
							\$param_db_user_table = '".$_POST['param_db_user_table']."';
							\$param_uesrname_field = '".$_POST['param_uesrname_field']."';
							\$param_pw_field = '". $_POST['param_pw_field']."';
							\$enablemd5 = '". $_POST['enablemd5']."';								
							?>";

	 					if($_POST['select_mode']=='mode_database') config_xml();
	 					else if($_POST['active']!= 'host_conf_inter_db')config_server_xml('URL');
	 				}
	 				else
	 				{
	 					$error[$error_num]['error'] =  $lang['error_db_table'];
	 					$error_num ++;
	 				}
	 			}
	 			else
	 			{
	 				$error[$error_num]['error'] = $lang['error_db_table'];
	 				$error_num ++;
	 			}
		  }
	 	  else
	  	  {
	  		$error[$error_num]['error'] = $db_connect[1];
	  		$error_num ++;
	  	  }
		}
	}
}

function  config_xml()
{
	config_server_xml($_POST['select_db']);
	$enablemd5 = ($_POST['enablemd5']=='On')?'On':'Off';
	$db_xml_node = array('database-name' => $_POST['param_db_name'],
						 'database-user' => $_POST['param_db_username'],
						 'database-password' => $_POST['param_db_password'],
	                     'user-table' => $_POST['param_db_user_table'],
						 'username-field' => $_POST['param_uesrname_field'],
						 'password-field' => $_POST['param_pw_field'],
						 'enable-md5' => $enablemd5
	);

	switch($_POST['select_db'])
	{
		case 'mysql':
			$db_xml_node['database-host'] = $_POST['param_db_host'];
			config_database_xml( 'Mysql.xml',$db_xml_node);
			break;
		case 'mssql':
			$db_xml_node['dsn-name'] = $_POST['param_db_host'];
			config_database_xml( 'ODBC.xml');
			break;
		case 'oracle':
			$db_xml_node['database-host'] = $_POST['param_db_host'];
			config_database_xml( 'Oracle.xml');
			break;
	}
}

function config_database_xml($xml_file,$node_array)
{
	include("../configure/config.php");
	$db_xml = checkSlash($local_server_address).'server/etc/groups/default/database/'.$xml_file;
	$doc = new DOMDocument();
	@$doc->load($db_xml);
	foreach($node_array as $node => $val)
	{
		$doc = replacenode($doc, $node, mysql_escape_string($val));
	}
	@$doc->save($db_xml);
}




function config_server_xml($mode)
{
	include("../configure/config.php");
	$php_self= str_replace('install/active','login_chat',$_SERVER['PHP_SELF']);
	$chat_url = 'http://'.$_SERVER['HTTP_HOST'].$php_self;
	$server_xml = checkSlash($local_server_address).'server/etc/groups/default/server.xml';
	$doc = new DOMDocument();
	@$doc->load($server_xml);
	$doc = replacenode($doc, "integrated-other-database",$mode);
	$doc = replacenode($doc, "auth-url",$chat_url."?username=%username%&amp;password=%password%","charset","UTF-8");
	@$doc->save($server_xml);
}

function replacenode($doc,$nodename,$nodevalue, $attr="",$attrvalue="")
{
	$parent = new DomDocument;
	$parent_node = $parent->createElement($nodename,$nodevalue);
	
	if(!is_array($attr) || !is_array($attrvalue))
	{
		if(!empty($attr) && !empty($attrvalue))
		{
			$parent_node->setAttribute($attr, $attrvalue);
		}
	}
	else
	{
		foreach($attr as $key => $value)
		{
			$parent_node->setAttribute($value, $attrvalue[$key]);
		}
	}


	$parent->appendChild($parent_node);
	$nodelist = $doc->getElementsByTagName($nodename);
	$node = @$nodelist->item(0);
	$newnode = $doc->importNode($parent->documentElement, true);
	$node->parentNode->replaceChild($newnode,$node);

	return $doc;
}


function check_php_module($function,$file_name)
{
	global $error,$lang,$error_num;
	if( function_exists($function))
	{
		return ('../db/'.$file_name.'.php');
	}
	else 
	{
		$error[$error_num]['error'] = $file_name.$lang['error_php_module'];
		$error_num ++;
		return 0;
	}
}





function check_room_name($room_name){
	global $error,$lang,$error_num,$config_content;

	if(empty($room_name)){
		$error[$error_num]['error'] = $lang['error_free_room_name'];
		$error_num ++;
	}else{

		$config_content = '<?php
		$running_mode = \'free\';
		$room_name = \''.$room_name.'\';
		?>';

	}

}

function check_host_address($host_address){
	global $error,$lang,$error_num,$config_content;


	$host_address  = checkSlash($host_address);
	$host_address_html = $host_address."123flashchat.html";

	$get_content = '';
	$pattern = "|http://host([0-9]*).123flashchat.com/(.+)/|U";
	$patterntrial = "|http://trial.123flashchat.com/(.+)/|U";

	$host_address  = checkSlash($host_address);
	$host_address_html = $host_address."123flashchat.html";
	


	if(empty($host_address)||(!preg_match($pattern, $host_address, $matches) && !preg_match($patterntrial, $host_address, $matches))){
		$error[$error_num]['error'] = $lang['error_host_address'];
		$error_num ++;
	}else{
		$get_content = @file_get_contents($host_address_html);
		if(empty($get_content))
		{
			$error[$error_num]['error'] = $lang['error_host_address'];
			$error_num ++;
		}

		$config_content = '<?php
		$running_mode = \'host\';
		$host_address = \''.$host_address.'\';
		?>';
	}

}

function check_local_address($server_address){
	global $error,$lang,$error_num,$config_content;
	$server_address = checkSlash($server_address);
	//$error[$error_num]['error'] = '';
	if($server_address){
		$server_address .= substr($server_address,-1,1) != '/' ? '/' : '';		
	}else{
		$server_address = 'http://'.$_SERVER['SERVER_NAME'].':35555/';
	}
	$config_content = '<?php
	$running_mode = \'local\';
	$local_chat_address = \''.$server_address.'\';
	?>';
}

function check_configphp_permission() 
{
	global $lang,$error,$config_content,$error_num;
	if(!is_dir("../configure"))  {
		if(!mkdir("../configure")){
			$error[$error_num]['error'] = $lang['error_mkdir_configure'];
			$error_num ++;
		}
	}
	if(!is_file("../configure/config.php")){
		$open = fopen("../configure/config.php","w");
		fclose($open);
	}
	if(!is_writable("../configure/config.php")){
		$error[$error_num]['error'] = $lang['error_config_writable'];
		$error_num ++;
	}
}

function create_installed_lock()
{
	global $lang,$error,$error_num;

	$open = fopen("../install/installed.lock","w");
	fclose($open);

	if(!is_file("../install/installed.lock")){
		$error[$error_num]['error'] = $lang['error_install_writable'];
		$error_num ++;
	}
}

function successful_return($array){
	include ("json.php");
	$json = new Services_JSON();
	return $json->encode($array);

}


function  print_error(){
	global $error,$error_num;

	if(!empty($error[0]['error'])){

		$error['tag']['next'] = false;
		$error['tag']['error_num'] = $error_num;
		include ("json.php");
		$json = new Services_JSON();
		return $json->encode($error);
	}else{
	 return "ok";
	}
}

function checkSlash($path)
{
	if(substr($path,-1,1) != "/" && !empty($path)){
		$path = $path."/";
	}
	return $path;
}
?>