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

$sql = "select * from notificacoes where id_user = '1' and lido = '0'";
$sql = $db->query($sql);
$array = ['qt'=>0];
if($sql->rowCount() > 0 ){
 $array['qt'] = $sql->rowCount();
}
echo json_encode($array);
exit;