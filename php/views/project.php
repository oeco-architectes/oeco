<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../bootstrap.php');

$href = get_server_origin($_SERVER) . BASEURL;
$projectId = $_GET['id'];
$project = include 'services/project.php';
$properties = include 'services/properties.php';
$title = $project['ok'] ? $project['project']['title'] : 'Article inconnu';

use League\CommonMark\CommonMarkConverter;
$converter = new CommonMarkConverter();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title><?= $title ?> - OECO Architectes</title>
  <link rel="canonical" href="<?= $href ?>/projets/<?= $project['project']['id'] ?>">

  <meta property="og:url" content="<?= $href ?>/projets/<?= $project['project']['id'] ?>">
  <meta property="og:title" content="<?= $title ?>">
  <meta property="og:site_name" content="OECO Architectes">
  <meta property="og:image" content="<?= $href ?>/img/projects/<?= $project['project']['id'] ?>/<?= $project['project']['id'] ?>-01@1200x600.jpg">
  <meta property="og:description" content="<?= str_replace("\r\n", ' ', explode("\r\n\r\n", $project['project']['content'])[0]) ?>">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="fr_FR">

  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="project container">

  <div class="row">
    <header class="col-sm-10 col-sm-offset-1">
      <a href="<?=BASEURL?>/"><img class="logo" src="<?=BASEURL?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" /></a>
      <nav id="navigation">
        <ul class="inline-list">
          <li><a href="<?=BASEURL?>/projets" class="active">projets</a></li>
          <li><a href="<?=BASEURL?>/agence">agence</a></li>
          <li><a href="<?=$config->facebook?>" title="Facebook page" target="_blank"><img src="<?=BASEURL?>/img/facebook.png" /></a></li>
        </ul>
      </nav>
    </header>
  </div>

  <?php if($project['ok']): ?>
    <div class="project-details row">

      <section class="col-sm-10 col-sm-offset-1">

        <h1 class="project-title"><?= $project['project']['title'] ?></h1>
        <?php if(isset($project['project']['summary'])): ?>
          <h2 class="project-summary"><?= $project['project']['summary'] ?></h2>
        <?php endif ?>

        <?php
          $width = 945;
        ?>

        <?php foreach(explode("\r\n\r\n", $project['project']['content']) as $i => $paragraph): ?>

          <div class="description">
            <?= $converter->convertToHtml(str_replace("\r\n", '<br/>', $paragraph)); ?>
          </div>

          <?php if (array_key_exists($i, $project['project']['images'])): ?>
            <?php $image = $project['project']['images'][$i]; ?>
            <?php $image['id'] = preg_replace('/^.*\/([^\/]+)\.jpg$/', '$1', $image['path']); ?>
            <?php include __DIR__ . '/parts/image.phtml'; ?>
          <?php endif; ?>

        <?php endforeach; ?>

        <?php for($i++; $i < count($project['project']['images']) ; $i++): ?>
          <?php $image = $project['project']['images'][$i]; ?>
          <?php $image['id'] = preg_replace('/^.*\/([^\/]+)\.jpg$/', '$1', $image['path']); ?>
          <?php include __DIR__ . '/parts/image.phtml'; ?>
        <?php endfor; ?>

        <?php if (count($project['project']['properties']) > 0): ?>
          <hr />
          <dl class="dl-horizontal">
            <?php foreach($properties['properties'] as $property): ?>
              <?php if (array_key_exists($property['id'], $project['project']['properties'])): ?>
                <dt><?= $property['name'] ?></dt>
                <dd><?= $converter->convertToHtml($project['project']['properties'][ $property['id'] ]); ?></dd>
              <?php endif; ?>
            <?php endforeach; ?>
          </dl>
        <?php endif; ?>

        <hr />
        <p class="actions">
          ◂ <a href="<?=BASEURL?>/projets">Retour</a>
        </p>

      </section>

    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/parts/scripts.phtml'; ?>
</body>
</html>
