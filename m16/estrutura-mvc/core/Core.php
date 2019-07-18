<?php
class Core {
  public function run(){
    //echo 'URL: '.$_GET['url'];
    
    $url = '/';
    if (isset($_GET['url'])){
      $url .= $_GET['url'];
    }
    $params=[];
    if(!empty($url)&& $url !='/'){
      $url = explode('/',$url);
      array_shift($url);
      $currentController = $url[0].'Controller';
      array_shift($url);
      if(isset($url[0]) && !empty($url[0])){
        $currentAction = $url[0];
        array_shift($url);
      }else{
        $currentAction = 'index';
      }
      if(count($url)> 0){
        $params = $url;
      }

    }else{
      $currentController = 'homeController';
      $currentAction = 'index';
    }

    if(!file_exists('controllers/'.$currentController.'.php') || !method_exists($currentController, $currentAction)){
      $currentController = 'notfoundController';
      $currentAction = 'index';
    }
    $c = new $currentController();
    call_user_func_array([$c,$currentAction], $params);



    // echo '<hr>';
    // echo "Controller: ".$currentController.'<br>';
    // echo "Action: ".$currentAction.'<br>';
    // echo "PARAMS: ".print_r($params,true) .'<br>';
  }
}