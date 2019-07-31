<?php
class Fotos extends model
{
  public function getFotos()
  {
    $array = [];
    $sql = 'Select * from fotos order by id desc';
    $sql = $this->db->query($sql);
    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }

  public function saveFotos()
  {
    if (isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['tmp_name'])) {
      $permitidos = [
        "image/jpeg",
        "image/jpg",
        "image/png"
      ];
      if (in_array($_FILES['arquivo']['type'], $permitidos)) {
        $nome = md5(time() . rand(0, 999)) . '.jpg';
        move_uploaded_file($_FILES['arquivo']['tmp_name'], 'assets/images/galeria/' . $nome);
        $titulo = '';
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
          $titulo = addslashes($_POST['titulo']);
         }
        $sql = "Insert into fotos set titulo ='$titulo', url='$nome'";
        $this->db->query($sql);
      }
    }
  }
}
