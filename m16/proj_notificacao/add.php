<?php
$config = [];
$config['dbname'] = 'notificacoes';
  $config['host'] = 'localhost';
  $config['dbuser'] = 'root';
  $config['dbpass'] = '';
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}
$prop = [
  'curtidor'=> '2',
  'id_foto'=> '123'
];

$sql = "insert into notificacoes (id_user,notificacao_tipo, propriedades, link) values (:id_user, :tipo, :prop, :link)";
$sql = $db->prepare($sql);
$sql->bindValue(':id_user', '1');
$sql->bindValue(':tipo', 'CURTIDA');
$sql->bindValue(':prop', json_encode($prop));
$sql->bindValue(':link', 'http://seusite.com/foto/123');
$sql->execute();
