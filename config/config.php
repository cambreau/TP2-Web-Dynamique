<?php
// Etape 1 : Définition des chemins
define('MODEL_DIR', 'models');
define('VIEW_DIR', 'views');
define('CONNEX_DIR', 'lib/connexion.php');

// Etape 2 : Configuration du contrôleur par défaut 
$config = array (
    'default_controller' => 'base',
    'default_function' => 'index',
);

?>