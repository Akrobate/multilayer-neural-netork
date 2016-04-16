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
		
		echo($str);
		
	}
	
	
}
	
	
	
	
