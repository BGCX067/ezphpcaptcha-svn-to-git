<?php
abstract class CaptchaStrings{

	//order matters
	protected $numbers;
	protected $days_of_week;
	protected $months;
	protected $letters;

	//order does not matter
	protected $animals;
	protected $mythical_creatures;
	protected $names;
	protected $colors;
	protected $food;

	public $plus;
	public $minus;
	public $equals;

	function num_to_string($num){
		return $this->numbers[$num];
	}

	function num_to_day_of_week($num){
		if($num <= sizeof($this->days_of_week)){
			return $this->days_of_week[$num];
		}else{
			throw new Exception("Invalid number for day of the week: ".$num);
		}
	}

	function getRandomValue($field){
		return $this->$field[mt_rand(0,sizeof($this->$field))];
	}

	function num_to_month($num){
		if($num <= sizeof($this->months)){
			return $this->months[$num];
		}else{
			throw new Exception("Invalid number for months: ".$num);
		}
	}

	function num_to_letter($num){
		if($num <= sizeof($this->letters)){
			return $this->letters[$num];
		}else{
			throw new Exception("Invalid number for letters: ".$num);
		}
	}
}
?>