
<?php
/**library de code d ecatalogue de produit Teetim */

/**
 * @param string $categorie categorie de produit
 * @param string $codeDlangue code en 2 lettres de langues d'afficahgez
 */
function obtenirCatalogue($categorie, $codeLangue)
{

	// Intégrer le fichier JSON contenant le catalogue
	$catalogue = json_decode(file_get_contents("data/$categorie.json"));
	// print_r($catalogue);

	// Obtenir les thèmes et les produits de ce catalogue
	$themes = [];
	$produits = [];
	// "Boucler" à travers le catalogue pour remplir ces deux tableaux
	// print_r($catalogue);
	foreach ($catalogue as $codeTheme => $detailTheme) {
		// Ramasser l'information sur les thèmes...
		$themes[$codeTheme] = $detailTheme->theme->$codeLangue;
		// Ramasser l'information sur les produits...
		// Il faut joindre tous les petits tableaux des produits dans chaque thème.
		$produits = array_merge($produits, $detailTheme->produits);
	}
	return [$themes, $produits];
}
