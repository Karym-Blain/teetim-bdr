<?php
// Définir la variable $page pour indiquer la page affichée.
include ('lib/catalogue.lib.php');
$page = 'teeshirts';

// Inclure la partie de haut de la page.
include('parties-communes/entete.php');


[$themes, $produits] = obtenirCatalogue($page, $langue);
// Trier les produits aléatoirement.
shuffle($produits);

// Formatteur des montants d'argent
$formatteurMontants = new NumberFormatter($langue, NumberFormatter::CURRENCY);
/** @var stdClass $_ : raccourci pour la section texte de cette page. */
?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_->titrePage ?></h1>
		<form class="controle">
			<div class="filtre">
				<label for="filtre">Filtrer par thème : </label>
				<select name="filtre" id="filtre">
					<option value="tous">Tous les produits</option>

					<!-- Gabarit pour le choix d'un thème -->

					<?php foreach ($themes as $codeTheme => $nomTheme) : ?>
						<option value="<?= $codeTheme; ?>">
							<?= $nomTheme; ?>
						</option>
					<?php endforeach; ?>

				</select>
			</div>
			<div class="tri">
				<label for="tri">Trier par : </label>
				<select name="tri" id="tri">
					<option value="aleatoire">Aleatoire</option>
					<option value="ventesDesc">Meilleur vendeur</option>
					<option value="prixAsc">Prix / ascendant</option>
					<option value="prixDesc">Prix / descendant</option>
					<option value="nomAsc">Alpha / ascendant</option>
					<option value="nomDesc">Alpha / descendant</option>
					<option value="dateDesc">Nouveauté</option>
				</select>
			</div>
		</form>
	</article>
	<article class="principal">
		<!-- Gabarit -->
		<?php foreach ($produits as $prd) : ?>
			<div class="produit">
				<span class="image">
					<img
						src="images/produits/teeshirts/<?= $prd->id; ?>.webp"
						alt="<?= $prd->nom->$langue; ?>">
				</span>
				<span class="nom"><?= $prd->nom->$langue; ?></span>
				<span class="prix">
					<?= $formatteurMontants->formatCurrency($prd->prix, 'CAD'); ?>
				</span>
			</div>
		<?php endforeach; ?>
	</article>
</main>
<?php include('parties-communes/pied2page.php'); ?>