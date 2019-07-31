<fieldset>
<legend>Adicionar uma foto</legend>
<form action="" enctype="multipart/form-data" method="POST">
Titulo Foto:
<input type="text" name="titulo">
<br>
<br>
<input type="file" name="arquivo">
<br>
<br>
<input type="submit" value="Enviar Arquivo">
</form>
</fieldset>
<br>
<br>
<?php
foreach ($fotos as $foto) :

  ?>
  <img src="assets/images/galeria/<?php echo $foto['url']; ?>" border="0" width="300"><br>
  <?php echo $foto['titulo']; ?>
  <hr />
<?php
endforeach;
?>