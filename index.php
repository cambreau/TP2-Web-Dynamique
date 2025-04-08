<?php
// Affiche les erreurs utilent pour le développement. 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Charge les fichiers de configuration et les fonctions de base. 
require_once('config/config.php');
require_once('lib/core.php');

// Récupère le nom du contrôleur et de la fonction depuis l’URL (via $_REQUEST). 
// Si aucun n'est spécifié, utilise les valeurs par défaut définies dans le fichier de configuration.
$controller = isset($_REQUEST['controller'])?safe($_REQUEST['controller']):$config['default_controller'];
$function = isset($_REQUEST['function'])?safe($_REQUEST['function']):$config['default_function'];

//Construit le chemin du fichier du contrôleur à inclure. 
$controller_file = "controllers/".ucfirst($controller)."Controller.php";

// Vérifie si le fichier du contrôleur existe.
// Si le fichier n'existe pas, affiche un message d'erreur et arrête l'exécution du script.
if(!file_exists($controller_file)){
    trigger_error('Could not find this file');
    exit();
}

// Inclut le fichier du contrôleur.
require_once($controller_file);

// Construit le nom de la fonction du contrôleur à appeler.
$controller_function = strtolower($controller)."_controller_".$function;

// Vérifie si la fonction du contrôleur existe.
// Si la fonction n'existe pas, affiche un message d'erreur et arrête l'exécution du script.
if(!function_exists($controller_function)){
    trigger_error('Could not find this function');
    exit();
}

// Appelle la fonction du contrôleur en lui passant les paramètres de la requête ($_REQUEST).
call_user_func($controller_function, $_REQUEST);

