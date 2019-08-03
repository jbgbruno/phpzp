<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;
class homeController extends Controller {

	public function index() {
		$dados = array();
		$usuarios = new Usuarios();
		$dados['lista']= $usuarios->getAll();
		$this->loadTemplate('home', $dados);
	}

}