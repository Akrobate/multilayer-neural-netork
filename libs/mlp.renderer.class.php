<?php


class MLPRenderer {

	private $mlp;
	
	function __construct($mlp) {
		$this->mlp = $mlp;
	}
	
	
	public function render() {
		$layers = $this->mlp->getLayers();
		foreach($layers as &$layer) {
			$this->renderLine($layer);
		}
	}
	
	
	private function renderLine($layer) {
		$str = "";
		$neurons = $layer->getNeurons();
		foreach($neurons as &$neuron) {
			$str .= $neuron->getValue() . "\t";	
		}
		$str .= "\n";
		
		$this->stdOut($str);
	}
	
	
	/**
	 *	Surcharge pour la sortie standard
	 *
	 */
	
	private function stdOut($value) {
		echo($value);
	}
	
	
	/**
	 *	Méthode permettant d'afficher 
	 *	les poids du réseau de neurones
	 *
	 */
	
	public function renderWeight() {
	
		$layer_num = 0;
		$layers = $this->mlp->getLayers();
		foreach($layers as &$layer) {	
			$neurons = $layer->getNeurons();
			$neuron_num = 0;
			foreach($neurons as &$neuron) {
				$connections_list = $neuron->getToConnectionList();
				
				$delta = $neuron->getDelta();
			
				$connection_num = 0;
				foreach($connections_list as $connection) {
					$weight = $connection->getWeight();
					$this->stdOut(	"L:" . $layer_num . 
									" N:" . $neuron_num . 
									" C:" . $connection_num . 
									" W:" .$weight .
									" D:" .$delta .  "   ***   ");
					$connection_num++;
				}
				
				$neuron_num++;
				$this->stdOut("\n");
			}
			
			$this->stdOut("\n");
			
			$layer_num++;
		}
	
	}
	
	
	
	
	
	public function exportToFile($filename) {
	
		$line = "";
		$layer_num = 0;
		$layers = $this->mlp->getLayers();
		foreach($layers as &$layer) {	
			$neurons = $layer->getNeurons();
			$neuron_num = 0;
			foreach($neurons as &$neuron) {
				$connections_list = $neuron->getToConnectionList();
				$connection_num = 0;
				foreach($connections_list as $connection) {
				
					$weight = $connection->getWeight();					
					$line .= $layer_num . "," . $neuron_num . "," . $connection_num . "," .$weight . "\n";
					$connection_num++;
				}
				$neuron_num++;			
			}
			$layer_num++;
		}
		
		file_put_contents($filename, $line);
	}
	
	
	
	
	public function importFromFile($filename) {
	
	
		$file_str = file_get_contents($filename);
	
		$lines_arr = explode("\n", $file_str);
		$lines_arr_addresses = array();
		
		foreach($lines_arr as $line){
			if ($line != "") {
				$lines_arr_addresses[] = explode(",",$line);
			}
		}
		
		$layers = $this->mlp->getLayers();
		foreach($lines_arr_addresses as $addr) {
		
			$layer_addr = $addr[0];
			$neurons_addr = $addr[1];
			$connection_addr = $addr[2];
			
			$layer = $layers[$layer_addr];
			$neurons = $layer->getNeurons();
			$neuron = $neurons[$neurons_addr];
			$connections = $neuron->getToConnectionList();
			$connection = $connections[$connection_addr];

			$connection->setWeight($addr[3]);
		}
		
	}
	
}
	
	
	
	
