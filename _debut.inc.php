<?php
include("_menu.inc.php");
include("_fonctions.inc.php");
//On démarre une nouvelle session
session_start();

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES JPE

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}


?>