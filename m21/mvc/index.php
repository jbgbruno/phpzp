<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

require 'config.php';
require 'routers.php';
require __DIR__.'/vendor/autoload.php';
use \Core\Core;

$core = new Core();
$core->run();