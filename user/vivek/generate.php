<?php

$flag = array();
$modifiedflag = array();
$parentarray = array();
function inside_array($needle, $haystack, $number){
	global $flag, $modifiedflag;
	for ($i=0; $i < count($haystack); $i++) { 
		if($haystack[$i] == $needle){
			if(!(in_array($i, $flag))){
				array_push($flag, $i);
				return true;
			}
		}
	}
	array_push($modifiedflag, $number);
	return false;
}
function parse($haystack){
	$notallowed = array('+', '-', '*', '!', '%', '^', '&', '(', ')', '=', '+=', '-=', '*=', '/=', '/', ';', '&&', '||', '&', '|' );
	global $parentarray;
	$parent = '';
	$child = '';
	for ($i=0; $i < strlen($haystack); $i++) { 
		if($haystack[$i] == '=' and $haystack[$i+1]!='='){
			$j = $i;
			while($haystack[$j] ==' ' or $haystack[$i] =='+' or $haystack[$i] =='-' or $haystack[$i] =='/' or $haystack[$i] =='*' or $haystack[$i] =='%') $j--;
			while($haystack[$j] != ' ' and $j>-1){
				$parent = $haystack[$j].$parent;
				$j--;
			}$i++;
			while($haystack[$i] != ';' and $i< strlen($haystack)){
				while($haystack[$i] == ' 'and $i< strlen($haystack)) $i++;
				while($haystack[$i] != ' ' and $haystack[$i] != ';' and $i < strlen($haystack)){
					$child = $child.$haystack[$i];
					$i++;
				}
				array_push($parentarray, $child."=>".$parent);
				$child = '';
			}
		}
	}
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

// echo "<h1 class='page-header'>Dashboard</h1>
// 	<label>Filename : <i>".$file."</i></label><br>";
if( !(file_exists($fileversion)) ){
	die('Sorry we do not have any previous versions of the specified files to compare with.');
}

$olddata = array();
$data = file($fileversion);
foreach ($data as $number => $line) {
	array_push($olddata, str_replace('<', '&lt;', $line));
}

$modified = array();
$data = file($fileoriginal);
foreach ($data as $number => $line) {
	if( !(inside_array(str_replace('<', '&lt;', $line), $olddata, $number)) ){
		array_push($modified, str_replace('<', '&lt;', $line));
	}
}

echo "<code>";
if(count($modified) == 0) die('No modifications since last build');
for ($i=0; $i < count($modified); $i++) {
	echo $modifiedflag[$i].": ".$modified[$i]."<br>";
	if(strchr($modified[$i], '=')) parse($modified[$i]);
}
echo "</code>";

?>