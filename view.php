<?php
require_once realpath(__DIR__ . '/application/Bootstrap.php');
$templates = new League\Plates\Engine(__DIR__ . '/application/views');
echo $templates->render($_GET['view'], [
  'view' => $_GET['view'],
  'config' => $GLOBALS['config'],
  'baseUrl' => BASEURL,
  'min' => MIN,
]);
