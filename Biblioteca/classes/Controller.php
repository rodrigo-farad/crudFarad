<?php

class Controller{
public $script;

function __construct()
{
    $this->script='';   
}
    public function load_scripts($script){
$this->script=$script;
    }

public function load_model($model){

    require_once '../Admin/Models/'.$model.'.php';

   $this->$model=new $model;   
}


public function  include($view,$dados=[]){



    $arquivo='../Admin/views/'.$view.'.php';

    if(file_exists($arquivo)){
     
    require_once $arquivo;
    
    }else{
    
        require_once '../Admin/views/pages/404.php';
    
    }

}






public function  view($view,$dados=[]){

$arquivo='../Admin/views/'.$view.'.php';

if(file_exists($arquivo)){



        require_once '../Admin/views/EstruturaHtml/cabecario.php';
        require_once '../Admin/views/EstruturaHtml/MenuEsquerdo.php';
        require_once '../Admin/views/EstruturaHtml/MenuSuperior.php';



        

        require_once $arquivo;
     $scripts= $this->script;
        require_once '../Admin/views/EstruturaHtml/rodape.php';
        



}else{

    require_once '../Admin/views/pages/404.php';

}

}





}