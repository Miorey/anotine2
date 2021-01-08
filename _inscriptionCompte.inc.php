<?php
include("_debut.inc.php");
$connexion = connect();
$utilisateur = isset($_POST['Identifiant']);
$password = isset($_POST['MotDePasse']);
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<head>
	<title>Inscription</title>
</head>
<body>

<h1>
	Sur cette page, inscrivez-vous en tant qu'utilisateur
</h1>
<!-- Formulaire d'inscription. On veut une methode = POST pour ne pas avoir le mot de passe en clair dans l'url -->
<form name="Inscription" id="Inscription" method="POST">
		<ul class="formulaire">
		<li><label for="id">Veuillez choisir un identifiant</label></li>
		<li><input type="text" id ="id" name="Identifiant"></input></li>
		<li><label for="pw">Veuillez choisir un Mot de passe</label></li>
		<li><input type="text" id="pw" name="MotDePasse"></input></li>
		<li><label for="pw">Veuillez confirmer votre Mot de passe en le resaisissant</label></li>
		<li><input type="text" id="pw2" name="MotDePasse2"></input></li>
		</ul>
		<button type="submit">Valider</button>
</form>

<?php 
if (isset ($_POST['Identifiant']) and ($_POST['MotDePasse'] == $_POST['MotDePasse2'])){
		$utilisateur = $_POST['Identifiant'];
		$req = "INSERT into `registration` (NomUtilisateur, Password)
        		VALUES ('$utilisateur', '".hash('sha256', $_POST['MotDePasse'])."')";
    	$rsRegistration = mysqli_query($connexion, $req);
    	echo "Votre inscription a réussi, ".$utilisateur.". Merci de vous être enregistré(e). Vous pouvez maintenant naviguer sur le site.";
    	 }
	    elseif (isset ($_POST['Identifiant']) and ($_POST['MotDePasse'] != $_POST['MotDePasse2'])){
	    	echo "Les mots de passe ne correspondent pas";
	    }
 ?>
</body>
</html>