<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../bootstrap.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Projets - oeco architectes</title>
  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="projects container">

  <header>
    <a href="<?=BASEURL?>/"><img class="logo" src="<?=BASEURL?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" /></a>
    <nav id="navigation">
      <ul class="inline-list">
        <li><a href="<?=BASEURL?>/projets" class="active">projets</a></li>
        <li><a href="<?=BASEURL?>/agence">agence</a></li>
        <li><a href="<?=$config->facebook?>" title="Facebook page" target="_blank"><img src="<?=BASEURL?>/img/facebook.png" /></a></li>
      </ul>
    </nav>
  </header>

<section>

  <ul id="project-categories" class="inline-list">
    <?php $categories = include 'services/categories.php'; ?>
    <?php if($categories['ok']): ?>
      <?php foreach($categories['categories'] as $category): ?>
        <li class="project-category-<?=$category['id']?>"><a href="#" data-id="<?=$category['id']?>"><?=strtolower($category['name'])?></a></li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>

<div id="projects">
  <?php
    $projects = include 'services/projects.php';
    $projects = $projects['projects'];
    foreach ($projects as $i => $project) {
      if (!$project['published']) {
        unset($projects[$i]);
      }
    }
    shuffle($projects);

    use \Model\MozaicLayout;
    $layout = new MozaicLayout(count($projects), 4);
  ?>

  <?php $i = -1; ?>
  <?php foreach($layout->getLines() as $line): ?>
    <div class="row">
      <?php foreach($line as $item): ?>
        <?php
          switch($item) {
                   case MozaicLayout::ITEM_SMALL:       $i++; ?><a class="pic pic-small col-sm-3 active <?='pic-' . implode(' pic-',$projects[$i]['categories'])?>" href="<?=BASEURL?>/projets/<?=$projects[$i]['id']?>"><figure><img src="<?=BASEURL?>/services/image.php?path=projects/<?=$projects[$i]['id']?>/<?=$projects[$i]['id']?>-01.jpg&amp;width=290&amp;height=190" width="290" height="190" alt="<?=$projects[$i]['title']?>" title="<?=$projects[$i]['title']?>" /><figcaption><?=$projects[$i]['title']?></figcaption></figure></a><?php
            break; case MozaicLayout::ITEM_HIGH_TOP:    $i++; ?><a class="pic pic-high  col-sm-3 active <?='pic-' . implode(' pic-',$projects[$i]['categories'])?>" href="<?=BASEURL?>/projets/<?=$projects[$i]['id']?>"><figure><img src="<?=BASEURL?>/services/image.php?path=projects/<?=$projects[$i]['id']?>/<?=$projects[$i]['id']?>-01.jpg&amp;width=290&amp;height=390" width="290" height="390" alt="<?=$projects[$i]['title']?>" title="<?=$projects[$i]['title']?>" /><figcaption><?=$projects[$i]['title']?></figcaption></figure></a><?php
            break; case MozaicLayout::ITEM_HIGH_BOTTOM:       ?><div class="col-sm-3">&nbsp;</div><?php
            break; case MozaicLayout::ITEM_LARGE_LEFT : $i++; ?><a class="pic pic-large col-sm-6 active <?='pic-' . implode(' pic-',$projects[$i]['categories'])?>" href="<?=BASEURL?>/projets/<?=$projects[$i]['id']?>"><figure><img src="<?=BASEURL?>/services/image.php?path=projects/<?=$projects[$i]['id']?>/<?=$projects[$i]['id']?>-01.jpg&amp;width=590&amp;height=190" width="590" height="190" alt="<?=$projects[$i]['title']?>" title="<?=$projects[$i]['title']?>" /><figcaption><?=$projects[$i]['title']?></figcaption></figure></a><?php
            break; case MozaicLayout::ITEM_LARGE_RIGHT:       ?><?php
          }
        ?>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

</section>
</div>

<?php include __DIR__ . '/parts/scripts.phtml'; ?>
</body>
</html>
