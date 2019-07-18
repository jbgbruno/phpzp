<?php


class loginController extends controller
{
  public function index(){
    $dados = [];

    $this->loadTemplate('login', $dados);
  }
  public function logar(){
    $dados = [];
    $u = new Usuarios();
    if (isset($_POST['email']) && !empty($_POST['email'])) {
      $email = addslashes($_POST['email']);
      $senha = addslashes($_POST['senha']);

      if($u->login($email, $senha)){
        header('Location: ' . BASE_URL);
        exit;
      }else{
        header('Location: ' . BASE_URL.'login');
        exit;
      }
    }
  }
  public function sair(){
    unset($_SESSION['cLogin']);
    header('Location: ' . BASE_URL);
    exit;
  }

}