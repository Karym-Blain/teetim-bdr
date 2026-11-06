<?php 
    // Indiquer la page
    $page = "apropos";
    include("parties-communes/entete.php"); 
?>
    <main class="page-apropos">
        <article class="amorce">
            <h1><?= $_->titrePage; ?></h1>
        </article>
        <article class="principal">
            <?= $_->aVenir; ?>
        </article>
    </main>
<?php include("parties-communes/pied2page.php"); ?>
