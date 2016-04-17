<?php


class MLP {


	private $layers;
	
	private $nb_layers;
	private $nb_neurons;
	private $nb_neurons_out_layer;	

	private $all_neurons_list;
	private $all_neural_connection_list;

	private $input_values_list;

	private $expected_values;

	function __construct($nb_neurons, $nb_layers, $nb_neurons_out_layer) {
	
		$this->nb_layers = $nb_layers;
		$this->nb_neurons_out_layer = $nb_neurons_out_layer;
		$this->nb_neurons = $nb_neurons;
		$this->all_neurons_list = array();
		$this->all_neural_connection_list = array();
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
			$this->all_neurons_list = array_merge($this->all_neurons_list, $layer->getNeurons());
		}
		$this->createNeuralConnections($neuron_min_value, $neuron_max_value);
	}


	/**
	 *	Création de tous les liens entre les neurones
	 *	Chaque couche est relié a celle du bas neurone par neurone
	 *	Une NeuralCOnnection est crée entre chaque neurone
	 *
	 */

	public function createNeuralConnections($neuron_min_value, $neuron_max_value) {
	
		$i = 0;
		while(isset($this->layers[$i])) {
		
			# On récupere tous les neurones de la couche courante
			$neurons_list_current = $this->layers[$i]->getNeurons();	
	
			# On verifie si ce n'est pas la derniere couche
			if (isset($this->layers[$i+1])) {

				# On récupere la liste des neurones suivant
				$neurons_list_next = $this->layers[$i+1]->getNeurons();	
			
				# pour chaque combinaison
				foreach($neurons_list_current as &$neuron_current) {
					foreach($neurons_list_next as &$neuron_next) {				

						# On crée le NeuralConnection
						$neural_connection = new NeuralConnection($neuron_current, $neuron_next);
						$neural_connection->init($neuron_min_value, $neuron_max_value);
						
						$this->all_neural_connection_list[] = $neural_connection;
						
						# On set la reference de la connection dans les neurones
						$neuron_current->addToConnectionList($neural_connection);
						$neuron_next->addFromConnectionList($neural_connection);						
					}
				}
			}
			
			$i++;
		}
	}

	public function getLayers() {
		return $this->layers;	
	}
	
	
	public function getAllNeurons() {
		return $this->all_neurons_list;	
	}
	
	
	public function getAllNeuralConnections() {
		return $this->all_neural_connection_list;	
	}	
	
	
	/**
	 *	Methode permettant de definir le point d'entrée 
	 *	du réseau de neurones
	 */

	public function setMLPInputValues($values_list) {
	
		$this->input_values_list = $values_list;
		$input_layer = $this->layers[0];
	
		$i = 0;
		foreach($input_layer->getNeurons() as &$neuron) {
			$neuron->setValue($this->input_values_list[$i]);
			$i++;
		
		}
	}
	
	
	/**
	 *	Methode permettant de recuperer le resultat
	 *	renvoi la liste de poids
	 */

	public function getMLPOutValues() {
	
		$out_layer_addr = count($this->layers) - 1;

		$out_layer = $this->layers[$out_layer_addr];
		$out = array();
	
		$i = 0;
		foreach($out_layer->getNeurons() as &$neuron) {
			$out[] = $neuron->getValue();
		}
		
		return $out;
		
	}
	
	
	public function setExpectedValues($expected_values) {
	
		$this->expected_values = $expected_values;
	
		
	}	
	
	
	public function getExpectedValues() {
	
		return $this->expected_values;
	
	}	
	
};

