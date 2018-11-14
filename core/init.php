<?php
	session_start();
	error_reporting(E_ALL);
	//error_reporting(0);

	define ('DATE_FORMAT', 'Y-m-d\TH:i:s\Z');



	$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => 'localhost',
			'user' => 'root',
			'pass' => '',
			'db'   => 'jon'
		),
		'base' => array(
			'url' => 'http://'.$_SERVER['HTTP_HOST'],
			'action' => $_SERVER['PHP_SELF'],
			'request_method' => $_SERVER['REQUEST_METHOD']
		),
		'csrf_token' => (isset($_REQUEST['token'])) ? $_REQUEST['token'] : ''
	);

	function classes($class){
		return require_once('class/'.$class.'.php');
		}


	spl_autoload_register('classes');


?>
