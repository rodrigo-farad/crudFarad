
<?php
     
     
 class  login{

  public $crud;
                       // tabela  referencia

 
  
 function __construct(){
      

    
 }



public static function  valido(){


if(!isset($_SESSION['user'])){ 

  $formulario=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
  $cpf=filter_var(isset($formulario['cpf'])?$formulario['cpf']:'',FILTER_SANITIZE_SPECIAL_CHARS);
  $senha=filter_var(isset($formulario['senha'])?$formulario['senha']:'',FILTER_SANITIZE_SPECIAL_CHARS);

  $crud=new Crud;  

  $crud->sql("SELECT *FROM usuarios WHERE cpf='$cpf'");
  $users=$crud->get_hall();

  if(password_verify($senha, $users[0]['senha'])) {

      $crud->sql("SELECT *FROM permissoes WHERE idpermissoes=".$users[0]['permissoes_idpermissoes']." AND emitente_id=".$users[0]['emitente_id']);
      $permissoes=$crud->get_hall(); //permissoes

       $_SESSION['user']=['permissoes'=>$permissoes[0]['permissoes'],'idUsuarios'=>$users[0]['idUsuarios'],'nome'=>$users[0]['nome'],'email'=>$users[0]['email'],'emitente_id'=>$users[0]['emitente_id']];

      return true;
    }else{

      return false;
    }
    
  
}else{



}





}






public static function autorizacao($usuarios){
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
      if (in_array($_SESSION['tipo'], $usuarios)){
      return true;
      }else{

        false;
      }


}




 }



