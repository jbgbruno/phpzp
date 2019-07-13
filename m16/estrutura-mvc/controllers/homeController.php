<?php
class homeController {
  public function index($params)
  {
    echo 'voce esta na funcao index da home';
    echo ('<pre>');
    var_dump($params);
    echo ('</pre>');
  }
  public function teste()
  {
    echo 'voce esta na funcao teste da home';

  }
}