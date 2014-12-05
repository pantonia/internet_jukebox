<?php
if(file_exists('../configure/config.php')&&file_exists('client_files.txt')&&!empty($_POST['active']))
{
	if(empty($_SESSION))
	{
		session_start();
	}

	include('../configure/config.php');

	/*
	 function get_all_files( $path )
	 {
		$list = array();
		foreach( glob( $path . '/*') as $item ){
		if( is_dir( $item ) )
		{
		$list = array_merge( $list , get_all_files( $item ) );
		}
		else{
		$list[] = $item;
		}
		}
		return $list;
		}

		*/
	if(isset($_SESSION['cp_error_file']))
	{
	 $_SESSION['cp_error_file'] = '';
	}

	function copy_file($file_source)
	{
		global $local_server_address;

		$folder = explode('/',$file_source);
		$address = str_replace('install/active_cpfile.php','client',$_SERVER['SCRIPT_FILENAME']);

		if(!is_dir($address))
		{
			mkdir($address);
		}

	 foreach($folder as $val)
	 {
	 	$address .= '/'.$val;
	 	if(!is_dir($address)&&!strpos($address,'.'))
	 	{
	 		mkdir($address);
	 	}
	 	else if(!file_exists($address)&&strpos($address,'.'))
	 	{
	 		$file_source =  trim($file_source);
	 		$address =  trim($address);
	 		$cp_source_file = $local_server_address.'/client/'.$file_source;
	 			
	 		if(!@copy( $cp_source_file,$address))
	 		{
	 			$_SESSION['cp_error_file'] = $cp_source_file.'to '.$address.'<!--|||-->';
	 		}
	 	}
	 }
	}

	function do_copy_file($address_array,$max_copy)
	{
		global $local_server_address;

		include ("json.php");
		$json = new Services_JSON();
			
		if(!isset($_SESSION['perv_cp_num']))
		{
			$_SESSION['perv_cp_num'] = 1;
			$_SESSION['cp_over'] = 'begin';
		}


		$_SESSION['sum_list'] = count($address_array);
		$_SESSION['max_copy'] =  $max_copy;
		$perv_cp_num = $_SESSION['perv_cp_num'];
			


		for($i=$perv_cp_num;$i < ($max_copy+$perv_cp_num);$i++)
		{
			$str = @str_replace($local_server_address.'/client/','',$address_array[$i]);
			copy_file($str);

			$_SESSION['perv_cp_num']++;
		}
			
		if($_SESSION['perv_cp_num']>= $_SESSION['sum_list'])
		{
			$_SESSION['cp_over'] = 'end';
		}
		//echo 'cp_ok';
		$return_cpf = $json->encode($_SESSION);
		echo $return_cpf;
	}


	function restartApi()
	{
		$rs = @file_get_contents("http://127.0.0.1:35555/restartgroup.api");
		if($rs === "0")
		{
			return true;
		}
		return false;
	}



	if($_POST['active']== 'movefile')
	{
		$max_copy = '50';
		// $address = $local_server_address.'/client';
		$address_array =  @file('client_files.txt');
		do_copy_file($address_array,$max_copy);
	}
	else if($_POST['active']== md5('restart_chat'))
	{
		if(restartApi()) echo 'rs_ok';
		else echo 'rs_fall';
	}
	else if($_POST['active']== 'reset')
	{
		$_SESSION['perv_cp_num'] = 1;
		$_SESSION['cp_over'] = 'begin';
	}
}
else
{
	exit;
}

?>