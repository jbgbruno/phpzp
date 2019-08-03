<?php
session_start();
require 'config.php';
require 'routers.php';

require __DIR__.'/vendor/autoload.php';

use \Core\Core;

$core = new Core();
$core->run();