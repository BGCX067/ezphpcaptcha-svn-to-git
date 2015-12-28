<?php
interface ICaptchaScheme{
	public function reload($value);
	public function initialize();
	public function displayImage($width,$height);
	public function getAnswer();
	public function getData();
}
?>