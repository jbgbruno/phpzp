
<div class="container">
  <h1>Cadastre-se</h1>



    <form action="<?php echo BASE_URL; ?>cadastrar/salvar" method="POST">
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
