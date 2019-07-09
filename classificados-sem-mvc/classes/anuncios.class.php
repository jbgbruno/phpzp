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
  public function getAnuncio($id)
  {
    global $pdo;
    $sql= $pdo->prepare('select * from anuncios where id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();
    $array = [];
    if($sql->rowCount() > 0){
      $array = $sql->fetch();
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
  public function editAnuncio($titulo, $id_categoria,$valor, $descricao, $estado, $id){
    global $pdo;
    $sql = $pdo->prepare(
      "UPDATE anuncios set titulo = :titulo, id_categoria=:id_categoria, id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado= :estado
      where id=:id"
    );
    $sql->bindValue(':titulo',$titulo);
    $sql->bindValue(':id_categoria',$id_categoria);
    $sql->bindValue(':valor',$valor);
    $sql->bindValue(':descricao',$descricao);
    $sql->bindValue(':estado',$estado);
    $sql->bindValue(':id_usuario',$_SESSION['cLogin']);
    $sql->bindValue(':id',$id);

    $sql->execute();
  }

  public function excluirAnuncio($id){
    global $pdo;
    $sql = $pdo->prepare('DELETE From anuncios_imagens where id_anuncio = :id_anuncio');
    $sql->bindValue(':id_anuncio', $id);
    $sql->execute();

    $sql = $pdo->prepare('DELETE From anuncios where id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();
  }
}