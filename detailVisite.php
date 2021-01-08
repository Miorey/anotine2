<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<head>
   <title>Détail visites</title>
</head>
<body>
<?php

include("_debut.inc.php");

$idVisite=$_REQUEST['idVisite'];

// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

$req="select * from visite, entreprise, activite
		where entreprise.idActivite=activite.id and visite.idEntreprise = entreprise.id
		and visite.id=$idVisite";
$rsVisite = mysqli_query($connexion, $req);
$lgVisite = mysqli_fetch_array($rsVisite);
$id = $lgVisite['id'];
$adresse=$lgVisite['adresse'];
$ville=$lgVisite['ville'];
$activite=$lgVisite['libelle'];
$date = dateAnglaisVersFrancais($lgVisite['dateV']);
$heureDebut=$lgVisite['heureDebut'];
$nbPlacesMax=$lgVisite['nbPlacesMax'];
$nbPlacesMin=$lgVisite['nbPlacesMin'];
$description=$lgVisite['description'];
$nbVisiteursInscrits=$lgVisite['nbVisiteursInscrits'];
$nomEntreprise=$lgVisite['raisonSociale'];
$nomContact=$lgVisite['nomContact'];
$telContact=$lgVisite['telContact'];


echo "
<div class='main'>
   <table class='tabNonQuadrille'>
      <tr class='ligneTabNonQuad'>
         <td> identifiant de la visite : </td>
         <td>$id</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Entreprise : </td>
         <td>$nomEntreprise</td>
      </tr>
      
      <tr class='ligneTabNonQuad'>
         <td> Activité : </td>
         <td>$activite</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Adresse : </td>
         <td>$adresse</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Ville : </td>
         <td>$ville</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Jour : </td>
         <td>$date</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Heure : </td>
         <td>$heureDebut</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Places reservées : </td>
         <td>$nbVisiteursInscrits</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Description de la visite : </td>
         <td>$description</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Nombre maximum de Places : </td>
         <td>$nbPlacesMax</td>
      </tr>

   	<tr class='ligneTabNonQuad'>
         <td> Nombre minimum de Places : </td>
         <td>$nbPlacesMin</td>
      </tr>

      <tr class='ligneTabNonQuad'>
         <td> Contact : </td>
         <td>$nomContact&nbsp; $telContact
         </td>
      </tr>
   </table>
   <table class='tabNonQuadrille'>
      <tr>
         <td><a href='listeVisitesPourDetail.php'>Retour liste des visites</a></td>
         <td><a href='listeInscrits.php?idVisite=$idVisite'>Liste des inscrits</a></td>
         <td><a href='modificationVisite.php?idVisite=$idVisite&action=demanderModifierVisite'>Modifier la visite</a></td>
         <td><a href='annulerVisite.php?idVisite=$idVisite&action=demanderAnnulerVisite'>Annuler la visite</a></td>
      </tr>
   </table>
</div>";
?>
</body>
</html>