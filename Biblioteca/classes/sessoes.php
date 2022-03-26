<?php
     
     
class  sessoes extends Controller{

  
 
                       // tabela  referencia

 
  
      function __construct(){
        if (session_status() !== PHP_SESSION_ACTIVE) {
          session_start();
        }

       
 }




public  static function tempoSessao(){
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  $agora = date("Y-n-j H:i:s");
  $tempo_transcorrido = (strtotime($agora)-strtotime($_SESSION["ultimoAcesso"]));
return $tempo_transcorrido;
}




public static function validaSessao(){
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  $sessao=isset($_SESSION["ok"])?$_SESSION["ok"]:'';
  
  if($sessao=='ok'){

    if(self::tempoSessao()>10000){
      session_unset();
      session_destroy();
      return false;
    }else{
      $_SESSION["ultimoAcesso"]=date("Y-n-j H:i:s");
      return true;
    }


  }else{
session_unset();
return false;
  }


}


 function deslogar(){
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  session_unset();
  session_destroy();
  $valores=['mensagem'=>"Você foi deslogado","titulo"=>"Deslogado","sucesso"=>"sucesso"];

  return $this->include('pages/login',$valores); 
}





public  static function CSRF(){
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  $rand=rand(5, 15).rand(5, 15).rand(5, 15);

$_SESSION['CSRF']=$rand;

}




public static function session($nome,$valor=null){

  if(is_null($valor)){
return $_SESSION[$nome];
  }else{

    $_SESSION[$nome]=$valor;
  }
  
}








}

?>



