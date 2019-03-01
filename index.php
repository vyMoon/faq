<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 1);

session_start(); 

spl_autoload_register(function ($class) {

	$dir = 'model/' . $class . '.php';
	if (file_exists($dir)) {
		require_once $dir;
	}

});

$Config = new Config;
$pdo = $Config->dbConnect;
$indexClass = new Index($pdo);
$indexClass->display();