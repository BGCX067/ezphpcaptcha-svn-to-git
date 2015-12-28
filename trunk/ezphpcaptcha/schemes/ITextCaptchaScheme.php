<?php
$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
include_once $app_path.'/schemes/ICaptchaScheme.php';
interface ITextCaptchaScheme extends ICaptchaScheme{
	public function getText();
}
?>