<?php

class miniFuncoes{

    public $propriedadeCard;    // usado especificamene para a função card


    public  static  function formataCelular($numero){

        if(strlen($numero) == 10){
            $telNovo = substr_replace($numero, '(', 0, 0);
            $telNovo = substr_replace($telNovo, '9', 3, 0);
            $telNovo = substr_replace($telNovo, ')', 3, 0);
        }else{
            $telNovo = substr_replace($numero, '(', 0, 0);
            $telNovo = substr_replace($telNovo, ')', 3, 0);
        }
        return $telNovo;
 
}

        //retornos de arrays comparados, retorna entre dois array algo que tenham em comun
         // lembrando que tenham a mesmo nome de chave para comparacao
         public   static  function filtrar2ArrayComMesmoIndice($array1,$array2){ //arr
$valorRetorno=array();
foreach($array1 as $indiceArray1=>$valorArray1){

    foreach($array2  as $valorArray2){

       // $valorRetorno[]=$valorArray2; 

    if($valorArray1==$valorArray2){

        $valorRetorno[]=$valorArray2; 
        

  }
    }
        


}

return $valorRetorno;
    
}
static function limitarTexto($texto, $limite){
    $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
    return $texto;
}










 static function  validaCPF($cpfs) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpfs );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}

static function isCnpjValid($cnpj)
	 	{
			//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
			$j=0;
			for($i=0; $i<(strlen($cnpj)); $i++)
				{
					if(is_numeric($cnpj[$i]))
						{
							$num[$j]=$cnpj[$i];
							$j++;
						}
				}
			//Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
			if(count($num)!=14)
				{
					return false;
				}
			//Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
			if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0)
				{
					return false;
				}
			//Etapa 4: Calcula e compara o primeiro dígito verificador.
			else
				{
					$j=5;
					for($i=0; $i<4; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$j=9;
					for($i=4; $i<12; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[12])
						{
							return false;
						} 
				}
			//Etapa 5: Calcula e compara o segundo dígito verificador.
			if(!isset($isCnpjValid))
				{
					$j=6;
					for($i=0; $i<5; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);
					$j=9;
					for($i=5; $i<13; $i++)
						{
							$multiplica[$i]=$num[$i]*$j;
							$j--;
						}
					$soma = array_sum($multiplica);	
					$resto = $soma%11;			
					if($resto<2)
						{
							$dg=0;
						}
					else
						{
							$dg=11-$resto;
						}
					if($dg!=$num[13])
						{
							$isCnpjValid=false;
						}
					else
						{
							$isCnpjValid=true;
						}
				}
		
			//Etapa 6: Retorna o Resultado em um valor booleano.
			return $isCnpjValid;			
		}


static function limparCpf($cpf){

  return  $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

}





public static function protocolo(){

   return date('YmdHis');

}


public static function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}



}