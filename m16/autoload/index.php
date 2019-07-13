<?php 
spl_autoload_register(function($class){
  require 'classes/'.$class.'.php';
});
$c = new Cavalo();
$p = new Pessoa();
$p->andar();
echo ('<hr>');
$c->falar();