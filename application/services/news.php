<?php
try {
	require_once realpath(__DIR__ . '/../../bootstrap.php');

	$adapter = new Zend\Db\Adapter\Adapter($GLOBALS['config']->db->toArray());

	$news = array();
	foreach($adapter->query('SELECT * FROM `news` ORDER BY `order`')->execute() as $new) {
		$item = array();
		foreach($new as $key => $value) {
			switch($key) {
				       case 'order'     : $item[$key] = intval($value);
				break; case 'project_id': $item[$key] = $value === '' ? null : $value;
				break; default          : $item[$key] = $value;
			}
		}
		$news[] = $item;
	}

	$output = array(
		'ok' => true,
		'news' => $news,
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
