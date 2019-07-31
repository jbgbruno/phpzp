<?php
class galeriaController extends controller {
  public function index(){
   $dados = [
     'quant' => 129
   ]; 
   $this->loadTemplate('galeria',$dados);
  }
  public function abrir($id, $titulo){
    echo 'ID: '.$id."<br>";
    echo 'TITULO: '.$titulo."<br>";

  }
}