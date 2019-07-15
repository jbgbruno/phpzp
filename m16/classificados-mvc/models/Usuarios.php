<?php
class Usuarios  extends model{

  public function getTotalUsuarios(){

    $sql = $this->db->query('SELECT count(*) as u from usuarios');
    $sql->execute();
    $row = $sql->fetch();
    return $row['u'];
  }
  public function cadastrar($nome,$email,$senha,$telefone){

    $sql = $this->db->prepare('select id from usuarios where email = :email');
    $sql->bindValue(':email', $email);
    $sql->execute();
    if ($sql->rowCount() == 0){
      $sql = $this->db->prepare('insert into 
          usuarios set nome=:nome, email=:email, senha=:senha, telefone=:telefone'); 
      $sql->bindValue(':nome',$nome);
      $sql->bindValue(':email', $email);
      $sql->bindValue(':senha',md5($senha));
      $sql->bindValue(':telefone', $telefone);
      $sql->execute();
      return true;
    }else{
      return false;
    }
  }

  public function login($email, $senha){


    $sql = $this->db->prepare("select id from usuarios
       where email= :email and senha = :senha ");
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', md5($senha));
    $sql->execute();
    if($sql->rowCount() > 0){
      $dado = $sql->fetch();
      $_SESSION['cLogin']= $dado['id'];
      return true;
    }
    return false;
  }
} 