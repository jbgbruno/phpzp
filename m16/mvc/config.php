<?php
require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development') {
  define("BASE_URL", "http://localhost/cursos/php-zp/m16/estrutura-mvc/");
  $config['dbname'] = 'curso-galeria';
  $config['host'] = 'localhost';
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
} else {
	define("BASE_URL", "http://meusite.com.br/");
	$config['dbname'] = 'estrutura_mvc';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}