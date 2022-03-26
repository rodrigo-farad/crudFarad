
<?php
     
     
 class  erros{

  
 
                       // tabela  referencia

 
  
 function __construct(){
      

        
 }



public static function  tryCatch($mensagem){
  
  $retorno=['mensagem'=>$mensagem,
  "CodigoErro"=>'999','sucesso'=>'danger'];
  return json_encode($retorno);

}
public static function  avisos($mensagem){
  
  $retorno=['mensagem'=>$mensagem,
  "CodigoErro"=>'222','sucesso'=>'warning','titulo'=>'Alerta!'];
  return json_encode($retorno);

}



 }



