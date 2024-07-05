<?php
require_once('../env/env.inc.php');
//Avec le API mysqli
$connexion = new mysqli(SERVEUR, USAGER, motDePass, BD);
if ($connexion->connect_errno) {
    echo "Probleme de connexion au serveur bd";
    exit();
}
//AVEC le API PDO
