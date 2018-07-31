<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title><?= isset($title) ? $this->e($title) . ' - ' : '' ?>ŒCO Architectes</title>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <?= $this->section('meta') ?>
  <link rel="stylesheet" href="<?= $baseUrl ?>/css/website<?= $min ?>.css">
</head>
<body>
  <div class="<?= $this->e($view) ?> container">
    <?php
      // Nav
      // ---
      $narrow = isset($wide) && $wide === false; // TODO: Find a more elegant solution
    ?>
    <?= $narrow ? '<div class="row">' : '' ?>
      <header<?= $narrow ? ' class="col-sm-10 col-sm-offset-1"' : '' ?>>
        <a id="logo" href="<?= $baseUrl ?>/"><img src="<?= $baseUrl ?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" /></a>
        <nav id="navigation">
          <ul class="inline-list">
            <li><a href="<?= $baseUrl ?>/projets" class="active">projets</a></li>
            <li><a href="<?= $baseUrl ?>/agence">agence</a></li>
            <li><a href="<?= $config->facebook ?>" title="Facebook page" target="_blank"><img src="<?= $baseUrl ?>/img/facebook.png" /></a></li>
          </ul>
        </nav>
      </header>
    <?= $narrow ? '</div>' : '' ?>

    <?php
      // Content
      // -------
    ?>
    <?= $this->section('content') ?>
  </div>

    <?php
    // Scripts
    // -------
    ?>
  <script src="<?= $baseUrl ?>/js/jquery-1.12.4<?= $min ?>.js"></script>
  <script src="<?= $baseUrl ?>/js/bootstrap<?= $min ?>.js"></script>
  <script src="<?= $baseUrl ?>/js/website<?= $min ?>.js"></script>
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-33132122-1']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = '<?= $baseUrl ?>/js/ga<?= $min ?>.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
</body>
