
<?php
     
     



        class email {



public function enviarTokem($dadosArray) {

    $destino = $dadosArray['email'];
    $assunto = "Ativação da conta Lavajato";
  
    // É necessário indicar que o formato do e-mail é html
    $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: {$dadosArray['nome']} <teste@gmail.com>";

        $enviaremail = mail($destino, $assunto, $dadosArray['mensagem'], $headers);
        if($enviaremail){
        $mgm = "E-MAIL ENVIADO COM SUCESSO! PARA ({$dadosArray['email']}) <br> O link será enviado para o e-mail fornecido no formulário";
       
        } else {
        $mgm = "ERRO AO ENVIAR E-MAIL!";
        
        }

        return  $mgm;
}



public function enviarConfirmacaoCadastro($dadosArray) {


}


public function esqueciSenha($dadosArray) {



}



 public static function acesso($dados){


        try{

        $logins=self::getFichaArray("SELECT *FROM login WHERE tipo='GESTOR_GERAL' AND ativo='1'");

        foreach($logins as $linhas){
        
                $destino = $linhas['email'];
                $assunto = $dados['assunto'];
              
                // É necessário indicar que o formato do e-mail é html
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    $headers .= "From: {$linhas['nome']} <BankPoupe>";
            
                   // $enviaremail = mail($destino, $assunto, $dados['mensagem'], $headers);
               
                }
        
                }catch(PDOException $e){

                        //echo 'Exceção capturada: ',  $e->getMessage(), "\n";

}

        
    
           
}



public static function getFichaArray($sql){
        $banco=new banco;
    $banco->query($sql);
    $result=$banco->resultados();
    return $result;
    }



}

?>



