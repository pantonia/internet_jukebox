<?php

$lang['title'] = 'Free PHP Chat Module - Add a chat room to your PHP website - Seamless Integrate 123 Flash Chat Software with PHP Website';
$lang['select_mode_free'] = 'Chat server hosted by 123flashchat free of charge';
$lang['select_mode_host'] = 'Chat server hosted by 123flashchat';
$lang['select_mode_local'] = 'Chat server hosted by your own';
$lang['select_mode_3rd'] = 'Use the professional 3rd part module';
$lang['fill_room_name'] = 'Please fill the parameter of room name in the following blank';
$lang['param_room_name'] = 'Room Name';
$lang['fill_host_address'] = 'Please fill the parameter of host address in the following blank';
$lang['param_host_address'] = 'Chat Client Location:';
$lang['fill_local_address'] =  'Please fill the parameter of local chat server installed directory in the following blank';
$lang['param_local_address'] = 'Chat Client Path:';
$lang['enable_integration'] = 'Do you want to integrate with your database.';
$lang['select_integration_mode'] = 'Please select integration mode.';
$lang['set_db_tip'] = 'Please  configure the database connecting parameters.';
$lang['3rd_part_tip'] = '123 Flash Chat can seamlessly integrate your website or database like Joomla, phpBB, vBulletin, etc. Please select website integration module.';
$lang['install_cancel'] = 'Notice: Sice you select 3rd part module,  it is not necessary for you to install PHP Chat';
$lang['select_db'] = 'Please select your database type';
$lang['move_file_s1'] = ' I want copy it by myself';
$lang['move_file_s1_tip'] = ' Notice: Please have a look at "Configure Instruction" part';
$lang['move_file_s2'] = ' I want to copy it automatically';
$lang['move_file'] = 'Please copy the client folder from chat installed directory';
$lang['login_chat'] = 'Please follow the instruction to integrate user data into your chat admin panel';
$lang['restart_chat'] = 'Please restart your chat server';
$lang['restart_chat_s1'] = 'Auto restart the server';
$lang['restart_chat_s2'] = 'I want to restart it by myself';
$lang['restart_chat_s2_tip'] = 'Please have a look at "configure instruction"';


//--------------------------------error meg--------------------------
$lang['install_error'] = 'PHP Chat install is not successful';
$lang['error_free_room_name'] = 'Please enter chat room name';
$lang['error_host_address'] = 'Please verify your chat host address';
$lang['error_local_server_address'] = 'Please enter a correct local chat server installed path';
$lang['error_local_server_xml'] = ', the file does not exist';
$lang['error_mkdir_configure'] = 'configure folder does not exist';
$lang['error_config_writable'] = 'phpchat/configure/config.php is not writeable';
$lang['error_install_writable'] = 'phpchat/install is not writeable';
$lang['error_local_server_xml_writable'] = ', the file is not writeable';
$lang['error_full_db_param'] = 'Please verify database parameter';
$lang['error_php_module'] = ' module is not loaded in php.ini, so you can not use the database module';
$lang['error_db_table'] = 'User list table does not exist, please make sure the value of table name, Username field, Password field are correct.';
$lang['reinstall_other_mode'] = 'Reinstall with other modes';


//----------------------------------tip word-------------------------------------
$lang['tip_room_name'] = 'Fill in your favorable room name and click "next" to complete installation';
$lang['tip_host_address'] = 'http://yourHostServerAddress/yourHostName/';
$lang['tip_local_address'] = 'http://&lt;123 Flash Chat server&gt;:35555/, for example: http://www.example.com:35555/';							
$lang['tip_integration_yes'] = 'Integrate with database';
$lang['tip_integration_no'] = 'Not integrate with database';
$lang['tip_integration_mode'] = 'Please select integration mode.';
$lang['tip_integration_db'] = 'Please select database type';
$lang['tip_param_db_host'] = 'You need to fill in your database host server ip address. If the database is installed on your local machine, please fill in with "localhost"';	
$lang['tip_param_db_port'] = 'You need to fill in your database host server port. If you are using default port, please leave it blank';
$lang['tip_param_db_name'] = 'You need to fill in database name.';
$lang['tip_param_db_username'] = 'You need to fill in the database username which is allowed to access the database. ';	
$lang['tip_param_db_password'] = 'You need to fill in the database password which is allowed to access the database. ';
$lang['tip_param_db_user_table'] = 'You need to fill in database user list table name of the integrated website.';	
$lang['tip_param_uesrname_field'] = 'You need to fill in its relevant username table name stored in the user list.';
$lang['tip_param_pw_field'] = ' You need to fill in its relevant password table name stored in the user list.';
$lang['tip_param_enablemd5'] = 'This item provides Encryption judgement. In your database, if the user password is encrypted with md5, you should set this item "on". Only do this can it identify he user password is encrypted with md5. If your encryption is not md5 or there is addtional salt parameter, you should go to the API to add your own encryption function.';




//----------------------------------instruction-------------------------------------


$lang['instruction_title'] = 'Installation Complete';
$lang['instruction_content'] = <<<END
    Congratulations! Your PHP Chat installation is now complete!
END;


$lang['instruction_title_setup'] = 'Select your website system:';
$lang['instruction_content_setup'] = <<<END
If your website comply with the cms, forum,.etc and its type is included in modules selection lists, we recommend you to use 3rd party module for integration because the particular 3rd party module can save your efforts in integration.
END;


$lang['instruction_others_t'] = 'Select Chat Server Mode';
$lang['instruction_others_c'] = <<<END
The PHP Chat need a java chat server, it offers you 3 mode to meet your different requirements for your website chat room.

1) <strong>Chat server hosted by your own.</strong>
 Please download and install 123FlashChat Server first, we provide Windows/Linux/Mac system packages. 
 <a href="http://www.123flashchat.com/download.html" target="_blank">http://www.123flashchat.com/download.html</a>.

2) <strong>Chat server hosted by 123flashchat.</strong>
 Please purchase a host from 123flashchat: <a href="http://www.123flashchat.com/host.html" target="_blank">http://www.123flashchat.com/host.html</a>
 Or apply a 15 days trial host here: <a href="http://www.123flashchat.com/host/apply.php" target="_blank">http://www.123flashchat.com/host/apply.php</a>

3) <strong>Chat server hosted by 123flashchat free of charge.</strong>
This chat server mode aims at testing the basic functions, only supported 1 room, no video chat function, you can select the mode 1 or 2 to get the full functions and control your chat room. 

END;

$lang['instruction_param_conf'] = 'Configure Instruction';
$lang['instruction_param_conf_free'] = <<<END
 This chat server mode aims at testing the basic functions, only supported 1 room, no video chat function, and also you don't have the administrator permission of entering this chat room, you can select the mode <strong>Chat server hosted by 123flashchat</strong> or <strong>Chat server hosted by your own</strong> to get the full functions and control your chat room.<br />
 Fill in your favorable room name and click "next" to complete installation
END;


$lang['instruction_param_conf_host'] = <<<END
<a href="http://www.123flashchat.com/host.html" target="_blank">For paid host</a>, please set the Chat Client Location like this, for example: http://host71200.123flashchat.com/phpchat/ , <a href="http://www.123flashchat.com/host.html" target="_blank">Buy host here</a>; 
<a href="http://www.123flashchat.com/host/apply.php" target="_blank">For trial host</a>, please setup Chat Client Location like this: http://trial.123flashchat.com/yourhostname/ , Just replace "yourhostname" to the real one when you applied, <a href="http://www.123flashchat.com/host/apply.php" target="_blank">Apply trial host</a>.

If you fill in it with a wrong format, you are not able to do the next operation.  
END;




$lang['instruction_param_host_inter'] = <<<END
If you select "No", it indicates that you don\'t want to integrate with database. The chat room and user information will be stored into our database. If the user want to log in chat room, he or she must register with new id or log in with guest.

If you select "yes", it indicates that you want to integrate with the website database and you have to configure the following items.
END;




$lang['instruction_param_conf_local'] = <<<END
 Please download and install 123FlashChat first: <a href="http://www.123flashchat.com/download.html" target="_blank">http://www.123flashchat.com/download.html</a>

 We recommend you to use the version contain JRE
Chat Client Path format should be as below
http://www.example123.com:35555/

If you fill in it with a wrong format, you are not able to do the next operation. 
END;

$lang['instruction_local_move_file']= <<<END
1), Please select the way how to copy the chat client. We recommend you copy the chat client not automatically but manually, because it really takes time by script! 

    Manually copy mode: search for 123 Flash Chat installation directory and copy the client files to the PHP Chat installation directory. 

2), Please select the way of restarting the 123 Flash Chat server. Auto-start is only available to the version 7.4 or higher version.

Manually restart method:
Windows: search for 123 Flash Chat installation directory, you will see the restart.bat under the server folder, double click it.
Linux: search for 123 Flash Chat installation directory, find the fcserver.sh under the server folder,
			 then type command "./fcserver.sh restart" and press "Enter" with root account.
END;


?>