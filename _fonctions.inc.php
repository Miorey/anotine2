<?php

/*							 FONCTIONS CONCERNANT LA BASE DE DONNEES				*/

function connect()
{
   $hote="localhost";
   $login="root";
   $mdp="llce01";
   $db="jpeppe";
   return mysqli_connect($hote, $login, $mdp, $db);
}

function mysql_error()
{
   echo "Il y a eu une erreur de connexion";
}

function selectBase($connexion)
{
   $bd="jpeppe";
   $query="SET CHARACTER SET utf8";
   // Modification du jeu de caractères de la connexion
   $res=mysqli_query($connexion, $req);
   $ok=mysqli_select_db($connexion, $bd);
   return $ok;
}
// FONCTION VERIFIANT LE NOMBRE DE PLACES DISPONIBLES
function nbPlacesDispo($connexion, $idVisite)
{
	$req = "select * from visite where visite.id=$idVisite";
	$rsVisite = mysqli_query($connexion, $req);
	$lgVisite = mysqli_fetch_array($rsVisite);
	$dispo = $lgVisite['nbPlacesMax'] - $lgVisite['nbVisiteursInscrits'];
	return $dispo;
}


/*							FONCTIONS DIVERSES					*/

// FONCTION CONCERNANT LES DATES


function dateAnglaisVersFrancais($madate){
   @list($annee,$mois,$jour)=explode('-',$madate);
   $date="$jour"."/".$mois."/".$annee;
   return $date;
}


// FONCTIONS DE CONTRÔLE DE SAISIE

// Si $codePostal a une longueur de 5 caractères et est de type entier, on
// considère qu'il s'agit d'un code postal
function estUnCp($codePostal)
{
   // Le code postal doit comporter 5 chiffres
   return strlen($codePostal)== 5 && estEntier($codePostal);
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres,
// la fonction retourne vrai
function estEntier($valeur)
{
   return !preg_match("[^0-9]", $valeur);
}

// Si la valeur transmise ne contient pas d'autres caractères que des chiffres
// et des lettres non accentuées, la fonction retourne vrai
function estChiffresOuEtLettres($valeur)
{
   return !preg_match("[^a-zA-Z0-9]", $valeur);
}

// Fonction qui vérifie la saisie lors de la création d'un visiteur.
// Pour chaque champ non valide, un message est ajouté à la liste des erreurs
function verifierDonneesVisiteur($connexion, $idVisite,$nom, $prenom, $tel, $cp, $nbInscrits){
   if ($nom=="" || $prenom="" || $tel=="" || $nbInscrits=="" || $cp==""){
      ajouterErreur("Chaque champ suivi du caractère * est obligatoire");
   }

   if (estEntier($nbInscrits) == FALSE){
   	ajouterErreur("Le nombre d'incrits doit être entier");
   }
   
   if ($nbInscrits < 1){
   	ajouterErreur("Il faut inscrire au moins 1 participant");
   }

   if ($cp!="" && !estUnCp($cp)){
      ajouterErreur("Le code postal doit comporter 5 chiffres");
   }

   if (nbPlacesDispo($connexion, $idVisite) <$nbInscrits){
      ajouterErreur("Capacité d'accueil dépassée");
   }
}

function verifierDonneesEntreprise
($dateVisite, $heureVisite, $dureeVisite, $descriptionVisite, $nbPlacesMax, $nbPlacesMin, $idEntreprise){
   if($dateVisite="" || $heureVisite=="" || $dureeVisite=="" || $descriptionVisite=="" || $nbPlacesMax=="" || $nbPlacesMin=="" || $idEntreprise==""){ 
   ajouterErreur("Chaque champ suivi du caractère * est obligatoire");

   }
}

/*
FONCTIONS DE GESTION DES ERREURS
*/

function ajouterErreur($msg){
   if (!isset($_REQUEST['erreurs'])){
         $_REQUEST['erreurs']=array();
         $_REQUEST['erreurs'][]=$msg;
   }
}

function nbErreurs(){
   if (!isset($_REQUEST['erreurs'])){
	   return 0;
	}
	else{
	   return count($_REQUEST['erreurs']);
	}
}

function afficherErreurs(){
   echo '<div class="msgErreur">';
   echo '<ul>';
   foreach($_REQUEST['erreurs'] as $erreur){
      echo "<li>$erreur</li>";
	}
   echo '</ul>';
   echo '</div>';
}

?>
