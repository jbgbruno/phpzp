<?php
if ($success = true):
  ?>
  <div class="alert alert-success" role="alert">
    <?php echo($mensagem_success); ?>
  </div>
  <script>
    setTimeout("location.href = '<?php echo($url_destino); ?>';",4000);

  </script>
<?php
else:
  ?>
  <div class="alert alert-success" role="alert">
    <?php echo($mensagem_error); ?>
  </div>
  <script>
    setTimeout("location.href = '<?php echo($url_destino); ?>';",4000);
  </script>

<?php
endif;
?>
