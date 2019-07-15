<?php require 'pages/header.php';
if (empty($_SESSION['cLogin'])) :
  ?>
  <script>
    window.location.href = "login.php"
  </script>
  <?php
  exit;
endif;
?>

<div class="container">
  <h1>Meus Anúncios</h1>
  <a href="add-anuncio.php" class="btn btn-default">Adicionar Anúncio</a>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Titulo</th>
        <th>Valor</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require 'classes/anuncios.class.php';
      $a = new Anuncios();
      $anuncios = $a->getMeusAnuncios();

      foreach ($anuncios as $anuncio) :
        ?>
        <tr>
          <td>
            <?php if (!empty($anuncio['url'])) : ?>
              <img src="assets/images/anuncios/<?php echo $anuncio['url'] ?>" height="50">
            <?php else : ?>
              <img src="assets/images/default.jpg" height="50">
            <?php endif; ?>
          </td>
          <td><?php echo $anuncio['titulo']; ?></td>
          <td>R$ <?php echo number_format($anuncio['valor'], 2); ?></td>
          <td>
            <a class="btn btn-default" href="editar-anuncio.php?id=<?php echo $anuncio['id']?>">Editar</a>
            <a class="btn btn-danger" href="excluir-anuncio.php?id=<?php echo $anuncio['id']?>">Excluir</a>
          </td>
        </tr>
      <?php
    endforeach;
    ?>

    </tbody>
  </table>

</div>
<?php require 'pages/footer.php'; ?>