<?php
// Render layout
$this->layout('layout', [
    'view' => 'agency',
    'config' => $config,
    'baseUrl' => $baseUrl,
    'min' => $min,
    'title' => 'Publications'
]);
?>

<div class="row">

    <section class="col-sm-7">

        <h1 class="title">Prix &amp; publications</h1>
        <article class="description">
            <p>
                <img src="<?=BASEURL?>/img/publications.jpg" alt="Prix &amp; publications d'oeco" width="661" height="437" />
            </p>
        </article>

        <p class="actions">
            ◂ <a href="<?=BASEURL?>/agence">Retour</a>
        </p>
    </section>

    <?php include __DIR__ . '/parts/agency.phtml'; ?>
</div>
