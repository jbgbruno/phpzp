<?php
class Categorias extends model
{
  public function getLista()
  {
    $array = [];

    $sql = $this->db->query("SELECT * from categorias");

    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
}
