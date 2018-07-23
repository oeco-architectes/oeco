<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../../Bootstrap.php');

function isPasswordCorrect($config, $username, $password) {

  if (!preg_match('/^[a-z0-9\\.-]+$/', $username)) {
    return false;
  }

  $adapter = new Zend\Db\Adapter\Adapter($GLOBALS['config']->db->toArray());
  $sql = 'SELECT * FROM `users` WHERE `id` =  \'' . $username . '\' AND `password` = \'' . md5($password) . '\'';
  $result = $adapter->query($sql)->execute();
  $result->buffer();
  if($result->count() === 1) {
    return true;
  }
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    if (isPasswordCorrect(
      $config,
      ($username = $_POST['username']),
      ($password = $_POST['password'])
    )) {
      session_start();
      $_SESSION['username'] = $username;
      header('Location: /admin');
      exit(0);
    }
    $wrongPassword = true;
}
else {
  $wrongPassword = false;
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
    <form role="form" method="post" class="col col-sm-4 col-sm-offset-4">
      <h1>Identification requise</h1>
      <br/>
      <?php if ($wrongPassword): ?>
        <p class="alert alert-danger">Votre nom d'utilisateur ou votre mot de passe est incorrect.</p>
      <?php endif; ?>
      <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" />
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>" />
      </div>
      <button type="submit" class="btn btn-default btn-primary">Se connecter</button>
    </form>
  </div>

</div>
</body>
</html>
