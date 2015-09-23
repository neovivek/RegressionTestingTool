<?php

 //  *************************************************************
  //   *                                                           *
  //    *               Created By VIVEK MALASI                     *
  //     *               Conceptualised by SHUBHAM NEHRA             *
  //      *                                                           *
  //       *                                                           *
  //        *************************************************************

    
$flag = array();
$modifiedflag = array();
$parentarray = array();
$assignment = array();
$assignmentindex = array();
$absoluteassignment = array();
$weight = array();
$flagweight = array();
$defination = array();
$useage = array();
$notallowedx = array( '!', '%', '^', '(', ')', '=', ';', '&&', '||', '&', '\'', '!', ',', '"', '>', '<', '{', '}' );
$notallowed = array('+', '-', '*', '!', '%', '^', '&', '(', ')', '=', '/', ';', '&&', '||', '&', '|', '\'', '!', ',', '"', '>', '<', '{', '}' );
$reserved = array('array', 'int', 'integer', 'double', 'float', 'static', 'global', 'string', 'fopen', 'fgetc', 'NULL', 'new', 'true', 'false');
$alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '_', '&');
$WC = $NB = $NLW = $WNLT = 0;
$conditionalarray = array();
$recursive = array();
$useageWC = array();
$useageNLW = array();
$useageWNLT = array();
$useageNB = array();
$useageWPU = array();
$ud = array();
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

function parse($haystack, $linenumber){
	global $notallowed;
	global $reserved;
	global $parentarray;
	global $assignment;
	global $weight; 
	global $defination;
	global $useage;
	global $notallowedx;
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

  //  *************************************************************
  //   *                                                           *
  //    *               Created By VIVEK MALASI                     *
  //     *               Conceptualised by SHUBHAM NEHRA             *
  //      *                                                           *
  //       *                                                           *
  //        *************************************************************

function parsenewdata($haystack, $linenumber){
	global $notallowed;
	global $notallowedx;
	global $reserved;
	global $parentarray;
	global $assignment;
	global $weight; 
	global $defination;
	global $useage;
	global $absoluteassignment;
	global $assignmentindex;
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
			array_push($defination, array('var' => $parent, 'line' => $linenumber));
			while($haystack[$i] != ';' and $haystack[$i] != ','){
				while($haystack[$i] == ' 'and $i< strlen($haystack)) $i++;
				while($haystack[$i] != ' ' and !(in_array($haystack[$i], $notallowed)) ){
					$child = $child.$haystack[$i];
					$i++;
					if($i >= strlen($haystack) - 1) break;
				}
				if(!(in_array($linenumber, $absoluteassignment)) and !(is_numeric($child))) array_push($absoluteassignment, $linenumber);
				$input = array('source' => $parent,
							'target' => $child);
				if($child != '' and !(in_array($child, $reserved)) and !(is_numeric($child)) and(!(in_array($input, $parentarray))) and($child != $parent) ) {
					array_push($parentarray, $input);
					$weight[$parent] = 0;
					$weight[$child] = 0;
				}
				if(is_numeric($child)) 
					if(!(in_array($linenumber, $assignmentindex))) array_push($assignmentindex, $linenumber);
				array_push($useage, array('var' => $child, 'line' => $linenumber));
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
			if (array_key_exists($value['source'], $flagweight)) continue;
			insertweight($value['source'], bcdiv($cost, 2, 5));
		}
	}
}
function find($haystack, $nest, $index, $value){
	global $conditionalarray;
	global $useageWC;
	global $modifiedflag;
	global $useageNLW;
	global $recursive;
	global $absoluteassignment;
	global $useageWNLT;
	global $notallowed;
	global $useageNB;
	global $alphabet;
	$ud = array();
	$loop = 0;
	$condition = 0;
	$lc = 0;
	for($i=$index; $i<count($haystack); $i++){
		$useageWC[$i] = $value;
		$useageNLW[$i] = $nest;
		$useageNLW[$i] = pow(10, 1-$useageNLW[$i]);
		$useageWNLT[$i] = $lc;
		$bool=0;
		if(strchr($haystack[$i], '&&')) $bool++;
		if(strchr($haystack[$i], '||')) $bool++;
		if(strchr($haystack[$i], '^')) $bool++;
		if(strchr($haystack[$i], '!') and !(strchr($haystack[$i], '!='))) $bool++;
		$useageNB[$i] = $bool;
		if(in_array($i, $absoluteassignment)){
			if($loop) $useageWNLT[$i] = bcadd($useageWNLT[$i], 2.5, 2);
			else if($useageNLW[$i] == 1 and in_array('main', $conditionalarray) ) $useageWNLT[$i] = bcadd($useageWNLT[$i], 3, 2);
		}
		if(strchr($haystack[$i], 'main') and !(in_array($haystack[$i][strpos($haystack[$i], 'main') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'main') + 4], $alphabet))){
			$value = bcadd($value, 0, 2);
			$nest ++;
			array_push($conditionalarray, 'main');
		}else if(strchr($haystack[$i], 'if')  and !(in_array($haystack[$i][strpos($haystack[$i], 'if') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'if') + 2], $alphabet))){
			$value = bcadd($value, 1, 2);
			$nest ++;
			array_push($conditionalarray, 'if');
			if($loop) $lc = bcadd($lc, 1, 2);
			if($condition) $lc = bcadd($lc, 2, 2);
			$condition++;
		}else if(strchr($haystack[$i], 'switch') and !(in_array($haystack[$i][strpos($haystack[$i], 'switch') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'switch') + 6], $alphabet))){
			$value = bcadd($value, 0.5, 2);
			$nest ++;
			array_push($conditionalarray, 'switch');
			if($loop) $lc = bcadd($lc, 1, 2);
			if($condition) $lc = bcadd($lc, 2, 2);
			$condition++;
		}else if(strchr($haystack[$i], 'while') and !(strchr($haystack[$i], ';')) and !(in_array($haystack[$i][strpos($haystack[$i], 'while') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'while') + 5], $alphabet))){
			$value = bcadd($value, 0.1, 2);
			$nest ++;
			array_push($conditionalarray, 'while');
			if($loop) $lc = bcadd($lc, 0.5, 2);
			if($condition) $lc = bcadd($lc, 1.5, 2);
			$loop++;
		}else if(strchr($haystack[$i], 'do') and !(in_array($haystack[$i][strpos($haystack[$i], 'do') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'do') + 2], $alphabet))){
			$value = bcadd($value, 0.11, 2);
			$nest ++;
			array_push($conditionalarray, 'do');
			if($loop) $lc = bcadd($lc, 0.5, 2);
			if($condition) $lc = bcadd($lc, 1.5, 2);
			$loop++;
		}else if(strchr($haystack[$i], 'for') and !(in_array($haystack[$i][strpos($haystack[$i], 'for') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'for') + 3], $alphabet))){
			$value = bcadd($value, 0, 2);
			$nest ++;
			array_push($conditionalarray, 'for');
			if($loop) $lc = bcadd($lc, 0.5, 2);
			if($condition) $lc = bcadd($lc, 1.5, 2);
			$loop++;
		}else if(strchr($haystack[$i], 'else') and !(in_array($haystack[$i][strpos($haystack[$i], 'else') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'else') + 4], $alphabet))){
			$value = bcadd($value, 0, 2);
			$nest ++;
			array_push($conditionalarray, 'else');
			if($loop) $lc = bcadd($lc, 1, 2);
			if($condition) $lc = bcadd($lc, 2, 2);
			$condition++;
		}else if(strchr($haystack[$i], '(') and strchr($haystack[$i], ')')  and !(strchr($haystack[$i], ';'))){
			$j = 0; $userdefined = '';
			while($haystack[$i][$j] != '(') $j++; $j--;
			while($haystack[$i][$j] == ' ') $j--;
			while($haystack[$i][$j] != ' ' and $haystack[$i][$j] != '\t' and !(in_array($haystack[$i][$j], $notallowed)) and $j>0){
				$userdefined = $haystack[$i][$j].$userdefined;
				$j--;
			}
			if(!(in_array($userdefined, $ud))){
				$flag[$userdefined] = 1;
				array_push($conditionalarray, $userdefined);
				if(array_key_exists($userdefined, $recursive)){
					if($recursive[$userdefined] == 1) $value = bcadd($value, 0.01, 2);
				}
				$nest ++;
			}
			$userdefined = '';
		}
		if($i >= count($haystack)) return count($haystack);
		if(strchr($haystack[$i], '}')){
			$t = end($conditionalarray);
			if($t == 'main'){
				$value = bcsub($value, 0, 2);
				$nest --;
			}else if($t == 'if'){
				$value = bcsub($value, 1, 2);
				$nest --;
				$condition--;
				if($loop) $lc = bcsub($lc, 1, 2);
				if($condition) $lc = bcsub($lc, 2, 2);
			}else if($t == 'switch'){
				$value = bcsub($value, 0.5, 2);
				$nest --;
				$condition--;
				if($loop) $lc = bcsub($lc, 1, 2);
				if($condition) $lc = bcsub($lc, 2, 2);
			}else if($t == 'while'){
				$value = bcsub($value, 0.1, 2);
				$nest --;
				$loop--;
				if($loop) $lc = bcsub($lc, 0.5, 2);
				if($condition) $lc = bcsub($lc, 1.5, 2);
			}else if($t == 'do'){
				$value = bcsub($value, 0.11, 2);
				$nest --;
				$loop--;
				if($loop) $lc = bcsub($lc, 0.5, 2);
				if($condition) $lc = bcsub($lc, 1.5, 2);
			}else if($t == 'for'){
				$value = bcsub($value, 0, 2);
				$nest --;
				$loop--;
				if($loop) $lc = bcsub($lc, 0.5, 2);
				if($condition) $lc = bcsub($lc, 1.5, 2);
			}else if($t == 'else'){
				$value = bcsub($value, 0, 2);
				$nest --;
				$condition--;
				if($loop) $lc = bcsub($lc, 1, 2);
				if($condition) $lc = bcsub($lc, 2, 2);
			}else{
				if(array_key_exists($t, $recursive)) $value = bcsub($value, 0.01, 2);
				$nest --;
			}
			end($conditionalarray);
			unset($conditionalarray[key($conditionalarray)]);
			if($nest==1 and in_array('main', $conditionalarray)) $value = 0; 
		}
	}
}

  //  *************************************************************
  //   *                                                           *
  //    *               Created By VIVEK MALASI                     *
  //     *               Conceptualised by SHUBHAM NEHRA             *
  //      *                                                           *
  //       *                                                           *
  //        *************************************************************

function recursion($haystack){
	$conditionalarray = array();
	global $ud;
	global $recursive;
	global $notallowed;
	global $alphabet;
	$flag = array();
	for ($i=0; $i < count($haystack); $i++) {

		if(strchr($haystack[$i], 'main') and !(in_array($haystack[$i][strpos($haystack[$i], 'main') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'main') + 4], $alphabet))){
			array_push($conditionalarray, 'main');
		}else if(strchr($haystack[$i], 'if') and !(in_array($haystack[$i][strpos($haystack[$i], 'if') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'if') + 2], $alphabet))){
			array_push($conditionalarray, 'if');
		}else if(strchr($haystack[$i], 'switch') and !(in_array($haystack[$i][strpos($haystack[$i], 'switch') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'switch') + 6], $alphabet))){
			array_push($conditionalarray, 'switch');
		}else if(strchr($haystack[$i], 'while') and !(strchr($haystack[$i], ';')) and !(in_array($haystack[$i][strpos($haystack[$i], 'while') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'while') + 5], $alphabet))){
			array_push($conditionalarray, 'while');
		}else if(strchr($haystack[$i], 'do') and !(in_array($haystack[$i][strpos($haystack[$i], 'do') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'do') + 2], $alphabet))){
			array_push($conditionalarray, 'do');
		}else if(strchr($haystack[$i], 'for') and !(in_array($haystack[$i][strpos($haystack[$i], 'for') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'for') + 3], $alphabet))){
			array_push($conditionalarray, 'for');
		}else if(strchr($haystack[$i], 'else') and !(in_array($haystack[$i][strpos($haystack[$i], 'else') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'else') + 4], $alphabet))){
			array_push($conditionalarray, 'else');
		}else if(strchr($haystack[$i], '(') and strchr($haystack[$i], ')') ){
			$j = 0; $userdefined = '';
			while($haystack[$i][$j] != '(') $j++; $j--;
			while($haystack[$i][$j] == ' ') $j--;
			while($haystack[$i][$j] != ' ' and !(in_array($haystack[$i][$j], $notallowed))){
				$userdefined = $haystack[$i][$j].$userdefined;
				$j--;
				if($j < 0) break;
			}
			preg_replace('/\t\t+/', '', $userdefined);
			if(!(in_array($userdefined, $ud)) and !(strchr($haystack[$i], ';'))){
				$flag[$userdefined] = 1;
				array_push($conditionalarray, $userdefined);
				array_push($ud, $userdefined);
			}else{
				if(array_key_exists($userdefined, $flag)){
					if($flag[$userdefined] == 0 and !(strchr($haystack[$i], ';'))){
						$flag[$userdefined] = 1;
						array_push($conditionalarray, $userdefined);
					}else if($flag[$userdefined]){
						$recursive[$userdefined] = 1;
					}
				}
			}
			$userdefined = '';
		}
		if($i >= count($haystack)) return count($haystack);
		if(strchr($haystack[$i], '}')){
			$t = end($conditionalarray);
			if($t != 'main' and $t != 'if' and $t != 'switch' and $t != 'while' and $t != 'do' and $t != 'for' and $t != 'else'){
				$flag[$t] = 0;
			}
			end($conditionalarray);
			unset($conditionalarray[key($conditionalarray)]);
		}
	}
}
function calculatePuse($haystack){
	global $weight;
	global $useageP;
	global $useageWPU;
	global $alphabet;
	$count = 0;
	for ($i=0; $i < count($haystack); $i++) {
		$useageWPU[$i] = $count;
		if(strchr($haystack[$i], 'if') and !(in_array($haystack[$i][strpos($haystack[$i], 'if') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'if') + 2], $alphabet)) and strchr($haystack[$i], '(') and strchr($haystack[$i], ')')){
			$count++;
		}else if(strchr($haystack[$i], 'while') and !(in_array($haystack[$i][strpos($haystack[$i], 'while') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'while') + 5], $alphabet)) and strchr($haystack[$i], '(') and strchr($haystack[$i], ')')){
			$count++;
		}else if(strchr($haystack[$i], 'for') and !(in_array($haystack[$i][strpos($haystack[$i], 'for') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'for') + 3], $alphabet)) and strchr($haystack[$i], '(') and strchr($haystack[$i], ')')){
			$count++;
		}else if(strchr($haystack[$i], 'switch') and !(in_array($haystack[$i][strpos($haystack[$i], 'switch') - 1], $alphabet) or in_array($haystack[$i][strpos($haystack[$i], 'switch') + 6], $alphabet)) and strchr($haystack[$i], '(') and strchr($haystack[$i], ')')){
			$count++;
		}
	}
}	
function finalUseageCount($haystack){
	global $weight;
	global $useage;
	global $defination;
	global $absoluteassignment;
	global $alphabet;
	global $assignmentindex;
	for($i=0; $i< count($haystack); $i++){
		if(!(in_array($i, $absoluteassignment)) and !(in_array($i, $assignmentindex))){
			foreach ($weight as $key => $value) {
				if(substr_count($haystack[$i], $key) > 0){
					$index = strpos($haystack[$i], $key);
					if(!(in_array($haystack[$i][$index - 1], $alphabet) or in_array($haystack[$i][$index + strlen($key)], $alphabet))){
						array_push($useage, array('var' => $key, 'line' => $i));
					}
				}
				if(substr_count($haystack[$i], $key) > 0){
					$index = strpos($haystack[$i], $key);
					if($haystack[$i][$index-1] == '&'){
						if(in_array($haystack[$i][$index - 2], $alphabet) or in_array($haystack[$i][$index + strlen($key)], $alphabet) ) continue;
						array_push($defination, array('var' => $key, 'line' => $i));
					}
				}
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

$olddata = array();
$data = file($fileversion);
foreach ($data as $number => $line) {
	array_push($olddata, $line);
}

$modified = array();
$newdata = array();
$data = file($fileoriginal);
foreach ($data as $number => $line) {
	array_push($newdata, " ".$line);
	if( !(inside_array($line, $olddata, $number)) ){
		array_push($modified, $line);
	}
}

for ($i=0; $i < count($modified); $i++) {
	if(strchr($modified[$i], '=')) parse($modified[$i], $i);
}
for ($i=0; $i < count($newdata); $i++) { 
	if(strchr($newdata[$i], '=')) parsenewdata($newdata[$i], $i);
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

foreach ($weight as $key => $value) {
	if($value == 0) unset($weight[$key]);
}

finalUseageCount($newdata);
calculatePuse($newdata);
recursion($newdata);
find($newdata, 0, 0, 0);
$useageWT = array();
for($i=0; $i<count($newdata); $i++){
	$WMS = 1;
	if($useageWC[$i]>0) $WMS = bcmul($WMS, $useageWC[$i], 4);
	if($useageNB[$i]>0) $WMS = bcmul($WMS, $useageNB[$i], 4);
	if($useageNLW[$i]>0) $WMS = bcmul($WMS, $useageNLW[$i], 4);
	if($useageWNLT[$i]>0) $WMS = bcmul($WMS, $useageWNLT[$i], 4);
	$useageWT[$i] = $WMS;
	$WMS = 1;

}

echo "<label>Filename : <i>".$file."</i></label><br><br> <div class='graph' ></div>";
echo "<div class='container'>";
echo "<h3>Directly changed variables (DCV) & affected variables (AV) and their node weights in VDG</h3>";
echo "<table class='table table-bordered table-striped table-hover'>
    <thead>
      <tr>
        <th>Variable Name</th>
        <th>Status of variable in VDG</th>
        <th>Node weight in VDG</th>
      </tr>
    </thead>
    <tbody>";

foreach ($weight as $key => $value) {
	echo "<tr>
		<td>".$key."</td>";
		if(in_array($key, $assignment)) echo "<td>DCV</td>";
		else echo "<td>AV</td>";
	echo "<td>".trim($value, '0')."</td>
	</tr>";
}

echo "</tbody>
  </table>";

echo "<h3>List of du paths of DCV & AV</h3>";
echo "<table class='table table-bordered table-striped table-hover'>
    <thead>
      <tr>
        <th>Variable Name</th>
        <th>DU path</th>
      </tr>
    </thead>
    <tbody>";


  //  *************************************************************
  //   *                                                           *
  //    *               Created By VIVEK MALASI                     *
  //     *               Conceptualised by SHUBHAM NEHRA             *
  //      *                                                           *
  //       *                                                           *
  //        *************************************************************

sort($defination);
sort($useage);
foreach ($defination as $key => $value) {
	if(array_key_exists($value['var'], $weight) and $weight[$value['var']] > 0){
		foreach ($useage as $key1 => $value1) {
			if($value['var'] == $value1['var'] and $value1['line'] >= $value['line']){
				echo "<tr>
					<td>".$value['var']."</td>
					<td>".bcadd($value['line'], 1, 0)."-".bcadd($value1['line'], 1, 0)."</td>
				</tr>";
			}
		}
	}
}

echo "</tbody>
	</table>";


echo "<h3>Weights of different factors and WT for du paths</h3>";
echo "<table class='table table-bordered table-striped table-hover'>
    <thead>
      <tr>
        <th>Var Name</th>
        <th>DU path</th>
        <th>WC</th>
        <th>NB</th>
        <th>NLW</th>
        <th>WNLT</th>
        <th>Total Weight (WT)</th>
      </tr>
    </thead>
    <tbody>";

foreach ($defination as $key => $value) {
	if(array_key_exists($value['var'], $weight) and $weight[$value['var']] > 0){
		foreach ($useage as $key1 => $value1) {
			if($value['var'] == $value1['var'] and $value1['line'] >= $value['line']){
				echo "<tr>
					<td>".$value['var']."</td>
					<td>".bcadd($value['line'], 1, 0)."-".bcadd($value1['line'], 1, 0)."</td>";
					if($useageWC[$value1['line']] > 0) echo "<td>".$useageWC[$value1['line']]."</td>";
					else echo "<td>-</td>";
					if($useageNB[$value1['line']] > 0) echo "<td>".$useageNB[$value1['line']]."</td>";
					else echo "<td>-</td>";
					if($useageNLW[$value1['line']] > 0) echo "<td>".$useageNLW[$value1['line']]."</td>";
					else echo "<td>-</td>";
					if($useageWNLT[$value1['line']] > 0) echo "<td>".$useageWNLT[$value1['line']]."</td>";
					else echo "<td>-</td>";
				echo "<td>".$useageWT[$value1['line']]."</td>
				</tr>";
			}
		}
	}
}

echo "</tbody>
  </table>";

echo "<h3>Calculating WMS Values using WT value</h3>";
echo "<table class='table table-bordered table-striped table-hover'>
    <thead>
      <tr>
        <th>Var Name</th>
        <th>DU path</th>
        <th>Total Weight (WT.)</th>
        <th>C = 10</th>
        <th>e<sup>-WT</sup>  e=2.71828</th>
        <th>WMS</th>
      </tr>
    </thead>
    <tbody>";

$useageWMS = array();
$useageWDU = array();
foreach ($defination as $key => $value) {
	if(array_key_exists($value['var'], $weight) and $weight[$value['var']] > 0){
		foreach ($useage as $key1 => $value1) {
			if($value['var'] == $value1['var'] and $value1['line'] >= $value['line']){
				$useageWMS[$value1['line']] = bcpow(2.71828, -$useageWT[$value1['line']], 4);
				echo "<tr>
					<td>".$value['var']."</td>
					<td>".bcadd($value['line'], 1, 0)."-".bcadd($value1['line'], 1, 0)."</td>
					<td>".$useageWT[$value1['line']]."</td>
					<td>10</td>
					<td>".$useageWMS[$value1['line']]."</td>
					<td>".bcmul(10, $useageWMS[$value1['line']], 2)."</td>
				</tr>";
			}
		}
	}
}

echo "</tbody>
  </table>";

echo "<h3>WDU Values  for various du paths</h3>";
echo "<table class='table table-bordered table-striped table-hover'>
    <thead>
      <tr>
        <th>Var Name</th>
        <th>DU path</th>
        <th>WMS</th>
        <th>WPU</th>
        <th>WV</th>
        <th>WDU</th>
      </tr>
    </thead>
    <tbody>";

foreach ($defination as $key => $value) {
	if(array_key_exists($value['var'], $weight) and $weight[$value['var']] > 0){
		foreach ($useage as $key1 => $value1) {
			if($value['var'] == $value1['var'] and $value1['line'] >= $value['line']){
				$useageWDU[$value['var'].$value['line'].$value1['line']] = bcadd(bcmul(10, $useageWMS[$value1['line']], 5), bcadd(bcsub($useageWPU[$value1['line']], $useageWPU[$value['line']]), $weight[$value1['var']], 5), 2);
				echo "<tr>
					<td>".$value['var']."</td>
					<td>".bcadd($value['line'], 1, 0)."-".bcadd($value1['line'], 1, 0)."</td>
					<td>".bcmul(10, $useageWMS[$value1['line']], 2)."</td>
					<td>".bcsub($useageWPU[$value1['line']], $useageWPU[$value['line']])."</td>
					<td>".trim($weight[$value1['var']], '0')."</td>
					<td>".$useageWDU[$value['var'].$value['line'].$value1['line']]."</td>
				</tr>";
			}
		}
	}
}

echo "</tbody>
  </table>";

echo "<h3>List of du paths arranged in descending values of  WDU</h3>
	<form action='javascript: fill();' id='finalaction' class='form-group'>";
echo "<table class='table table-bordered table-striped table-hover'>
    <thead>
      <tr>
        <th>Variable Used</th>
        <th>DU path</th>
        <th>WDU</th>
        <th>Test Case Covered</th>
      </tr>
    </thead>
    <tbody>";

$latch = array();

foreach ($defination as $key => $value) {
	if(array_key_exists($value['var'], $weight) and $weight[$value['var']] > 0){
		foreach ($useage as $key1 => $value1) {
			if($value['var'] == $value1['var'] and $value1['line'] >= $value['line']){
				array_push($latch, array(
						'wdu' => $useageWDU[$value['var'].$value['line'].$value1['line']],
						'sline' => bcadd($value['line'], 1, 0),
						'eline' => bcadd($value1['line'], 1, 0),
						'var' => $value['var']
						));
			}
		}
	}
}
arsort($latch);
foreach ($latch as $key => $value){
	echo "<tr>
		<td>".$value['var']."</td>
		<td>".$value['sline']."-".$value['eline']."</td>
		<td>".$value['wdu']."</td>
		<td><input type='text' name='".$value['var'].$value['sline'].$value['eline']."' class='form-control testcaseinput' id='".$value['var'].$value['sline'].$value['eline']."' data-weight='".$value['wdu']."' required /></td>
	</tr>";
}

echo "</tbody>
  </table>
  <input type='submit' class='btn btn-info' name='finalsubmit' data-toggle='modal' data-target='#finaltable' />
  </form>";
echo "<div class='modal fade' id='finaltable' tabindex='-1' role='dialog' aria-labelledby='reportLabel' aria-hidden='true'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
          <h4 class='modal-title' id='reportLabel'>Test cases and their weights</h4>
        </div>
        <div class='modal-body'>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-default formclose' data-dismiss='modal'>Close</button>
        </div>
      </div>
    </div>
  </div>";

  //  *************************************************************
  //   *                                                           *
  //    *               Created By VIVEK MALASI                     *
  //     *               Conceptualised by SHUBHAM NEHRA             *
  //      *                                                           *
  //       *                                                           *
  //        *************************************************************

echo "</div>";
?>