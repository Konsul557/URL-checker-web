<?php
$driver = "mysql";
$host = "mariadb";
$un = "root";
$pass = "qwerty";
$db_name = "urldb";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

$pdo = new PDO("$driver:host=$host;dbname=$db_name", $un, $pass, $options);   //подключение к бд