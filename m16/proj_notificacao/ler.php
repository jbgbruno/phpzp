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

$sql = "select * from notificacoes where id_user = '1'";
$sql = $db->query($sql);

if($sql->rowCount() > 0){
  foreach($sql->fetchAll() as $item){
    $propriedades = json_decode($item['propriedades']);
    echo 'tipo: '. $item['notificacao_tipo']. '<br>';
    print_r($propriedades);
    echo '<hr>';
  }
}
