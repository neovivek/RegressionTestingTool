<?php

if(!(isset($_FILES["fileToUpload"]["name"])) || $_FILES["fileToUpload"]["name"] == '') {
    header('Location: /');
    die();
}

session_start();
if(isset($_SESSION['user']) ){
    $USER = $_SESSION['user'];
}else header('Location: /');

$path = dirname( __FILE__ );
$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
define( 'BASE_DIR', $path . $slash . 'user' . $slash );

$target_dir = BASE_DIR . $USER . $slash;
$target_dir_1 = BASE_DIR . $USER . '_1' . $slash;

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$name = explode('.', basename($_FILES["fileToUpload"]["name"]));
$extension = pathinfo($target_file, PATHINFO_EXTENSION);
if (file_exists($target_file)) {
    rename($target_file, $target_dir_1.$name[0].'_1.'.$extension);
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    header('Location: /');
}

?>