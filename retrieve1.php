<?php

session_start();
if(isset($_SESSION['user'])) $USER = $_SESSION['user'];
else die('Can\'t Process Request. Please fill in Username or Project Name first.');
if($USER == 'undefined' || $USER == '') die('Can\'t process request. Please fill in username first.');
if(!(isset($_SESSION['user'])) ){
	$_SESSION['user'] = $USER;
}
$path = dirname( __FILE__ );
$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
define( 'BASE_DIR', $path . $slash . 'user' . $slash );

$folder  = $USER;
$dirPath = BASE_DIR . $folder;

if(!(file_exists($dirPath)) ){
	die('Can\'t process request right now');
}

$dh  = opendir($dirPath);
$count = 0;
while (false !== ($filename = readdir($dh))) {
	if($count < 2){
		$count ++ ;
		continue;
	}
    echo "
	<div class='radio'>
	  <label>
	    <input type='radio' class='genrep' name='".$filename."' id='".$filename."' value='".$filename."'>
	    ".$filename."
	  </label>
	</div>";
}

?>