<?php
try {
	require_once realpath(__DIR__ . '/../Bootstrap.php');

	$adapter = new Zend\Db\Adapter\Adapter($GLOBALS['config']->db->toArray());

	$projects = array();
	foreach($adapter->query('SELECT * FROM `projects`')->execute() as $project) {
		$item = array();
		foreach($project as $key => $value) {
			$item[$key] = $value;
		}
		$projects[] = $item;
	}

	// Categories
	foreach($projects as $i => $project) {
		$projects[$i]['categories'] = array();
		foreach($adapter->query('SELECT * FROM `project_categories` WHERE `project_id` = \'' . $project['id'] . '\'')->execute() as $projectCategory) {
			$projects[$i]['categories'][] = $projectCategory['category_id'];
		}
	}

	$output = array(
		'ok' => true,
		'projects' => $projects,
	);
}
catch(Exception $e) {
	$output = array(
		'ok' => false,
		'error' => $e->getMessage() . "\n" . $e->getTraceAsString()
	);
}

if(isset($_GET['json']) || !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	header('Content-Type: application/json');
	echo \Zend\Json\Json::encode($output);
}
else {
	return $output;
}
