<?php
try {
	require_once realpath(__DIR__ . '/../bootstrap.php');
	
	$adapter = new Zend\Db\Adapter\Adapter($config->db->toArray());
	
	$properties = array();
	foreach($adapter->query('SELECT * FROM `properties` ORDER BY `order` ASC')->execute() as $category) {
		$item = array();
		foreach($category as $key => $value) {
			switch($key) {
				default: $item[$key] = $value;
			}
		}
		$properties[ $item['id'] ] = $item;
	}
	
	$output = array(
		'ok' => true,
		'properties' => $properties,
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