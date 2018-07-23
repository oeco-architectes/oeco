<?php
// Fetch project
$origin = get_server_origin($_SERVER) . $baseUrl;
$projectId = $_GET['id'];
$project = include 'application/services/project.php';
$properties = include 'application/services/properties.php';
$title = $project['ok'] ? $project['project']['title'] : 'Article inconnu';
$canonicalUrl = $origin . '/projets/' . $project['project']['id'];

// Render layout
$this->layout('layout', [
  'view' => $view,
  'config' => $config,
  'baseUrl' => $baseUrl,
  'min' => $min,
  'title' => $title,
  'wide' => false,
]);
?>

<?php
 // Meta
 // ----
?>
<?php $this->start('meta') ?>
  <link rel="canonical" href="<?= $this->e($canonicalUrl) ?>">
  <meta name="og:url" content="<?= $canonicalUrl ?>">
  <meta name="og:title" content="<?= $title ?>">
  <meta name="og:site_name" content="<?= 'OECO Architectes' ?>">
  <meta name="og:image" content="<?= $origin . '/img/projects/' . $project['project']['id'] . '/' . $project['project']['id'] . '-01@1200x600.jpg' ?>">
  <meta name="og:description" content="<?= str_replace("\r\n", ' ', explode("\r\n\r\n", $project['project']['content'])[0]) ?>">
  <meta name="og:type" content="<?= 'article' ?>">
  <meta name="og:locale" content="<?= 'fr_FR' ?>">
<?php $this->stop() ?>

<?php
 // Content
 // -------
?>
<?php
  use League\CommonMark\CommonMarkConverter;
  $converter = new CommonMarkConverter();
?>
<?php if($project['ok']): ?>
  <div class="row">
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
