/*
//================================================================================
* phphq.Net Custom PHP Scripts *
//================================================================================
:- Script Name: phUploader
:- Version: 1.3
:- Release Date: June 23rd  2004
:- Last Updated: Jan 23 2010
:- Author: Scott Lucht <scott@phphq.net> http://www.phphq.net
:- Copyright (c) 2010 All Rights Reserved
:-
:- This script is free software; you can redistribute it and/or modify
:- it under the terms of the GNU General Public License as published by
:- the Free Software Foundation; either version 2 of the License, or
:- (at your option) any later version.
:-
:- This script is distributed in the hope that it will be useful,
:- but WITHOUT ANY WARRANTY; without even the implied warranty of
:- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
:- GNU General Public License for more details.
:- http://www.gnu.org/licenses/gpl.txt
:-
//================================================================================
* Description
//================================================================================
:- phUploader is a script for uploading single or multiple images or files to your website. You can specify your 
:- own file extensions that are accepted, the file size and naming options. This script was built and tested on 
:- IIS6/7 and Apache 2+. It's recommended to use php 5.1+ This script is very useful for temporary file
:- storage or simple sig and avatar hosting.
//================================================================================
* Setup
//================================================================================
:- To setup this script, upload phUploader.php to a folder on your server. Create a new folder named uploads
:- and chmod it to 777. Edit the variables below to change how the script acts. Please read the notes if you
:- don't understand something.
//================================================================================
* Change log
//================================================================================
:- Version 1.0
:-		1) Initial Release
:-		
:- Version 1.1
:-		1) Minor bug fixes
:-		2) Enabled multiple file uploads
:-		
:- Version 1.2
:-		1) Added CSS styling
:-		2) Removed automatic creation of file upload folder.
:-		3) Improved cookie security by hashing password and storing it within the cookie for authentication.
:-		4) Minor bug fixes
:-		
:- Version 1.3
:-		1) Re-write of many core functions to increase security.
:-		2) Patched a vulnerability that allowed a remote attacker to upload a file with two extensions and then
:-			remotely execute the script on a vulnerable web server. <http://www.securityfocus.com/bid/25405>
:-		3) New feature allows files that pass validation to be uploaded while files that fail validation are not
:-			uploaded without rejecting to whole group of files.
:-		4) Fixed a flaw that allowed files with blank names or un-sanitized names to be uploaded which may
:-			cause issues for some users.
:-		5) Minor bug fixes
:-		
//================================================================================
* Frequently Asked Questions
//================================================================================
:- Q1: I always get an error that the files were not uploaded. IE: GENERAL ERROR
:-		1) Make sure you have CHMOD your "uploads" folder to 777 using your FTP client or similar. If you do
:-			 not know how to do this ask your hosting provider.
:-		2) Make sure the uploads folder actually exists. This is the second most common mistake aside from
:-			 improper permissions.
:-		3) If you are having problems uploading after you have chmod the uploads folder 777, try using the
:-			 full server path in $fullpath below. If you do not know this ask your host.
:-		4) Make sure "file_uploads" is set to ON in php.ini
:-
:- Q2: The page takes long to load and then gives me a page cannot be displayed or a blank page.
:-		1) This is usually due to a low value in php.ini for "max_execution_time". 
:-		2) A newer ini setting "max_file_uploads" in php 5.2.12 was added which may be limiting the number
			of simultaneous uploads.
:-		3) Your "upload_max_filesize" and "post_max_size" in php.ini might be set to low.
:-
:- Q3: How do I edit the colors of the form?
:-		1) You will need to edit the CSS near the bottom of the script to change the looks and colors of the form.
:-			Check http://www.w3schools.com/css/default.asp for more information on CSS.
:-
:- Q4: Can I remove your copyright link?
:-		1) I can't physically stop you. However, I really appreciate it when people leave it intact.
:-			Some people donate $5, $10, $20 to take it off.
:-
:- Q5: You never respond to my emails or to my questions in your forums!
:-		1) I'm a very busy guy. I'm out of town a lot, and at any given time I have several projects going on.
:-			I get a lot of emails about this script, not to mention my other ones.
:-		2) I only understand English. If your English is very bad please write in your native language and then
:-			translate it to English using <http://babelfish.altavista.com/babelfish/tr>.
:-		3) If you are going to contact me, describe the issue you are having as completly as possible.
:-			"dude me form don't work see it at blah.com what's wrong??!?!" will get no response, ever. Write
:-			in detail what the problem is. Spend a minute on it, and maybe I'll take some of my time to reply.
:-
/*
//================================================================================
* ! ATTENTION !
//================================================================================
:- Please read the above FAQ before giving up or emailing me. It may sort out your problems!
*/