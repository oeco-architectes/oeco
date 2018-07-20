<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../bootstrap.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Publications - oeco architectes</title>
  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="agency publications container">

  <header>
    <a href="<?=BASEURL?>/"><img class="logo" src="<?=BASEURL?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" /></a>
    <nav id="navigation">
      <ul class="inline-list">
        <li><a href="<?=BASEURL?>/projets">projets</a></li>
        <li><a href="<?=BASEURL?>/agence" class="active">agence</a></li>
        <li><a href="<?=$config->facebook?>" title="Facebook page" target="_blank"><img src="<?=BASEURL?>/img/facebook.png" /></a></li>
      </ul>
    </nav>
  </header>

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

    <aside class="people col-sm-4 col-sm-offset-1" itemscope itemtype="http://schema.org/Organization">
      <div class="row-fluid">
        <figure class="col-sm-12">
          <img src="<?=BASEURL?>/img/people/team.jpg"/>
        </figure>
        <figcaption>
          <span class="col-sm-4 text-center">Vanessa<br/>Larrère</span>
          <span class="col-sm-4 text-center">Claire<br/>Furlan</span>
          <span class="col-sm-4 text-center">Coralie<br/>Bouscal</span>
        </figcaption>
      </div>
      <div class="row-fluid">
        <div class="col-sm-11">
          <?php include __DIR__ . '/parts/agency.phtml'; ?>
        </div>
      </div>
    </aside>
  </div>
</div>

<?php include __DIR__ . '/parts/scripts.phtml'; ?>
</body>
</html>
