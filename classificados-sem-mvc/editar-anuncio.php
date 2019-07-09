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

  $a->editAnuncio($titulo, $categoria,$valor, $descricao, $estado, $_GET['id']);
  ?>
  <div class="alert alert-success">
    Produto Editado com Sucesso!
  </div> 
  <?php

}
if(isset($_GET['id']) && !empty($_GET['id'])){
  $info = $a->getAnuncio($_GET['id']);
}else {
?>
  <script>
    window.location.href = "meus-anuncios.php"
  </script>
<?php  
}
?>

<div class="container">
  <h1>Meus Anúncios - Editar Anúncio</h1>

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
          <option <?php echo ($info['id_categoria'] == $cat['id']? 'selected':'')?> value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="titulo">Titulo:</label>
      <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']?>">
    </div>
    <div class="form-group">
      <label for="valor">Valor:</label>
      <input type="text" name="valor" id="valor" class="form-control" value="<?php echo $info['valor']?>">
    </div>
    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control" rows="3"><?php echo $info['descricao']?></textarea>
    </div>
    <div class="form-group">
      <label for="estado">Estado de Conservação:</label>

      <select name="estado" id="estado" class="form-control">
        <option value='0' <?php echo ($info['estado'] == '0'? 'selected':'')?> >Ruim</option>
        <option value='1' <?php echo ($info['estado'] == '1'? 'selected':'')?>>Bom</option>
        <option value='2' <?php echo ($info['estado'] == '2'? 'selected':'')?>>Ótimo</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Salvar</button>

  </form>



</div>
<?php require 'pages/footer.php'; ?>