<?php
class galeriaController extends controller {
  public function index(){
   $dados = [
     'quant' => 129
   ]; 
   $this->loadTemplate('galeria',$dados);
  }
}