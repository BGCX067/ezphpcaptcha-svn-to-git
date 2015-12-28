<?php
session_start();
$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
include_once $app_path.'/core/EZCaptcha.php';
include_once $app_path.'/serialization/lmbSerializable.php';

if(!isset($_SESSION['ezcaptcha'])){
	$ezcaptcha= new EZCaptcha();
	$ezcaptcha->saveToSession();
	$_SESSION['ezcaptcha'] = '';
}else{
	$ezcaptcha= new EZCaptcha();
	$ezcaptcha->loadFromSession();
}

$width = isset($_GET['width']) && $_GET['width'] < 600 ? $_GET['width'] : '120';
$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '40';

$ezcaptcha->displayImage($width,$height);
?>