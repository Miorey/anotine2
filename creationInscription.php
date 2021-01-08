<?php
include("_debut.inc.php");
if(!isset($_SESSION["Identifiant"])){
   header("Location: _authentification.inc.php");
   exit(); 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html lang="fr">
<head>
<link rel="stylesheet" type="text/css" href="cssGeneral.css">
<?php

/***
 CREATION D'UNE NOUVELLE NSCRIPTION 
 ***/

/*Récupération des variables provenant du formulaire précédent*/

$action=$_REQUEST['action'];
$idVisite=$_REQUEST['idVisite'];


// Recherche de quelle page on vient en évaluant la variable action passée
if($action == "demandeInscription")
{
	$nom='';
	$prenom='';
	$tel='';
	$cp='';
	$nbInscrits=0;
}
else
{
	$nom=$_REQUEST['nom'];
	$prenom=$_REQUEST['prenom'];
	$tel=$_REQUEST['tel'];
	$cp=$_REQUEST['cp'];
	$nbInscrits=$_REQUEST['nbInscrits'];
	
   // Appel d'une fonction de vérification des valeurs saisies par l'utilisateur
	$nbErreurs = nbErreurs();
	verifierDonneesVisiteur($connexion, $idVisite,$nom, $prenom, $tel, $cp, $nbInscrits);
	
   if (nbErreurs()==0){
	 // enregistrement de la nouvelle inscription
	  $nom=str_replace("'", "''", $nom);
	  $prenom=str_replace("'", "''", $prenom);
	  $req = "insert into visiteur(nom,prenom,tel,cp,nbPersonnes,idVisite) values('$nom','$prenom','$tel','$cp',$nbInscrits,$idVisite)";
	  mysqli_query($connexion, $req);

	 // mise à jour du nombre d'inscrits pour la visite
	 	$req ="update visite set nbVisiteursInscrits=nbVisiteursInscrits + $nbInscrits 
      where visite.id = $idVisite";
		mysqli_query($connexion, $req);

	 }

}

echo"</head>";

echo "<body>
         <div class = 'main'>
         <div class = 'content'>
      <form method='POST' action='creationInscription.php?idVisite=$idVisite&action=validerCreationInscription'>


   <table class='tabNonQuadrille'>
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Nouvelle inscription</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nom*: </td>
         <td><input type='text' name='nom' value='".$nom."' size='30'
         maxlength='45'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Prenom*: </td>
         <td><input type='text' name='prenom' value='".$prenom."' size='30'
         maxlength='45'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> teléphone*: </td>
         <td><input type='text' name='tel' value='".$tel."'
         size='10' maxlength='10'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Code Postal*: </td>
         <td><input type='text' name='cp'  value='".$cp."' size='5'
         maxlength='5'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nombre de visiteurs à inscrire*: </td>
         <td><input type='text'  name='nbInscrits' value='$nbInscrits' size ='10'
         maxlength='10'></td>
      </tr> </table>";


   echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='index.php'>Retour accueil</a>
         </td>
      </tr>
   </table>
</form>";

// En cas de validation du formulaire : affichage des erreurs ou du message de
// confirmation

if ($action=='validerCreationInscription'){
      if (nbErreurs()!=0){
         afficherErreurs();
      }
      else{
         echo "<h5><center>L'inscription a été effectuée</center></h5>";
		    echo "<table class ='tabNonQuadrille'>
            <tr>
             	<td>
                  <a href='listeInscrits.php?idVisite=$idVisite'>Liste des inscrits</a>
   			   </td>
            </tr>
			</table>
         </div>
         </div>
         </body>";
      }
}

?>
