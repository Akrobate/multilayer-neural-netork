<?php

require_once("api.php");

$mlp = new MLP(10, 5, 5);
$mlp->init(10, -10);


$renderer = new MLPRenderer($mlp);
$renderer->render();


$layers = $mlp->getLayers();
$first_layer = $layers[2];
$neurons_list = $first_layer->getNeurons();

//$nner = new Neuron(10, 100);
//$neurons_list[0] = $nner;
//$first_layer->setNeurons($neurons_list);
//var_dump($first_layer);

$neuron = $neurons_list[1];
#$neuron->setValue(103);

$connections_to = $neuron->getFromConnectionList();

$first_connection = $connections_to[0];

$next_neurone = $first_connection->neuron_from;

echo("#####\n");
echo( $next_neurone->getValue());
echo("#####\n");


$renderer = new MLPRenderer($mlp);
$renderer->render();


echo("#####\n");
echo( count($mlp->getAllNeurons()));
echo("#####\n");


echo("#####\n");
echo( count($mlp->getAllNeuralConnections()));
echo("#####\n");




