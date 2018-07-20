<?php
/**
 * Application initialization
 */

// Bootstrapping
chdir(__DIR__);
$loader = require_once 'vendor/autoload.php';

// Constants
if(!defined('APPLICATION_ENV')) {
	define('APPLICATION_ENV', getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production');
}
if(APPLICATION_ENV === 'development') {
	define('BASEURL', $_SERVER['HTTP_HOST'] === 'localhost' ? '/www.oeco-architectes.com' : '');
	define('MIN', '');
}
else {
	define('BASEURL', '');
	define('MIN', '.min');
}

function is_https_enabled($server) {
  return array_key_exists('HTTPS', $server) && $_SERVER['HTTPS'] === 'on';
}

function is_default_port($server) {
  return is_https_enabled($server) && $server['SERVER_PORT'] === '443' || !is_https_enabled($server) && $server['SERVER_PORT'] === '80';
}

function get_server_host($server) {
  return $_SERVER['SERVER_NAME'] . (is_default_port($server) ? '' : ':' . $server['SERVER_PORT']);
}

function get_server_scheme($server) {
   return is_https_enabled($server) ? 'https' : 'http';
}

function get_server_origin($server) {
  return get_server_scheme($server) . '://' .get_server_host($_SERVER);
}

// Config
$config = new Zend\Config\Config(include 'config/application.config.php', true);
foreach(array_diff(scandir('config/autoload'), array('.','..')) as $filename) {
	if(preg_match('/\.php$/', $filename)) {
		$config->merge(new Zend\Config\Config(include 'config/autoload/' . $filename));
	}
}
