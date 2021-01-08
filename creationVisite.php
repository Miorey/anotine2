<?php

include("_debut.inc.php");
//Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["Identifiant"])){
   header("Location: _authentification.inc.php");
   exit(); 
}
/*recupération des informations du formulaire*/
$action = isset($_REQUEST['action']);


?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<head>
	<title>Inscription</title>
</head>
<body>
	<div class = "main">
	<div class = "content">
	<div class = "formulaire"> 
		<form method="POST" action='creationVisite.php?action=creationVisite'>
			<table class='tabNonQuadrille'>
				<tr class = "enTeteTabNonQuad">
					<td> Nouvelle Visite </td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Date de la Visite* : </td>
					<td><input type = "Date" name ="dateVisite"></td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Heure de la Visite* : </td>
					<td><input type = "Time" name ="heureVisite"></td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Durée de la Visite* : </td>
					<td><input type = "text" name ="dureeVisite"></td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Description de la Visite* : </td>
					<td><input type = "text" name ="descriptionVisite"></td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Nombre de places maximum * : </td>
					<td><input type = "number" name ="nbPlacesMax"></td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Nombre de places minimum * : </td>
					<td><input type = "number" name ="nbPlacesMin"></td>
				</tr>
				<tr class = "ligneTabNonQuad">
					<td>Votre Identifiant d'entreprise * : </td>
					<td><input type = "number" name ="idEntreprise"></td>
				</tr>
			</table>
			<input type="submit">
			<input type="reset">
		</form>
	</div>
	</div>
	</div>
</body>
</html>
<?php 
if ($action =='creationVisite'){

$dateVisite = $_POST['dateVisite'];
$heureVisite = $_POST['heureVisite'];
$dureeVisite = $_POST['dureeVisite'];
$descriptionVisite = $_POST['descriptionVisite'];
$nbPlacesMax = $_POST['nbPlacesMax'];
$nbPlacesMin = $_POST['nbPlacesMin'];
$idEntreprise = $_POST['idEntreprise'];

/*validation des données à l'aide de la fonction verifierDonneesEntreprise*/
$nbErreurs = nbErreurs();
verifierDonneesEntreprise($dateVisite, $heureVisite, $dureeVisite, $descriptionVisite, $nbPlacesMax, $nbPlacesMin, $idEntreprise);

		if (nbErreurs()!=0){
			echo"il y a au moins 1 erreur(s)";
			afficherErreurs();
		}	
		if (nbErreurs()==0){
			// enregistrement de la nouvelle inscription
	  $req = "insert into visite(dateV, heureDebut, duree, description, nbPlacesMax, nbPlacesMin, etat, idEntreprise) 
	  values('$dateVisite','$heureVisite','$dureeVisite','$descriptionVisite',$nbPlacesMax , $nbPlacesMin, 'ouverte', $idEntreprise)";
	  mysqli_query($connexion, $req);
		}

      }
?>