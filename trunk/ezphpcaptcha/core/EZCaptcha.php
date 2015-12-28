<?php
$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
include_once $app_path.'/schemes/ICaptchaScheme.php';
include_once $app_path.'/schemes/ITextCaptchaScheme.php';
include_once $app_path.'/schemes/MathProblem.php';
include_once $app_path.'/schemes/SecurityImages.php';
include_once $app_path.'/conf/Conf.php';

class EZCaptcha{
	function __autoload($class_name) {
		$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
		include_once $app_path.'/schemes/ICaptchaScheme.php';
		include_once $app_path.'/schemes/ITextCaptchaScheme.php';
		include_once $app_path.'/schemes/MathProblem.php';
		include_once $app_path.'/schemes/SecurityImages.php';
		include_once $app_path.'/conf/Conf.php';
	}
	private $currentCaptcha;
	private $SchemeImpl;

	public function EZCaptcha(){
		$this->refresh();
	}
	
	public function loadFromSession($key=''){
		$this->SchemeImpl = $_SESSION[$key.'SchemeImpl'];
		$this->currentCaptcha = new $this->SchemeImpl();
		$this->currentCaptcha->reload($_SESSION[$key.'CaptchaData']);
	}
	
	public function saveToSession($key=''){
		$_SESSION[$key.'SchemeImpl'] = $this->SchemeImpl;
		$_SESSION[$key.'CaptchaData'] = $this->currentCaptcha->getData();
	}

	public function refresh(){
		$this->SchemeImpl = Conf::$available_schemes[rand(0,sizeof(Conf::$available_schemes) - 1)];
		//echo $this->SchemeImpl;
		$this->currentCaptcha = new $this->SchemeImpl();
		$this->currentCaptcha->initialize();
	}

	public function displayImage($width,$height){
		$this->currentCaptcha->displayImage($width,$height);
	}

	function checkResponse($userAnswer){
		if($userAnswer == $this->currentCaptcha->getAnswer()){
			return true;
		}
		return false;
	}
}
?>