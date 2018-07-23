<?php
http_response_code(404);
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../Bootstrap.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <title>Impossible de trouver la page - oeco architectes</title>
  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="agency container">

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

    <section class="span9">
      <h1 class="title">ŒCO Architectes : Œuvre Collective</h1>
      <article class="description">
        <p>Cette page n'existe pas.</p>
      </article>
    </section>
  </div>
</div>

<?php include __DIR__ . '/parts/scripts.phtml'; ?>
</body>
</html>
