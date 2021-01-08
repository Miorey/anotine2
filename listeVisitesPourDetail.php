<!DOCTYPE html>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<html>
<head>
   <title>Liste des visites</title>
</head>
<body>
<?php
include("_debut.inc.php");
//Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if(!isset($_SESSION["Identifiant"])){
   header("Location: _authentification.inc.php");
   exit(); 
}


echo "
<div class='main'>
   <table class='tabNonQuadrille'>
      <tr class='enTeteTabNonQuad'>
         <td colspan='5'>Visites</td>
      </tr>";

   $req="
   select visite.id as idVisite, visite.dateV, visite.heureDebut, visite.description, entreprise.raisonSociale
   from visite, entreprise 
   where visite.idEntreprise=entreprise.id and visite.etat LIKE 'ouverte'
   and visite.nbPlacesMax > visite.nbVisiteursInscrits 
   order by visite.dateV ";
   
   $connexion = connect();
   $rsVisite = mysqli_query($connexion, $req);
   $lgVisite = mysqli_fetch_array($rsVisite);

// BOUCLE SUR LES VISITES
   while ($lgVisite != FALSE)
   {
   $idVisite = $lgVisite['idVisite'];
   $date = dateAnglaisVersFrancais($lgVisite['dateV']);
   $debut = $lgVisite['heureDebut'];
   $entreprise= $lgVisite['raisonSociale'];
   $description = $lgVisite['description'];
echo "
      
		<tr class='ligneTabNonQuad'>
	     <td>$date</td>
	     <td>$debut</td>
		  <td>$entreprise</td>
     	  <td>$description</td>
        <td><a href='detailVisite.php?idVisite=$idVisite'>Voir détail</a></td>
      </tr>
      </div>";
      $lgVisite=mysqli_fetch_array($rsVisite);
   }
   echo "</table>";
?>
</div>
</body>
</html>