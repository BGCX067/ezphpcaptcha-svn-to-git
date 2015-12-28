<?
$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
include_once $app_path.'/conf/Conf.php';
include_once $app_path.'/strings/en_USCaptchaStrings.php';
include_once $app_path.'/schemes/ITextCaptchaScheme.php';

class MathProblem implements ITextCaptchaScheme{
	private $code;
	private $text;
	
	function getData(){
		return array('code'=>$code,'text'=>$text);
	}
	
	function reload($data){
		$code=$data['code'];
		$text=$data['text'];
	}

	function generateCode($characters){
		$StringsImpl = Conf::$default_lang_code.'CaptchaStrings';
		$str = new $StringsImpl();
		$rand1 = rand(0,10);
		$rand2 = rand(0,10);
		$sign = rand(0,1);

		$this->text = (rand(0,1) == 0 ? $rand1 : $str->num_to_string($rand1));
		if($sign==0){
			$this->code = $i+$j;
			$this->text = $this->text.(rand(0,1) == 0 ? ' + ' : $str->plus);
		}else{
			$this->code = $i-$j;
			$this->text = $this->text.(rand(0,1) == 0 ? ' - ' : $str->minus);
		}
		$this->text = $this->text.(rand(0,1) == 0 ? $rand2 : $str->num_to_string($rand2)).(rand(0,1) == 0 ? ' = ' : $str->equals);
		//echo $this->text;
	}

	public function initialize(){
		$this->generateCode(Conf::$str_len);
	}

	public function getAnswer(){
		return $this->code;
	}

	function getText(){
		return $this->text;
	}

	function displayImage($width,$height){
		$im = @ImageCreate ($width,$height) or die ("Error creating captcha image");
		$background_color = ImageColorAllocate ($im, 255, 255, 255); // White: 255,255,255
		$text_color = imagecolorallocate($im,0,0,0);
		//echo $this->text;
		imagestring($im, 3,5,2,$this->text, $text_color);
		header('Content-Type: image/jpeg');
		imagejpeg($im);
		imagedestroy($im);
	}
}
?>