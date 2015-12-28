<?php
$app_path = $_SERVER['DOCUMENT_ROOT'].'/EZCaptcha';
include_once $app_path.'/strings/CaptchaStrings.php';
class en_USCaptchaStrings extends CaptchaStrings{
	
	public function en_USCaptchaStrings(){
		$this->fields = array('number'=>'numbers','day of the week'=>'days_of_week','month'=>'months','letter'=>'letters','animal'=>'animals','mythical creature'=>'mythical_creatures','name'=>'names','color'=>'colors','food'=>'food');
	
		//order matters
		$this->numbers =  array('zero','one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen','twenty');
		$this->days_of_week = array('Sunday','Monday','Tuesday','Thursday','Friday','Saturday');
		$this->months = array('January','February','March','April','May','June','July','August','September','October','November','December');
		$this->letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	
		//order does not matter
		$this->animals = array('giraffe','elephant','tiger','monkey','lion','zebra','bear','dog','hippo','cat','cheetah','rabbit','horse','snake','duck','leopard','dolphin','penguin','lamb','wolf','gorilla','cow','turtle','frog','bird','rhino','pig','hippopotamus','moose','sheep','buffalo','crocodile','kangaroo','chimpanzee','camel','alligator','mouse');
		$this->mythical_creatures = array('unicorn','dragon','chimera','pegasus','phoenix','sphinx','griffin','vampire','hydra','gargoyl','elf','werewolf','centaur','mermaid','kraken','minotaur','goblin','ogre','satyr','fairy','banshee','basilisk','manticore','djinn','gorgon','troll','orc','raiju','zombie');
		$this->names=array('bob','sue','jack','mary','dave','jim','howard','edward','franz','michael','andy','ann','clyde','joe','mandy','jess','steve','eric','derek','mike','matt','ross','chris','nikki','peter','melissa','tom','audrey','katherine','adam','stella','rob','jessica','aaron','ken','brad','george','don','alex','lee','harold','jon');
		$this->colors=array('red','violet','blue','yellow','black','white','brown','green','pink','gray','purple','orange','grey','bronze','burgundy','magenta','cyan');
		$this->food=array('pot roast','potatoes','pizza','pasta','cookies','milk','candy','chips','fruit','coffee','sugar','butter','tea','salad','wine','hamburgers','nuts','meat','bread','cake','crackers','eggs','desserts','cheese','steak','salads','soup','sushi','truffles','seafood','cakes','honey','popcorn','dessert','chocolate');
		
		//mathematical strings
		$this->plus=' plus ';
		$this->minus=' minus ';
		$this->equals=' is ';
	}
}
?>