<?php
$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
include_once $app_path.'/schemes/ICaptchaScheme.php';
include_once $app_path.'/conf/Conf.php';

/*
 * File: CaptchaSecurityImages.php
 * Author: Simon Jarvis
 * Copyright: 2006 Simon Jarvis
 * Date: 03/08/06
 * Updated: 07/02/07
 * Requirements: PHP 4/5 with GD and FreeType libraries
 * Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/gpl.html
 *
 */

class SecurityImages implements ICaptchaScheme{
	
	private $font = 'monofont.ttf';
	private $code;
	
	function getData(){
		return $code;
	}
	
	function reload($data){
		$code=$code;
	}

	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) {
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		$this->code=$code;
	}

	public function initialize(){
		$this->generateCode(Conf::$str_len);
	}

	public function getAnswer(){
		return $this->code;
	}

	public function displayImage($width,$height){
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 20, 40, 100);
		//$noise_color1 = imagecolorallocate($image, 100, 120, 180);

		$noise_color1 = imagecolorallocate($image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
		$noise_color2 = imagecolorallocate($image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color1);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color2);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $this->code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $this->code) or die('Error in imagettftext function');
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
	}
}
?>