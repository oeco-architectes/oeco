<?php
try {
    require_once realpath(__DIR__ . '/../Bootstrap.php');

    // Check path

    if (!isset($_GET['id']) && !isset($projectId)) {
        throw new Exception('Missing parameter id', 400);
    }

    $id = isset($_GET['id']) ? $_GET['id'] : $projectId;

    if (!preg_match('/^[a-z0-9]+(-[a-z0-9]+)*$/', $id)) {
        throw new Exception('Invalid id "' . $id . '"', 400);
    }

    $adapter = new Zend\Db\Adapter\Adapter($GLOBALS['config']->db->toArray());

    $project = $adapter->query('SELECT * FROM `projects` WHERE `id` = \'' . $id . '\'')->execute()->current();
    if ($project === false) {
        throw new Exception('The project "' . $id . '" does not exist', 404);
    }

    // Date
    $project['date'] = DateTime::createFromFormat('Y-m-d H:i:s', $project['date']);

    // Categories
    $project['categories'] = array();
    foreach ($adapter->query('SELECT * FROM `project_categories` WHERE `project_id` = \'' . $id . '\'')->execute() as $projectCategory) {
        $project['categories'][] = $projectCategory['category_id'];
    }

    // Properties
    $project['properties'] = array();
    foreach ($adapter->query('SELECT * FROM `project_properties` WHERE `project_id` = \'' . $id . '\'')->execute() as $projectproperty) {
        $project['properties'][ $projectproperty['property_id'] ] = $projectproperty['value'];
    }

    // Images
    $project['images'] = array();
    foreach (array_diff(scandir($config->data->imgDir . '/projects/' . $id), array('.','..')) as $filename) {
        if (preg_match('/^' . preg_quote($id) . '-([0-9]+)\.jpg$/', $filename, $matches)) {
            $image = array(
                'path' => 'projects/'. $id . '/' . $filename,
            );

            // Image legend, etc...
            $imageInfo = $adapter->query('SELECT * FROM `images` WHERE `project_id` = \'' . $id . '\' AND `number` = \'' . $matches[1] . '\'')->execute()->current();
            $image['legend'] = $imageInfo ? $imageInfo['legend'] : null;

            $project['images'][] = $image;
        }
    }

    $output = array(
        'ok' => true,
        'project' => $project,
    );
} catch (Exception $e) {
    $output = array(
        'ok' => false,
        'error' => $e->getMessage() . "\n" . $e->getTraceAsString()
    );
}

if (isset($_GET['json']) || !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo \Zend\Json\Json::encode($output);
} else {
    return $output;
}
