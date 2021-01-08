<?php
include("_debut.inc.php");
$connexion = connect();
// $utilisateur = isset($_POST['Identifiant']);
// $password = isset($_POST['MotDePasse']);
//$action = $_REQUEST['demanderModifierVisite'];

$idVisite=$_REQUEST['idVisite'];

// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

$req="select * from visite
		where visite.id=$idVisite";
$rsVisite = mysqli_query($connexion, $req);
$lgVisite = mysqli_fetch_array($rsVisite);

//Utilisation d'une fonction de conversion de date pour l'afficher au format français
$date = dateAnglaisVersFrancais($lgVisite['dateV']);
$heureDebut=$lgVisite['heureDebut'];
$duree = $lgVisite['duree'];
$nbPlacesMax=$lgVisite['nbPlacesMax'];
$nbPlacesMin=$lgVisite['nbPlacesMin'];
$description=$lgVisite['description'];
$nbVisiteursInscrits=$lgVisite['nbVisiteursInscrits'];
?>


<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<head>
	<title>Modification</title>
</head>
<?php
echo "
<body>
	<div class = 'main'>
		<div class= 'content'>
			<div class = 'formulaire'>
			
				<form method='POST' action='modificationVisite.php?idVisite=$idVisite&action=modifierVisite'>
			<table class='tabNonQuadrille'>
				<tr class = 'enTeteTabNonQuad'>
					<td colspan='4'> Modification de visite </td>
				</tr>
				<tr class = 'ligneTabNonQuad'>
					<td>Ancienne Date de la visite : </td>
					<td>$date</td>
					<td>Nouvelle Date de la Visite* : </td>
					<td><input type = 'Date' name ='newDateVisite'></td>
				</tr>
				<tr class = 'ligneTabNonQuad'>
					<td>Ancienne Heure de la Visite : </td>
					<td>$heureDebut</td>
					<td>Nouvelle heure de la Visite : </td>
					<td><input type = 'Time' name ='newHeureVisite'></td>
				</tr>
				<tr class = 'ligneTabNonQuad'>
					<td>Ancienne durée de la Visite : </td>
					<td>$duree</td>
					<td>Nouvelle durée de la Visite : </td>
					<td><input type = 'text' name ='newDureeVisite'></td>
				</tr>
				<tr class = 'ligneTabNonQuad'>
					<td>Ancienne description de la Visite : </td>
					<td>$description</td>
					<td>Nouvelle description de la Visite : </td>
					<td><input type = 'text' name ='newDescriptionVisite'></td>
				</tr>
				<tr class = 'ligneTabNonQuad'>
					<td>Ancien nombre de places maximum : </td>
					<td>$nbPlacesMax</td>
					<td>Nouveau nombre de places maximum : </td>
					<td><input type = 'number' name ='newNbPlacesMax'></td>
				</tr>
				<tr class = 'ligneTabNonQuad'>
					<td>Ancien nombre de places minimum : </td>
					<td>$nbPlacesMin</td>
					<td>Nouveau nombre de places minimum : </td>
					<td><input type = 'number' name ='newNbPlacesMin'></td>
				</tr>
				
			</table>
			<input type='submit'>
			<input type='reset'>
		</form>
			</div>
		</div>
	</div>";

	
	if ($action='modifierVisite'){
//recupération des valeurs du formulaire
	$newDateVisite = $_POST['newDateVisite'];
	$newHeureVisite = $_POST['newHeureVisite'];
	$newDureeVisite = $_POST['newDureeVisite'];
	$newDescriptionVisite = $_POST['newDescriptionVisite'];
	$newNbPlacesMax = $_POST['newNbPlacesMax'];
	$newNbPlacesMin = $_POST['newNbPlacesMin'];

//requetes de modification
	if ($newDateVisite !=""){
	$req = "update visite SET dateV = '$newDateVisite' where visite.id=$idVisite";
	mysqli_query($connexion, $req);
	echo "Vous avez modifié la date de la visite au : ".dateAnglaisVersFrancais($newDateVisite)."<br />";
	}
	if ($newHeureVisite !=""){
	$req = "update visite SET heureDebut = '$newHeureVisite' where visite.id=$idVisite";
	mysqli_query($connexion, $req);
	echo "Vous avez modifié l'heure de la visite pour : ".$newHeureVisite."<br />";
	}
	if ($newDureeVisite !=""){
	$req = "update visite SET duree = '$newDureeVisite' where visite.id=$idVisite";
	mysqli_query($connexion, $req);
	echo "Vous avez modifié la durée de la visite en : ".$newDureeVisite."<br />";
	}
	if ($newDescriptionVisite !=""){
	$req = "update visite SET description = '$newDescriptionVisite' where visite.id=$idVisite";
	mysqli_query($connexion, $req);
	echo "Vous avez modifié la description de la visite en : ".$newDescriptionVisite."<br />";
	}
	if ($newNbPlacesMax !=""){
	$req = "update visite SET nbPlacesMax = '$newNbPlacesMax' where visite.id=$idVisite";
	mysqli_query($connexion, $req);
	echo "Vous avez modifié le nombre de places maximum en : ".$newNbPlacesMax."<br />";
	}
	if ($newNbPlacesMin !=""){
	$req = "update visite SET nbPlacesMin = '$newNbPlacesMin' where visite.id=$idVisite";
	mysqli_query($connexion, $req);
	echo "Vous avez modifié le nombre de places minimum en : ".$newNbPlacesMin.	"<br />";
	}
	
	}
?>
</body>