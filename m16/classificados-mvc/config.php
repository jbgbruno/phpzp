<?php

require 'environment.php';

$config = [];
if (ENVIRONMENT == 'development') {
  define("BASE_URL","http://localhost/cursos/php-zp/m16/classificados-mvc/");
  $config['dbname'] = 'classificados';
  $config['host'] = 'localhost';
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
} else {
  define("BASE_URL","http://meusite.com.br/");
  $config['dbname'] = 'classificados';
  $config['host'] = 'localhost';
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
}
global $db;
try { 
  $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
  echo "ERRO: " . $e->getMessage();
}
