<?php require 'pages/header.php'; ?>
<div class="container">
  <h1>Cadastre-se</h1>
  <?php
  require 'classes/usuarios.class.php';
  $u = new Usuarios();
  if (isset($_POST['nome']) && !empty($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $telefone = addslashes($_POST['telefone']);

    if (!empty($nome) && !empty($email) && !empty($senha)) {
      if ($u->cadastrar($nome, $email, $senha, $telefone)) {  ?>
        <div class="alert alert-success">
          Cadastrado com sucesso! <a href="login.php" class="alert-link">Faça o login agora</a>
        </div>
      <?php
      }else { ?>
          <div class="alert alert-warning">
            Este usuario ja existe! <a href="login.php" class="alert-link">Faça o login agora</a>
          </div>
      <?php
        }
      } else {
        ?>
        <div class="alert alert-warning">
          Preencha todos os campos!
        </div>
      <?php

      }
    }
    ?>



    <form method="POST">
      <div class="form-group">
        <label for="">Nome:</label>
        <input type="text" class="form-control" name="nome" id="nome" />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" />
      </div>
      <div class="form-group">
        <label for="">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha" />
      </div>
      <div class="form-group">
        <label for="">Telefone:</label>
        <input type="text" class="form-control" name="telefone" id="telefone" />
      </div>
      <input type="submit" value="Cadastrar" class="btn btn-default">

    </form>
  </div>

  <?php require 'pages/footer.php'; ?>