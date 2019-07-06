<?php
class Anuncios {
  public function getMeusAnuncios(){
    global $pdo;
    $array = [];
    $sql = $pdo->prepare('SELECT *,
      (select anuncios_imagens.url from anuncios_imagens 
        where anuncios_imagens.id_anuncio = anuncios.id 
        limit 1) as url from anuncios where id_usuario = :id_usuario');
    $sql->bindValue(':id_usuario', $_SESSION['cLogin']);
    $sql->execute();
    if($sql->rowCount() > 0){
      $array = $sql->fetchAll();
    }
    return $array;
  }  
  public function addAnuncio($titulo, $id_categoria,$valor, $descricao, $estado){
    global $pdo;
    $sql = $pdo->prepare(
      "INSERT INTO anuncios set titulo = :titulo, id_categoria=:id_categoria, id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado= :estado"
    );
    $sql->bindValue(':titulo',$titulo);
    $sql->bindValue(':id_categoria',$id_categoria);
    $sql->bindValue(':valor',$valor);
    $sql->bindValue(':descricao',$descricao);
    $sql->bindValue(':estado',$estado);
    $sql->bindValue(':id_usuario',$_SESSION['cLogin']);

    $sql->execute();
  }
}