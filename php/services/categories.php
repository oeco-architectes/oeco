<?php
try {
	require_once realpath(__DIR__ . '/../bootstrap.php');
	
	$adapter = new Zend\Db\Adapter\Adapter($config->db->toArray());
	
	$categories = array();
	foreach($adapter->query('SELECT * FROM `categories`')->execute() as $category) {
		$item = array();
		foreach($category as $key => $value) {
			switch($key) {
				default: $item[$key] = $value;
			}
		}
		$categories[] = $item;
	}
	
	$output = array(
		'ok' => true,
		'categories' => $categories,
	);
}
catch(Exception $e) {
	$output = array(
		'ok' => false,
		'error' => $e->getMessage()
	);
}

if(isset($_GET['json']) || !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	header('Content-Type: application/json');
	echo \Zend\Json\Json::encode($output);
}
else {
	return $output;
}