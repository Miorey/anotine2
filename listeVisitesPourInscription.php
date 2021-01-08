<?php

include("_debut.inc.php");

echo "
   <div class ='main'>
   <table class='tabNonQuadrille'>
      <tr class='enTeteTabNonQuad'>
         <td colspan='5'>Visites</td>
      </tr>";
$req="
   select visite.id as idVisite, visite.dateV, visite.heureDebut, visite.description, entreprise.raisonSociale
   from visite, entreprise 
   where visite.idEntreprise=entreprise.id and visite.etat LIKE 'ouverte'
   and visite.nbPlacesMax > visite.nbVisiteursInscrits 
   order by visite.dateV";

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
      <td><a href='creationInscription.php?idVisite=$idVisite&action=demandeInscription'>Inscription</a></td>
   </tr>";
   $lgVisite=mysqli_fetch_array($rsVisite);
   }
echo "</table>";

?>