<?php

if(isset($_REQUEST['user'])) $USER = $_REQUEST['user'];
else die('Can\'t Process Request');
session_start();
if(!(isset($_SESSION['user'])) ){
	$_SESSION['user'] = $USER;
}
$path = dirname( __FILE__ );
$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
define( 'BASE_DIR', $path . $slash . 'user' . $slash );

$folder  = $USER;
$dirPath = BASE_DIR . $folder;

if(!(file_exists($dirPath)) ){
	mkdir( $dirPath, '0755' );
	mkdir( $dirPath . '_1', '0755' );
}

echo "<div class='col-sm-6 col-md-6'>
		<h3>Available Files for <i><b>".$USER."</b></i></h3>";
$dh  = opendir($dirPath);
$count = 0;
while (false !== ($filename = readdir($dh))) {
	if($count < 2){
		$count ++ ;
		continue;
	}
    echo "
    <div class='content'>
    	<button type='button' class='open' >
          <span class='glphicon glyphicon-plus'></span>
        </button>
        <label class='control-label genreport' id='".$filename."'>".$filename."</label>
    </div>";
}
echo "</div>";
echo "<div class='col-sm-6 col-md-6 leftbar'>
		<h3>Upload new files</h3>
		<form id='uploadform' action='upload.php' method='post' enctype='multipart/form-data'>
			<div class='form-group'>
				<input class='' type='file' id='filename' name='fileToUpload' />
				<p class='help-block'>Upload files from your system.</p>
			</div>
			<div class='form-group'>
				<input class='btn btn-default' type='submit' value='upload' id='uploadconfirm'>
			</div>
		</form>
	</div>";

?>