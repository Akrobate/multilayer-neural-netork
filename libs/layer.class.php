<?php


class Layer {

	private $neurons;
	
	function __construct($nb_neurons) {

		$this->neurons = array();	

		for($i = 0; $i < $nb_neurons; $i++) {
			$neuron = new Neuron($nb_neurons);
			$this->neurons[] = $neuron;
		}
	}
	
	
	public function init($min_value, $max_value) {
		foreach($this->neurons as &$neuron) {
			$neuron->init($min_value, $max_value);
		}
	}
	
	
	public function getNeurons() {
		return $this->neurons;
	}
	
	
};

