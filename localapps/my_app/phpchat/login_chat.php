<?php
$select_db = '';
if(is_file('configure/config.php'))
{
	require_once('configure/config.php');
}
else
{
	echo '<script>window.location.href("index.php");</script>';
	exit;
}

if(is_file('api/Api_password_encrypt.php'))
{
	include('api/Api_password_encrypt.php');
}

$LOGIN_SUCCESS = 0;
$LOGIN_PASSWD_ERROR = 1;
$LOGIN_NICK_EXIST = 2;
$LOGIN_ERROR = 3;
$LOGIN_ERROR_NOUSERID = 4;
$LOGIN_SUCCESS_ADMIN = 5;
$LOGIN_NOT_ALLOW_GUEST = 6;
$LOGIN_USER_BANED = 7;

$username = isset($_GET['username']) ? trim(htmlspecialchars($_GET['username'])) : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';


$db_server = $param_db_host;
$db_name = $param_db_name;
$db_user = $param_db_user;
$db_pass = $param_db_password;
$db_table = $param_db_user_table;
$db_user_field = $param_uesrname_field;
$db_pass_field = $param_pw_field;


if(is_file('db/'.$select_db.'.php'))
{
	include('db/'.$select_db.'.php');
}
else
{
	echo 'no integrate.';
	exit;
}

if(empty($username))
{
	echo $LOGIN_ERROR_NOUSERID;
	exit;
}

$db = new dbal_mysql;

$db_port = false;

if(!empty( $param_db_port))
{
	$db_port = $param_db_port;
}

$db_connect = $db -> sql_connect($db_server, $db_user, $db_pass, $db_name, $db_port);

if ($db_connect[0] !='error')
{
	$sql = "SELECT * FROM ".$db_table." WHERE ".$db_user_field."='".$username."'";

	if(!$sql_query = $db -> sql_query($sql))
	{
		echo $LOGIN_ERROR;
		exit;
	}

	if($fetch_row = $db -> sql_fetchrow($sql_query))
	{
		if ($fetch_row[$db_pass_field] != $password && $fetch_row[$db_pass_field] != md5($password ))
		{
			if(!empty($password_encrypt_function_name) && is_function($password_encrypt_function_name))
			{
				if
				(
					$fetch_row[$db_pass_field] == $password_encrypt_function_name($password)||
					$password_encrypt_function_name($fetch_row[$db_pass_field]) == $password
				)
				{
					echo $LOGIN_SUCCESS;
					exit;

				}
				else
				{
					echo $LOGIN_PASSWD_ERROR;
					exit;
				}
			}
			else
			{
				echo $LOGIN_PASSWD_ERROR;
				exit;
			}
		}
		else
		{
			echo $LOGIN_SUCCESS;
			exit;
		}
	}
	else
	{
		echo $LOGIN_ERROR_NOUSERID;
		exit;

	}
}
else
{
	echo $LOGIN_ERROR;
}
?>