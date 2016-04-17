<?php

require_once("api.php");

$mlp = new MLP(2, 3, 1);
$mlp->init(10, -10);


$renderer = new MLPRenderer($mlp);

$mlp->setMLPInputValues(array(-1,2));
$mlp->setExpectedValues(array(1));


echo("\n\n#####\n\n");

$renderer->render();

echo("\n\n#####\n\n");


$renderer->importFromFile("./data/out.csv");
$renderer->renderWeight();
echo("\n\n#####\n\n");

$process = new MLPProcess($mlp);

$process->forwardPropagation();
$renderer->render();

$process->backwardDeltaCalculation();
$renderer->renderWeight();
echo("\n\n#####\n\n");


$v = -0.5;
$r = $process->log($v);
echo("\n $v ## $r ##  \n");

print_r($mlp->getMLPOutValues());




echo("\n\n#####\n\n");
echo( count($mlp->getAllNeurons()));
echo("\n");
echo( count($mlp->getAllNeuralConnections()));

