<div class="container">
  <h1>Login</h1>

  <form method="POST" action="<?php echo BASE_URL?>login/logar">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email"/>
    </div>
    <div class="form-group">
      <label for="">Senha:</label>
      <input type="password" class="form-control" name="senha" id="senha"/>
    </div>
    <input type="submit" value="Fazer Login" class="btn btn-default">

  </form>
</div>

