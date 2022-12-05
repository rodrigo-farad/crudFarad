<?php

class Controller{
public $codeScript;
public function load_model($model){

    require_once '../Admin/Models/'.$model.'.php';

   $this->$model=new $model;  
   return  $this->$model;
}

public function load_scripts($script){
if(strlen($script)>5){
    $this->codeScript.="  ".$script;
}else{
    $this->codeScript=$script;
}
      

        }
    

public function load_service($service){

    $arquivo=  'biblioteca/service/'.$service.'.php';

   

   if (file_exists($arquivo)) {
       require_once $arquivo;
       $this->$service=new $service;   
      return $this->$service;
   }

}

public function load($biblioteca){

    $arquivo=  'biblioteca/load/'.$biblioteca.'.php';



   if (file_exists($arquivo)) {
    require_once $arquivo;
    $this->$service=new $service;   
    return $this->$service;
}


}









}