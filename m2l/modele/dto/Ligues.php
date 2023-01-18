<?php
class Ligues{
	private $ligues ;

	public function __construct($array){
		if (is_array($array)) {
			$this->ligues = $array;
		}
	}

	public function getLigues(){
		return $this->ligues;
	}

	public function chercheLigue($unIdLigue){
		$i = 0;
		while ($unIdLigue != $this->ligues[$i]->getIdLigue() && $i < count($this->ligues)-1){
			$i++;
		}
		if ($unIdLigue == $this->ligues[$i]->getIdLigue()){
			return $this->ligues[$i];
		}
	}

	/*public function chercheLigue($unNomLigue){
		$i = 0;
		while ($unNomLigue != $this->ligues[$i]->getNomLigue() && $i < count($this->ligues)-1){
			$i++;
		}
		if ($unNomLigue == $this->ligues[$i]->getNomLigue()){
			return $this->ligues[$i];
		}
	}*/
}