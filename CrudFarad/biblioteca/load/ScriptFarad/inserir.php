<?php

namespace cadastrarTabela;
require ('classeTabela.php');

$Insert=new tabela;
include_once('cmd/requests.php');
$where='where';






$explodido=explode(',',$Insert->proriedadeInputs['colunaVerific']);
foreach($explodido as $num){

    $where.=" {$valorescoluna[$num]}=:{$valorescoluna[$num]} and"; 


}

$size = strlen($where);
$where = substr($where,0, $size-3);





if($estilo=='form' or $estilo=='modal'){

     

      
    
       
    $verrifica=$Insert->registroDuplo($where,$explodido);  // função que verificará se á registro duplicado caso não vai fazer o cadastro chamando a função 'setCadastrar()'

    echo $verrifica;
    
}




if($estilo=='login'){


   
   echo $Insert->login($explodido,$where);



}








?>