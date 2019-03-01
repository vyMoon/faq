<?php

class Config
{

    public $config = [
        'host' => 'localhost',
        'dbname' => 'faq',
        'user' => 'root',
        'pass' => '' 
    ];
    // public $config = [
    //     'host' => 'localhost',
    //     'dbname' => 'apopov',
    //     'user' => 'apopov',
    //     'pass' => 'neto1813'
    // ];

    public $dbConnect;

    function __construct()
    {
        $config = $this->config;

        $this->dbConnect = new PDO(
            'mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8', 
            $config['user'], $config['pass']
        );

    }
    
}