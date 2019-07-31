<?php
global $routes;
$routes = array();

// $routes['/cadastro/{nome}/{sobrenome}'] = '/usuarios/cadastrar/:nome/:sobrenome';
// $routes['/galeria/{id}'] = '/galeria/abrir/:id';
// $routes['/news/{titulo}'] = '/noticia/abrir/:titulo';
// $routes['/{titulo}'] = '/noticia/abrir/:titulo';


$routes['/galeria/{id}/{titulo}'] = '/galeria/abrir/:id/:titulo';
$routes['/news/{id}'] = '/noticia/abrir/:id';
//$routes['/{titulo}'] = '/noticia/abrirtitulo/:titulo';
