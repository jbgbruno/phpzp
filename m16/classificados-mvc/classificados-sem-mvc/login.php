<?php require 'pages/header.php'; ?>
<div class="container">
  <h1>Login</h1>
  <?php
  require 'classes/usuarios.class.php';
  $u = new Usuarios();
  if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($u->login($email, $senha)){
    ?>
    <script type="text/javascript">window.location.href="./"</script>
    <?php  
    }else{
    ?>
    <div class="alert alert-danger">
    Usuário e/ou Senha incorreto</div>
    <?php  
    }
    }
    ?>



    <form method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" />
      </div>
      <div class="form-group">
        <label for="">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senha" />
      </div>

      <input type="submit" value="Fazer Login" class="btn btn-default">

    </form>
  </div>

  <?php require 'pages/footer.php'; ?>