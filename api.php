<?php

/**
 * @brief		ensemble des inclusions nécessaires a l'application
 * @author		Artiom FEDOROV
 *
 */

// Definitions des Constantes
define ("PATH_SEP", '/');	

// Permet la surcharge en amont de path_current pour que tout s'include correctement
if (!defined ( "PATH_CURRENT" ) ) {
	define ("PATH_CURRENT", "." . PATH_SEP );
}

define ("PATH_CONFIGS", PATH_CURRENT. "config" . PATH_SEP);	
define ("PATH_LIBS", PATH_CURRENT . "libs" . PATH_SEP );


// Inclusion des fichiers libs
#require_once(PATH_CONFIGS . "conf.php");

require_once(PATH_LIBS . "mlp.class.php");
require_once(PATH_LIBS . "layer.class.php");
require_once(PATH_LIBS . "neuron.class.php"); 
require_once(PATH_LIBS . "neuralconnection.class.php");

require_once(PATH_LIBS . "mlp.process.class.php");

require_once(PATH_LIBS . "mlp.renderer.class.php");
