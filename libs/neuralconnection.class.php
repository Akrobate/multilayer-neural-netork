<?php


class NeuralConnection {

	public  $neuron_from;
	public  $neuron_to;	
	private $weight;


	function __construct($neuron_from, $neuron_to) {
		$this->neuron_from = $neuron_from;
		$this->neuron_to = $neuron_to;
	}


	public function init($min_value, $max_value) {
		$this->weight = rand($min_value, $max_value);
	}

	
	public function getWeight() {
		return $this->weight;
	}

	
	public function setWeight($weight) {
		$this->weight = $weight;
	}

	
	public function getNeuronTo() {
		return $this->neuron_to;
	}

	
	public function setNeuronTo($neuron_to) {
		$this->neuron_to = $neuron_to;
	}

	public function getNeuronFrom() {
		return $this->neuron_from;
	}

	
	public function setNeuronFrom($neuron_from) {
		$this->neuron_from = $neuron_from;
	}
}
