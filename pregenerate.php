<?php

$flag = array();
$modifiedflag = array();
$parentarray = array();
$weight = array();
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
	$notallowedx = array( '!', '%', '^', '(', ')', '=', ';', '&&', '||', '&', '\'', '!', ',', '"', '>', '<', '{', '}' );
	$notallowed = array('+', '-', '*', '!', '%', '^', '&', '(', ')', '=', '/', ';', '&&', '||', '&', '|', '\'', '!', ',', '"', '>', '<', '{', '}' );
	$reserved = array('array', 'int', 'integer', 'double', 'float', 'static', 'global', 'string', 'fopen', 'fgetc', 'NULL', 'new', 'true', 'false');
	global $parentarray;
	$parent = '';
	$child = '';
	for ($i=0; $i < strlen($haystack); $i++) {
		if($haystack[$i] == '/' and $haystack[$i+1] == '/' ) break;
		if($haystack[$i] == '=' and $haystack[$i+1]!='=' and !(in_array($haystack[$i-1], $notallowedx)) ){
			$j = $i - 1 ;
			while($haystack[$j] ==' ' or $haystack[$j] =='+' or $haystack[$j] =='-' or $haystack[$j] =='/' or $haystack[$j] =='*' or $haystack[$j] =='%') $j--;
			while($haystack[$j] != ' ' and !(in_array($haystack[$j], $notallowed)) ){
				$parent = $haystack[$j].$parent;
				$j--;
				if($j < 0 ) break;
			}$i++;
			$parent = trim($parent);
			while($haystack[$i] != ';' and $haystack[$i] != ','){
				while($haystack[$i] == ' 'and $i< strlen($haystack)) $i++;
				while($haystack[$i] != ' ' and !(in_array($haystack[$i], $notallowed)) ){
					$child = $child.$haystack[$i];
					$i++;
					if($i >= strlen($haystack) - 1) break;
				}
				$input = array('source' => $parent,
							'target' => $child,
							'type' => 'suit');
				if($child != '' and !(in_array($child, $reserved)) and !(is_numeric($child)) and(!(in_array($input, $parentarray))) and($child != $parent) ) {
					array_push($parentarray, $input);
				}
				if($haystack[$i] == ';' or $haystack[$i] == ',') break;
				$child = '';
				$i++;
				if($i >= strlen($haystack) - 2) break;
			}
			$child = ''; $parent = '';
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

echo "<label>Filename : <i>".$file."</i></label><br><br> <div class='graph' ></div>";
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
for ($i=0; $i < count($modified); $i++) {
	if(strchr($modified[$i], '=')) parse($modified[$i]);
}

if( count($parentarray) > 0 ) echo "<button class='btn btn-default next' data-file='".$file."'>Generate</button>";
else echo "No assignment statements modified since last build.";
?>