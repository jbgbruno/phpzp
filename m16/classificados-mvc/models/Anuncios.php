<?php
class Anuncios extends model
{
  public function getTotalAnuncios($filtros)
  {

    $filtrostring = ['1=1'];
    if (!empty($filtros['categoria'])) {
      $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
    }
    if (!empty($filtros['preco'])) {
      $filtrostring[] = 'anuncios.valor between :preco1 and :preco2';
    }
    if (!empty($filtros['estado'])) {
      $filtrostring[] = 'anuncios.estado = :estado';
    }
    $sql = $this->db->prepare('SELECT count(*) as c from anuncios where '.implode(' and ', $filtrostring));
    if (!empty($filtros['categoria'])) {
      $sql->bindValue(':id_categoria', $filtros['categoria']);
    }
    if (!empty($filtros['preco'])) {
      $preco = explode('-', $filtros['preco']);
      $sql->bindValue(':preco1', $preco[0]);
      $sql->bindValue(':preco2', $preco[1]);
    }
    if (!empty($filtros['estado'])) {
      $sql->bindValue(':estado', $filtros['estado']);
    }
    $sql->execute();
    $row = $sql->fetch();
    return $row['c'];
  }
  public function getUltimosAnuncios($page, $perPage, $filtros)
  {
    
    $offset = ($page - 1) * 2;
    $array = [];
    $filtrostring = ['1=1'];
    if (!empty($filtros['categoria'])) {
      $filtrostring[] = 'anuncios.id_categoria = :id_categoria';
    }
    if (!empty($filtros['preco'])) {
      $filtrostring[] = 'anuncios.valor between :preco1 and :preco2';
    }
    if (!empty($filtros['estado'])) {
      $filtrostring[] = 'anuncios.estado = :estado';
    }
    $sql = $this->db->prepare("SELECT *,
      (select anuncios_imagens.url from anuncios_imagens 
        where anuncios_imagens.id_anuncio = anuncios.id 
        limit 1) as url,
        (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria
         from anuncios 
         where " . implode(' and ', $filtrostring) . "
                  order by id desc limit $offset,$perPage");
    if (!empty($filtros['categoria'])) {
      $sql->bindValue(':id_categoria', $filtros['categoria']);
    }
    if (!empty($filtros['preco'])) {
      $preco = explode('-', $filtros['preco']);
      $sql->bindValue(':preco1', $preco[0]);
      $sql->bindValue(':preco2', $preco[1]);
    }
    if (!empty($filtros['estado'])) {
      $sql->bindValue(':estado', $filtros['estado']);
    }
    $sql->execute();
    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  public function getMeusAnuncios()
  {
    
    $array = [];
    $sql = $this->db->prepare('SELECT *,
      (select anuncios_imagens.url from anuncios_imagens 
        where anuncios_imagens.id_anuncio = anuncios.id 
        limit 1) as url from anuncios where id_usuario = :id_usuario');
    $sql->bindValue(':id_usuario', $_SESSION['cLogin']);
    $sql->execute();
    if ($sql->rowCount() > 0) {
      $array = $sql->fetchAll();
    }
    return $array;
  }
  public function getAnuncio($id)
  {
    
    $sql = $this->db->prepare('select *,
    (select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as categoria,
    (select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario) as telefone
    from anuncios where id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();
    $array = [];
    if ($sql->rowCount() > 0) {
      $array = $sql->fetch();
      $array['fotos'] = [];
      $sql = $this->db->prepare('select id,url from anuncios_imagens where id_anuncio = :id_anuncio');
      $sql->bindValue(':id_anuncio', $id);
      $sql->execute();
      if ($sql->rowCount() > 0) {
        $array['fotos'] = $sql->fetchAll();
      }
    }
    return $array;
  }
  public function addAnuncio($titulo, $id_categoria, $valor, $descricao, $estado)
  {
    
    $sql = $this->db->prepare(
      "INSERT INTO anuncios set titulo = :titulo, id_categoria=:id_categoria, id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado= :estado"
    );
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':id_categoria', $id_categoria);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':descricao', $descricao);
    $sql->bindValue(':estado', $estado);
    $sql->bindValue(':id_usuario', $_SESSION['cLogin']);

    $sql->execute();
  }
  public function editAnuncio($titulo, $id_categoria, $valor, $descricao, $estado, $fotos, $id)
  {
    
    $sql = $this->db->prepare(
      "UPDATE anuncios set titulo = :titulo, id_categoria=:id_categoria, id_usuario = :id_usuario, descricao = :descricao, valor = :valor, estado= :estado
      where id=:id"
    );
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':id_categoria', $id_categoria);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':descricao', $descricao);
    $sql->bindValue(':estado', $estado);
    $sql->bindValue(':id_usuario', $_SESSION['cLogin']);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if (count($fotos) > 0) {
      //percorre o array de fotos
      for ($q = 0; $q < count($fotos['tmp_name']); $q++) {
        $tipo = $fotos['type'][$q]; //pega o tipo da foto
        if (in_array($tipo, ['image/jpeg', 'image/png'])) {
          $tmpname = md5(time() . rand(0, 9999)) . '.jpg'; //cria um nome randomico para a foto
          move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/anuncios/' . $tmpname); //move a imagem para o diretorio de imagens do servidor
          list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/' . $tmpname); //pega o tamanho da imagem
          $ratio = $width_orig / $height_orig;
          $width = 500;
          $height = 500;
          if ($width / $height > $ratio) {
            $width = $height * $ratio;
          } else {
            $height = $width / $ratio;
          }
          $img = imagecreatetruecolor($width, $height);
          if ($tipo == 'image/jpeg') {
            $origi = imagecreatefromjpeg('assets/images/anuncios/' . $tmpname);
          } elseif ($tipo = 'image/png') {
            $origi = imagecreatefrompng('assets/images/anuncios/' . $tmpname);
          }
          imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
          imagejpeg($img, 'assets/images/anuncios/' . $tmpname, 80);

          $sql = $this->db->prepare('insert into anuncios_imagens set id_anuncio = :id_anuncio, url = :url');
          $sql->bindValue(':id_anuncio', $id);
          $sql->bindValue(':url', $tmpname);
          $sql->execute();
        }
      }
    }
  }

  public function excluirAnuncio($id)
  {

    $sql = $this->db->prepare('DELETE From anuncios_imagens where id_anuncio = :id_anuncio');
    $sql->bindValue(':id_anuncio', $id);
    $sql->execute();

    $sql = $this->db->prepare('DELETE From anuncios where id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();
  }
  public function excluirFoto($id)
  {

    $id_anuncio = 0;
    $sql = $this->db->prepare('select id_anuncio from anuncios_imagens where id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();
    if ($sql->rowCount() > 0) {
      $row = $sql->fetch();
      $id_anuncio = $row['id_anuncio'];
    }

    $sql = $this->db->prepare('DELETE From anuncios_imagens where id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();
    return $id_anuncio;
  }
}
