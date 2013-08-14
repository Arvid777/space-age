<?

abstract class Creature {

protected $name;
protected $text;

protected $mass; // в кг
protected $height; // в cм

protected $feet; // число ног
protected $hands; // число рук

	protected $intelligence; // from 0 to 10
	
	function __construct($name = false,$text = false,$mass = false,$height = false, $feet = false, $hands = false, $intelligence) {
		if ($name === false) {
		// Случайное имя
		$name = "Creature".rand(1,1000);
		}
		$this->name = $name;
		
		if ($text === false) $text = "Об этом существе ничего не известно";
		$text = "Это существо<br><br>".$text;
		$this->text = $text;
		
		$this->mass = $mass;
		$this->height = $height;
		$this->feet = $feet;
		$this->hands = $hands;
		
		$this->intelligence = $intelligence;
	}

}

abstract class Mammal extends Creature { // Млекопитающее

protected $fur; // мех boolean
protected $temp; // температура тела

	function __construct($name = false,$text = '',$mass = false,$height = false, $feet = false, $hands = false, $intelligence = false, $fur = false, $temp = false) {
		$this->fur = $fur;
		$this->temp = $temp;
		
		$text = "Это млекопитающее<br>".$text;
		
		parent::__construct($name,$text,$mass,$height, $feet, $hands, $intelligence);
	}	

}

class Primate extends Mammal {

	
	function __construct($name = false, $intelligence = false) {
		
		if ($name === false) $name = "Primate".rand(0,1000);
		$text = "Это примат<br>";
		
		$mass = rand(10,100);
		$height = rand(60,250);
		$feet = 2;
		$hands = 2;
		if ($intelligence === false) $intelligence = rand (0,9);
		$fur = rand(0,10)?false:true;
		$temp = rand(340,400)/10;
		
		
		parent::__construct($name,$text,$mass, $height, $feet, $hands, $intelligence, $fur,$temp);
				
	}
		
}
