<?php

$flag = array();
$modifiedflag = array();
$parentarray = array();
$assignment = array();
$weight = array();
$flagweight = array();
$notallowed = array('+', '-', '*', '!', '%', '^', '&', '(', ')', '=', '/', ';', '&&', '||', '&', '|', '\'', '!', ',', '"', '>', '<', '{', '}' );
$reserved = array('array', 'int', 'integer', 'double', 'float', 'static', 'global', 'string', 'fopen', 'fgetc', 'NULL', 'new', 'true', 'false');
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
	global $notallowed;
	global $reserved;
	global $parentarray;
	global $assignment;
	global $weight;
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
							'target' => $child);
				if($child != '' and !(in_array($child, $reserved)) and !(is_numeric($child)) and(!(in_array($input, $parentarray))) and($child != $parent) ) {
					array_push($parentarray, $input);
					$weight[$parent] = 0;
					$weight[$child] = 0;
				}else if(is_numeric($child)){
					$flag = 0;
					foreach ($assignment as $key => $value) {
						if($value == $parent){
							$flag = 1; break;
						}
					}
					if($flag == 0) array_push($assignment, $parent);
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
function parsenewdata($haystack){
	$notallowedx = array( '!', '%', '^', '(', ')', '=', ';', '&&', '||', '&', '\'', '!', ',', '"', '>', '<', '{', '}' );
	global $notallowed;
	global $reserved;
	global $parentarray;
	global $assignment;
	global $weight;
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
							'target' => $child);
				if($child != '' and !(in_array($child, $reserved)) and !(is_numeric($child)) and(!(in_array($input, $parentarray))) and($child != $parent) ) {
					array_push($parentarray, $input);
					$weight[$parent] = 0;
					$weight[$child] = 0;
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

function insertweight($variable, $cost){
	global $flagweight;
	global $parentarray;
	global $weight;
	$weight[$variable] = bcadd($cost, $weight[$variable], 5);
	$flagweight[$variable] = 1;
	foreach ($parentarray as $key => $value) {
		if($value['target'] == $variable){
			if (!(array_key_exists($value['source'], $flagweight)))
				insertweight($value['source'], bcdiv($cost, 2, 5));
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
	parsenewdata($line);
}

for ($i=0; $i < count($modified); $i++) {
	if(strchr($modified[$i], '=')) parse($modified[$i]);
}

for($i=0; $i< count($assignment); $i++){
	if (array_key_exists($assignment[$i], $weight)){
		$weight[$assignment[$i]] = bcadd(1, $weight[$assignment[$i]], 5);
		$flagweight[$assignment[$i]] = 1;
		foreach ($parentarray as $key => $value) {
			if($value['target'] == $assignment[$i]){
				if (!(array_key_exists($value['source'], $flagweight)))
					insertweight($value['source'], bcdiv(1, 2, 5));
			}
			$flagweight = array();
		}
	}
}

$graph = array();
foreach ($parentarray as $key => $value) {
	if($weight[$value['source']] > 0 and $weight[$value['target']] > 0){
		$newnode = array('source' => $value['source']." ( ".trim($weight[$value['source']], '0')." )",
				'target' => $value['target']." ( ".trim($weight[$value['target']], '0')." )",
				'type' => 'suit');
		array_push($graph, $newnode);
	}
}
	
echo json_encode($graph);
?>