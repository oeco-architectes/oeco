<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../../bootstrap.php');

session_start();
if (!isset($_SESSION['username'])) {
  header('Location: /admin/login');
  exit(0);
}

$properties = include 'services/properties.php';
$properties = $properties['properties'];

$categories = include 'services/categories.php';
$categories = $categories['categories'];

$new = $_GET['new'] === 'true';
if ($new) {
  $project = array(
    'id' => null,
    'title' => '',
    'summary' => '',
    'content' => '',
    'published' => false,
    'date' => date('d/m/Y'),
    'properties' => array(),
    'categories' => array(),
  );
}
else {
  $projectId = $_GET['id'];
  $project = include 'services/project.php';
  $project = $project['project'];
  $project['date'] = $project['date']->format('d/m/Y');
}

// Actions
$messages = array();
$fieldMessages = array();
$queries = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $project['id'] = $_POST['id'];
  $project['title'] = $_POST['title'];
  $project['summary'] = $_POST['summary'];
  $project['content'] = $_POST['content'];
  $project['published'] = array_key_exists('published', $_POST);
  $project['date'] = $_POST['date'];
  foreach ($properties as $id => $property) {
    if (empty($_POST['properties'][$id])) {
      unset($project['properties'][$id]);
    }
    else {
      $project['properties'][ $property['id'] ] = $_POST['properties'][$id];
    }
  }
  foreach ($categories as $category) {
    $key = array_search($category['id'], $project['categories']);
    if (!array_key_exists('categories', $_POST) || !array_key_exists($category['id'], $_POST['categories'])) {
      if ($key !== false) {
        unset($project['categories'][$key]);
      }
    }
    elseif ($key === false) {
      $project['categories'][] = $category['id'];
    }
  }

  if ($project['id'] === '') {
    $fieldMessages['id'] = array('danger', 'L\'identifiant est obligatoire.');
  }
  else if (!preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $project['id'])) {
    $fieldMessages['id'] = array('danger', 'L\'identifiant doit contenir uniquement des caractères minuscules (pas d\'accents), des chiffres et des tirets. Il ne doit ni commencer ni terminer par un tiret. Il ne doit pas contenir deux tirets consécutifs.');
  }

  // if ($project['title'] === '') {
  //   $fieldMessages['title'] = array('danger', 'Le titre est obligatoire.');
  // }

  if ($project['date'] === '') {
    $fieldMessages['date'] = array('danger', 'La date est obligatoire.');
  }
  else if (!preg_match('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/', $project['date'], $matches)) {
    $fieldMessages['date'] = array('danger', 'La date doit être au format JJ/MM/AAAA.');
  }
  else if (!checkdate($matches[2], $matches[1], $matches[3])) {
    $fieldMessages['date'] = array('danger', 'Cette date n\'existe pas.');
  }

  if (count($fieldMessages) === 0) {

    try {

      $adapter = new Zend\Db\Adapter\Adapter($config->db->toArray());
      $platform = $adapter->platform;
      $connection = $adapter->getDriver()->getConnection();

      // Project
      if ($new) {
        $queries[] = 'INSERT INTO `projects` (`id`, `title`, `summary`, `content`, `date`, `published`) VALUES ('
          . $platform->quoteValueList(array(
            $project['id'],
            $project['title'],
            empty($project['summary']) ? null : $project['summary'],
            $project['content'],
            DateTime::createFromFormat('d/m/Y H:i:s', $project['date'] . ' 00:00:00')->format('Y-m-d H:i:s')
          ))
          . ', ' . intval($project['published'])
          . ')';
      }
      else {
        $queries[] = 'UPDATE `projects` SET'
          . ' `title` = '     . $platform->quoteValue($project['title']) . ','
          . ' `summary` = '   . $platform->quoteValue(empty($project['summary']) ? null : $project['summary']) . ','
          . ' `content` = '   . $platform->quoteValue($project['content']) . ','
          . ' `published` = ' . intval($project['published']) . ','
          . ' `date` = '      . $platform->quoteValue( DateTime::createFromFormat('d/m/Y H:i:s', $project['date'] . ' 00:00:00')->format('Y-m-d H:i:s') )
          . ' WHERE `id` = ' . $platform->quoteValue($project['id']);
      }

      // Categories
      $queries[] = 'DELETE FROM `project_categories` WHERE `project_id` = ' . $platform->quoteValue($project['id']);
      foreach ($categories as $id => $category) {
        if (in_array($category['id'], $project['categories'])) {
          $queries[] = 'INSERT INTO `project_categories` (`project_id`, `category_id`) VALUES (' . $platform->quoteValueList(array($project['id'], $category['id'])) . ')';
        }
      }

      // Properties
      $queries[] = 'DELETE FROM `project_properties` WHERE `project_id` = ' . $platform->quoteValue($project['id']) . '';
      foreach ($properties as $id => $property) {
        if (array_key_exists($property['id'], $project['properties'])) {
          $queries[] = 'INSERT INTO `project_properties` (`project_id`, `property_id`, `value`) VALUES (' . $platform->quoteValueList(array($project['id'], $property['id'], $project['properties'][ $property['id'] ])) . ')';
        }
      }

      // Send queries to DB
      $connection->beginTransaction();
      foreach ($queries as $query) {
        $adapter->query($query)->execute();
      }
      $connection->commit();

      if ($new) {
        mkdir('data/img/projects/' . $project['id']);
        $new = false;
        $messages[] = array('success', '<a class="btn btn-success pull-right" href="' . BASEURL . '/admin">Retour à l\'accueil</a> <p class="clearfix">Le projet a été créé avec succès.</p>');
      }
      else {
        $messages[] = array('success', '<a class="btn btn-success pull-right" href="' . BASEURL . '/admin">Retour à l\'accueil</a> <p class="clearfix">Le projet a été modifié avec succès.</p>');
      }
    }
    catch (Exception $e) {
      $messages[] = array('danger', $e->getMessage());
      try {
        $connection->rollback();
      }
      catch (Exception $e) {
        $messages[] = array('danger', $e->getMessage());
      }
    }
  }
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

    <?php if (!$new && $_GET['new'] === 'true'): ?>
      <script>
        window.history && window.history.replaceState(null, 'Agence - oeco architectes', '<?=BASEURL?>/admin/project/<?= $project['id'] ?>/edit');
      </script>
    <?php endif; ?>

    <?php if (APPLICATION_ENV === 'development'): ?>
      <script>
        <?php foreach ($queries as $query): ?>
          console.info('SQL', '<?= str_replace("'", "\\'", str_replace("\r", '\\r', str_replace("\n", '\\n', htmlentities($query)))) ?>');
        <?php endforeach; ?>
      </script>
    <?php endif; ?>
  </header>

  <br/>
  <h1>
    <?= $new ? 'Nouveau projet' : 'Edition de projet' ?>
  </h1>
  <br/>
  <form role="form" method="post" action="<?=BASEURL?>/admin/project/<?= $new ? 'new' : $project['id'] . '/edit' ?>">

    <?php foreach ($messages as $message): ?>
      <div class="row">
        <div class="col col-sm-6 col-sm-offset-3">
          <div class="alert alert-<?= $message[0] ?>"><?= $message[1] ?></div>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="row">

      <div class="col col-sm-8">

        <div class="form-group <?= array_key_exists('id', $fieldMessages) ? 'has-error' : '' ?>">
          <label for="id">Identifiant</label>
          <small class="help-block">
            L'identifiant apparaitra dans l'adresse du projet. Ex: http://www.oeco-architectes.com/projets/regie-eaux-dax.
            Il ne doit contenir que des lettres minuscules, des chiffres et des tirets.
            Google et les autres moteurs de recherche priorisent les adresses contenant
            les mot-clés recherchés dans leurs résultats, il faut donc nommer ce champ
            comme si on faisait une recherche.
          </small>
          <small class="help-block">
            Attention: il n'est pas possible de modifier ce champ une fois le projet créé !
          </small>
          <input id="id" name="id" type="text" class="form-control" value="<?= $project['id']; ?>" placeholder="Ex: regie-eaux-dax" <?= $new ? '' : ' readonly' ?> />
          <?php if (array_key_exists('id', $fieldMessages)): ?>
            <br/>
            <div class="alert alert-<?= $fieldMessages['id'][0] ?>"><?= $fieldMessages['id'][1] ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group <?= array_key_exists('title', $fieldMessages) ? 'has-error' : '' ?>">
          <label for="title">Titre</label>
          <input id="title" name="title" type="text" class="form-control" value="<?= $project['title']; ?>" placeholder="Ex: Bureaux L, bureaux pour des agriculteurs à Liposthey" />
          <?php if (array_key_exists('title', $fieldMessages)): ?>
            <br/>
            <div class="alert alert-<?= $fieldMessages['title'][0] ?>"><?= $fieldMessages['title'][1] ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="summary">Résumé</label>
          <small class="help-block">Le résumé est optionnel. Si renseigné, il apparaitra juste en dessous du titre.</small>
          <input id="summary" name="summary" type="text" class="form-control" value="<?= $project['summary']; ?>" placeholder="Ex: Prix de la première œuvre Le Moniteur 2011" />
        </div>

        <div class="form-group">
          <label for="content">Texte</label>
          <small class="help-block">Les images seront insérées automatiquement entre 2 paragraphes.</small>
          <textarea id="content" name="content" class="form-control" rows="40"><?= $project['content'] ?></textarea>
        </div>

      </div>

      <div class="col col-sm-3 col-sm-offset-1">

        <div class="form-group <?= array_key_exists('date', $fieldMessages) ? 'has-error' : '' ?>">
          <label for="date">Date</label>
          <small class="help-block">Date du projet au format JJ/MM/AAAA</small>
          <input id="date" name="date" type="text" class="form-control" value="<?= $project['date']; ?>" placeholder="Ex: 1985-02-18" />
          <?php if (array_key_exists('date', $fieldMessages)): ?>
            <br/>
            <div class="alert alert-<?= $fieldMessages['date'][0] ?>"><?= $fieldMessages['date'][1] ?></div>
          <?php endif; ?>
        </div>

        <br />
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input id="published" name="published" type="checkbox" <?= $project['published'] ? ' checked' : '' ?>/> Publié
            </label>
          </div>
          <small class="help-block">Seuls les projets publiés sont visibles</small>
        </div>

        <br />
        <div class="form-group">
          <label>Catégories</label>
          <?php foreach ($categories as $category): ?>
            <div class="checkbox">
              <label>
                <input id="categories[<?= $category['id'] ?>]"
                       name="categories[<?= $category['id'] ?>]"
                       type="checkbox"
                       <?= in_array($category['id'], $project['categories']) ? 'checked' : '' ?>
                />
                <?= $category['name'] ?>
              </label>
            </div>
          <?php endforeach; ?>
        </div>

        <br />
        <?php foreach ($properties as $id => $property): ?>
          <div class="form-group">
            <label for="properties[<?= $id ?>]"><?= $property['name']; ?></label>
            <input id="properties[<?= $id ?>]"
                   name="properties[<?= $id ?>]"
                   type="text"
                   class="form-control"
                   value="<?= array_key_exists($id, $project['properties']) ? $project['properties'][$id] : '' ?>"
            />
          </div>
        <?php endforeach; ?>

      </div>

    </div>

    <div class="row">
      <button type="submit" class="btn btn-default btn-primary">Enregistrer</button>
      <a href="/admin" class="btn btn-default">Annuler</a>
    </div>
  </form>

</div>
</body>
</html>
