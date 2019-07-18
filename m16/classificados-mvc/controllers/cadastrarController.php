<?php

class cadastrarController extends controller
{
  public function index()
  {
    $dados = [];
    $this->loadTemplate('cadastre-se', $dados);
  }

  public function salvar()
  {
    $dados = [];
    $u = new Usuarios();
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
      $nome = addslashes($_POST['nome']);
      $email = addslashes($_POST['email']);
      $senha = addslashes($_POST['senha']);
      $telefone = addslashes($_POST['telefone']);
      $dados['success'] = $u->cadastrar($nome, $email, $senha, $telefone);
      $dados['mensagem_success'] = 'Cadastro realizado com sucesso!';
      $dados['url_destino'] = BASE_URL;
      //header('Location: ' . BASE_URL);
      //exit;
      $this->loadTemplate('alerts', $dados);
    } else {
      header('Location: ' . BASE_URL);
      exit;
    }
  }
}