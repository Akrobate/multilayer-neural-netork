<?php




class Neuron {

	private $value;
	private $weights;
	
	#theorical test
	private $weightA;
	private $weightB;	
	
	
	private $nb_connections;
	
	function __construct($nb_connections, $value = 0, $weights = array()) {
		$this->neurons = array();	
		$this->value = $value;
		$this->weights = $weights;
		$this->nb_connections = $nb_connections;
		
		
		
	}
	
	
	public function init($min_value, $max_value) {
		$this->value = rand($min_value, $max_value);
		for ($i = 0; $i < $this->nb_connections; $i++) {
			$this->weights[] = rand($min_value, $max_value);
		}
		
	}
	
	public function getValue() {
		return $this->value;
	}
	
};




