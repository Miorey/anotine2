<?php
include "_debut.inc.php";
//Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["Identifiant"])){
    header("Location: _authentification.inc.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<head>
   <title>Accueil</title>
</head>
<body>
<div class="main">
   <div class="content">
      <h1> Bienvenue dans l'application JPE</h1>
      <p>Cette application web permet de gérer les inscriptions des visiteurs
         durant les journées du patrimoine économique.</p>
      <h2>Elle offre les services suivants :</h2>
      <ul>
         <li>Gérer les visites
         <li>Gérer les inscriptions

      </ul>
   </div>
</div>
</body>
</html>
