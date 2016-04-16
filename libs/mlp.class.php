<?php


class MLP {


	private $layers;
	
	private $nb_layers;
	private $nb_neurons;
	private $nb_neurons_out_layer;	


	function __construct($nb_neurons, $nb_layers, $nb_neurons_out_layer) {
	
		$this->nb_layers = $nb_layers;
		$this->nb_neurons_out_layer = $nb_neurons_out_layer;
		$this->nb_neurons = $nb_neurons;

		#First and hidden layers
		for($i = 0; $i < $this->nb_layers; $i++) {
			$layer = new Layer($nb_neurons);
			$this->layers[$i] = $layer;
		}
		
		#Last layer (output layer)
		$layer = new Layer($nb_neurons_out_layer);
		$this->layers[] = $layer;
	}
	
	
	public function init($neuron_min_value, $neuron_max_value) {
		foreach($this->layers as &$layer) {
			$layer->init($neuron_min_value, $neuron_max_value);
		}	
	}
	
	
	public function getLayers() {
		return $this->layers;	
	}
	
};

