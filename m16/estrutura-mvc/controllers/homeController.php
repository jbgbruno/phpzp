<?php
class homeController extends controller {
  public function index()
  {
    $anuncios = new Anuncios();
    $usuarios = new Usuarios;
    $dados = [
      'nome'=>$usuarios->getNome(),
      'quantidade'=> $anuncios->getQuantidade(),
      'idade' => $usuarios->getIdade()  
    ];
    
    $this->loadTemplate('home', $dados);
  }
  public function teste($params)
  {
      var_dump($params);

  }
}