<?php require 'pages/header.php';
if (empty($_SESSION['cLogin'])) :
  ?>
  <script>
    window.location.href = "login.php"
  </script>
  <?php
  exit;
endif;


require 'classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
  $titulo = addslashes($_POST['titulo']);
  $categoria = addslashes($_POST['categoria']);
  $valor = addslashes($_POST['valor']);
  $descricao = addslashes($_POST['descricao']);
  $estado = addslashes($_POST['estado']);

  $a->addAnuncio($titulo, $categoria,$valor, $descricao, $estado);
  ?>
  <div class="alert alert-success">
    Produto Adicionado com Sucesso!
  </div> 
  <?php

}
?>

<div class="container">
  <h1>Meus Anúncios - Adicionar Anúncio</h1>

  <form action="" method="POST" enctype="multipart-form-data">
    <div class="form-group">
      <label for="">Categoria:</label>
      <select name="categoria" id="categoria" class="form-control">
        <?php
        require 'classes/categorias.class.php';
        $c = new Categorias();
        $categorias = $c->getLista();
        foreach ($categorias as $cat) :
          ?>
          <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="titulo">Titulo:</label>
      <input type="text" name="titulo" id="titulo" class="form-control">
    </div>
    <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="text" name="valor" id="valor" class="form-control">
    </div>
    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="estado">Estado de Conservação:</label>

      <select name="estado" id="estado" class="form-control">
        <option value='0'>Ruim</option>
        <option value='1'>Bom</option>
        <option value='2'>Ótimo</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default"> Adicionar</button>

  </form>



</div>
<?php require 'pages/footer.php'; ?>