<?php

if(empty($_POST['tipname'])||empty($_POST['tipid'])) exit;
include("../theme/language/en/language.php");
echo $_POST['tipid']."<!-|||->";
switch ($_POST['tipname'])
{
	case 'select_mode_free': echo  $lang['tip_free'];
	break;
	case 'select_mode_host': echo $lang['tip_host'];
	break;
	case 'select_mode_local': echo $lang['tip_local'];
	break;
	case 'select_mode_3rd': echo $lang['tip_3rd'];
	break;
	case 'param_room_name': echo $lang['tip_room_name'];
	break;
	case 'param_host_address': echo $lang['tip_host_address'];
	break;
	case 'param_local_address': echo $lang['tip_local_address'];
	break;
	case 'integration_yes': echo 	$lang['tip_integration_yes'];
	break;
	case 'integration_no': echo 	$lang['tip_integration_no'];
	break;
		
	case 'integration_select_mode':echo $lang['tip_integration_mode'];
	break;
	case 'integration_select_db':echo $lang['tip_integration_db'];
	break;


	case 'param_db_host':echo $lang['tip_param_db_host'];
	break;
	case 'param_db_port':echo $lang['tip_param_db_port'];
	break;
	case 'param_db_name':echo $lang['tip_param_db_name'];
	break;
	case 'param_db_username':echo $lang['tip_param_db_username'];
	break;
	case 'param_db_password':echo $lang['tip_param_db_password'];
	break;
	case 'param_db_user_table':echo $lang['tip_param_db_user_table'];
	break;
	case 'param_uesrname_field':echo $lang['tip_param_uesrname_field'];
	break;
	case 'param_pw_field':echo $lang['tip_param_pw_field'];
	break;
	case 'enablemd5':echo $lang['tip_param_enablemd5'];
	break;
}
?>