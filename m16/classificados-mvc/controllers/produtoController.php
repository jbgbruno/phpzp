<?php
class produtoController extends controller{
  public function index(){

  }
  public function abrir($id){
    $a = new Anuncios();
    $u = new Usuarios();
   $dados = [];
    
    if ( !empty($id)) {
      $id = addslashes($id);
    } else {
      header('Location: '.BASE_URL);
      exit;
    }    
    $info = $a->getAnuncio($id);
    $dados['info'] = $info;
    $this->loadTemplate('produto', $dados);
  }
}