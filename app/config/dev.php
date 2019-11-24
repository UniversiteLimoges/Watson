<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'mysql',  
    'port'     => '3306',
    'dbname'   => 'docker',
    'user'     => 'docker',
    'password' => 'docker'
);

// enable the debug mode
$app['debug'] = true;

// define log parameters
$app['monolog.level'] = 'INFO';
