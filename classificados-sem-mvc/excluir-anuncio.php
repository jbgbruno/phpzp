<?php 
require 'config.php';
if (empty($_SESSION['clogin'])){
  header('Location: login.php');
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_GET['id'])  && !empty($_GET['id'])){
  $a->excluirAnuncio($_GET['id']);
}
header('Location: meus-anuncios.php');