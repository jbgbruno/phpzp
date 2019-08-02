<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
class homeController extends Controller {

	public function index() {
		$array = [
			'nome'=>'Bruno',
			'idade'=> '27'
		];
		$this->returnJson($array);
	
	}
	public function testando(){
		echo 'testando rota';
	}
	public function visualizar_usuarios($id){
		echo 'ID: '. $id;
	}

}