<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../../bootstrap.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /admin/login');
  exit(0);
}

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Agence - oeco architectes</title>
  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="container">

  <header>
    <p>
      Connecté(e) en tant que <?= $_SESSION['username'] ?>.
      <a href="/admin/logout">Se déconnecter</a>
    </p>
    <a href="<?=BASEURL?>/"><img class="logo" src="<?=BASEURL?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" /></a>
    <nav id="navigation">
      <ul class="inline-list">
        <li><a href="<?=BASEURL?>/projets">projets</a></li>
        <li><a href="<?=BASEURL?>/agence" class="active">agence</a></li>
        <li><a href="<?=$config->facebook?>" title="Facebook page" target="_blank"><img src="<?=BASEURL?>/img/facebook.png" /></a></li>
      </ul>
    </nav>
  </header>

  <br/>
  <h1>Administration</h1>
  <br/>

  <div class="row">

    <br/>
    <div class="col col-md-12">
      <h2>Projets</h2>
      <?php
        $projects = include 'services/projects.php';
        $projects = $projects['projects'];
      ?>
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>Titre</th>
            <th class="text-center">Publié</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $project): ?>
          <tr>
            <td>
              <?= $project['title'] ?>
              <br />
              <small class="text-muted"><?= $project['summary'] ?></small>
            </td>
            <td class="text-center">
              <?= $project['published'] ? '✔' : '' ?>
            </td>
            <td class="text-center">
              <a class="btn btn-default" href="/projets/<?= $project['id']; ?>"><?= $project['published'] ? 'Voir' : 'Prévisualiser' ?></a>
              <a class="btn btn-default" href="/admin/project/<?= $project['id']; ?>/edit">Editer</a>
              <a class="disabled btn btn-default btn-danger" href="/admin/project/<?= $project['id']; ?>/delete">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <a class="btn btn-primary" href="/admin/project/new">Ajouter un projet</a>
    </div>

    <br/>
    <div class="col col-md-12">
      <h2>News</h2>
      <?php
        $news = include 'services/news.php';
        $news = $news['news'];
      ?>
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>Titre</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($news as $new): ?>
          <tr>
            <td>
              <?= $new['title'] ?>
            </td>
            <td class="text-center">
              <a class="disabled btn btn-default" href="/admin/new/<?= $new['id']; ?>/edit">Editer</a>
              <a class="disabled btn btn-default btn-danger" href="/admin/new/<?= $new['id']; ?>/delete">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <button class="disabled btn btn-default btn-primary">Ajouter une news</button>
    </div>

  </div>

</div>
</body>
</html>
