<?php




class Neuron {

	private $value;
	
	#theorical test
	private $connections_from_list;
	private $connections_to_list;	
	
	
	private $nb_connections;
	
	function __construct( $value = 0, $weights = array()) {
		$this->neurons = array();	
		$this->value = $value;
		$this->connections_from_list = array();
		$this->connections_to_list = array();
		
		//$this->weights = $weights;
		//$this->nb_connections = $nb_connections;
	}
	
	
	public function init($min_value, $max_value) {
		$this->value = rand($min_value, $max_value);
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function setValue($value) {
		$this->value = $value;
	}
	
	public function setFromConnectionList($list) {
		$this->connections_from_list = $list;
	}
	
	public function getFromConnectionList() {
		return $this->connections_from_list;
	}
	
	public function setToConnectionList($list) {
		$this->connections_to_list = $list;
	}
	
	public function getToConnectionList() {
		return $this->connections_to_list;
	}
	
	public function addToConnectionList($elem) {
		$this->connections_to_list[] = $elem;
	}
	
	public function addFromConnectionList($elem) {
		$this->connections_from_list[] = $elem;
	}
	
	
};




