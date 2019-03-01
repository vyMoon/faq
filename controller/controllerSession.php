<?php

    session_start();

    spl_autoload_register(function ($class) {

        $dir = '../model/' . $class . '.php';
        if (file_exists($dir)) {
            require_once $dir;
        }
        
    });  

    $Config = new Config;
    $pdo = $Config->dbConnect;
    $ControllerSession = new ControllerSession($pdo);
    $ControllerSession->logout();