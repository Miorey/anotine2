<?php
include("_debut.inc.php");


/*Si l'utilsateur est renseigné et que le couple user/mot de passe est dans la base, continuer dans le site, sinon rediriger vers la page d'authentification*/

if (isset($_POST['Identifiant'])){
	$utilisateur = stripslashes($_POST['Identifiant']);
	$utilisateur = mysqli_real_escape_string($connexion, $utilisateur);
	$password = stripslashes($_POST['MotDePasse']);
	$password = mysqli_real_escape_string($connexion, $_POST['MotDePasse']);
	$query = "SELECT * FROM registration WHERE NomUtilisateur = '$utilisateur' AND password='".hash('sha256', $password)."'";
	$result = mysqli_query($connexion,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);	
	var_dump($result);
  	
  	echo'Il y a '.$rows.'Ligne(s) pour cet utilisateur';
  if($rows==1){
      $_SESSION['Identifiant'] = $utilisateur;
      header("Location: index.php");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}



?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<head>
	<title>Authentification</title>
</head>
<body>
	
	<div class="main">
		<div class = "content">
			<h1> Bienvenue sur l'application JPE.</h1>
	<h2> Veuillez vous identifier </h2>
		<div class="formulaire">
			<form name="Authentification" id="Authentification" method="POST">
				<label for="id">Entrez votre identifiant</label>
				<br /><input type="text" id ="id" name="Identifiant"></input>
				<br /><label for="pw">Entrez votre Mot de passe</label>
				<br /><input type="text" id="pw" name="MotDePasse"></input>
				<input align="Center" type="submit" value="valider"></input>
			</form>
		<br />
		<a href="_inscriptionCompte.inc.php">Pas encore inscrit ? cliquez ici pour créer un compte !</a>
		</div>
	 	
		</div>
	</div>
</body>
</html>
