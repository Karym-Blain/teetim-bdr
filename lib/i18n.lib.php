<?php

/**
 * Obtient la collection des langues disponibles.
 * @return array Tableau des codes de langues. 
 */
function obtenirLanguesDisponibles()
{
  $languesDispo = [];
  $contenuI18n = scandir('i18n');
  for ($i = 0; $i < count($contenuI18n); $i++) {
    $fichier = $contenuI18n[$i];
    if ($fichier != '.' && $fichier != '..') {
      $languesDispo[] = substr($fichier, 0, 2);
    }
  }
  return $languesDispo;
}
/**
 * Determiner la langue d'affichage active du site
 * @param array $languespermises tableau des de langues disponibles
 * @return string $langues
 */
function determinerlangue($languesPermises){
// 1. Langue par défaut
$langue = 'fr';

// 2. Langue mémorisée dans un témoin HTTP
if (isset($_COOKIE['choixLangue']) && in_array($_COOKIE['choixLangue'], $languesPermises)) {
	$langue = $_COOKIE['choixLangue'];
}

// 3. Langue spécifiée explicitement
if (isset($_GET['lan']) &&  in_array($_GET['lan'], $languesPermises)) {
	$langue = $_GET['lan'];
	setcookie('choixLangue', $langue, time() + 30 * 24 * 3600);
}
return $langue;
}
/**
 * obtient le stextes d ela page specifié a partir du fichier Json
 * dans la langue spécifié par son code
 * @param string  $codeLangue en deux lerttre de la langue d'affichage 
 * @param string $nomPage  Nom dan ;a page requise
 * @return array tableau contenant des raccourcis pour les textes de l'entete,
 *  du pied de page et du contenu de la page spécifique (sous forme d'objets)
 * Php
 */
function obtenirtextesStatiques($codesLangue,$nomPage){
  $textesJSON = file_get_contents("i18n/" . $codesLangue . ".json");
$textes = json_decode($textesJSON);
// Variables raccourcis pour les parties communes
$_ent = $textes->entete;
$_pp = $textes->pp;
// Variable raccourci pour toutes les pages spécifiques
$_ = @$textes->$nomPage;
return[$_ent, $_pp, $_];
}

function determinerDirectionLangueEcriture($codeLangue){
  // Déterminer la direction d'écriture
return in_array($codeLangue, ["ar", "he", "fa", "ur", "dv", "ps", "ku"])
	? 'rtl' : 'ltr';

}
