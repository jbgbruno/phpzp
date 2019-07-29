<?php
global $routes;
$routes = array();

$routes['/cadastro/{nome}/{sobrenome}'] = '/usuarios/cadastrar/:nome/:sobrenome';
$routes['/galeria/{id}'] = '/galeria/abrir/:id';
$routes['/news/{titulo}'] = '/noticia/abrir/:titulo';
$routes['/{titulo}'] = '/noticia/abrir/:titulo';
