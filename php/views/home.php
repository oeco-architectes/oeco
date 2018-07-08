<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../bootstrap.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>oeco architectes</title>
  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="home container">

  <header>
    <img class="logo" src="<?=BASEURL?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" />

    <nav id="navigation">
      <ul class="inline-list">
        <li><a href="<?=BASEURL?>/projets">projets</a></li>
        <li><a href="<?=BASEURL?>/agence">agence</a></li>
        <li><a href="<?=$config->facebook?>" title="Facebook page" target="_blank"><img src="<?=BASEURL?>/img/facebook.png" /></a></li>
      </ul>
    </nav>
  </header>

  <section>
    <?php $news = include 'services/news.php'; ?>
    <?php if($news['ok']): ?>
      <div id="news" class="carousel slide">

        <ol class="carousel-indicators">
          <?php foreach($news['news'] as $i => $new): ?>
            <li data-target="#news" data-slide-to="<?php echo $i; ?>" class="<?= $i == 0 ? 'active ' : ''?>"></li>
          <?php endforeach; ?>
        </ol>

        <div class="carousel-inner">
          <?php foreach($news['news'] as $i => $new): ?>
            <figure class="item<?= $i == 0 ? ' active' : ''?>">
              <img src="<?=BASEURL?>/services/image.php?path=news/<?=$new['id']?>.jpg&amp;width=800&amp;height=500" width="800" height="500" alt="<?=$new['title']?>" />
              <figcaption>
                <p class="news-title"><?=$new['title']?></p>
                <p class="news-summary"><?=$new['summary']?></p>
              </figcaption>
            </figure>
          <?php endforeach; ?>
        </div>

        <a class="left carousel-control" href="#news" data-slide="prev">
          <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#news" data-slide="next">
          <span class="icon-next"></span>
        </a>

      </div>
    <?php endif; ?>
  </section>
</div>

<?php include __DIR__ . '/parts/scripts.phtml'; ?>
</body>
</html>
