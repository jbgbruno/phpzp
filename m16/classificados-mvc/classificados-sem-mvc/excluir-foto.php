<?php 
require 'config.php';
if (empty($_SESSION['clogin'])){
  header('Location: login.php');
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_GET['id'])  && !empty($_GET['id'])){
  $id_anuncio = $a->excluirFoto($_GET['id']);
}
if(isset($id_anuncio)){
  header('Location: editar-anuncio.php?id='.$id_anuncio);  
}else{
  header('Location: meus-anuncios.php');
}
