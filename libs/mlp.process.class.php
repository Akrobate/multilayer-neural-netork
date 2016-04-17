<?php

class MLPProcess {


	private $mlp;


	function __construct($mlp) {
		$this->mlp = $mlp;
	}
	

	
	public function forwardPropagation() {
	
		$all_neurons = $this->mlp->getAllNeurons();
		
		foreach($all_neurons as &$neuron) {
			
			$connections_from = $neuron->getFromConnectionList();
			
			if (count($connections_from) != 0) {
				$neurons_sum = 0;
				foreach($connections_from as &$connection) {
					$neurons_sum += $connection->getNeuronFrom()->getValue() * $connection->getWeight();
				}
				$neuron->setValue($this->log($neurons_sum));
			}
		}
	}
	
	
	
	
	public function backwardDeltaCalculation() {
	
		
		$layers = $this->mlp->getLayers();
		$out_layer_addr = count($layers) - 1;
		$out_layer = $layers[$out_layer_addr];
		$out = array();
	
		$i = 0;
		foreach($out_layer->getNeurons() as &$neuron) {
			$exp_values = $this->mlp->getExpectedValues();	
			$neuron->setDelta($exp_values[$i] - $neuron->getValue());
			$i++;
		}
		
		
		while(isset($layers[$out_layer_addr])) {
			$out_layer = $layers[$out_layer_addr];
			
			foreach($out_layer->getNeurons() as &$neuron) {
				$derivate = $neuron->getValue()	* (1 - $neuron->getValue());
				echo("derive : " . $derivate . "\n");
				
				$connections_to = $neuron->getToConnectionList();
				$neurons_sum = 0;
				
				
				if (count($connections_to) != 0) {	
					foreach($connections_to as &$connection) {
					
						echo($connection->getNeuronTo()->getDelta() . "\n");
					
						$neurons_sum += $connection->getNeuronTo()->getDelta() * $connection->getWeight();
						
					
					}
					
					echo("neruon summ : " . $neurons_sum . "\n");
					
					//$neuron->setValue($this->log($neurons_sum));
				}
				$neuron->setDelta($neurons_sum * $derivate);
			}
			$out_layer_addr--;
		}
		

	}
	
	
	public function log($x) {
		return 1.0/(1.0 + exp(-$x));
	}

}
