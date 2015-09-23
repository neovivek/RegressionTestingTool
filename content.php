<?php

$flag = array();
$modifiedflag = array();
function inside_array($needle, $haystack, $number){
	global $flag, $modifiedflag;
	for ($i=0; $i < count($haystack); $i++) {
		if($haystack[$i] == $needle and !(in_array($i, $flag))){
			array_push($flag, $i);
			return true;
		}
	}
	array_push($modifiedflag, $number);
	return false;
}

session_start();
if( !(isset($_SESSION['user'])) ) header('Location: /');
$USER = $_SESSION['user'];
if( !(isset($_REQUEST['file'])) || $_REQUEST['file']=='' ) die('Can\'t Process Request');
$file = $_REQUEST['file'];

$path = dirname( __FILE__ );
$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
define( 'BASE_DIR', $path . $slash . 'user' . $slash );
$folder  = $USER;
$dirPath = BASE_DIR . $folder . '_1' ;

$name = explode('.', $file);
$extension = pathinfo($file, PATHINFO_EXTENSION);

$fileoriginal = BASE_DIR.$folder.$slash.$file;
$fileversion = $dirPath.$slash.$name[0].'_1.'.$extension;

echo "<label>Filename : <i>".$file."</i></label><br><br>";
if( !(file_exists($fileversion)) ){
	die('Sorry we do not have any previous versions of the specified files to compare with.');
}

$olddata = array();
$data = file($fileversion);
foreach ($data as $number => $line) {
	array_push($olddata, $line);
}

$modified = array();
$data = file($fileoriginal);
foreach ($data as $number => $line) {
	if( !(inside_array($line, $olddata, $number)) ){
		array_push($modified, $line);
	}
}

if(count($modified) == 0) die('No modifications since last build');
echo "<label>Modifications since last build</label><br><br>";
echo "<code>";
for ($i=0; $i < count($modified); $i++) {
	echo bcadd(1, $modifiedflag[$i]).": ".str_replace('<', '&lt;', $modified[$i])."<br>";
}
echo "</code>";

?>